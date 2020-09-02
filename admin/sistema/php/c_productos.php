<?php
require_once('../../../conexion.php');
require_once('./crud.php');

$op = $_POST['operacion'];

switch ($op) {
    case 1: // Listar productos
        $query = "SELECT p.referencia, p.nombre_referencia, p.unidad_empaque, np.nombre as producto, ns.nombre as notificacion, linea.nombre as linea, m.nombre as marca, pr.nombre as propietario, pc.nombre as presentacion, c.nombre as color, ap.nombre as apariencia, u.nombre as untuosidad, pe.nombre as poder_espumoso, rm.nombre as recuento_mesofilos, ps.nombre as pseudomona, es.nombre as escherichia, st.nombre as staphylococcus, CONCAT(dg.limite_inferior, ' - ' ,dg.limite_superior) as densidad
                  FROM producto p INNER JOIN nombre_producto np INNER JOIN notificacion_sanitaria ns INNER JOIN linea INNER JOIN marca m INNER JOIN propietario pr INNER JOIN presentacion_comercial pc INNER JOIN color c INNER JOIN apariencia ap INNER JOIN untuosidad u INNER JOIN poder_espumoso pe INNER JOIN recuento_mesofilos rm INNER JOIN pseudomona ps INNER JOIN escherichia es INNER JOIN staphylococcus st INNER JOIN densidad_gravedad dg
                  ON np.id = p.id_nombre_producto AND linea.id = p.id_linea AND ns.id = p.id_notificacion_sanitaria AND p.id_marca= m.id AND p.id_propietario = pr.id AND p.id_presentacion_comercial = pc.id AND p.id_color=c.id AND p.id_apariencia=ap.id AND p.id_untuosidad=u.id AND p.id_poder_espumoso=pe.id AND p.id_recuento_mesofilos=rm.id AND p.id_pseudomona=ps.id AND p.id_escherichia=es.id AND p.id_staphylococcus=st.id AND p.id_densidad_gravedad = dg.id";
        ejecutarQuerySelect($conn, $query);
        break;
    case 2:

    case 2: //Eliminar
        $id = $_POST['id'];

        $query = "DELETE FROM condicionesmedio_tiempo WHERE id = $id";
        ejecutarQuery($conn, $query);
        break;

    case 3: // Guardar data
        $modulo = $_POST['modulo'];
        $t_min = $_POST['t_min'];
        $t_max =  $_POST['t_max'];

        $query = "SELECT COUNT(id) from condicionesmedio_tiempo where id_modulo = $modulo";
        $row = existeRegistro($conn, $query);

        if ($row > 0)
            $query = "UPDATE condicionesmedio_tiempo SET min=$t_min, max=$t_max WHERE id_modulo = $modulo";
        else
            $query = "INSERT INTO condicionesmedio_tiempo (id_modulo, min, max) VALUES('$modulo', '$t_min', '$t_max')";

        ejecutarQuery($conn, $query);

        break;



    case 4: // Cargar datos para actualizar
        $id = $_POST['id'];

        $query = "SELECT c.id, c.id_modulo, c.min, c.max, m.modulo FROM condicionesmedio_tiempo c INNER JOIN modulo m ON c.id_modulo = m.id WHERE c.id = $id";
        ejecutarQuerySelect($conn, $query);
        break;

    case 5: // Cargar Selectores
        $tabla = $_POST['tabla'];

        if ($tabla == 'ph' || $tabla == 'viscosidad' || $tabla == 'densidad_gravedad' || $tabla == 'grado_alcohol')
            $query = "SELECT id, CONCAT(limite_inferior, ' - ', limite_superior) as nombre FROM $tabla";
        else
            $query = "SELECT * FROM $tabla";

        ejecutarQuerySelect($conn, $query);
        break;
}
