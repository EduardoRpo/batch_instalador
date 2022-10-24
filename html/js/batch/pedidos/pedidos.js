$(document).ready(function () {
  let selectedFile;

  $('.cardImportarPedidos').hide();

  $('#btnCargarExcelPedidos').click(function (e) {
    $('.cardImportarPedidos').toggle(800);
  });
});

$('#filePedidos').change(function (e) {
  e.preventDefault();
  selectedFile = e.target.files[0];
});

/* $('#btnCargarExcelPedidos').click(function (e) {
e.preventDefault()

$.ajax({
url: '../../../html/php/explosion_materiales/pedidos.php',

beforeSend: function () {
  $('#spinner').css('display', 'block')
},

success: function (data) {
  alertify.set('notifier', 'position', 'top-right')
  alertify.success('Pedidos importados exitosamente')
  $('#spinner').css('display', 'none')
},
})
})
*/
