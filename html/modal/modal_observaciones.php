<div class="modal" id="modalObservaciones" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="color: white;">Observaciones</h5>
      </div>
      <div class="modal-body">
        <label style="margin-left: 50px;">Incidencias</label>
        <label style="margin-left: 390px;">Observaciones</label>

        <div class="observacion">
          <label class="categorias">1-Metodo, 2-Materiales, 3-Medicion, 4-Máquina, 5-Mano de Obra, 6-Medio Ambiente, 7-Necesarias </label>

          <label>1</label>
          <select class="custom-select" id="incidencias1" style="font-size: small;">
            <option value="" hidden selected>METODO</option>
            <textarea class="form-control txtObservaciones" aria-label="With textarea"></textarea>

            <label for="">2</label>
            <select class="custom-select" id="incidencias2" style="font-size: small;">
              <option value="" hidden selected>MATERIALES</option>
            </select>

            <label for="">3</label>
            <select class="custom-select" id="incidencias3" style="font-size: small;">
              <option value="" hidden selected>MEDICIÓN</option>
            </select>

            <label for="">4</label>
            <select class="custom-select" id="incidencias4" style="font-size: small;">
              <option value="" hidden selected>MÁQUINA</option>
            </select>

            <label for="">5</label>
            <select class="custom-select" id="incidencias5" style="font-size: small;">
              <option value="" hidden selected>MANO DE OBRA</option>
            </select>

            <label for="">6</label>
            <select class="custom-select" id="incidencias6" style="font-size: small;">
              <option value="" hidden selected>MEDIO AMBIENTE</option>
            </select>

            <label for="">7</label>
            <select class="custom-select" id="incidencias7" style="font-size: small;">
              <option value="" hidden selected>INCIDENCIAS NECESARIAS</option>
            </select>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="guardarIncidencias">Guardar</button>
        <button type="button" class="btn btn-secondary" id="cerrarIncidencias">Cerrar</button>
      </div>
    </div>
  </div>
</div>