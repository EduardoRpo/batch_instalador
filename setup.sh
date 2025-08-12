#!/bin/bash

# Script de configuración interactiva para Batch Record

# Colores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
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
    echo -e "${BLUE}  CONFIGURADOR BATCH RECORD${NC}"
    echo -e "${BLUE}================================${NC}"
}

print_header

# Solicitar configuración al usuario
echo ""
print_message "Configuración de la instalación"
echo ""

# Ruta de instalación
read -p "Ruta de instalación [/ruta/nueva/pdn/linux]: " APP_PATH
APP_PATH=${APP_PATH:-"/ruta/nueva/pdn/linux"}

# Puerto
read -p "Puerto de la aplicación [8580]: " APP_PORT
APP_PORT=${APP_PORT:-"8580"}

# Contraseña de base de datos
read -s -p "Contraseña de la base de datos [batch_record_2024]: " DB_PASSWORD
echo ""
DB_PASSWORD=${DB_PASSWORD:-"batch_record_2024"}

# Confirmar configuración
echo ""
print_message "Resumen de la configuración:"
echo "  • Ruta: $APP_PATH"
echo "  • Puerto: $APP_PORT"
echo "  • Contraseña DB: $DB_PASSWORD"
echo ""

read -p "¿Continuar con esta configuración? (y/N): " CONFIRM
if [[ ! $CONFIRM =~ ^[Yy]$ ]]; then
    print_warning "Instalación cancelada"
    exit 0
fi

# Ejecutar instalación con los parámetros
print_message "Iniciando instalación..."
./install.sh "$APP_PATH" "$APP_PORT" "$DB_PASSWORD" 