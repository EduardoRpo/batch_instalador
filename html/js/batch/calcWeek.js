$(document).ready(function() {
    currentdate = new Date();
    var oneJan = new Date(currentdate.getFullYear(), 0, 1);
    var numberOfDays = Math.floor((currentdate - oneJan) / (24 * 60 * 60 * 1000));
    var result = Math.ceil((currentdate.getDay() + numberOfDays) / 7);
    $(`#numberWeek`).html(`Semana No. ${result}`);
});