#!/bin/bash

# Script de Diagnóstico Automático para Batch Record
# Valida todas las conexiones de base de datos y genera un reporte
# Uso: ./diagnostic_db.sh

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
    echo -e "${BLUE}  DIAGNÓSTICO AUTOMÁTICO BATCH RECORD${NC}"
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

# Función para probar conectividad a un puerto
test_port() {
    local host=$1
    local port=$2
    local service=$3
    
    print_step "Probando $service en $host:$port..."
    
    if timeout 5 bash -c "</dev/tcp/$host/$port" 2>/dev/null; then
        print_success "$service accesible en $host:$port ✅"
        return 0
    else
        print_error "$service NO accesible en $host:$port ❌"
        return 1
    fi
}

# Función para probar conexión MySQL/MariaDB
test_mysql_connection() {
    local host=$1
    local port=$2
    local user=$3
    local password=$4
    local database=$5
    
    print_step "Probando conexión MySQL a $host:$port..."
    
    if command_exists mysql; then
        if timeout 10 mysql -h "$host" -P "$port" -u "$user" -p"$password" -e "SELECT 1;" 2>/dev/null; then
            print_success "Conexión MySQL exitosa a $host:$port ✅"
            return 0
        else
            print_error "Conexión MySQL falló a $host:$port ❌"
            return 1
        fi
    else
        print_warning "MySQL client no instalado, probando con telnet..."
        if timeout 5 telnet "$host" "$port" 2>/dev/null | grep -q "MariaDB\|MySQL"; then
            print_success "Servidor MySQL detectado en $host:$port ✅"
            return 0
        else
            print_error "No se detectó servidor MySQL en $host:$port ❌"
            return 1
        fi
    fi
}

# Función para generar reporte
generate_report() {
    local report_file="diagnostico_$(date +%Y%m%d_%H%M%S).txt"
    
    print_step "Generando reporte: $report_file"
    
    {
        echo "=========================================="
        echo "  REPORTE DE DIAGNÓSTICO BATCH RECORD"
        echo "=========================================="
        echo "Fecha: $(date)"
        echo "Servidor: $(hostname)"
        echo "IP del servidor: $(hostname -I)"
        echo ""
        echo "=== CONFIGURACIÓN ACTUAL ==="
        echo "Archivo env.php:"
        cat env.php
        echo ""
        echo "Archivo docker-compose.yml:"
        cat docker-compose.yml
        echo ""
        echo "=== ESTADO DE CONTENEDORES ==="
        docker compose ps
        echo ""
        echo "=== LOGS DE LA APLICACIÓN ==="
        docker compose logs app
        echo ""
        echo "=== RESULTADOS DE PRUEBAS ==="
        echo "$TEST_RESULTS"
    } > "$report_file"
    
    print_success "Reporte generado: $report_file"
    return "$report_file"
}

# Función para aplicar solución automática
apply_solution() {
    local solution=$1
    
    print_step "Aplicando solución: $solution"
    
    case $solution in
        "172.17.0.1")
            sed -i 's/$servername = ".*";/$servername = "172.17.0.1:3307";/g' env.php
            print_success "Configurado para usar 172.17.0.1:3307"
            ;;
        "10.1.200.16")
            sed -i 's/$servername = ".*";/$servername = "10.1.200.16:3307";/g' env.php
            print_success "Configurado para usar 10.1.200.16:3307"
            ;;
        "host.docker.internal")
            sed -i 's/$servername = ".*";/$servername = "host.docker.internal:3307";/g' env.php
            print_success "Configurado para usar host.docker.internal:3307"
            ;;
        *)
            print_error "Solución no reconocida: $solution"
            return 1
            ;;
    esac
    
    # Reiniciar aplicación
    print_step "Reiniciando aplicación..."
    docker compose restart app
    
    # Esperar a que se reinicie
    sleep 5
    
    # Verificar estado
    if docker compose ps | grep -q "Up"; then
        print_success "Aplicación reiniciada correctamente ✅"
        return 0
    else
        print_error "Error al reiniciar la aplicación ❌"
        return 1
    fi
}

# Inicializar variables
TEST_RESULTS=""
REPORT_FILE=""

print_header
print_message "Iniciando diagnóstico automático..."
echo ""

# Verificar que estamos en el directorio correcto
if [ ! -f "docker-compose.yml" ] || [ ! -f "env.php" ]; then
    print_error "No se encontraron archivos de configuración"
    print_error "Ejecuta este script desde el directorio del proyecto"
    exit 1
fi

print_step "Directorio actual: $(pwd)"
print_step "Verificando archivos de configuración..."

# Verificar archivos de configuración
if [ -f "env.php" ]; then
    print_success "env.php encontrado ✅"
    print_info "Configuración actual:"
    grep "servername" env.php
else
    print_error "env.php no encontrado ❌"
fi

if [ -f "docker-compose.yml" ]; then
    print_success "docker-compose.yml encontrado ✅"
else
    print_error "docker-compose.yml no encontrado ❌"
fi

