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
                    AND p.id_escherichia=es.id AND p.id_escherichia=es.id AND p.id_staphylococcus=st.id AND p.id_ph = ph.id 
                    AND p.id_viscosidad=v.id AND p.id_densidad_gravedad=d.id AND p.id_grado_alcohol = a.id";

        ejecutarQuerySelect($conn, $query);
        break;


    case 2: //Eliminar
        $id = $_POST['id'];
        $sql = "DELETE FROM producto WHERE referencia = :id";
        ejecutarEliminar($conn, $sql, $id);
        break;

    case 3: // Guardar data
        if (!empty($_POST)) {
            $editar = $_POST['editar'];

            //carga la informacion del POST
            foreach ($_POST as $nombre_campo => $valor) {
                $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
                eval($asignacion);
            }

            $nombre = strtoupper($nombre);

            if ($editar > 0) {
                $query = "UPDATE producto SET referencia=:referencia, nombre_referencia=':nombre', unidad_empaque=:empaque, 
            id_nombre_producto =:nombre_producto, id_notificacion_sanitaria =:notificacion_sanitaria, id_linea = :linea, 
            id_marca =:marca, id_propietario =:propietario, id_presentacion_comercial= :presentacion_comercial, 
            id_color =:color, id_olor= :olor, id_apariencia = :apariencia, id_untuosidad=:untuosidad, 
            id_poder_espumoso =:poder_espumoso, id_recuento_mesofilos =:recuento_mesofilos, id_pseudomona=:pseudomona, 
            id_escherichia =:escherichia, id_staphylococcus=:staphylococcus, id_ph =:ph, id_viscosidad =:viscosidad, 
            id_densidad_gravedad =:densidad_gravedad, id_grado_alcohol = :grado_alcohol WHERE referencia = :id_referencia";

                $query = $conn->prepare($sql);
                $result = $query->execute([
                    'referencia' => $referencia, 'nombre' => $nombre, 'empaque' => $empaque, 'nombre_producto' => $nombre_producto,
                    'notificacion_sanitaria' => $notificacion_sanitaria, 'linea' => $linea, 'marca' => $marca, 'propietario' => $propietario,
                    'presentacion_comercial' => $presentacion_comercial, 'color' => $color, 'olor' => $olor, 'apariencia' => $apariencia,
                    'untuosidad' => $untuosidad, 'poder_espumoso' => $poder_espumoso, 'recuento_mesofilos' => $recuento_mesofilos,
                    'pseudomona' => $pseudomona, 'escherichia' => $escherichia, 'staphylococcus' => $staphylococcus, 'ph' => $ph,
                    'viscosidad' => $viscosidad, 'densidad_gravedad' => $densidad_gravedad, 'grado_alcohol' => $grado_alcohol,
                    'id_referencia' => $id_referencia
                ]);

                if ($result) {
                    echo '3';
                    exit();
                }
            } else {

                //valida si el registro existe

                $query = "SELECT * FROM producto WHERE referencia='$referencia'";
                $query = $conn->prepare($sql);
                $query->execute(['cargo' => $cargo]);
                $rows = $query->rowCount();

                if ($rows > 0) {
                    echo '2';
                    exit();
                } else {
                    $query = "INSERT INTO producto (referencia, nombre_referencia, unidad_empaque, id_nombre_producto, 
                    id_notificacion_sanitaria, id_linea, id_marca, id_propietario, id_presentacion_comercial, id_color, id_olor, 
                    id_apariencia, id_untuosidad, id_poder_espumoso, id_recuento_mesofilos, id_pseudomona, id_escherichia, 
                    id_staphylococcus, id_ph, id_viscosidad, id_densidad_gravedad, id_grado_alcohol)
                    VALUES (:referencia, ':nombre', :empaque, :nombre_producto, :notificacion_sanitaria, 
                    :linea, :marca, :propietario, :presentacion_comercial, :color, :olor, :apariencia, 
                    :untuosidad, :poder_espumoso, :recuento_mesofilos, :pseudomona, :escherichia, :staphylococcus,
                    :ph, :viscosidad, :densidad_gravedad, :grado_alcohol)";

                    $query = $conn->prepare($sql);
                    $result = $query->execute([
                        'referencia' => $referencia, 'nombre' => $nombre, 'empaque' => $empaque, 'nombre_producto' => $nombre_producto,
                        'notificacion_sanitaria' => $notificacion_sanitaria, 'linea' => $linea, 'marca' => $marca, 'propietario' => $propietario,
                        'presentacion_comercial' => $presentacion_comercial, 'color' => $color, 'olor' => $olor, 'apariencia' => $apariencia,
                        'untuosidad' => $untuosidad, 'poder_espumoso' => $poder_espumoso, 'recuento_mesofilos' => $recuento_mesofilos,
                        'pseudomona' => $pseudomona, 'escherichia' => $escherichia, 'staphylococcus' => $staphylococcus, 'ph' => $ph,
                        'viscosidad' => $viscosidad, 'densidad_gravedad' => $densidad_gravedad, 'grado_alcohol' => $grado_alcohol,
                        'id_referencia' => $id_referencia
                    ]);
                    ejecutarQuery($result, $conn);
                }
            }
        }

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
