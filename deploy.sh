#!/bin/bash

# Script de despliegue para Batch Record en Linux con Docker

echo "=== Despliegue de Batch Record ==="

# Verificar si Docker está instalado
if ! command -v docker &> /dev/null; then
    echo "Error: Docker no está instalado"
    exit 1
fi

# Verificar si Docker Compose está instalado
if ! command -v docker-compose &> /dev/null; then
    echo "Error: Docker Compose no está instalado"
    exit 1
fi

# Crear directorio de logs si no existe
mkdir -p logs

# Detener contenedores existentes
echo "Deteniendo contenedores existentes..."
docker-compose down

# Construir y levantar los contenedores
echo "Construyendo y levantando contenedores..."
docker-compose up -d --build

# Esperar a que MySQL esté listo
echo "Esperando a que MySQL esté listo..."
sleep 30

# Verificar el estado de los contenedores
echo "Verificando estado de los contenedores..."
docker-compose ps

echo "=== Despliegue completado ==="
echo "La aplicación estará disponible en: http://localhost:8580/ruta/nueva/pdn/linux"
echo "⚠️  Si instalaste en una ruta diferente, ejecuta: ./change_path.sh <tu_ruta>"
echo "phpMyAdmin estará disponible en: http://localhost:8080" 