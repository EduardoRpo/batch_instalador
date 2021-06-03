let filas

controlCondiciones = () => {
    $.ajax({
      type: "POST",
      url: "../../../admin/sistema/php/condicionesMedio.php",
      data: { batch: "1" },
      success: function (r) {
        const data = JSON.parse(r);
        filas = data.length;
        for (let i = 0; i < data.length; i++) {
          
            $("#tb_medios").append(` 
                  <tr id="fila${i+1}">
                      <th class="centrado" id="batch">${data[i].id_batch}</th>
                      <th class="centrado" id="pesaje">${data[i].id_modulo==2 ? 1 :''}</th>
                      <th class="centrado" id="preparacion">${data[i].id_modulo==3 ? 1 :''}</th>
                      <th class="centrado" id="aprobacion">${data[i].id_modulo==4 ? 1 :''}</th>
                      <th class="centrado" id="envasado">${data[i].id_modulo==5 ? 1 :''}</th>
                      <th class="centrado" id="acondicionamiento">${data[i].id_modulo==6 ? 1 :''}</th>
                      <th class="centrado" id="microbiologia">${data[i].id_modulo==8 ? 1 :''}</th>
                      <th class="centrado" id="fisicoquimico">${data[i].id_modulo==9 ? 1 :''}</th>
                    </tr>`);
        }
      },
    });
}

controlCondicionesBuscar = (batch) => {
    $.ajax({
      type: "POST",
      url: "../../../admin/sistema/php/condicionesMedio.php",
      data: { batch: batch },
      success: function (r) {
        const data = JSON.parse(r);
        for (let i = 0; i <= filas; i++) {
            $(`#fila${i}`).remove();
        }

        for (let i = 0; i < data.length; i++) {
          
            $("#tb_medios").append(` 
                 <tr id="fila${i+1}">
                      <th class="centrado" id="batch">${data[i].id_batch}</th>
                      <th class="centrado" id="pesaje">${data[i].id_modulo==2 ? 1 :''}</th>
                      <th class="centrado" id="preparacion">${data[i].id_modulo==3 ? 1 :''}</th>
                      <th class="centrado" id="aprobacion">${data[i].id_modulo==4 ? 1 :''}</th>
                      <th class="centrado" id="envasado">${data[i].id_modulo==5 ? 1 :''}</th>
                      <th class="centrado" id="acondicionamiento">${data[i].id_modulo==6 ? 1 :''}</th>
                      <th class="centrado" id="microbiologia">${data[i].id_modulo==8 ? 1 :''}</th>
                      <th class="centrado" id="fisicoquimico">${data[i].id_modulo==9 ? 1 :''}</th>
                    </tr>`);
        }
      },
    });
}

$('#buscarmedios').change(function (e) { 
    e.preventDefault();
    const buscar_batch = $('#buscarmedios').val();
    controlCondicionesBuscar(buscar_batch)
});

controlCondiciones();

