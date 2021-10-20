let selectedFile

/* Mostrar Menu seleccionadp */
$('.contenedor-menu .menu a').removeAttr('style')
$('#link_menu_explosion_pedidos').css('background', 'coral')
$('.contenedor-menu .menu ul.menu_explosion').show()

$('.excelImportar').hide()

$('#btnCargarExcel').click(function (e) {
  e.preventDefault()
  $('.excelImportar').toggle(600)
})

/* Cargar Archivo Excel */

/* $('#uploadForm').on('submit', function (e) {
  e.preventDefault()
  datos = new FormData(this)
  //datos.append("operacion", "6");
  $.ajax({
    type: 'POST',
    url: '../../../admin/sistema/php/explosion_materiales/pedidos.php',
    data: datos,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend: function () {
      $('#uploadStatus').html(
        '<img src="images/uploading.gif" style="height:100px"/>',
      )
    },
    error: function () {
      $('#uploadStatus').html(
        '<span style="color:#EA4335;">No se importó el archivo correctamente, trate nuevamente.<span>',
      )
    },
    success: function (data) {
      if (data === 'false') {
        $('#uploadStatus').html(
          '<span style="color:#EA4335;">No existe la referencia asociada a la imagen.<span>',
        )
        return false
      }
      $('#uploadForm')[0].reset()
      $('#uploadStatus').html(
        '<span style="color:#28A74B;">Archivo importado correctamente.<span>',
      )
    },
  })
}) */

$('#uploadForm').on('click', function (e) {
  if (selectedFile) {
    let fileReader = new FileReader()
    fileReader.readAsBinaryString(selectedFile)

    fileReader.onload = (e) => {
      let data = e.target.result
      let workbook = XLSX.read(data, { type: 'binary' })

      workbook.SheetNames.forEach((sheet) => {
        let rowObject = XLSX.utils.sheet_to_row_object_array(
          workbook.Sheets[sheet],
        )
        data = rowObject
        //console.log(rowObject)
        /* pedidos = JSON.stringify(rowObject, undefined, 4)
        console.log(pedidos)
 */
        /* document.getElementById('jsondata').innerHTML = JSON.stringify(
          rowObject,
          undefined,
          4,
        ) */

        $.ajax({
          type: 'POST',
          url: '../../../admin/sistema/php/explosion_materiales/pedidos.php',
          data: { data: data },

          success: function (response) {
            alertify.set('notifier', 'position', 'top-right')
            alertify.success('Datos importados exitosamente.')
            $('#fileInput').val('')
          },
        })
      })
    }
  }
})

// File type validation
$('#fileInput').change(function (e) {
  selectedFile = e.target.files[0]
  archivo = $('#fileInput').val()
  let extensiones = archivo.substring(archivo.lastIndexOf('.'))

  if (extensiones != '.xlsx') {
    alertify.set('notifier', 'position', 'top-right')
    alertify.error('Seleccione una imagen valida con formato (xlsx).')
    $('#fileInput').val('')
    return false
  }
})

$('#tblExplosionMaterialesPedidos').dataTable({
  pageLength: 50,
  order: [[1, 'desc']],
  ajax: {
    url: '/api/explosionMaterialesBatch',
    dataSrc: '',
  },
  language: {
    url: '//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
  },
  columns: [
    {
      title: 'Referencia',
      data: 'id_materiaprima',
      className: 'uniqueClassName',
    },
    {
      title: 'Materia Prima',
      data: 'nombre',
      className: 'uniqueClassName',
    },
    {
      title: 'Cantidad (Kg)',
      data: 'cantidad',
      className: 'uniqueClassName',
    },
  ],
})
