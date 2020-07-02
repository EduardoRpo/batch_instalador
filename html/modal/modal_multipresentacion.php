
<div class="modal fade" id="Modal_Multipresentacion" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><strong style="color: white;">Multipresentación</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <input class="btn btn-primary ml-3" id="masMulti" type="button" value="Adicionar" style="width: 150px;" >
            <label class="labelcenter ml-3 mr-3">Tamaño Lote</label>
            <input type="text" id="loteTotal" class="form-control" style = "width: 100px;" readonly>
            <input type="text" id="transitoMulti" hidden>
          </div>
            <div class="insertarRefMulti mb-3 mt-3"></div>        
        </div>
      <div class="inputcalculoTotal mb-3 mr-5" style="display: flex; justify-content:flex-end">  
        <label class="labelcenter ml-3 mr-3" style="padding-right: 10px;">Total</label>
        <input id="sumaMulti" type="text" class="form-control" style="width: 28%;" readonly autocomplete="off">
      </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary" onclick="guardar_Multi();">Aceptar</button>
      </div>
    </div>
  </div>
</div>
