#!/bin/bash

# Script para configurar el nuevo repositorio de GitHub
# Uso: ./setup_git.sh

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
    echo -e "${BLUE}  CONFIGURACIÓN DE GIT REPOSITORIO${NC}"
    echo -e "${BLUE}================================${NC}"
}

print_step() {
    echo -e "${BLUE}[STEP]${NC} $1"
}

print_header

# Verificar si Git está instalado
if ! command -v git &> /dev/null; then
    print_error "Git no está instalado. Instálalo primero."
    exit 1
fi

print_message "Git verificado ✅"

# Verificar si ya existe un repositorio Git
if [ -d ".git" ]; then
    print_warning "Ya existe un repositorio Git en este directorio"
    print_message "Eliminando configuración anterior..."
    
    # Eliminar configuración de remotes anteriores
    git remote remove origin 2>/dev/null || true
    git remote remove upstream 2>/dev/null || true
    
    print_message "Configuración anterior eliminada ✅"
else
    print_step "Inicializando nuevo repositorio Git..."
    git init
    print_message "Repositorio Git inicializado ✅"
fi

# Crear .gitignore si no existe
if [ ! -f ".gitignore" ]; then
    print_step "Creando archivo .gitignore..."
    cat > .gitignore << 'EOF'
# Archivos de sistema
.DS_Store
Thumbs.db
desktop.ini

# Archivos de IDE
.vscode/
.idea/
*.swp
*.swo
*~

# Archivos de log
*.log
logs/

# Archivos temporales
*.tmp
*.temp
*.bak
*.backup

# Archivos de configuración local
.env
.env.local
.env.production

# Archivos de Docker
docker-compose.override.yml

# Archivos de base de datos
*.sqlite
*.db

# Archivos de cache
cache/
tmp/

# Archivos de vendor (si usas Composer)
vendor/

# Archivos de node_modules (si usas npm)
node_modules/

# Archivos de build
dist/
build/

# Archivos de backup de configuración
*.conf.bak
*.config.bak
EOF
    print_message "Archivo .gitignore creado ✅"
fi

# Agregar todos los archivos
print_step "Agregando archivos al repositorio..."
git add .

# Hacer el primer commit
print_step "Haciendo primer commit..."
git commit -m "Initial commit: Batch Record Docker Installer

- Scripts de instalación automática (auto_install.sh, quick_install.sh)
- Configuración Docker completa
- Base de datos configurada sin contraseña
- Documentación completa
- Configuración Apache para puerto 8580"

print_message "Primer commit realizado ✅"

# Configurar la rama principal como main
print_step "Configurando rama principal..."
git branch -M main

# Agregar el nuevo repositorio remoto
print_step "Configurando repositorio remoto..."
git remote add origin https://github.com/EduardoRpo/batch_instalador.git

print_message "Repositorio remoto configurado ✅"

# Mostrar información final
echo ""
print_message "=== CONFIGURACIÓN COMPLETADA ==="
echo ""
echo -e "${GREEN}✅ Repositorio configurado correctamente${NC}"
echo ""
echo -e "${BLUE}📋 Próximos pasos:${NC}"
echo "  1. Verificar la configuración:"
echo "     git remote -v"
echo ""
echo "  2. Subir al repositorio:"
echo "     git push -u origin main"
echo ""
echo "  3. Verificar en GitHub:"
echo "     https://github.com/EduardoRpo/batch_instalador"
echo ""
print_warning "⚠️  IMPORTANTE: Ejecuta 'git push -u origin main' para subir el código"
echo ""
print_message "🎉 ¡Listo para subir al nuevo repositorio!" 