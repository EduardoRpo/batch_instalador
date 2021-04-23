$(".img_ref").click(function (e) {
  e.preventDefault();
  let input;
  let ref;
  input = this.nextElementSibling.className;
  ref = $(`.${input}`).val();
  cargarImagen(ref);
});

/* $(".img_ref").mouseleave(function () {
  $("#imageRef").modal("hide");
}); */

/* $.doTimeout(5000, function () {
  //$("#mydiv").fadeOut();
  $("#imageRef").modal("hide");
}); */

const cargarImagen = (ref) => {
  let mbatch;
  let img;
  batchMulti == 0 ? (mbatch = batch) : (mbatch = batchMulti);

  $("#imageRef").modal("show");
  if (batchMulti == 0) {
    $("#img").prop("src", mbatch.img);
    $("#img").prop("alt", mbatch.referencia);
  } else {
    mbatch.forEach((element) => {
      if (element.referencia == ref) {
        img = element.img;
        ref = element.referencia;
      }
    });

    $("#img").prop("src", img);
    $("#img").prop("alt", ref);
  }
  //$("#imageRef").fadeOut(3000).modal("hide");
  setTimeout("$('#imageRef').modal('hide');", 5000);
};
