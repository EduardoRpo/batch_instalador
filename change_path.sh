#!/bin/bash

# Script para cambiar la ruta de instalación del proyecto

if [ $# -eq 0 ]; then
    echo "Uso: $0 <nueva_ruta>"
    echo "Ejemplo: $0 /mi/nueva/ruta"
    exit 1
fi

NEW_PATH=$1

echo "=== Cambiando ruta de instalación a: $NEW_PATH ==="

# Cambiar en apache.conf
sed -i "s|/ruta/nueva/pdn/linux|$NEW_PATH|g" apache.conf

# Cambiar en env.example
sed -i "s|/ruta/nueva/pdn/linux|$NEW_PATH|g" env.example

# Cambiar en README_DEPLOY.md
sed -i "s|/ruta/nueva/pdn/linux|$NEW_PATH|g" README_DEPLOY.md

# Cambiar en deploy.sh
sed -i "s|/ruta/nueva/pdn/linux|$NEW_PATH|g" deploy.sh

echo "✅ Ruta cambiada exitosamente a: $NEW_PATH"
echo "📝 Recuerda actualizar tu archivo .env con la nueva ruta:"
echo "   APP_PATH=$NEW_PATH" 