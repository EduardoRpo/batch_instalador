<?php

namespace BatchRecord\utils;

use PDO;

class EstadoValidator
{
    private $pdo;
    
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    /**
     * Valida si un producto tiene fórmulas e instructivos
     * @param string $referencia Referencia del producto
     * @return int 0 = Falta Fórmula/Instructivo, 1 = Tiene ambos
     */
    public function checkFormulasAndInstructivos($referencia)
    {
        try {
            // Contar fórmulas
            $stmtFormula = $this->pdo->prepare("
                SELECT COUNT(*) as count 
                FROM formula 
                WHERE id_producto = :referencia
            ");
            $stmtFormula->execute(['referencia' => $referencia]);
            $formulas = $stmtFormula->fetch(PDO::FETCH_ASSOC)['count'];
            
            // Contar instructivos
            $stmtInstructivo = $this->pdo->prepare("
                SELECT COUNT(*) as count 
                FROM instructivo_preparacion 
                WHERE id_producto = :referencia
            ");
            $stmtInstructivo->execute(['referencia' => $referencia]);
            $instructivos = $stmtInstructivo->fetch(PDO::FETCH_ASSOC)['count'];
            
            // Calcular resultado
            $result = $formulas * $instructivos;
            $estado = ($result == 0) ? 0 : 1;
            
            error_log("🔍 EstadoValidator - Producto: $referencia, Fórmulas: $formulas, Instructivos: $instructivos, Estado: $estado");
            
            return $estado;
            
        } catch (Exception $e) {
            error_log("❌ EstadoValidator - Error validando estado para $referencia: " . $e->getMessage());
            return 0; // Por defecto, asumir que falta documentación
        }
    }
    
    /**
     * Actualiza el estado de todos los pre-planeados de un producto
     * @param string $referencia Referencia del producto
     * @param int $estado Nuevo estado (0 o 1)
     */
    public function updateEstadoPreplaneados($referencia, $estado)
    {
        try {
            $stmt = $this->pdo->prepare("
                UPDATE plan_preplaneados 
                SET estado = :estado 
                WHERE id_producto = :referencia
            ");
            $stmt->execute([
                'estado' => $estado,
                'referencia' => $referencia
            ]);
            
            $affectedRows = $stmt->rowCount();
            error_log("✅ EstadoValidator - Actualizados $affectedRows registros para producto $referencia con estado $estado");
            
        } catch (Exception $e) {
            error_log("❌ EstadoValidator - Error actualizando estado para $referencia: " . $e->getMessage());
        }
    }
    
    /**
     * Valida y actualiza el estado de múltiples productos
     * @param array $productos Array de referencias de productos
     * @return array Array con el estado de cada producto
     */
    public function validateMultipleProducts($productos)
    {
        $resultados = [];
        
        foreach ($productos as $referencia) {
            $estado = $this->checkFormulasAndInstructivos($referencia);
            $this->updateEstadoPreplaneados($referencia, $estado);
            
            $resultados[$referencia] = [
                'estado' => $estado,
                'descripcion' => ($estado == 0) ? 'Falta Formula e Instructivo' : 'Inactivo'
            ];
        }
        
        return $resultados;
    }
} 