/* Cargar imagen referencia */

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

  setTimeout("$('#imageRef').modal('hide');", 5000);
};
