#!/bin/bash

# Instalador Inteligente para Batch Record
# Valida instalaciones existentes y configura de forma no intrusiva
# Uso: ./smart_install.sh [password_db]

# Colores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
CYAN='\033[0;36m'
PURPLE='\033[0;35m'
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
    echo -e "${BLUE}  INSTALADOR INTELIGENTE BATCH RECORD${NC}"
    echo -e "${BLUE}========================================${NC}"
}

print_step() {
    echo -e "${CYAN}[STEP]${NC} $1"
}

print_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

print_info() {
    echo -e "${PURPLE}[DETAIL]${NC} $1"
}

# Función para verificar si un comando existe
command_exists() {
    command -v "$1" >/dev/null 2>&1
}

# Función para obtener versión de Docker
get_docker_version() {
    if command_exists docker; then
        docker --version | cut -d' ' -f3 | cut -d',' -f1
    else
        echo "no_installed"
    fi
}

# Función para obtener versión de Docker Compose
get_compose_version() {
    if command_exists docker-compose; then
        docker-compose --version | cut -d' ' -f3 | cut -d',' -f1
    elif command_exists docker; then
        # Verificar si es Docker Compose V2
        if docker compose version >/dev/null 2>&1; then
            docker compose version | cut -d' ' -f4 | cut -d',' -f1
        else
            echo "no_installed"
        fi
    else
        echo "no_installed"
    fi
}

# Función para verificar permisos de Docker
check_docker_permissions() {
    if command_exists docker; then
        if docker info >/dev/null 2>&1; then
            return 0
        else
            return 1
        fi
    else
        return 2
    fi
}

# Función para verificar si el puerto está en uso
check_port_usage() {
    local port=$1
    if command_exists netstat; then
        netstat -tuln | grep -q ":$port "
    elif command_exists ss; then
        ss -tuln | grep -q ":$port "
    else
        # Fallback: intentar conectar al puerto
        timeout 1 bash -c "</dev/tcp/localhost/$port" 2>/dev/null
    fi
}

