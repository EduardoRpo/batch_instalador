<?php
/**
 * ARCHIVO NUEVO - Creado para manejar la tercera firma de preparación
 * Reemplaza la API /api/saveBatchTanques que falla por tabla GESTION_GRANELES_TRACKING
 * Fecha: $(Get-Date -Format "yyyy-MM-dd HH:mm:ss")
 * Motivo: Evitar errores de API y usar tablas existentes
 */

require_once __DIR__ . '/../../env.php';
header('Content-Type: application/json');

try {
    // Validar parámetros recibidos
    $operacion = $_POST['operacion'] ?? null;
    $equipos = $_POST['equipos'] ?? null;
    $tanques = $_POST['tanques'] ?? null;
    $tanquesOk = $_POST['tanquesOk'] ?? null;
    $modulo = $_POST['modulo'] ?? null;
    $batch = $_POST['batch'] ?? null;
    $usuario = $_POST['usuario'] ?? null;
    
    if (!$operacion || !$equipos || !$tanques || !$modulo || !$batch || !$usuario) {
        echo json_encode(['error' => 'Parámetros incompletos']);
        exit;
    }
    
    // Validar que sea módulo 3 (preparación)
    if ($modulo != 3) {
        echo json_encode(['error' => 'Este endpoint es solo para módulo 3 (preparación)']);
        exit;
    }
    
    $conn = new PDO("mysql:dbname=$database;host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Iniciar transacción
    $conn->beginTransaction();
    
    try {
        // 1. Guardar información de equipos seleccionados
        if (!empty($equipos)) {
            // MODIFICADO: Ajustar procesamiento de equipos para la estructura enviada
            // ANTES: Esperaba equipos como array de objetos con id y tipo
            // AHORA: equipos es array simple con valores de selectores
            // Fecha: $(Get-Date -Format "yyyy-MM-dd HH:mm:ss")
            
            // Limpiar equipos anteriores para este batch
            $sqlDeleteEquipos = "DELETE FROM batch_equipos_preparacion WHERE batch = :batch";
            $stmtDeleteEquipos = $conn->prepare($sqlDeleteEquipos);
            $stmtDeleteEquipos->execute(['batch' => $batch]);
            
            // Insertar nuevos equipos
            $tipos = ['agitador', 'marmita'];
            foreach ($equipos as $index => $idEquipo) {
                if (!empty($idEquipo) && $idEquipo !== 'no_aplica') {
                    $tipo = $tipos[$index] ?? 'equipo';
                    $sqlInsertEquipo = "INSERT INTO batch_equipos_preparacion (batch, id_equipo, tipo) VALUES (:batch, :id_equipo, :tipo)";
                    $stmtInsertEquipo = $conn->prepare($sqlInsertEquipo);
                    $stmtInsertEquipo->execute([
                        'batch' => $batch,
                        'id_equipo' => $idEquipo,
                        'tipo' => $tipo
                    ]);
                }
            }
        }
        
        // 2. Actualizar estado de tanques
        if ($tanques > 0) {
            $sqlUpdateTanques = "UPDATE batch_tanques_chks SET 
                estado = :estado, 
                fecha_verificacion = NOW(), 
                usuario_verificacion = :usuario 
                WHERE batch = :batch AND modulo = :modulo";
            
            $estado = ($tanquesOk == $tanques) ? 'completado' : 'pendiente';
            
            $stmtUpdateTanques = $conn->prepare($sqlUpdateTanques);
            $stmtUpdateTanques->execute([
                'estado' => $estado,
                'usuario' => $usuario,
                'batch' => $batch,
                'modulo' => $modulo
            ]);
        }
        
        // 3. Registrar la firma
        $sqlFirma = "INSERT INTO batch_firmas2seccion (batch, modulo, usuario, fecha_firma, tipo_firma) 
                     VALUES (:batch, :modulo, :usuario, NOW(), 'tercera_firma')";
        $stmtFirma = $conn->prepare($sqlFirma);
        $stmtFirma->execute([
            'batch' => $batch,
            'modulo' => $modulo,
            'usuario' => $usuario
        ]);
        
        // Confirmar transacción
        $conn->commit();
        
        echo json_encode([
            'success' => true, 
            'message' => 'Tercera firma guardada correctamente',
            'equipos_guardados' => count($equipos),
            'tanques_actualizados' => $tanques,
            'estado_tanques' => $estado
        ]);
        
    } catch (Exception $e) {
        // Revertir transacción en caso de error
        $conn->rollback();
        throw $e;
    }
    
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error de base de datos: ' . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['error' => 'Error general: ' . $e->getMessage()]);
}
?> 