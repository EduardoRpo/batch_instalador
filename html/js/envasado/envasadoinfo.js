/* Cargar linea y maquinas de acuerdo con la seleccion */

$( "#select-Linea" ).change(function () {
    cargarMaquinas();
  })
  
/* Cargar el numero de muestras de acuerdo con las unidades a producir*/

function calcularMuestras(batch) {  
  let muestras = batch.unidad_lote;

  if(muestras < 2001){
    $('#Muestras').val(20);
  }else if(muestras > 2000 && muestras < 4001 ){
    $('#Muestras').val(40);
  }else{
    $('#Muestras').val(60);
  }
}

/* Calcular peso minimo, maximo y promedio */

function calcularPeso(batch){
  var peso_min = batch.lote_presentacion * batch.densidad; // DENSIDAD DEBE TRAERSE DE LA GUARDADO EN APROBACION POR CALIDAD
  var peso_minimo = formatoCO(peso_min);
  
  var peso_max = peso_min * (1+0.03);
  var peso_maximo = formatoCO(peso_max);
  
  var prom = (parseInt(peso_min) + peso_max)/2;
  var promedio = formatoCO(prom);
  
  $('#Minimo').val(peso_minimo);
  $('#Maximo').val(peso_maximo);
  $('#Medio').val(promedio);
}

