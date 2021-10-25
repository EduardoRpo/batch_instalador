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

/* Importar pedidos */

$('#importarFile').on('click', function (e) {
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

        $.ajax({
          type: 'POST',
          url: '../../../admin/sistema/php/explosion_materiales/pedidos.php',
          data: { data: data },
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
          success: function (response) {
            let data = JSON.parse(response)
            localStorage.setItem('referencias', data)
            $('#uploadStatus').html(
              '<span style="color:#28A74B;">Datos importados correctamente.<span>',
            )
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

/* Datatable consolidado */

$('#tblExplosionMaterialesPedidos').dataTable({
  pageLength: 50,
  order: [[1, 'desc']],
  dom: 'Bfrtip',
  order: [[0, 'asc']],
  buttons: [
    {
      extend: 'excel',
      text: 'Exportar',
      className: 'btn btn-primary',
      exportOptions: {
        columns: [0, 1, 5],
      },
    },
  ],
  ajax: {
    url: '/api/explosionMaterialesPedidos',
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
      title: 'Requerida Batch',
      data: 'cantidad_batch',
      className: 'uniqueClass',
      render: $.fn.dataTable.render.number('.', ',', 2),
    },
    {
      title: 'Requerida Pedidos',
      data: 'cantidad_pedidos',
      className: 'uniqueClass',
      render: $.fn.dataTable.render.number('.', ',', 2),
    },
    {
      title: 'Utilizada',
      data: 'cantidad_batch_uso',
      className: 'uniqueClass',
      render: $.fn.dataTable.render.number('.', ',', 2),
    },
    {
      title: 'Gap',
      data: 'gap',
      className: 'uniqueClass',
      render: $.fn.dataTable.render.number('.', ',', 2),
    },
  ],
})

/* Referencias sin formula */

$('#btnReferenciasSinFormula').click(function (e) {
  e.preventDefault()

  data = localStorage.getItem('referencias')
  data = data.split(',')

  Data = []
  for (let j = 0; j < data.length; j++) {
    arry = {}
    arry.id = j + 1
    arry.ref = data[j]
    Data.push(arry)
  }

  let ws = XLSX.utils.json_to_sheet(Data)
  let wb = XLSX.utils.book_new()
  XLSX.utils.book_append_sheet(wb, ws, 'Referencias')

  XLSX.writeFile(wb, 'referenciasSinFormula.xlsx')
})
