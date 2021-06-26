let envase;
let presentacion;
let r1,
  r2,
  r3 = 0;

/* Cargar referencia */

$(".ref_multi1").click(function (e) {
  e.preventDefault();
  ref_multi = $(`.ref1`).val();
  id_multi = 1;
  r1++;
  identificarDensidad(batch);
  presentacion_multi();
});

$(".ref_multi2").click(function (e) {
  e.preventDefault();
  ref_multi = $(`.ref2`).val();
  id_multi = 2;
  r2++;
  presentacion_multi();
  identificarDensidad(batch);
});

$(".ref_multi3").click(function (e) {
  e.preventDefault();
  ref_multi = $(`.ref3`).val();
  id_multi = 3;
  r3++;
  presentacion_multi();
  identificarDensidad(batch);
});

function presentacion_multi() {
  if (batchMulti) {
    batch = batchMulti.find((elemento) => elemento.referencia == ref_multi);
    presentacion = batch.presentacion;
  } else presentacion = batch.presentacion;
  cargarImagen(ref_multi);
  if (modulo !== 7) cargarfirma2();
  if (modulo === 7) {
    cargar_despacho();
    cargarBatch();
  }
}
