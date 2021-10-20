/* Mostrar Menu seleccionadp */
$('.contenedor-menu .menu a').removeAttr('style')
$('#link_menu_explosion_pedidos').css('background', 'coral')
$('.contenedor-menu .menu ul.menu_explosion').show()

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