# Función para verificar recursos del sistema
check_system_resources() {
    print_step "Verificando recursos del sistema..."
    
    # Verificar espacio en disco
    local available_space=$(df . | awk 'NR==2 {print $4}')
    local available_gb=$((available_space / 1024 / 1024))
    
    if [ $available_gb -lt 2 ]; then
        print_warning "Espacio disponible: ${available_gb}GB (recomendado: 2GB mínimo)"
    else
        print_success "Espacio disponible: ${available_gb}GB ✅"
    fi
    
    # Verificar memoria RAM
    if command_exists free; then
        local total_mem=$(free -m | awk 'NR==2{print $2}')
        if [ $total_mem -lt 2048 ]; then
            print_warning "Memoria RAM: ${total_mem}MB (recomendado: 2GB mínimo)"
        else
            print_success "Memoria RAM: ${total_mem}MB ✅"
        fi
    fi
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
WEB_ROOT="/var/www/html"
if [[ "$SCRIPT_DIR" == *"$WEB_ROOT"* ]]; then
    APP_PATH="/${SCRIPT_DIR#$WEB_ROOT}"
else
    APP_PATH="/$(basename "$SCRIPT_DIR")"
fi

# Configuración por defecto
DEFAULT_PORT="8580"
DEFAULT_DB_PASSWORD="batch_record_$(date +%Y%m%d)"
DB_PASSWORD=${1:-$DEFAULT_DB_PASSWORD}

print_header
print_message "Iniciando instalación inteligente..."
echo ""
print_step "Directorio actual: $SCRIPT_DIR"
print_step "Ruta de aplicación: $APP_PATH"
print_step "Puerto: $DEFAULT_PORT"
print_step "Contraseña DB: $DB_PASSWORD"
echo ""

# Verificar recursos del sistema
check_system_resources
echo ""

# Verificar Docker
print_step "Verificando instalación de Docker..."
DOCKER_VERSION=$(get_docker_version)

if [ "$DOCKER_VERSION" = "no_installed" ]; then
    print_error "Docker no está instalado."
    echo ""
    print_message "¿Deseas instalar Docker automáticamente? (y/n)"
    read -r response
    if [[ "$response" =~ ^[Yy]$ ]]; then
        print_step "Instalando Docker..."
        
        # Detectar sistema operativo
        if command_exists apt-get; then
            # Ubuntu/Debian
            sudo apt-get update
            sudo apt-get install -y docker.io docker-compose
            sudo systemctl start docker
            sudo systemctl enable docker
            sudo usermod -aG docker $USER
            print_success "Docker instalado en Ubuntu/Debian"
            print_warning "⚠️  Necesitas cerrar sesión y volver a entrar para que los permisos de Docker funcionen"
        elif command_exists yum; then
            # CentOS/RHEL
            sudo yum install -y docker docker-compose
            sudo systemctl start docker
            sudo systemctl enable docker
            sudo usermod -aG docker $USER
            print_success "Docker instalado en CentOS/RHEL"
            print_warning "⚠️  Necesitas cerrar sesión y volver a entrar para que los permisos de Docker funcionen"
        else
            print_error "No se pudo instalar Docker automáticamente. Instálalo manualmente."
            exit 1
        fi
    else
        print_error "Docker es requerido para continuar. Instálalo manualmente."
        exit 1
    fi
else
    print_success "Docker ya está instalado ✅"
    print_info "Versión: $DOCKER_VERSION"
fi

# Verificar permisos de Docker
print_step "Verificando permisos de Docker..."
if check_docker_permissions; then
    print_success "Permisos de Docker correctos ✅"
else
    print_warning "Problemas con permisos de Docker"
    print_info "Intentando ejecutar con sudo..."
    if sudo docker info >/dev/null 2>&1; then
        print_success "Docker funciona con sudo ✅"
        print_warning "⚠️  Considera agregar tu usuario al grupo docker: sudo usermod -aG docker $USER"
    else
        print_error "No se puede acceder a Docker. Verifica la instalación."
        exit 1
    fi
fi

# Verificar Docker Compose
print_step "Verificando Docker Compose..."
COMPOSE_VERSION=$(get_compose_version)

if [ "$COMPOSE_VERSION" = "no_installed" ]; then
    print_error "Docker Compose no está instalado."
    echo ""
    print_message "¿Deseas instalar Docker Compose automáticamente? (y/n)"
    read -r response
    if [[ "$response" =~ ^[Yy]$ ]]; then
        print_step "Instalando Docker Compose..."
        
        # Instalar Docker Compose
        sudo curl -L "https://github.com/docker/compose/releases/latest/download/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
        sudo chmod +x /usr/local/bin/docker-compose
        print_success "Docker Compose instalado ✅"
    else
        print_error "Docker Compose es requerido para continuar. Instálalo manualmente."
        exit 1
    fi
else
    print_success "Docker Compose ya está instalado ✅"
    print_info "Versión: $COMPOSE_VERSION"
fi

# Verificar si el puerto está en uso
print_step "Verificando disponibilidad del puerto $DEFAULT_PORT..."
if check_port_usage $DEFAULT_PORT; then
    print_warning "El puerto $DEFAULT_PORT está en uso"
    print_info "Verificando si es un contenedor de Docker..."
    
    # Verificar si hay contenedores usando el puerto
    if command_exists docker; then
        local container_using_port=$(docker ps --format "table {{.Names}}\t{{.Ports}}" | grep ":$DEFAULT_PORT->" | awk '{print $1}')
        if [ -n "$container_using_port" ]; then
            print_warning "Contenedor usando el puerto: $container_using_port"
            echo ""
            print_message "¿Deseas detener el contenedor existente? (y/n)"
            read -r response
            if [[ "$response" =~ ^[Yy]$ ]]; then
                docker stop "$container_using_port"
                print_success "Contenedor detenido ✅"
            else
                print_error "No se puede continuar con el puerto ocupado"
                exit 1
            fi
        else
            print_error "Puerto $DEFAULT_PORT ocupado por otro proceso"
            exit 1
        fi
    else
        print_error "Puerto $DEFAULT_PORT ocupado"
        exit 1
    fi
else
    print_success "Puerto $DEFAULT_PORT disponible ✅"
fi

# Crear directorios necesarios
print_step "Creando directorios necesarios..."
mkdir -p logs
mkdir -p db
print_success "Directorios creados ✅"

# Configurar variables de entorno
print_step "Configurando variables de entorno..."
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

print_success "Archivo .env creado ✅"

# Configurar apache.conf con la ruta dinámica
print_step "Configurando Apache..."
sed -i "s|\${APP_PATH}|$APP_PATH|g" apache.conf
print_success "Apache configurado ✅"

# Configurar docker-compose.yml
print_step "Configurando Docker Compose..."
sed -i "s|8580:8580|$DEFAULT_PORT:8580|g" docker-compose.yml
sed -i "s|your_password_here||g" docker-compose.yml
print_success "Docker Compose configurado ✅"

# Verificar si existe el archivo de base de datos
if [ ! -f "db/batch_record.sql" ]; then
    print_warning "No se encontró db/batch_record.sql"
    print_message "La base de datos se creará automáticamente si no existe"
else
    print_success "Archivo de base de datos encontrado ✅"
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
        print_success "MySQL está listo ✅"
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
    print_success "Contenedores iniciados correctamente ✅"
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
# Uso: ./manage.sh [start|stop|restart|logs|status|clean]

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
    clean)
        docker-compose down -v --remove-orphans
        docker system prune -f
        echo "✅ Limpieza completada"
        ;;
    *)
        echo "Uso: \$0 {start|stop|restart|logs|status|clean}"
        exit 1
        ;;
esac
EOF

chmod +x manage.sh
print_success "Script de gestión creado ✅"

# Mostrar información final
echo ""
print_success "=== INSTALACIÓN COMPLETADA EXITOSAMENTE ==="
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
echo "  • Limpiar: ./manage.sh clean"
echo ""
echo -e "${BLUE}🔐 Credenciales de base de datos:${NC}"
echo "  • Usuario: root"
echo "  • Contraseña: (sin contraseña)"
echo "  • Base de datos: batch_record"
echo ""
echo -e "${BLUE}📁 Archivos importantes:${NC}"
echo "  • Configuración: .env"
echo "  • Logs: logs/"
echo "  • Base de datos: db/"
echo ""
echo -e "${BLUE}🐳 Información de Docker:${NC}"
echo "  • Docker: $DOCKER_VERSION"
echo "  • Docker Compose: $COMPOSE_VERSION"
echo ""
print_warning "⚠️  IMPORTANTE: Asegúrate de que tu base de datos esté configurada correctamente"
echo ""
print_success "🎉 ¡La instalación está lista para usar!" 