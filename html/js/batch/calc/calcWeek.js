$(document).ready(function () {
  sessionStorage.removeItem('semana');

  function getDateWeek() {
    let date = new Date();
    date.setHours(0, 0, 0, 0);
    date.setDate(date.getDate() + 4 - (date.getDay() || 7));
    semana = Math.ceil(
      ((date - new Date(date.getFullYear(), 0, 1)) / 8.64e7 + 1) / 7
    );
    sessionStorage.setItem('semana', semana);

    let primerdia = new Date(date.getFullYear(), 0, 1);

    let correccion = 6 - primerdia.getDay();

    let primer = new Date(
      date.getFullYear(),
      0,
      (semana - 1) * 7 + 3 + correccion
    );

    let ultimo = new Date(
      date.getFullYear(),
      0,
      (semana - 1) * 7 + 9 + correccion
    );

    let mesPrimer = primer.toLocaleString(undefined, { month: 'long' });
    let mesUltimo = ultimo.toLocaleString(undefined, { month: 'long' });

    $('.numberWeek').html(
      `<div style="font-size:x-large" class="col">Semana No. ${semana}</div>
    <div class="col">${primer.getDate()} ${
        mesPrimer.charAt(0).toUpperCase() + mesPrimer.slice(1)
      } - ${ultimo.getDate()} ${
        mesUltimo.charAt(0).toUpperCase() + mesUltimo.slice(1)
      }</div>`
    );
  }

  getDateWeek();
});
