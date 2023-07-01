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

    const { primerDia, ultimoDia } = calcularPrimerUltimoDiaSemana(
      semana,
      date.getFullYear()
    );

    let mesPrimer = primerDia.toLocaleString(undefined, { month: 'long' });
    let mesUltimo = ultimoDia.toLocaleString(undefined, { month: 'long' });

    $('.numberWeek').html(
      `<div style="font-size:x-large" class="col">Semana No. ${semana}</div>
    <div class="col">${primerDia.getDate()} ${
        mesPrimer.charAt(0).toUpperCase() + mesPrimer.slice(1)
      } - ${ultimoDia.getDate()} ${
        mesUltimo.charAt(0).toUpperCase() + mesUltimo.slice(1)
      }</div>`
    );
  }

  function calcularPrimerUltimoDiaSemana(numeroSemana, año) {
    const primerDiaAño = new Date(año, 0, 1); // Primer día del año
    const diaSemanaPrimerDiaAño = primerDiaAño.getDay(); // Día de la semana del primer día del año (0-6)
    const diasHastaPrimerLunes = (7 - diaSemanaPrimerDiaAño + 1) % 7; // Días hasta el primer lunes del año (+1 para incluir el primer día)
    const diasHastaSemanaDeseada =
      (numeroSemana - 1) * 7 + diasHastaPrimerLunes; // Días hasta el inicio de la semana deseada

    const primerDiaSemana = new Date(año, 0, diasHastaSemanaDeseada + 1); // Sumamos 1 para obtener el primer día de la semana
    const ultimoDiaSemana = new Date(año, 0, diasHastaSemanaDeseada + 7); // Sumamos 7 para obtener el último día de la semana

    return {
      primerDia: primerDiaSemana,
      ultimoDia: ultimoDiaSemana,
    };
  }

  getDateWeek();
});
