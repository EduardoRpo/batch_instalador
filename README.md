# Batch Record - Sistema de Gestión de Producción

Sistema de órdenes de producción para Samara, migrado a Docker para despliegue en servidores Linux.

## 🚀 Características

- **Gestión de órdenes de producción**
- **Control de calidad**
- **Reportes y certificados**
- **Interfaz web moderna**
- **Base de datos MySQL**
- **Despliegue containerizado con Docker**

## 📋 Requisitos del Sistema

### Mínimos:
- **Espacio en disco**: 2GB mínimo
- **Memoria RAM**: 2GB mínimo
- **Sistema operativo**: Linux (Ubuntu, CentOS, etc.)

### Software:
- **Docker** (se instala automáticamente si no existe)
- **Docker Compose** (se instala automáticamente si no existe)

## 🐳 Instalación con Docker

### Opción 1: Instalación Inteligente (Recomendada)

El script `smart_install.sh` es la opción más avanzada y segura:

```bash
# Dar permisos de ejecución
chmod +x smart_install.sh

# Ejecutar instalación inteligente
./smart_install.sh
```

**Características del Smart Install:**
- ✅ Detecta versiones de Docker existentes
- ✅ Verifica permisos y recursos del sistema
- ✅ Valida disponibilidad de puertos
- ✅ Instalación no intrusiva
- ✅ Configuración automática de rutas
- ✅ Manejo inteligente de conflictos

### Opción 2: Instalación Rápida

Para instalación en cualquier directorio:

```bash
# Copiar el script a tu directorio
cp quick_install.sh /tu/directorio/

# Dar permisos y ejecutar
chmod +x quick_install.sh
./quick_install.sh
```

### Opción 3: Instalación Manual

Si prefieres control total:

```bash
# Configurar variables de entorno
cp env.example .env
# Editar .env con tus configuraciones

# Construir y levantar contenedores
docker-compose up -d --build
```

## 🔧 Configuración

### Variables de Entorno (.env)

```env
# Configuración del entorno
APP_ENV=production

# Configuración de la base de datos
DB_HOST=mysql
DB_NAME=batch_record
DB_USER=root
DB_PASSWORD=

# Configuración de la aplicación
APP_URL=http://localhost:8580
APP_PATH=/ruta/nueva/pdn/linux

# Configuración de logs
LOG_LEVEL=info
LOG_PATH=/var/www/html/logs
```

### Puertos por Defecto

- **Aplicación principal**: 8580
- **phpMyAdmin**: 8080
- **MySQL**: 3306

## 🛠️ Gestión de la Aplicación

### Comandos de Gestión

```bash
# Usar el script de gestión
./manage.sh [comando]

# Comandos disponibles:
./manage.sh start      # Iniciar aplicación
./manage.sh stop       # Detener aplicación
./manage.sh restart    # Reiniciar aplicación
./manage.sh logs       # Ver logs en tiempo real
./manage.sh status     # Ver estado de contenedores
./manage.sh clean      # Limpiar contenedores y caché
```

### Comandos Docker Directos

```bash
# Ver estado de contenedores
docker-compose ps

# Ver logs
docker-compose logs -f

# Reiniciar servicios
docker-compose restart

# Detener y eliminar contenedores
docker-compose down

# Reconstruir contenedores
docker-compose up -d --build
```

## 🌐 Acceso a la Aplicación

### URLs de Acceso

- **Aplicación principal**: http://localhost:8580/ruta/nueva/pdn/linux
- **phpMyAdmin**: http://localhost:8080

### Credenciales de Base de Datos

- **Usuario**: root
- **Contraseña**: (sin contraseña)
- **Base de datos**: batch_record
- **Host**: mysql (desde contenedores) o localhost (desde host)

## 📁 Estructura del Proyecto

```
BatchRecord/
├── html/                 # Archivos de la aplicación web
│   ├── index.php        # Página principal
│   ├── css/             # Estilos
│   ├── js/              # JavaScript
│   └── php/             # Scripts PHP
├── db/                  # Base de datos
│   └── batch_record.sql # Esquema y datos
├── logs/                # Logs de la aplicación
├── Dockerfile           # Configuración de Docker
├── docker-compose.yml   # Orquestación de servicios
├── apache.conf          # Configuración de Apache
├── env.php              # Configuración de entorno PHP
├── smart_install.sh     # Instalador inteligente
├── quick_install.sh     # Instalador rápido
├── manage.sh            # Script de gestión
└── README.md            # Esta documentación
```

