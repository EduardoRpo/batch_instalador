#!/bin/bash

# Script de gestión para Batch Record
# Uso: ./manage.sh [start|stop|restart|logs|status|clean]

case "$1" in
    start)
        docker compose up -d
        echo "✅ Aplicación iniciada"
        ;;
    stop)
        docker compose down
        echo "✅ Aplicación detenida"
        ;;
    restart)
        docker compose restart
        echo "✅ Aplicación reiniciada"
        ;;
    logs)
        docker compose logs -f
        ;;
    status)
        docker compose ps
        ;;
    clean)
        docker compose down -v --remove-orphans
        docker system prune -f
        echo "✅ Limpieza completada"
        ;;
    *)
        echo "Uso: $0 {start|stop|restart|logs|status|clean}"
        exit 1
        ;;
esac