echo ""

# Verificar estado de contenedores
print_step "Verificando estado de contenedores..."
if docker compose ps | grep -q "Up"; then
    print_success "Contenedores corriendo ✅"
    docker compose ps
else
    print_error "Contenedores no están corriendo ❌"
    print_step "Levantando contenedores..."
    docker compose up -d app phpmyadmin
fi

echo ""

# Obtener IPs del servidor
print_step "Obteniendo información del servidor..."
SERVER_IPS=$(hostname -I)
print_info "IPs del servidor: $SERVER_IPS"

# Extraer IPs principales
PRIMARY_IP=$(echo $SERVER_IPS | awk '{print $1}')
DOCKER_HOST_IP="172.17.0.1"

print_info "IP principal: $PRIMARY_IP"
print_info "IP Docker host: $DOCKER_HOST_IP"

echo ""

# Probar conectividad a MariaDB según documentación
print_step "Probando conectividad a MariaDB (puerto 3307)..."

# Probar desde el servidor (fuera del contenedor)
print_step "Probando desde el servidor..."
if test_port "$PRIMARY_IP" "3307" "MariaDB"; then
    TEST_RESULTS="$TEST_RESULTS\n✅ MariaDB accesible desde servidor en $PRIMARY_IP:3307"
    
    # Probar conexión MySQL
    if test_mysql_connection "$PRIMARY_IP" "3307" "root" "S@m4r@_2025!" "batch_record"; then
        TEST_RESULTS="$TEST_RESULTS\n✅ Conexión MySQL exitosa desde servidor"
    else
        TEST_RESULTS="$TEST_RESULTS\n❌ Conexión MySQL falló desde servidor"
    fi
else
    TEST_RESULTS="$TEST_RESULTS\n❌ MariaDB NO accesible desde servidor en $PRIMARY_IP:3307"
fi

echo ""

# Probar desde dentro del contenedor
print_step "Probando desde dentro del contenedor..."

# Probar diferentes IPs desde el contenedor
for ip in "$DOCKER_HOST_IP" "$PRIMARY_IP" "host.docker.internal"; do
    print_step "Probando $ip:3307 desde contenedor..."
    
    if docker compose exec app bash -c "timeout 5 bash -c '</dev/tcp/$ip/3307'" 2>/dev/null; then
        TEST_RESULTS="$TEST_RESULTS\n✅ MariaDB accesible desde contenedor en $ip:3307"
        
        # Probar conexión MySQL desde contenedor
        if docker compose exec app bash -c "timeout 10 mysql -h $ip -P 3307 -u root -p'S@m4r@_2025!' -e 'SELECT 1;'" 2>/dev/null; then
            TEST_RESULTS="$TEST_RESULTS\n✅ Conexión MySQL exitosa desde contenedor usando $ip"
            
            # Aplicar solución automática
            print_success "¡Conexión exitosa con $ip! Aplicando configuración..."
            if apply_solution "$ip"; then
                TEST_RESULTS="$TEST_RESULTS\n✅ Configuración aplicada exitosamente con $ip"
                break
            fi
        else
            TEST_RESULTS="$TEST_RESULTS\n❌ Conexión MySQL falló desde contenedor usando $ip"
        fi
    else
        TEST_RESULTS="$TEST_RESULTS\n❌ MariaDB NO accesible desde contenedor en $ip:3307"
    fi
done

echo ""

# Probar phpMyAdmin
print_step "Probando phpMyAdmin..."
if test_port "$PRIMARY_IP" "8083" "phpMyAdmin"; then
    TEST_RESULTS="$TEST_RESULTS\n✅ phpMyAdmin accesible en $PRIMARY_IP:8083"
else
    TEST_RESULTS="$TEST_RESULTS\n❌ phpMyAdmin NO accesible en $PRIMARY_IP:8083"
fi

echo ""

# Verificar logs de la aplicación
print_step "Verificando logs de la aplicación..."
if docker compose logs app | grep -q "error\|Error\|ERROR"; then
    print_warning "Se encontraron errores en los logs de la aplicación"
    TEST_RESULTS="$TEST_RESULTS\n⚠️ Errores encontrados en logs de aplicación"
else
    print_success "No se encontraron errores en los logs ✅"
    TEST_RESULTS="$TEST_RESULTS\n✅ Sin errores en logs de aplicación"
fi

echo ""

# Generar reporte
REPORT_FILE=$(generate_report)

echo ""
print_success "=== DIAGNÓSTICO COMPLETADO ==="
echo ""
print_message "Resultados de las pruebas:"
echo -e "$TEST_RESULTS"
echo ""
print_message "Reporte generado: $REPORT_FILE"
echo ""
print_message "Próximos pasos:"
echo "1. Revisar el reporte: cat $REPORT_FILE"
echo "2. Probar la aplicación: http://$PRIMARY_IP:8580/batch_instalador"
echo "3. Si hay problemas, revisar los logs: docker compose logs app"
echo ""
print_success "¡Diagnóstico completado! 🚀" 