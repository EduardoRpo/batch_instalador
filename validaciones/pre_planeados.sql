-- Ver todos los pedidos pre-planeados recientes
SELECT 
    id,
    pedido,
    id_producto,
    fecha_programacion,
    tamano_lote,
    unidad_lote,
    valor_pedido,
    estado,
    fecha_registro,
    fecha_insumo,
    sim,
    planeado
FROM plan_preplaneados 
ORDER BY id DESC 
LIMIT 10;

-- Buscar pedidos por fecha de insumo específica
SELECT 
    id,
    pedido,
    id_producto,
    fecha_programacion,
    tamano_lote,
    unidad_lote,
    fecha_insumo,
    sim,
    planeado,
    fecha_registro
FROM plan_preplaneados 
WHERE fecha_insumo = '2025-08-21'  -- Cambia por la fecha que usaste
ORDER BY id DESC;

-- Buscar pedidos por referencia (ej: M-20591)
SELECT 
    id,
    pedido,
    id_producto,
    fecha_programacion,
    tamano_lote,
    unidad_lote,
    fecha_insumo,
    sim,
    planeado,
    fecha_registro
FROM plan_preplaneados 
WHERE id_producto = 'M-20591'  -- Cambia por la referencia que usaste
ORDER BY id DESC;

-- Buscar pedidos por número de pedido
SELECT 
    id,
    pedido,
    id_producto,
    fecha_programacion,
    tamano_lote,
    unidad_lote,
    fecha_insumo,
    sim,
    planeado,
    fecha_registro
FROM plan_preplaneados 
WHERE pedido = '7149'  -- Cambia por el número de pedido que usaste
ORDER BY id DESC;

-- Ver todos los registros creados hoy
SELECT 
    id,
    pedido,
    id_producto,
    fecha_programacion,
    tamano_lote,
    unidad_lote,
    fecha_insumo,
    sim,
    planeado,
    fecha_registro
FROM plan_preplaneados 
WHERE fecha_registro = CURDATE()
ORDER BY id DESC;

-- Ver registros con sim = 1 (que es lo que debería guardarse)
SELECT 
    id,
    pedido,
    id_producto,
    fecha_programacion,
    tamano_lote,
    unidad_lote,
    fecha_insumo,
    sim,
    planeado,
    fecha_registro
FROM plan_preplaneados 
WHERE sim = 1
ORDER BY id DESC;

-- Ver los últimos 5 registros insertados
SELECT 
    id,
    pedido,
    id_producto,
    fecha_programacion,
    tamano_lote,
    unidad_lote,
    fecha_insumo,
    sim,
    planeado,
    fecha_registro
FROM plan_preplaneados 
ORDER BY id DESC 
LIMIT 5;