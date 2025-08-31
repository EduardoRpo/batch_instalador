<div class="modal" id="modalObservaciones" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title" style="color: white;">Observaciones</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <h6 class="mb-3">Incidencias</h6>
            <p class="text-muted small mb-3">1-Metodo, 2-Materiales, 3-Medicion, 4-Máquina, 5-Mano de Obra, 6-Medio Ambiente, 7-Necesarias</p>
            
            <div class="form-group">
              <label for="incidencias1">1. Método</label>
              <select class="custom-select" id="incidencias1" style="font-size: small;">
                <option value="" selected>Seleccionar</option>
              </select>
            </div>

            <div class="form-group">
              <label for="incidencias2">2. Materiales</label>
              <select class="custom-select" id="incidencias2" style="font-size: small;">
                <option value="" selected>Seleccionar</option>
              </select>
            </div>

            <div class="form-group">
              <label for="incidencias3">3. Medición</label>
              <select class="custom-select" id="incidencias3" style="font-size: small;">
                <option value="" selected>Seleccionar</option>
              </select>
            </div>

            <div class="form-group">
              <label for="incidencias4">4. Máquina</label>
              <select class="custom-select" id="incidencias4" style="font-size: small;">
                <option value="" selected>Seleccionar</option>
              </select>
            </div>

            <div class="form-group">
              <label for="incidencias5">5. Mano de Obra</label>
              <select class="custom-select" id="incidencias5" style="font-size: small;">
                <option value="" selected>Seleccionar</option>
              </select>
            </div>

            <div class="form-group">
              <label for="incidencias6">6. Medio Ambiente</label>
              <select class="custom-select" id="incidencias6" style="font-size: small;">
                <option value="" selected>Seleccionar</option>
              </select>
            </div>

            <div class="form-group">
              <label for="incidencias7">7. Incidencias Necesarias</label>
              <select class="custom-select" id="incidencias7" style="font-size: small;">
                <option value="" selected>Seleccionar</option>
              </select>
            </div>
          </div>
          
          <div class="col-md-6">
            <h6 class="mb-3">Observaciones</h6>
            <div class="form-group">
              <textarea class="form-control txtObservaciones" rows="12" placeholder="Escriba sus observaciones aquí..." aria-label="Observaciones"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="guardarIncidencias">Guardar</button>
        <button type="button" class="btn btn-secondary" id="cerrarIncidencias">Cerrar</button>
      </div>
    </div>
  </div>
</div>