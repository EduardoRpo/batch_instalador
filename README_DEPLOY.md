# Despliegue de Batch Record en Linux con Docker

## Requisitos Previos

- Docker instalado
- Docker Compose instalado
- Git (opcional, para clonar el repositorio)

## Configuración

### 1. Variables de Entorno

Copia el archivo de ejemplo y configúralo:

```bash
cp env.example .env
```

Edita el archivo `.env` con tus configuraciones:

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
# IMPORTANTE: Cambia esta ruta según donde se instale el proyecto
APP_PATH=/ruta/nueva/pdn/linux
```

### 2. Base de Datos

Asegúrate de que el archivo `db/batch_record.sql` contenga la estructura de tu base de datos.

## Despliegue

### Opción 1: Instalación Universal (Recomendada)

```bash
# Dar permisos de ejecución
chmod +x auto_install.sh

# Instalación automática (detecta directorio automáticamente)
./auto_install.sh [password_db]

# Ejemplos:
./auto_install.sh                    # Usa contraseña por defecto
./auto_install.sh mi_password_seguro # Con contraseña personalizada
```

### Opción 2: Instalación Rápida (Para cualquier directorio)

```bash
# Copiar el script a cualquier directorio donde quieras instalar
cp quick_install.sh /tu/nuevo/directorio/
cd /tu/nuevo/directorio/

# Dar permisos y ejecutar
chmod +x quick_install.sh
./quick_install.sh [password_db]
```

### Opción 3: Instalación con Parámetros

```bash
# Dar permisos de ejecución
chmod +x install.sh setup.sh

# Instalación con parámetros
./install.sh [ruta] [puerto] [password_db]

# Ejemplos:
./install.sh /mi/ruta 8580 mi_password
./install.sh /var/www/batch 8581 secure_pass
./install.sh  # Usa valores por defecto
```

### Opción 2: Instalación Interactiva

```bash
chmod +x setup.sh
./setup.sh
```

### Opción 3: Script Automático (Legacy)

```bash
chmod +x deploy.sh
./deploy.sh
```

### Opción 4: Comandos Manuales

```bash
# Crear directorio de logs
mkdir -p logs

# Construir y levantar contenedores
docker-compose up -d --build

# Verificar estado
docker-compose ps
```

## Acceso a la Aplicación

- **Aplicación principal**: http://localhost:8580/ruta/nueva/pdn/linux (cambia la ruta según tu instalación)
- **phpMyAdmin**: http://localhost:8080

## Comandos Útiles

```bash
# Ver logs de la aplicación
docker-compose logs app

# Ver logs de MySQL
docker-compose logs mysql

# Detener contenedores
docker-compose down

# Reiniciar contenedores
docker-compose restart

# Acceder al contenedor de la aplicación
docker-compose exec app bash

# Acceder a MySQL
docker-compose exec mysql mysql -u root -p
```

## Estructura de Archivos

```
BatchRecord/
├── Dockerfile              # Configuración del contenedor PHP
├── docker-compose.yml      # Orquestación de servicios
├── apache.conf            # Configuración de Apache
├── env.php                # Configuración de entorno
├── env.example            # Ejemplo de variables de entorno
├── deploy.sh              # Script de despliegue
├── logs/                  # Directorio de logs
└── db/                    # Scripts de base de datos
```

## Solución de Problemas

### Error de permisos
```bash
sudo chown -R $USER:$USER .
```

### Error de puerto ocupado
Cambia el puerto en `docker-compose.yml`:
```yaml
ports:
  - "8581:8580"  # Cambia 8580 por 8581
```

### Error de conexión a la base de datos
Verifica que las variables de entorno en `.env` coincidan con las del `docker-compose.yml`.

## Migración de Datos

Si tienes datos existentes, puedes importarlos:

```bash
# Copiar tu archivo SQL a la carpeta db/
cp tu_backup.sql db/

# Reiniciar contenedores
docker-compose down
docker-compose up -d
```

## Seguridad

- Cambia las contraseñas por defecto
- Configura un firewall
- Usa HTTPS en producción
- Mantén Docker actualizado 