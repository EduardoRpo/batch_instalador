#!/bin/bash

# Instalador Universal para Batch Record
# Detecta automáticamente el directorio y configura todo
# Uso: ./auto_install.sh [password_db]

# Colores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
CYAN='\033[0;36m'
NC='\033[0m' # No Color

# Función para mostrar mensajes
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
    echo -e "${BLUE}========================================${NC}"
    echo -e "${BLUE}  INSTALADOR UNIVERSAL BATCH RECORD${NC}"
    echo -e "${BLUE}========================================${NC}"
}

print_step() {
    echo -e "${CYAN}[STEP]${NC} $1"
}

# Obtener el directorio actual donde se ejecuta el script
CURRENT_DIR=$(pwd)
SCRIPT_DIR=$(dirname "$(readlink -f "$0")")

# Si el script se ejecuta desde otro directorio, cambiar a ese directorio
if [ "$CURRENT_DIR" != "$SCRIPT_DIR" ]; then
    print_warning "Ejecutando desde directorio diferente: $CURRENT_DIR"
    print_message "Cambiando al directorio del script: $SCRIPT_DIR"
    cd "$SCRIPT_DIR"
fi

# Obtener la ruta relativa desde la raíz del servidor web
# Asumimos que está en /var/www/html o similar
WEB_ROOT="/var/www/html"
if [[ "$SCRIPT_DIR" == *"$WEB_ROOT"* ]]; then
    # Extraer la ruta relativa desde la raíz web
    APP_PATH="/${SCRIPT_DIR#$WEB_ROOT}"
else
    # Si no está en la raíz web estándar, usar el nombre del directorio
    APP_PATH="/$(basename "$SCRIPT_DIR")"
fi

# Configuración por defecto
DEFAULT_PORT="8580"
DEFAULT_DB_PASSWORD="batch_record_$(date +%Y%m%d)"

# Obtener parámetros
DB_PASSWORD=${1:-$DEFAULT_DB_PASSWORD}

print_header
print_message "Detectando configuración automáticamente..."
echo ""
print_step "Directorio actual: $SCRIPT_DIR"
print_step "Ruta de aplicación: $APP_PATH"
print_step "Puerto: $DEFAULT_PORT"
print_step "Contraseña DB: $DB_PASSWORD"
echo ""

# Verificar requisitos
print_step "Verificando requisitos del sistema..."

# Verificar si Docker está instalado
if ! command -v docker &> /dev/null; then
    print_error "Docker no está instalado."
    echo "Instalando Docker..."
    
    # Detectar sistema operativo
    if command -v apt-get &> /dev/null; then
        # Ubuntu/Debian
        sudo apt-get update
        sudo apt-get install -y docker.io docker-compose
        sudo systemctl start docker
        sudo systemctl enable docker
        sudo usermod -aG docker $USER
        print_message "Docker instalado en Ubuntu/Debian"
    elif command -v yum &> /dev/null; then
        # CentOS/RHEL
        sudo yum install -y docker docker-compose
        sudo systemctl start docker
        sudo systemctl enable docker
        sudo usermod -aG docker $USER
        print_message "Docker instalado en CentOS/RHEL"
    else
        print_error "No se pudo instalar Docker automáticamente. Instálalo manualmente."
        exit 1
    fi
else
    print_message "Docker ya está instalado ✅"
fi

# Verificar si Docker Compose está instalado
if ! command -v docker-compose &> /dev/null; then
    print_error "Docker Compose no está instalado."
    echo "Instalando Docker Compose..."
    
    # Instalar Docker Compose
    sudo curl -L "https://github.com/docker/compose/releases/latest/download/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
    sudo chmod +x /usr/local/bin/docker-compose
    print_message "Docker Compose instalado ✅"
else
    print_message "Docker Compose ya está instalado ✅"
fi

# Crear directorio de logs
print_step "Creando directorios necesarios..."
mkdir -p logs
mkdir -p db
print_message "Directorios creados ✅"

# Configurar variables de entorno
print_step "Configurando variables de entorno..."
cat > .env << EOF
# Configuración del entorno
APP_ENV=production

# Configuración de la base de datos
DB_HOST=mysql
DB_NAME=batch_record
DB_USER=root
DB_PASSWORD=$DB_PASSWORD

# Configuración de la aplicación
APP_URL=http://localhost:$DEFAULT_PORT
APP_PATH=$APP_PATH

# Configuración de logs
LOG_LEVEL=info
LOG_PATH=/var/www/html/logs
EOF

print_message "Archivo .env creado ✅"

# Configurar apache.conf con la ruta dinámica
print_step "Configurando Apache..."
sed -i "s|\${APP_PATH}|$APP_PATH|g" apache.conf
print_message "Apache configurado ✅"

# Configurar docker-compose.yml
print_step "Configurando Docker Compose..."
sed -i "s|8580:8580|$DEFAULT_PORT:8580|g" docker-compose.yml
sed -i "s|your_password_here||g" docker-compose.yml
print_message "Docker Compose configurado ✅"

# Verificar si existe el archivo de base de datos
if [ ! -f "db/batch_record.sql" ]; then
    print_warning "No se encontró db/batch_record.sql"
    print_message "La base de datos se creará automáticamente si no existe"
fi

# Detener contenedores existentes
print_step "Deteniendo contenedores existentes..."
docker-compose down 2>/dev/null || true

# Construir y levantar contenedores
print_step "Construyendo y levantando contenedores..."
docker-compose up -d --build

# Esperar a que MySQL esté listo
print_step "Esperando a que MySQL esté listo..."
for i in {1..60}; do
    if docker-compose exec mysql mysqladmin ping -h localhost -u root --silent 2>/dev/null; then
        print_message "MySQL está listo ✅"
        break
    fi
    echo -n "."
    sleep 1
    if [ $i -eq 60 ]; then
        print_warning "MySQL tardó en iniciar, continuando..."
    fi
done

# Verificar el estado de los contenedores
print_step "Verificando estado de los contenedores..."
if docker-compose ps | grep -q "Up"; then
    print_message "Contenedores iniciados correctamente ✅"
else
    print_error "Error al iniciar contenedores"
    docker-compose logs
    exit 1
fi

# Crear script de gestión
print_step "Creando script de gestión..."
cat > manage.sh << EOF
#!/bin/bash

# Script de gestión para Batch Record
# Uso: ./manage.sh [start|stop|restart|logs|status]

case "\$1" in
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
        echo "Uso: \$0 {start|stop|restart|logs|status}"
        exit 1
        ;;
esac
EOF

chmod +x manage.sh
print_message "Script de gestión creado ✅"

# Mostrar información final
echo ""
print_message "=== INSTALACIÓN COMPLETADA EXITOSAMENTE ==="
echo ""
echo -e "${GREEN}✅ Batch Record instalado en: $SCRIPT_DIR${NC}"
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
echo -e "${BLUE}🔐 Credenciales de base de datos:${NC}"
echo "  • Usuario: root"
echo "  • Contraseña: $DB_PASSWORD"
echo "  • Base de datos: batch_record"
echo ""
echo -e "${BLUE}📁 Archivos importantes:${NC}"
echo "  • Configuración: .env"
echo "  • Logs: logs/"
echo "  • Base de datos: db/"
echo ""
print_warning "⚠️  IMPORTANTE: Asegúrate de que tu base de datos esté configurada correctamente"
echo ""
print_message "🎉 ¡La instalación está lista para usar!" 