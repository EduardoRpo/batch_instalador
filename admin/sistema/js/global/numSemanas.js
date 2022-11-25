$(document).ready(function () {
  // Calcular numero de semana actual
  Date.prototype.getWeekNumber = function () {
    var d = new Date(+this);
    d.setHours(0, 0, 0, 0);
    d.setDate(d.getDate() + 4 - (d.getDay() || 7));

    return Math.ceil(((d - new Date(d.getFullYear(), 0, 1)) / 8.64e7 + 1) / 7);
  };

  // Cargar numero de semanas
  loadsemanas = () => {
    // Calcular numero de semana actual
    semanaActual = new Date().getWeekNumber();

    let select = $('#numSemana');

    select.empty();
    //select.append(`<option disabled>Numero Semana</option>`);

    for (i = 1; i <= 52; i++) {
      if (i >= semanaActual) {
        let options = $('#numSemana option').length;
        if (options < 12) select.append(`<option value ="${i}">${i}</option>`);
      }
    }

    for (i = 1; i < 52; i++) {
      let options = $('#numSemana option').length;

      if (options < 12) select.append(`<option value ="${i}">${i}</option>`);
      else break;
    }
  };
  loadsemanas();

  $(`#numSemana option[value="${semanaActual}"]`).prop('selected', true);
  selectChange = () => {
    $('#numSemana').trigger('change');
  };

  setTimeout(selectChange, 4000);
});
