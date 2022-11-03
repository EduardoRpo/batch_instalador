let tnq = 1;
let total = 0;
let addtnq = 1;
let products;

$(document).ready(function () {
  /* Mostrar Modal y Ocultar select referencias */

  mostrarModal = () => {
    $('#referencia').css('display', 'none');
    $('#cmbNoReferencia').css('display', 'block');
    $('#modalCrearBatch').find('input,textarea,select').val('');
    $('#guardarBatch').html('Crear');
    $('.tcrearBatch').html('Crear Batch Record');

    $('#inpNombreReferencia').hide();
    $('#nombrereferencia').show();
    $('#calcTamanioLote').show();
    $('#pedido').prop('disabled', false);

    data = '';
    cargarNombresReferencias();
    cargarTanques();
  };

  /* Llenar el selector de referencias al crear Batch */

  /* function cargarReferencias() {
        $.ajax({
            type: "POST",
            url: "php/listarBatch.php",
            data: {
                operacion: "3",
            },
            
            success: function(r) {
                var $select = $("#cmbNoReferencia");
                $("#cmbNoReferencia").empty();
                var info = JSON.parse(r);
                $select.append("<option disabled selected>" + "Referencia" + "</option>");
                
                $.each(info, function(i, value) {
                    $select.append("<option>" + value.referencia + "</option>");
                });
                
                $("#modalCrearBatch").modal("show");
                addtnq = 1;
            },
        });
    } */

  /* Llenar campos de producto de acuerdo con la referencia del producto */

  $(document).ready(function () {
    $('#cmbNoReferencia').change(function () {
      nameRef = this.value;
      $('#nombrereferencia').val(nameRef);
      recargarDatos();
    });

    $('#nombrereferencia').change(function () {
      ref = this.value;
      $('#cmbNoReferencia').val(ref);
      recargarDatos();
    });
  });

  recargarDatos = () => {
    ref = $('#nombrereferencia').val();

    for (let i = 0; i < products.length; i++) {
      if (products[i].referencia == ref) {
        $('#idbatch').val(products[i].referencia);
        $('#marca').val(products[i].marca);
        $('#notificacionSanitaria').val(products[i].notificacion_sanitaria);
        $('#propietario').val(products[i].propietario);
        $('#producto').val(products[i].producto);
        $('#presentacioncomercial').val(products[i].presentacion_comercial);
        $('#linea').val(products[i].linea);
        $('#densidad_producto').val(products[i].densidad_producto);
        $('#ajuste').val(products[i].ajuste);
      }
    }
  };

  $(document).on('click', '#calcTamanioLote', function (e) {
    e.preventDefault();
    ref = $('#cmbNoReferencia').val();
    validarMulti(ref);
  });

  /* Adicionar referencia para crear multipresentacion en un batch*/

  /* $("#adicionarCantidades").on("click", function() {
        debugger
        objetos = $(".multi").length;
        !objetos ? (index = 1) : index++;
        
        if (index < 6) {
            $(".insertarRefCantidad").append(
                `<select class="form-control presentacion" name="presentacion" id="presentacion${index}" onchange="cargarReferenciaM(${index});"></select>
                 <input type="text" class="form-control derecha" id="cantidad${index}" name="cantidad" placeholder="cantidad" onkeyup="CalculoloteMulti(${index});">
                 <input type="text" class="form-control" id="totalKg${index}" name="totalKG" placeholder="Total Kg">
                 <button class="btn btn-warning btneliminarReg${index}" onclick="eliminarReg(${index});" type="button">X</button>`
                 );
            //cargarMulti(multi);
        }
    }); */

  /* function recargarDatos() {
        var combo = document.getElementById("cmbNoReferencia");
        var sel = combo.options[combo.selectedIndex].text;
        
        $.ajax({
            url: `/api/product/${sel}`,
            data: { operacion: "4", id: sel },
            
            success: function(r) {
                var info = JSON.parse(r);
                
                $("#idbatch").val(info[0].referencia);
                //$("#nombrereferencia").val(info[0].nombre);
                $("#marca").val(info[0].marca);
                $("#notificacionSanitaria").val(info[0].notificacion_sanitaria);
                $("#propietario").val(info[0].propietario);
                $("#producto").val(info[0].producto);
                $("#presentacioncomercial").val(info[0].presentacion_comercial);
                $("#linea").val(info[0].linea);
                $("#densidad_producto").val(info[0].densidad_producto);
                $("#ajuste").val(info[0].ajuste);
                
            },
        });
    } */

  /* calcular Tamaño del Lote */

  /* function CalculoTamanolote(valor) {
        var total = 0;
        unidades = parseInt(valor);
        densidad_producto = $("#densidad_producto").val();
        ajuste = $("#ajuste").val();
        sessionStorage.setItem('ajuste', ajuste)
        
        if (batch == undefined || batch == false)
        presentacion = formatoGeneral($("#presentacioncomercial").val());
        else
        presentacion = batch[0].presentacion_comercial;
        
        total = ((unidades * densidad_producto * presentacion) / 1000) * (1 + parseFloat(ajuste));
        
        if (total > 2500) {
            alertify.set("notifier", "position", "top-right");
            alertify.error("El lote debe ser máximo de 2500 kg");
            $('#unidadesxlote').val('');
            $('#tamanototallote').val('');
            
            return false
        }
        
        if (isNaN(total))
        total = 0
        
        total1 = formatoCO(total.toFixed(2));
        $("#tamanototallote").val(total1);
    } */

  /* Limpiar datos al cambiar referencia en el modal de crear Batch */

  $('#cmbNoReferencia').change(function () {
    $('#tamanototallote').val('');
    $('#unidadesxlote').val('');
    $('#fechaprogramacion').val('');
  });

  /* Calcular el valor de los tanques */

  $(document).on('change', '.select-tanque', function (e) {
    idTanque = this.id;
    if (idTanque.includes('-')) {
      i = idTanque.slice(-1, idTanque.length);
      idCant = `cantTanque-${i}`;
    } else idCant = 'txtCantidad1';

    $(`#${idCant}`).click();
  });

  $(document).on('click keyup', '.txtCantidad', function (e) {
    let sumaTanques = 0;
    idCant = this.id;
    if (idCant.includes('-')) i = idCant.slice(-1, idCant.length);

    if (idCant.includes('-')) tanque = parseFloat($(`#cmbTanque-${i}`).val());
    else tanque = parseFloat($(`#${idTanque}`).val());

    let tamanioTanque = parseFloat($(`#${idCant}`).val());

    if (tamanioTanque < 0 || tamanioTanque == '' || isNaN(tamanioTanque)) {
      alertify.set('notifier', 'position', 'top-right');
      alertify.error('Ingrese la cantidad de Tanques');
      return false;
    }

    if (tanque == null || isNaN(tanque)) {
      alertify.set('notifier', 'position', 'top-right');
      alertify.error('Seleccione el tamaño del tanque');
      if (idCant.includes('-')) $(`#cantTanque-${i}`).val('');
      return false;
    }

    let cantidadLote = parseFloat($('#tamanototallote').val());
    if (isNaN(cantidadLote) && idCant.includes('-')) {
      cantidadLote = parseFloat($(`#tamanioLote-${i}`).html());
    }

    if (isNaN(cantidadLote)) {
      $('#tamanototallote').val('');
      alertify.set('notifier', 'position', 'top-right');
      alertify.error('Calcule el tamaño del lote');
      return false;
    }

    tamanioTotalTanque = tanque * tamanioTanque;

    if (tamanioTotalTanque <= cantidadLote) {
      alertify.set('notifier', 'position', 'top-right');
      alertify.error(
        'La configuración de Tanques No supera el Tamaño del lote'
      );

      if (idCant.includes('-')) {
        $(`#cantTanque-${i}`).val('');
      } else {
        $('#sumaTanques').val('');
        $('#txtTotal1').val('');
      }
      return false;
    } else {
      if (idCant.includes('-')) {
        /* Capturar datos */
        granel = $(`#granel-${i}`).html();

        dataTanques = {
          granel: granel,
          tanque: tanque,
          cantidades: tamanioTanque,
        };
        dataTanquesPlaneacion.push(dataTanques);
      } else {
        $('#sumaTanques').val(tamanioTotalTanque);
        $('#txtTotal1').val(tamanioTotalTanque);
      }
    }
  });

  /* function validarTanque(id) {
        const cant = $("#txtCantidad" + id).val();
        
        if (cant != "") {
            CalcularTanque(id);
        }
    }
    
    function CalcularTanque(id) {
        const tanque = $("#cmbTanque" + id).val();
        const cantidad = $("#txtCantidad" + id).val();
        
        if (cantidad >= 11) {
            $("#txtTotal1").val("");
            $("#sumaTanques").val("");
            alertify.set("notifier", "position", "top-right");
            alertify.error("Supera el número de tanques");
            return false;
        }
        
        if (tanque == "" || cantidad == "" || cantidad == 0) {
            return false;
        }
        
        $("#sumaTanques").val("");
        
        if (tanque == "null") {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Seleccione el Tanque");
            return false;
        }
        
        total = tanque * cantidad;
        $("#txtTotal" + id).val(total);
        
        var sumaTanques = 0;
        
        for (i = 1; i <= id; i++) {
            let total = $("#txtTotal" + i).val();
            sumaTanques = parseInt(sumaTanques) + parseInt(total);
        }
        
        let cantidadLote = parseFloat($("#tamanototallote").val());
        //cantidadLote = formatoGeneral(cantidadLote);
    
        if (sumaTanques <= cantidadLote) {
            alertify.set("notifier", "position", "top-right");
            alertify.error("La configuración de Tanques supera el Tamaño del lote");
            return false;
        } else {
            $("#sumaTanques").val(sumaTanques);
        }
    } */

  cerrarModal = () => {
    $('#modalCrearBatch').modal('hide');
    $('#Modal_Multipresentacion').modal('hide');
    $('#m_observaciones').modal('hide');
  };
});
