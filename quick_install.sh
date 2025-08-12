#!/bin/bash

# Script de instalación rápida para Batch Record
# Se puede copiar a cualquier directorio y ejecutar
# Uso: ./quick_install.sh [password_db]

# Colores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
CYAN='\033[0;36m'
NC='\033[0m' # No Color

print_message() {
    echo -e "${GREEN}[INFO]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

print_header() {
    echo -e "${BLUE}================================${NC}"
    echo -e "${BLUE}  INSTALACIÓN RÁPIDA BATCH RECORD${NC}"
    echo -e "${BLUE}================================${NC}"
}

print_step() {
    echo -e "${CYAN}[STEP]${NC} $1"
}

# Obtener el directorio actual
CURRENT_DIR=$(pwd)
DIR_NAME=$(basename "$CURRENT_DIR")

# Configuración
APP_PATH="/$DIR_NAME"
DEFAULT_PORT="8580"
DEFAULT_DB_PASSWORD="batch_record_$(date +%Y%m%d)"
DB_PASSWORD=${1:-$DEFAULT_DB_PASSWORD}

print_header
print_message "Instalando Batch Record en: $CURRENT_DIR"
print_step "Ruta de aplicación: $APP_PATH"
print_step "Puerto: $DEFAULT_PORT"
print_step "Contraseña DB: $DB_PASSWORD"
echo ""

# Verificar si estamos en el directorio correcto
if [ ! -f "index.php" ]; then
    print_error "No se encontró index.php en el directorio actual"
    print_error "Asegúrate de estar en el directorio raíz de Batch Record"
    exit 1
fi

# Verificar Docker
if ! command -v docker &> /dev/null; then
    print_error "Docker no está instalado. Instálalo primero."
    exit 1
fi

if ! command -v docker-compose &> /dev/null; then
    print_error "Docker Compose no está instalado. Instálalo primero."
    exit 1
fi

print_message "Docker y Docker Compose verificados ✅"

# Crear archivos de configuración si no existen
print_step "Creando archivos de configuración..."

# Crear .env
cat > .env << EOF
# Configuración del entorno
APP_ENV=production

# Configuración de la base de datos
DB_HOST=mysql
DB_NAME=batch_record
DB_USER=root
DB_PASSWORD=

# Configuración de la aplicación
APP_URL=http://localhost:$DEFAULT_PORT
APP_PATH=$APP_PATH

# Configuración de logs
LOG_LEVEL=info
LOG_PATH=/var/www/html/logs
EOF

# Crear Dockerfile si no existe
if [ ! -f "Dockerfile" ]; then
    cat > Dockerfile << 'EOF'
FROM php:8.1-apache

# Instalar extensiones PHP necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_mysql mysqli

# Habilitar mod_rewrite para Apache
RUN a2enmod rewrite

# Configurar el directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos de la aplicación
COPY . /var/www/html/

# Configurar permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Exponer puerto 8580
EXPOSE 8580

# Cambiar el puerto de Apache a 8580
RUN sed -i 's/Listen 80/Listen 8580/' /etc/apache2/ports.conf \
    && sed -i 's/<VirtualHost \*:80>/<VirtualHost *:8580>/' /etc/apache2/sites-available/000-default.conf

# Comando para iniciar Apache
CMD ["apache2-foreground"]
EOF
fi

# Crear docker-compose.yml si no existe
if [ ! -f "docker-compose.yml" ]; then
    cat > docker-compose.yml << EOF
version: '3.8'

services:
  # Servicio de la aplicación PHP
  app:
    build: .
    container_name: batch_record_app
    ports:
      - "$DEFAULT_PORT:8580"
    volumes:
      - ./:/var/www/html
      - ./logs:/var/www/html/logs
    environment:
      - APP_ENV=production
      - DB_HOST=mysql
      - DB_NAME=batch_record
      - DB_USER=root
      - DB_PASSWORD=
    depends_on:
      - mysql
    networks:
      - batch_record_network
    restart: unless-stopped

  # Servicio de MySQL
  mysql:
    image: mysql:8.0
    container_name: batch_record_mysql
    ports:
      - "3306:3306"
    environment:
      - MYSQL_ROOT_PASSWORD=
      - MYSQL_DATABASE=batch_record
      - MYSQL_USER=batch_user
      - MYSQL_PASSWORD=
    volumes:
      - mysql_data:/var/lib/mysql
      - ./db:/docker-entrypoint-initdb.d
    networks:
      - batch_record_network
    restart: unless-stopped
    command: --default-authentication-plugin=mysql_native_password

  # Servicio de phpMyAdmin
  phpmyadmin:
    image: phpmyadmin/phpmyadmin
    container_name: batch_record_phpmyadmin
    ports:
      - "8080:80"
    environment:
      - PMA_HOST=mysql
      - PMA_PORT=3306
      - PMA_USER=root
      - PMA_PASSWORD=
    depends_on:
      - mysql
    networks:
      - batch_record_network
    restart: unless-stopped

volumes:
  mysql_data:

networks:
  batch_record_network:
    driver: bridge
EOF
fi

# Crear directorios necesarios
mkdir -p logs
mkdir -p db

# Verificar si existe el archivo de base de datos
if [ ! -f "db/batch_record.sql" ]; then
    print_warning "No se encontró db/batch_record.sql"
    print_message "La base de datos se creará automáticamente si no existe"
fi

print_message "Archivos de configuración creados ✅"

# Detener contenedores existentes
print_step "Deteniendo contenedores existentes..."
docker-compose down 2>/dev/null || true

# Construir y levantar contenedores
print_step "Construyendo y levantando contenedores..."
docker-compose up -d --build

# Esperar a que MySQL esté listo
print_step "Esperando a que MySQL esté listo..."
sleep 30

# Verificar estado
print_step "Verificando estado de los contenedores..."
if docker-compose ps | grep -q "Up"; then
    print_message "Contenedores iniciados correctamente ✅"
else
    print_error "Error al iniciar contenedores"
    docker-compose logs
    exit 1
fi

# Crear script de gestión
cat > manage.sh << 'EOF'
#!/bin/bash

# Script de gestión para Batch Record
case "$1" in
    start)
        docker-compose up -d
        echo "✅ Aplicación iniciada"
        ;;
    stop)
        docker-compose down
        echo "✅ Aplicación detenida"
        ;;
    restart)
        docker-compose restart
        echo "✅ Aplicación reiniciada"
        ;;
    logs)
        docker-compose logs -f
        ;;
    status)
        docker-compose ps
        ;;
    *)
        echo "Uso: $0 {start|stop|restart|logs|status}"
        exit 1
        ;;
esac
EOF

chmod +x manage.sh

# Mostrar información final
echo ""
print_message "=== INSTALACIÓN COMPLETADA ==="
echo ""
echo -e "${GREEN}✅ Batch Record instalado en: $CURRENT_DIR${NC}"
echo ""
echo -e "${BLUE}📋 Información de acceso:${NC}"
echo "  • Aplicación principal: http://localhost:$DEFAULT_PORT$APP_PATH"
echo "  • phpMyAdmin: http://localhost:8080"
echo ""
echo -e "${BLUE}🔧 Comandos de gestión:${NC}"
echo "  • Iniciar: ./manage.sh start"
echo "  • Detener: ./manage.sh stop"
echo "  • Reiniciar: ./manage.sh restart"
echo "  • Ver logs: ./manage.sh logs"
echo "  • Estado: ./manage.sh status"
echo ""
echo -e "${BLUE}🔐 Credenciales:${NC}"
echo "  • Usuario: root"
echo "  • Contraseña: (sin contraseña)"
echo "  • Base de datos: batch_record"
echo ""
print_warning "⚠️  IMPORTANTE: Asegúrate de que tu base de datos esté configurada correctamente"
print_message "🎉 ¡La instalación está lista!" 