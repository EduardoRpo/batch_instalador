begin 
  DECLARE vn_numero_orden VARCHAR (10); 
   
  DECLARE vn_annio VARCHAR(2); 
  DECLARE vn_linea VARCHAR(2); 
  DECLARE vn_numero_lote VARCHAR(10); 
  -- sacar en numero de orden 
  SELECT lpad( max(substring(numero_orden, 3, 3)) +1, 3, 0 ) 
  INTO   vn_numero_orden 
  FROM   batch 
  WHERE  substring(numero_orden, 7, 2) = date_format(now(), '%y') ; 
   
  -- año actual 
  SELECT date_format(now(), '%y') 
  INTO   vn_annio; 
   
  IF vn_numero_orden IS NULL THEN 
    SET vn_numero_orden = '001'; 
  END IF; 
  SET new.numero_orden = concat( 'OP', 
  vn_numero_orden, '/', 
  vn_annio 
  ); 
  -- seleccion de tipo de linea 
  SELECT 
         CASE 
                WHEN id_linea = 1 THEN 'LQ' 
                WHEN id_linea = 2 THEN 'SM' 
                WHEN id_linea = 3 THEN 'SL' 
         end 
  INTO   vn_linea 
  FROM   producto 
  WHERE  referencia = new.id_producto; 
   
  -- seleccion de consecutivo para numero de lote 
  SELECT lpad( max(substring(numero_lote, 2, 3)) +1, 3, 0 ) 
  INTO   vn_numero_lote 
  FROM   batch 
  WHERE  substring(numero_lote, 7, 2) = date_format(now(), '%y') 
  AND    substring(numero_lote, 1, 1) = vn_linea; 
   
  IF vn_numero_lote IS NULL THEN 
    SET vn_numero_lote = '001'; 
  END IF; 
  SET new 
  .numero_lote = concat( 
  vn_linea, 
  vn_numero_lote, 
  date_format(now(), '%m'), 
  vn_annio); 
END