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
            // Debug: Verificar si la referencia existe
            error_log("🔍 EstadoValidator - Iniciando validación para referencia: $referencia");
            
            // Primero obtener el granel correspondiente a la referencia
            $stmtGranel = $this->pdo->prepare("
                SELECT multi as granel 
                FROM producto 
                WHERE referencia = :referencia
            ");
            $stmtGranel->execute(['referencia' => $referencia]);
            $productoData = $stmtGranel->fetch(PDO::FETCH_ASSOC);
            
            if (!$productoData) {
                error_log("❌ EstadoValidator - No se encontró producto para referencia: $referencia");
                return 0;
            }
            
            $granel = $productoData['granel'];
            error_log("🔍 EstadoValidator - Granel encontrado para $referencia: $granel");
            
            // Contar fórmulas por granel
            $stmtFormula = $this->pdo->prepare("
                SELECT COUNT(*) as count 
                FROM formula 
                WHERE id_producto = :granel
            ");
            $stmtFormula->execute(['granel' => $granel]);
            $formulas = $stmtFormula->fetch(PDO::FETCH_ASSOC)['count'];
            
            // Debug: Verificar fórmulas encontradas
            error_log("🔍 EstadoValidator - Fórmulas encontradas para granel $granel: $formulas");
            
            // Contar instructivos por granel
            $stmtInstructivo = $this->pdo->prepare("
                SELECT COUNT(*) as count 
                FROM instructivo_preparacion 
                WHERE id_producto = :granel
            ");
            $stmtInstructivo->execute(['granel' => $granel]);
            $instructivos = $stmtInstructivo->fetch(PDO::FETCH_ASSOC)['count'];
            
            // Debug: Verificar instructivos encontrados
            error_log("🔍 EstadoValidator - Instructivos encontrados para granel $granel: $instructivos");
            
            // Calcular resultado
            $result = $formulas * $instructivos;
            $estado = ($result == 0) ? 0 : 1;
            
            error_log("🔍 EstadoValidator - Producto: $referencia, Granel: $granel, Fórmulas: $formulas, Instructivos: $instructivos, Resultado: $result, Estado: $estado");
            
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
    
    /**
     * Función de debugging para verificar la estructura de las tablas
     * @param string $referencia Referencia del producto a verificar
     */
    public function debugTablas($referencia)
    {
        try {
            error_log("🔍 EstadoValidator - DEBUG: Verificando estructura para $referencia");
            
            // Verificar tabla formula
            $stmtFormula = $this->pdo->prepare("
                SELECT * FROM formula WHERE id_producto = :referencia LIMIT 1
            ");
            $stmtFormula->execute(['referencia' => $referencia]);
            $formulaData = $stmtFormula->fetch(PDO::FETCH_ASSOC);
            error_log("🔍 EstadoValidator - DEBUG: Datos de fórmula: " . json_encode($formulaData));
            
            // Verificar tabla instructivo_preparacion
            $stmtInstructivo = $this->pdo->prepare("
                SELECT * FROM instructivo_preparacion WHERE id_producto = :referencia LIMIT 1
            ");
            $stmtInstructivo->execute(['referencia' => $referencia]);
            $instructivoData = $stmtInstructivo->fetch(PDO::FETCH_ASSOC);
            error_log("🔍 EstadoValidator - DEBUG: Datos de instructivo: " . json_encode($instructivoData));
            
            // Verificar estructura de tabla formula
            $stmtStructure = $this->pdo->prepare("DESCRIBE formula");
            $stmtStructure->execute();
            $formulaStructure = $stmtStructure->fetchAll(PDO::FETCH_ASSOC);
            error_log("🔍 EstadoValidator - DEBUG: Estructura tabla formula: " . json_encode($formulaStructure));
            
            // Verificar estructura de tabla instructivo_preparacion
            $stmtStructure2 = $this->pdo->prepare("DESCRIBE instructivo_preparacion");
            $stmtStructure2->execute();
            $instructivoStructure = $stmtStructure2->fetchAll(PDO::FETCH_ASSOC);
            error_log("🔍 EstadoValidator - DEBUG: Estructura tabla instructivo_preparacion: " . json_encode($instructivoStructure));
            
        } catch (Exception $e) {
            error_log("❌ EstadoValidator - DEBUG Error: " . $e->getMessage());
        }
    }
} 