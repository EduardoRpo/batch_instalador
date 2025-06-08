import mysql.connector
from flask import Flask, request, jsonify
import json

app = Flask(__name__)

# Configuración de la base de datos
db_config = {
    'host': '10.1.200.30',
    'user': 'root',
    'password': '',
    'database': 'batch_record'
}

# Ruta para el ingreso de datos
@app.route('/guardar_muestras', methods=['POST'])
def guardar_muestras():
    # Obtener los datos del cuerpo de la solicitud
    data = request.get_json()

    if not data or not data.get('data'):
        return jsonify({'success': False, 'message': 'No se recibieron datos'}), 400

    # Conectar a la base de datos
    try:
        conn = mysql.connector.connect(**db_config)
    except mysql.connector.Error as err:
        return jsonify({'success': False, 'message': f'Error de conexión a la base de datos: {err}'}), 500

    # Preparar el cursor y la consulta SQL
    cursor = conn.cursor()

    # Consulta para insertar datos en la tabla 'plan_muestras_tara'
    query = """
        INSERT INTO plan_muestras_tara (tara, densidad_final, lote, referencia, batch, hora_inicio, hora_final)
        VALUES (%s, %s, %s, %s, %s, %s, %s)
    """
    
    # Iterar sobre los datos y ejecutar la consulta
    try:
        for row in data['data']:
            tara = row['tara']
            densidad_final = row['densidad_final']
            lote = row.get('lote', '')  # Puede que no se reciba lote, se asigna un valor vacío si no existe
            referencia = row.get('referencia', '')  # Similar para referencia
            batch = row.get('batch', '')  # Similar para batch
            hora_inicio = row.get('hora_inicio', '')  # Hora de inicio, opcional
            hora_final = row.get('hora_final', '')  # Hora final, opcional

            # Ejecutar la consulta con los valores correspondientes
            cursor.execute(query, (tara, densidad_final, lote, referencia, batch, hora_inicio, hora_final))

        # Confirmar la transacción
        conn.commit()

        # Responder con éxito
        return jsonify({'success': True, 'message': 'Datos guardados correctamente'}), 200

    except mysql.connector.Error as err:
        # Si hay un error al ejecutar la consulta
        conn.rollback()
        return jsonify({'success': False, 'message': f'Error al guardar los datos: {err}'}), 500

    finally:
        # Cerrar la conexión y el cursor
        cursor.close()
        conn.close()

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=2222, debug=True)
