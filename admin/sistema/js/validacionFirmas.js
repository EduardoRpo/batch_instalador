let filas;

controlFirmas = () => {
  $.ajax({
    type: "POST",
    url: "../../../admin/sistema/php/validacionFirmas.php",
    data: { batch: "1" },
    success: function (r) {
      const data = JSON.parse(r);
      filas = data.length;

      /* for (let i = 0; i < data.length; i++) {
        if (i == 0) {
          $("#tb_firmas").append(` 
          <tr id="fila${i}">
            <th class="centrado" id="batch">${data[i].batch}</th>
            <th class="centrado" id="pesaje">
              ${
                data[0].cantidad_firmas + " " + "(" + data[0].total_firmas + ")"
              }
            </th>
            <th class="centrado" id="preparacion">
              ${
                data[1].cantidad_firmas + " " + "(" + data[1].total_firmas + ")"
              }
            </th>
            <th class="centrado" id="aprobacion">${
              data[2].cantidad_firmas + " " + "(" + data[2].total_firmas + ")"
            }</th>
            <th class="centrado" id="envasado">${
              data[3].cantidad_firmas + " " + "(" + data[3].total_firmas + ")"
            }</th>
            <th class="centrado" id="acondicionamiento">${
              data[4].cantidad_firmas + " " + "(" + data[4].total_firmas + ")"
            }</th>
            <th class="centrado" id="despachos">${
              data[5].cantidad_firmas + " " + "(" + data[5].total_firmas + ")"
            }</th>
            <th class="centrado" id="microbiologia">${
              data[6].cantidad_firmas + " " + "(" + data[6].total_firmas + ")"
            }</th>
            <th class="centrado" id="fisicoquimico">${
              data[7].cantidad_firmas + " " + "(" + data[7].total_firmas + ")"
            }</th>
            <th class="centrado" id="liberacionLote">${
              data[8].cantidad_firmas + " " + "(" + data[8].total_firmas + ")"
            }</th>
          </tr>`);
        } else if (data[i].batch != data[i - 1].batch) {
          $("#tb_firmas").append(` 
          <tr id="fila${i}">
            <th class="centrado" id="batch">${data[i].batch}</th>
            <th class="centrado" id="pesaje">
              ${
                data[0].cantidad_firmas + " " + "(" + data[0].total_firmas + ")"
              }
            </th>
            <th class="centrado" id="preparacion">
              ${
                data[1].cantidad_firmas + " " + "(" + data[1].total_firmas + ")"
              }
            </th>
            <th class="centrado" id="aprobacion">${
              data[2].cantidad_firmas + " " + "(" + data[2].total_firmas + ")"
            }</th>
            <th class="centrado" id="envasado">${
              data[3].cantidad_firmas + " " + "(" + data[3].total_firmas + ")"
            }</th>
            <th class="centrado" id="acondicionamiento">${
              data[4].cantidad_firmas + " " + "(" + data[4].total_firmas + ")"
            }</th>
            <th class="centrado" id="despachos">${
              data[5].cantidad_firmas + " " + "(" + data[5].total_firmas + ")"
            }</th>
            <th class="centrado" id="microbiologia">${
              data[6].cantidad_firmas + " " + "(" + data[6].total_firmas + ")"
            }</th>
            <th class="centrado" id="fisicoquimico">${
              data[7].cantidad_firmas + " " + "(" + data[7].total_firmas + ")"
            }</th>
            <th class="centrado" id="liberacionLote">${
              data[8].cantidad_firmas + " " + "(" + data[8].total_firmas + ")"
            }</th>
          </tr>`);
        }
      } */
    },
  });
};

controlFirmasBuscar = (batch) => {
  $("#buscarFirmas").val("");
  $.ajax({
    type: "POST",
    url: "../../../admin/sistema/php/validacionFirmas.php",
    data: { batch: batch },
    success: function (r) {
      const data = JSON.parse(r);
      for (let i = 0; i <= filas; i++) {
        $(`#fila${i}`).remove();
      }
      i = 0;
      $("#tb_firmas").append(` 
          <tr id="${batch}">
            <th class="centrado" id="batch">${batch}</th>
            <th class="centrado mod2" id="pesaje${batch}">${
        data[0] && data[0].modulo == 2
          ? data[0].cantidad_firmas + " " + "(" + data[0].total_firmas + ")"
          : 0
      }
            <th class="centrado mod3" id="preparacion${batch}">${
        data[1] && data[1].modulo == 3
          ? data[1].cantidad_firmas + " " + "(" + data[1].total_firmas + ")"
          : 0
      }
            <th class="centrado mod4" id="aprobacion${batch}">${
        data[2] && data[2].modulo == 4
          ? data[2].cantidad_firmas + " " + "(" + data[2].total_firmas + ")"
          : 0
      }
            <th class="centrado mod5" id="envasado${batch}">${
        data[3] && data[3].modulo == 5
          ? data[3].cantidad_firmas + " " + "(" + data[3].total_firmas + ")"
          : 0
      }
            <th class="centrado mod6" id="acondicionamiento${batch}">${
        data[4] && data[4].modulo == 6
          ? data[4].cantidad_firmas + " " + "(" + data[4].total_firmas + ")"
          : 0
      }
            <th class="centrado mod7" id="despachos${batch}">${
        data[5] && data[5].modulo == 7
          ? data[5].cantidad_firmas + " " + "(" + data[5].total_firmas + ")"
          : 0
      }
            </th>
            <th class="centrado mod8" id="microbiologia${batch}">${
        data[6] && data[6].modulo == 8
          ? data[6].cantidad_firmas + " " + "(" + data[6].total_firmas + ")"
          : 0
      }
            <th class="centrado mod9" id="fisicoquimico${batch}">${
        data[7] && data[7].modulo == 9
          ? data[7].cantidad_firmas + " " + "(" + data[7].total_firmas + ")"
          : 0
      }
            <th class="centrado mod10" id="liberacionLote${batch}">${
        data[8] && data[8].modulo == 10
          ? data[8].cantidad_firmas + " " + "(" + data[8].total_firmas + ")"
          : 0
      }
          </tr>`);

      let j = 2;
      for (let i = 0; i < data.length; i++) {
        cantidad_firmas = data[i].cantidad_firmas;
        total_firmas = data[i].total_firmas;
        if (cantidad_firmas != total_firmas) {
          if (j == 2) $(`#pesaje${batch}`).css("color", "red");
          if (j == 3) $(`#preparacion${batch}`).css("color", "red");
          if (j == 4) $(`#aprobacion${batch}`).css("color", "red");
          if (j == 5) $(`#envasado${batch}`).css("color", "red");
          if (j == 6) $(`#acondicionamiento${batch}`).css("color", "red");
          if (j == 7) $(`#despachos${batch}`).css("color", "red");
          if (j == 8) $(`#microbiologia${batch}`).css("color", "red");
          if (j == 9) $(`#fisicoquimico${batch}`).css("color", "red");
          if (j == 10) $(`#liberacionLote${batch}`).css("color", "red");
        }
        j++;
      }
    },
  });

  //
};

$("#buscarFirmas").change(function (e) {
  e.preventDefault();
  const buscar_batch = $("#buscarFirmas").val();
  controlFirmasBuscar(buscar_batch);
});

controlFirmas();
