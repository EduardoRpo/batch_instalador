$("#envasadoMulti1").mouseover(function () {
  ref = $("#ref1").val();
  cargarImagen(ref);
});

$("#envasadoMulti2").mouseover(function () {
  ref = $("#ref2").val();
  cargarImagen(ref);
});

$("#envasadoMulti3").mouseover(function () {
  ref = $("#ref3").val();
  cargarImagen(ref);
});

$("#acondicionamientoMulti1").mouseover(function () {
  ref = $("#ref1").val();
  cargarImagen(ref);
});

$("#acondicionamientoMulti2").mouseover(function () {
  ref = $("#ref2").val();
  cargarImagen(ref);
});

$("#acondicionamientoMulti3").mouseover(function () {
  ref = $("#ref3").val();
  cargarImagen(ref);
});

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
};
