#!/bin/bash

# Script de instalación automatizada para Batch Record
# Uso: ./install.sh [ruta_instalacion] [puerto] [password_db]

# Colores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
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
    echo -e "${BLUE}================================${NC}"
    echo -e "${BLUE}  INSTALADOR BATCH RECORD${NC}"
    echo -e "${BLUE}================================${NC}"
}

# Valores por defecto
DEFAULT_PATH="/ruta/nueva/pdn/linux"
DEFAULT_PORT="8580"
DEFAULT_DB_PASSWORD="batch_record_2024"

# Obtener parámetros
APP_PATH=${1:-$DEFAULT_PATH}
APP_PORT=${2:-$DEFAULT_PORT}
DB_PASSWORD=${3:-$DEFAULT_DB_PASSWORD}

print_header
print_message "Configurando instalación con los siguientes parámetros:"
echo "  • Ruta de instalación: $APP_PATH"
echo "  • Puerto: $APP_PORT"
echo "  • Contraseña DB: $DB_PASSWORD"
echo ""

# Verificar si Docker está instalado
if ! command -v docker &> /dev/null; then
    print_error "Docker no está instalado. Por favor instala Docker primero."
    exit 1
fi

# Verificar si Docker Compose está instalado
if ! command -v docker-compose &> /dev/null; then
    print_error "Docker Compose no está instalado. Por favor instala Docker Compose primero."
    exit 1
fi

print_message "Verificando requisitos... ✅"

# Crear directorio de logs
mkdir -p logs

# Configurar variables de entorno
print_message "Configurando variables de entorno..."
cat > .env << EOF
# Configuración del entorno
APP_ENV=production

# Configuración de la base de datos
DB_HOST=mysql
DB_NAME=batch_record
DB_USER=root
DB_PASSWORD=$DB_PASSWORD

# Configuración de la aplicación
APP_URL=http://localhost:$APP_PORT
APP_PATH=$APP_PATH

# Configuración de logs
LOG_LEVEL=info
LOG_PATH=/var/www/html/logs
EOF

print_message "Archivo .env creado ✅"

# Configurar apache.conf con la ruta dinámica
print_message "Configurando Apache..."
sed -i "s|\${APP_PATH}|$APP_PATH|g" apache.conf
print_message "Apache configurado ✅"

# Configurar docker-compose.yml con el puerto dinámico
print_message "Configurando Docker Compose..."
sed -i "s|8580:8580|$APP_PORT:8580|g" docker-compose.yml
sed -i "s|your_password_here|$DB_PASSWORD|g" docker-compose.yml
print_message "Docker Compose configurado ✅"

# Detener contenedores existentes si los hay
print_message "Deteniendo contenedores existentes..."
docker-compose down 2>/dev/null || true

# Construir y levantar contenedores
print_message "Construyendo y levantando contenedores..."
docker-compose up -d --build

# Esperar a que MySQL esté listo
print_message "Esperando a que MySQL esté listo..."
sleep 30

# Verificar el estado de los contenedores
print_message "Verificando estado de los contenedores..."
if docker-compose ps | grep -q "Up"; then
    print_message "Contenedores iniciados correctamente ✅"
else
    print_error "Error al iniciar contenedores"
    docker-compose logs
    exit 1
fi

# Mostrar información final
echo ""
print_message "=== INSTALACIÓN COMPLETADA ==="
echo ""
echo -e "${GREEN}✅ Aplicación instalada exitosamente${NC}"
echo ""
echo -e "${BLUE}📋 Información de acceso:${NC}"
echo "  • Aplicación principal: http://localhost:$APP_PORT$APP_PATH"
echo "  • phpMyAdmin: http://localhost:8080"
echo ""
echo -e "${BLUE}🔧 Comandos útiles:${NC}"
echo "  • Ver logs: docker-compose logs app"
echo "  • Detener: docker-compose down"
echo "  • Reiniciar: docker-compose restart"
echo ""
echo -e "${BLUE}🔐 Credenciales de base de datos:${NC}"
echo "  • Usuario: root"
echo "  • Contraseña: $DB_PASSWORD"
echo "  • Base de datos: batch_record"
echo ""
print_warning "Recuerda cambiar la contraseña de la base de datos en producción" 