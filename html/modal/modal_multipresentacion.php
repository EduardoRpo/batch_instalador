<div class="modal" id="Modal_Multipresentacion" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><strong style="color: white;">Multipresentación</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row adicionarMulti">
          <input class="btn btn-primary ml-3" id="adicionarMultipresentacion" type="button" value="Adicionar" style="width: 150px;">
          <!-- <label class="labelcenter ml-3 mr-3">Tamaño Total Lote (Kg)</label>
          <input type="text" id="loteTotal" class="form-control" style="width: 100px;" readonly> -->
        </div>
        <!-- <div class="insertarRefMulti mb-3 mt-3" id="etiquetasMulti" style="justify-items:center; display: none;">
          <p><b>Presentación</b></p>
          <p><b>Unidades</b></p>
          <p><b>Lote</b></p>
        </div> -->
        <table class="table table-borderless text-center">
          <thead>
            <tr>
              <th scope="col">Referencia</th>
              <th scope="col">Unidades</th>
              <th scope="col">Peso</th>
              <th></th>
            </tr>
          </thead>
          <tbody id="insertarRefMulti">
          </tbody>
        </table>
      </div>
      <div class="inputcalculoTotal mb-3 mr-5" style="display: flex; justify-content:flex-end">
        <label class="labelcenter ml-3 mr-3" style="padding-right: 10px;">Total (Kg)</label>
        <input id="sumaMulti" type="text" class="form-control centrado" style="width: 28%;" readonly autocomplete="off">
        <input id="totalKg" type="text" class="form-control centrado" style="width: 28%;" hidden>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <?php if ($_SESSION['rol'] != 6) {  ?>
          <button type="button" class="btn btn-primary footSaveMulti" id="btnCargarKg">Guardar</button>
        <?php  }  ?>
      </div>
    </div>
  </div>
</div>