## 🔍 Scripts de Instalación Disponibles

### 1. `smart_install.sh` (Recomendado)
- **Instalación inteligente** con validaciones avanzadas
- **Detección automática** de configuraciones existentes
- **Verificación de recursos** del sistema
- **Manejo de conflictos** de puertos
- **Instalación no intrusiva**

### 2. `quick_install.sh`
- **Instalación rápida** en cualquier directorio
- **Creación automática** de archivos de configuración
- **Configuración básica** de Docker

### 3. `auto_install.sh`
- **Instalación universal** con detección de directorio
- **Instalación automática** de Docker si no existe
- **Configuración completa** del entorno

## 🚨 Solución de Problemas

### Problemas Comunes

#### 1. Puerto 8580 ocupado
```bash
# Verificar qué usa el puerto
netstat -tuln | grep 8580

# Detener contenedor conflictivo
docker stop [nombre_contenedor]
```

#### 2. Permisos de Docker
```bash
# Agregar usuario al grupo docker
sudo usermod -aG docker $USER

# Reiniciar sesión o ejecutar
newgrp docker
```

#### 3. Base de datos no conecta
```bash
# Verificar estado de MySQL
docker-compose exec mysql mysqladmin ping -h localhost -u root

# Ver logs de MySQL
docker-compose logs mysql
```

#### 4. Aplicación no carga
```bash
# Ver logs de la aplicación
docker-compose logs app

# Verificar configuración de Apache
docker-compose exec app apache2ctl -S
```

### Logs y Debugging

```bash
# Ver logs de todos los servicios
docker-compose logs

# Ver logs de un servicio específico
docker-compose logs app
docker-compose logs mysql
docker-compose logs phpmyadmin

# Seguir logs en tiempo real
docker-compose logs -f
```

## 🔄 Migración desde Windows

### Pasos para Migrar

1. **Preparar archivos en Windows**:
   - Asegurar que `env.php` esté configurado
   - Verificar que `db/batch_record.sql` esté presente
   - Comprobar que todos los archivos estén sincronizados

2. **Subir a servidor Linux**:
   ```bash
   # Clonar desde Git
   git clone https://github.com/EduardoRpo/batch_instalador.git
   cd batch_instalador
   
   # O copiar archivos manualmente
   scp -r BatchRecord/ usuario@servidor:/ruta/destino/
   ```

3. **Instalar en Linux**:
   ```bash
   cd /ruta/destino/BatchRecord
   chmod +x smart_install.sh
   ./smart_install.sh
   ```

### Diferencias de Configuración

| Aspecto | Windows | Linux/Docker |
|---------|---------|--------------|
| Base de datos | localhost | mysql (contenedor) |
| Puerto | 80 | 8580 |
| Usuario DB | root | root |
| Contraseña DB | (vacía) | (vacía) |
| Ruta | /ruta/nueva/pdn/linux | /ruta/nueva/pdn/linux |

## 📊 Monitoreo y Mantenimiento

### Verificar Estado del Sistema

```bash
# Estado de contenedores
docker-compose ps

# Uso de recursos
docker stats

# Espacio en disco
df -h

# Logs del sistema
journalctl -u docker
```

### Backup de Base de Datos

```bash
# Crear backup
docker-compose exec mysql mysqldump -u root batch_record > backup_$(date +%Y%m%d).sql

# Restaurar backup
docker-compose exec -T mysql mysql -u root batch_record < backup_20231201.sql
```

### Actualización de la Aplicación

```bash
# Detener aplicación
./manage.sh stop

# Actualizar código
git pull

# Reconstruir y reiniciar
docker-compose up -d --build

# Verificar estado
./manage.sh status
```

## 🤝 Contribución

Para contribuir al proyecto:

1. Fork el repositorio
2. Crea una rama para tu feature
3. Realiza tus cambios
4. Prueba la instalación
5. Envía un pull request

## 📞 Soporte

Para soporte técnico o reportar problemas:

- **Repositorio**: https://github.com/EduardoRpo/batch_instalador
- **Issues**: Crear issue en GitHub
- **Documentación**: Este README

## 📄 Licencia

Este proyecto es propiedad de Samara y está destinado para uso interno.

---

**Versión**: 2.0  
**Última actualización**: Diciembre 2024  
**Compatibilidad**: Docker, Linux, PHP 8.1, MySQL 8.0
