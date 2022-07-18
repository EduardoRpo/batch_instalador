<?php
if (!empty($_POST)) {
    require_once('../../../conexion.php');
    require_once('./crud.php');

    $op = $_POST['operacion'];

    switch ($op) {
        case 1: // Listar productos
            //$query = "SELECT * FROM producto";
            //ejecutarQuerySelect($conn, $query);
            break;

        case 2: //Eliminar
            /* $id = $_POST['id'];
            $sql = "DELETE FROM producto WHERE referencia = :id";
            ejecutarEliminar($conn, $sql, $id); */
            break;

        case 3: // Crear o actualizar datos de productos

            /* $editar = $_POST['editar']; */

            //carga la informacion del POST
            /* foreach ($_POST as $nombre_campo => $valor) {
                $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
                eval($asignacion);
            } */

            //$nombre = ucfirst(mb_strtolower($nombre, "UTF-8"));

            /* if ($editar > 0) {
                $sql = "UPDATE producto SET nombre_referencia =:nombre,  unidad_empaque = :uniEmpaque,  
                        id_nombre_producto = :nombre_producto, id_notificacion_sanitaria = :notificacion_sanitaria, id_linea = :linea, 
                        id_marca =:marca, id_propietario =:propietario, presentacion_comercial= :presentacion_comercial, 
                        id_color =:color, id_olor= :olor, id_apariencia = :apariencia, id_untuosidad=:untuosidad, 
                        id_poder_espumoso =:poder_espumoso, id_recuento_mesofilos =:recuento_mesofilos, id_pseudomona=:pseudomona, 
                        id_escherichia =:escherichia, id_staphylococcus=:staphylococcus, id_ph =:ph, id_viscosidad =:viscosidad, 
                        id_densidad_gravedad =:densidad_gravedad, id_grado_alcohol = :grado_alcohol, id_tapa = :tapa, id_envase = :envase, 
                        id_etiqueta = :etiqueta, id_empaque =:empaque, id_otros = :otros, base_instructivo = :bases_instructivo, 
                        instructivo = :instructivo 
                        WHERE referencia = :id_referencia";

                $query = $conn->prepare($sql);
                $result = $query->execute([
                    'nombre' => $nombre, 'uniEmpaque' => $uniEmpaque, 'nombre_producto' => $nombre_producto,
                    'notificacion_sanitaria' => $notificacion_sanitaria, 'linea' => $linea, 'marca' => $marca, 'propietario' => $propietario,
                    'presentacion_comercial' => $presentacion_comercial, 'color' => $color, 'olor' => $olor, 'apariencia' => $apariencia,
                    'untuosidad' => $untuosidad, 'poder_espumoso' => $poder_espumoso, 'recuento_mesofilos' => $recuento_mesofilos,
                    'pseudomona' => $pseudomona, 'escherichia' => $escherichia, 'staphylococcus' => $staphylococcus, 'ph' => $ph,
                    'viscosidad' => $viscosidad, 'densidad_gravedad' => $densidad_gravedad, 'grado_alcohol' => $grado_alcohol,
                    'tapa' => $tapa, 'envase' => $envase, 'etiqueta' => $etiqueta, 'empaque' => $empaque, 'otros' => $otros,
                    'bases_instructivo' => $bases_instructivo, 'instructivo' => $instructivo, 'id_referencia' => $referencia
                ]);

                if ($result) {
                    echo '3';
                    exit();
                }
            } else { */

                //valida si el registro existe

                /* $sql = "SELECT * FROM producto WHERE referencia =:referencia";
                $query = $conn->prepare($sql);
                $query->execute(['referencia' => $referencia]);
                $rows = $query->rowCount();

                if ($rows > 0) {
                    echo '2';
                    exit();
                } else {
                    $path = '../../html/img/referencias/' . $referencia . '.jpg';

                    $sql = "INSERT INTO producto (referencia, nombre_referencia, unidad_empaque, id_nombre_producto, 
                    id_notificacion_sanitaria, id_linea, id_marca, id_propietario, presentacion_comercial, id_color, id_olor, 
                    id_apariencia, id_untuosidad, id_poder_espumoso, id_recuento_mesofilos, id_pseudomona, id_escherichia, 
                    id_staphylococcus, id_ph, id_viscosidad, id_densidad_gravedad, id_grado_alcohol, id_envase, id_tapa, id_etiqueta, 
                    id_empaque, id_otros, base_instructivo, instructivo, img)
                    VALUES (:referencia, :nombre, :uniEmpaque, :nombre_producto, :notificacion_sanitaria, 
                    :linea, :marca, :propietario, :presentacion_comercial, :color, :olor, :apariencia, 
                    :untuosidad, :poder_espumoso, :recuento_mesofilos, :pseudomona, :escherichia, :staphylococcus,
                    :ph, :viscosidad, :densidad_gravedad, :grado_alcohol, :envase, :tapa, :etiqueta, :empaque, :otros,
                    :bases_instructivo, :instructivo, :img)";

                    $query = $conn->prepare($sql);
                    $result = $query->execute([
                        'referencia' => $referencia, 'nombre' => $nombre, 'uniEmpaque' => $uniEmpaque, 'nombre_producto' => $nombre_producto,
                        'notificacion_sanitaria' => $notificacion_sanitaria, 'linea' => $linea, 'marca' => $marca, 'propietario' => $propietario,
                        'presentacion_comercial' => $presentacion_comercial, 'color' => $color, 'olor' => $olor, 'apariencia' => $apariencia,
                        'untuosidad' => $untuosidad, 'poder_espumoso' => $poder_espumoso, 'recuento_mesofilos' => $recuento_mesofilos,
                        'pseudomona' => $pseudomona, 'escherichia' => $escherichia, 'staphylococcus' => $staphylococcus, 'ph' => $ph,
                        'viscosidad' => $viscosidad, 'densidad_gravedad' => $densidad_gravedad, 'grado_alcohol' => $grado_alcohol,
                        'envase' => $envase, 'tapa' => $tapa, 'etiqueta' => $etiqueta, 'empaque' => $empaque, 'otros' => $otros,
                        'bases_instructivo' => $bases_instructivo, 'instructivo' => $instructivo, 'img' => $path
                    ]);
                    ejecutarQuery($result, $conn);
                }
            } */

            break;

        case 4: // Cargar Selectores
            /*$tabla = $_POST['tabla'];

            if ($tabla == 'ph' || $tabla == 'viscosidad' || $tabla == 'densidad_gravedad' || $tabla == 'grado_alcohol') {
                $query = "SELECT id, CONCAT(limite_inferior, ' - ', limite_superior) as nombre FROM $tabla";
            } else {
                $query = "SELECT * FROM $tabla";
            }

            ejecutarQuerySelect($conn, $query);
            break;
*/
        case 5: //cargar select base
            $query = "SELECT DISTINCT np.id, np.nombre as producto_base 
                FROM instructivos_base ib 
                INNER JOIN nombre_producto np ON np.id = ib.producto";
            ejecutarQuerySelect($conn, $query);
            break;
        case 6: // Cargar imagenes
            if (!empty($_FILES['images'])) {
                // File upload configuration
                $targetDir = "../../../html/img/referencias/";
                $allowTypes = array('jpg', 'jpeg');

                $images_arr = array();
                foreach ($_FILES['images']['name'] as $key => $val) {

                    $image_name = $_FILES['images']['name'][$key];
                    $tmp_name   = $_FILES['images']['tmp_name'][$key];
                    $size       = $_FILES['images']['size'][$key];
                    $type       = $_FILES['images']['type'][$key];
                    $error      = $_FILES['images']['error'][$key];
                    $targetFilePath = $targetDir . $image_name;
                    $referencia = substr($image_name, 0, -4);

                    $sql = "SELECT img FROM producto WHERE referencia = :referencia";
                    $query = $conn->prepare($sql);
                    $query->execute(['referencia' => $referencia]);
                    $rows = $query->rowCount();

                    if ($rows > 0) {
                        $sql = "UPDATE producto SET img = :img WHERE referencia = :referencia";
                        $query = $conn->prepare($sql);
                        $result = $query->execute(['referencia' => $referencia, 'img' => $targetFilePath]);

                        $fileName = basename($_FILES['images']['name'][$key]);
                        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                        if (in_array($fileType, $allowTypes)) {
                            move_uploaded_file($tmp_name, $targetFilePath);
                        }
                    } else
                        echo "false";
                }
            }

            break;
    }
}
