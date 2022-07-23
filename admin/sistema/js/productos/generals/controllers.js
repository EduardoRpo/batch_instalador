// $("#1").slideUp();
$("#2").slideUp();
$("#3").slideUp();
$("#4").slideUp();
$("#5").slideUp();
$("#6").slideUp();

$(document).ready(function () {
  $(document).on("click", ".controller", function (e) {
    id = this.id;   
    $(`.cardGenerales`).toggle();
    $(`#card_${id}`).slideDown();
    
  });
});

// $(document).ready(function () {
//     debugger
//   $("#1").slideUp();
//   $("#2").slideUp();
//   $("#3").slideUp();
//   $("#4").slideUp();
//   $("#5").slideUp();
//   $("#6").slideUp();

//   $(document).on("click", "#nombre_producto", function (e) {
//     e.preventDefault();

//     $("#1").slideDown();
//     $("#2").slideUp();
//     $("#3").slideUp();
//     $("#4").slideUp();
//     $("#5").slideUp();
//     $("#6").slideUp();
//   });
//   $(document).on("click", "#notificacion_sanitaria", function (e) {
//     e.preventDefault();

//     $("#1").slideUp();
//     $("#2").slideDown();
//     $("#3").slideUp();
//     $("#4").slideUp();
//     $("#5").slideUp();
//     $("#6").slideUp();
//   });
//   $(document).on("click", "#linea", function (e) {
//     e.preventDefault();

//     $("#1").slideUp();
//     $("#2").slideUp();
//     $("#3").slideDown();
//     $("#4").slideUp();
//     $("#5").slideUp();
//     $("#6").slideUp();
//   });

//   $(document).on("click", "#marca", function (e) {
//     e.preventDefault();

//     $("#1").slideUp();
//     $("#2").slideUp();
//     $("#3").slideUp();
//     $("#4").slideDown();
//     $("#5").slideUp();
//     $("#6").slideUp();
//   });
//   $(document).on("click", "#propietario", function (e) {
//     e.preventDefault();

//     $("#1").slideUp();
//     $("#2").slideUp();
//     $("#3").slideUp();
//     $("#4").slideUp();
//     $("#5").slideDown();
//     $("#6").slideUp();
//   });
//   $(document).on("click", "#presentacion_comercial", function (e) {
//     e.preventDefault();

//     $("#1").slideUp();
//     $("#2").slideUp();
//     $("#3").slideUp();
//     $("#4").slideUp();
//     $("#5").slideUp();
//     $("#6").slideDown();
//   });
// });
