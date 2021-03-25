<div class="modal" id="Modal_Multipresentacion" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><strong style="color: white;">Multipresentación</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <input class="btn btn-primary ml-3" id="adicionarMultipresentacion" type="button" value="Adicionar" style="width: 150px;">
          <label class="labelcenter ml-3 mr-3">Tamaño Total Lote (Kg)</label>
          <input type="text" id="loteTotal" class="form-control" style="width: 100px;" readonly>
        </div>
        <div class="insertarRefMulti mb-3 mt-3" id="etiquetasMulti" style="justify-items:center; display: none;">
          <p><b>Presentación</b></p>
          <p><b>Unidades</b></p>
          <p><b>Lote</b></p>
        </div>
        <div class="insertarRefMulti mb-3 mt-3">
          <!-- <label class="centrado">Multipresentación</label>
              <label class="centrado">No Unidades</label>
              <label class="centrado">Total</label>
              <label for=""></label> -->

          <select class="form-control select" name="MultiReferencia" id="cmbMultiReferencia1" onchange="cargarReferenciaM(1);"></select>
          <input type="text" class="form-control derecha" id="txtcantidadMulti1" name="cantidadMulti" placeholder="Unidades" onkeyup="CalculoloteMulti(1, this.value);">
          <input type="text" class="form-control derecha" id="txttamanoloteMulti1" name="tamanoloteMulti" readonly placeholder="Lote">
          <input type="text" class="form-control" id="txtdensidadMulti1" name="densidadMulti" placeholder="Densidad" >
          <input type="text" class="form-control" id="txtpresentacionMulti1" name="presentacionMulti" placeholder="Presentación" >
          <button class="btn btn-warning btneliminarMulti1" onclick="eliminarMulti(1);" type="button">X</button>

          <select class="form-control select" name="MultiReferencia" id="cmbMultiReferencia2" onchange="cargarReferenciaM(2);"></select>
          <input type="text" class="form-control derecha" id="txtcantidadMulti2" name="cantidadMulti" placeholder="Unidades" onkeyup="CalculoloteMulti(2, this.value);">
          <input type="text" class="form-control derecha" id="txttamanoloteMulti2" name="tamanoloteMulti" readonly placeholder="Lote">
          <input type="text" class="form-control" id="txtdensidadMulti2" name="densidadMulti" placeholder="Densidad" >
          <input type="text" class="form-control" id="txtpresentacionMulti2" name="presentacionMulti" placeholder="Presentación" >
          <button class="btn btn-warning btneliminarMulti2" onclick="eliminarMulti(2);" type="button">X</button>

          <select class="form-control select" name="MultiReferencia" id="cmbMultiReferencia3" onchange="cargarReferenciaM(3);"></select>
          <input type="text" class="form-control derecha" id="txtcantidadMulti3" name="cantidadMulti" placeholder="Unidades" onkeyup="CalculoloteMulti(3, this.value);">
          <input type="text" class="form-control derecha" id="txttamanoloteMulti3" name="tamanoloteMulti" readonly placeholder="Lote">
          <input type="text" class="form-control" id="txtdensidadMulti3" name="densidadMulti" placeholder="Densidad" >
          <input type="text" class="form-control" id="txtpresentacionMulti3" name="presentacionMulti" placeholder="Presentación" >
          <button class="btn btn-warning btneliminarMulti3" onclick="eliminarMulti(3);" type="button">X</button>

          <select class="form-control select" name="MultiReferencia" id="cmbMultiReferencia4" onchange="cargarReferenciaM(4);"></select>
          <input type="text" class="form-control derecha" id="txtcantidadMulti4" name="cantidadMulti" placeholder="Unidades" onkeyup="CalculoloteMulti(4, this.value);">
          <input type="text" class="form-control derecha" id="txttamanoloteMulti4" name="tamanoloteMulti" readonly placeholder="Lote">
          <input type="text" class="form-control" id="txtdensidadMulti4" name="densidadMulti" placeholder="Densidad" >
          <input type="text" class="form-control" id="txtpresentacionMulti4" name="presentacionMulti" placeholder="Presentación" >
          <button class="btn btn-warning btneliminarMulti4" onclick="eliminarMulti(4);" type="button">X</button>

          <select class="form-control select" name="MultiReferencia" id="cmbMultiReferencia5" onchange="cargarReferenciaM(5);"></select>
          <input type="text" class="form-control derecha" id="txtcantidadMulti5" name="cantidadMulti" placeholder="Unidades" onkeyup="CalculoloteMulti(5, this.value);">
          <input type="text" class="form-control derecha" id="txttamanoloteMulti5" name="tamanoloteMulti" readonly placeholder="Lote">
          <input type="text" class="form-control" id="txtdensidadMulti5" name="densidadMulti" placeholder="Densidad" >
          <input type="text" class="form-control" id="txtpresentacionMulti5" name="presentacionMulti" placeholder="Presentación" >
          <button class="btn btn-warning btneliminarMulti5" onclick="eliminarMulti(5);" type="button">X</button>
        </div>
      </div>
      <div class="inputcalculoTotal mb-3 mr-5" style="display: flex; justify-content:flex-end">
        <label class="labelcenter ml-3 mr-3" style="padding-right: 10px;">Total (Kg)</label>
        <input id="sumaMulti" type="text" class="form-control centrado" style="width: 28%;" readonly autocomplete="off">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary" onclick="guardar_Multi();">Guardar</button>
      </div>
    </div>
  </div>
</div>