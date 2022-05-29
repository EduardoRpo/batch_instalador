$(document).ready(function() {
    $('.cardImportOrders').hide();

    $('#btnCargarExcelPedidos').click(function(e) {
        $('.cardImportOrders').toggle(800);
    })
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