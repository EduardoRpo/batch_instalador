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


/* Carga tabla de propiedades del producto */
function cargarTablaEnvase(batch){

  $.ajax({
    url: '../../html/php/envase.php',
    type: 'POST',
    data: {id: batch.referencia},

  }).done((data, status, xhr) => {
    
    var info = JSON.parse(data);
    unidades = formatoCO(batch.unidad_lote);

    $('#tapa').html(info[0].referencia);
    $('#descripcion_tapa').html(info[0].descripcion);
    
    $('#envase').html(info[1].referencia);
    $('#descripcion_envase').html(info[1].descripcion);

    $('#otro').html(info[2].referencia);
    $('#descripcion_otro').html(info[2].descripcion);
  
    $('#tapa1').html(info[0].referencia);
    $('#descripcion_tapa1').html(info[0].descripcion);

    $('#envase1').html(info[1].referencia);
    $('#descripcion_envase1').html(info[1].descripcion);

    $('#otro1').html(info[2].referencia);
    $('#descripcion_otro1').html(info[2].descripcion);
    
    for (let i=1; i<7; i++){
      $('#unidades'+i).html(unidades);
    }
  
  });
}

/* Calculo de la devolucion de material */

function devolucionMaterial(valor){
  
  let unidades_envasadas = formatoCO(parseInt(valor));

  if(unidades_envasadas ==='NaN'){
    unidades_envasadas=0;
  }
  
  $('#txtCantidad_Envasada').val(unidades_envasadas);
  $('#unidades_envasadas').html(unidades_envasadas);
  $('#unidades_envasadas1').html(unidades_envasadas);
}