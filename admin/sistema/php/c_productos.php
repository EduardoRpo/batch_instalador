<?php
require_once('../../../conexion.php');
require_once('./crud.php');

$op = $_POST['operacion'];

switch ($op) {
    case 1: // Listar productos
        $query = "SELECT p.referencia, p.nombre_referencia, p.unidad_empaque, np.nombre as producto, 
                    ns.nombre as notificacion, linea.nombre as linea, m.nombre as marca, pr.nombre as propietario, 
                    pc.nombre as presentacion, c.nombre as color, o.nombre as olor, ap.nombre as apariencia, 
                    u.nombre as untuosidad, pe.nombre as poder_espumoso, rm.nombre as recuento_mesofilos, 
                    ps.nombre as pseudomona, es.nombre as escherichia, st.nombre as staphylococcus, 
                    CONCAT(ph.limite_inferior, ' - ' ,ph.limite_superior) as ph, 
                    CONCAT(v.limite_inferior, ' - ' ,v.limite_superior) as viscosidad, 
                    CONCAT(d.limite_inferior, ' - ' ,d.limite_superior) as densidad, 
                    CONCAT(a.limite_inferior, ' - ' ,a.limite_superior) as alcohol
                  FROM producto p INNER JOIN nombre_producto np INNER JOIN notificacion_sanitaria ns INNER JOIN linea 
                    INNER JOIN marca m INNER JOIN propietario pr INNER JOIN presentacion_comercial pc INNER JOIN color c 
                    INNER JOIN olor o INNER JOIN apariencia ap INNER JOIN untuosidad u INNER JOIN poder_espumoso pe 
                    INNER JOIN recuento_mesofilos rm INNER JOIN pseudomona ps INNER JOIN escherichia es 
                    INNER JOIN staphylococcus st INNER JOIN ph INNER JOIN viscosidad v INNER JOIN densidad_gravedad d 
                    INNER JOIN grado_alcohol a
                  ON np.id = p.id_nombre_producto AND linea.id = p.id_linea AND ns.id = p.id_notificacion_sanitaria 
                    AND p.id_marca= m.id AND p.id_propietario = pr.id AND p.id_presentacion_comercial = pc.id 
                    AND p.id_color=c.id AND p.id_olor=o.id AND p.id_apariencia=ap.id AND p.id_untuosidad=u.id 
                    AND p.id_poder_espumoso=pe.id AND p.id_recuento_mesofilos=rm.id AND p.id_pseudomona=ps.id 
                    AND p.id_escherichia=es.id AND p.id_escherichia=es.id AND p.id_staphylococcus=st.id AND P.id_ph=PH.id 
                    AND p.id_viscosidad=v.id AND p.id_densidad_gravedad=d.id AND p.id_grado_alcohol = a.id";

        ejecutarQuerySelect($conn, $query);
        break;
    

    case 2: //Eliminar
        $id = $_POST['referencia'];
        $query = "DELETE FROM producto WHERE referencia = $id";
        ejecutarQuery($conn, $query);
        break;

    case 3: // Guardar data

        foreach ($_POST as $nombre_campo => $valor) {
            $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
            eval($asignacion);
        }

        /* echo $referencia; '<br>';
        echo $nombre; '<br>';   
        echo $empaque; '<br>';
        echo $nombre_producto; '<br>';
        echo $notificacion_sanitaria; '<br>';
        echo $linea; '<br>';
        echo $marca; '<br>';
        echo $propietario; '<br>'; 
        echo $presentacion_comercial; '<br>'; 
        echo $color; '<br>'; 
        echo $olor; '<br>';
        echo $apariencia; '<br>'; 
        echo $untuosidad; '<br>';
        echo $poder_espumoso; '<br>'; 
        echo $recuento_mesofilos; '<br>';
        echo $pseudomona; '<br>';
        echo $escherichia; '<br>';
        echo $staphylococcus; '<br>';
        echo $ph; '<br>';
        echo $viscosidad; '<br>';
        echo $densidad_gravedad; '<br>';
        echo $grado_alcohol; '<br>'; */
        //exit();

        //validar si el registro existe

        $query = "SELECT * FROM producto WHERE referencia='$referencia'";
        $result = existeRegistro($conn, $query);

        if ($result > 0) {
            echo '2';
        } else {
            $query = "INSERT INTO producto (referencia, nombre_referencia, unidad_empaque, id_nombre_producto, 
            id_notificacion_sanitaria, id_linea, id_marca, id_propietario, id_presentacion_comercial, id_color, id_olor, 
            id_apariencia, id_untuosidad, id_poder_espumoso, id_recuento_mesofilos, id_pseudomona, id_escherichia, 
            id_staphylococcus, id_ph, id_viscosidad, id_densidad_gravedad, id_grado_alcohol)
            VALUES ('$referencia', '$nombre', '$empaque', '$nombre_producto', '$notificacion_sanitaria', 
            '$linea', '$marca', '$propietario', '$presentacion_comercial', '$color', '$olor', '$apariencia', 
            '$untuosidad', '$poder_espumoso', '$recuento_mesofilos', '$pseudomona', '$escherichia', '$staphylococcus',
             '$ph', '$viscosidad', '$densidad_gravedad', '$grado_alcohol')";
             echo $query;
             exit();
        }

        ejecutarQuery($conn, $query);

        break;


    case 4: // Cargar Selectores
        $tabla = $_POST['tabla'];

        if ($tabla == 'ph' || $tabla == 'viscosidad' || $tabla == 'densidad_gravedad' || $tabla == 'grado_alcohol')
            $query = "SELECT id, CONCAT(limite_inferior, ' - ', limite_superior) as nombre FROM $tabla";
        else
            $query = "SELECT * FROM $tabla";

        ejecutarQuerySelect($conn, $query);
        break;
}
