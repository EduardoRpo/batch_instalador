<?php
/**
 * MODIFICADO: Agregar logs para debuggear la carga de especificaciones
 * ANTES: No había logs para ver qué estaba pasando
 * AHORA: Se agregan logs para verificar el flujo de datos
 * Fecha: $(Get-Date -Format "yyyy-MM-dd HH:mm:ss")
 */

if (!empty($_POST)) {

    require_once('../../conexion.php');

    $modulo = $_POST['modulo'];
    $batch = $_POST['idBatch'];
    
    // MODIFICADO: Agregar logs para debuggear
    error_log("🔍 controlProceso.php - Recibido POST: modulo=$modulo, batch=$batch");

    $sql = "SELECT * FROM batch_control_especificaciones WHERE modulo = :modulo AND batch = :batch";
    $query = $conn->prepare($sql);
    $result = $query->execute(['modulo' => $modulo, 'batch' => $batch]);
    
    // MODIFICADO: Agregar logs para debuggear
    error_log("🔍 controlProceso.php - SQL ejecutado: $sql");
    error_log("🔍 controlProceso.php - Resultado de ejecución: " . ($result ? 'true' : 'false'));

    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    
    // MODIFICADO: Agregar logs para debuggear
    error_log("🔍 controlProceso.php - Datos encontrados: " . count($data));
    if (!empty($data)) {
        error_log("🔍 controlProceso.php - Primer registro: " . json_encode($data[0]));
    }
    
    if (empty($data)) {
        error_log("🔍 controlProceso.php - No hay datos, retornando '0'");
        echo '0';
    } else {
        error_log("🔍 controlProceso.php - Retornando datos JSON");
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}
