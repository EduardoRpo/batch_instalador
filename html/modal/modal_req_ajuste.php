<div class="modal" tabindex="-1" role="dialog" id="m_req_ajuste">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="color: white;">Requerimiento de Ajuste</h5>
      </div>
      <form action="" id="req_ajustes">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12 col-2 align-self-center">
              <label for="">Materia prima</label>
              <textarea class="form-control" id="req_materiales" rows="3"></textarea>
            </div>
            <div class="col-md-12 col-2 align-self-center">
              <label for="">Procedimiento</label>
              <textarea class="form-control" id="req_procedimiento" rows="3"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button id="btnEnviarAjuste" onclick="guardarRequerimientoAjuste();" type="button" class="btn btn-primary">Enviar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>