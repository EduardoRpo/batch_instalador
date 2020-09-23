<div class="modal fade" id="m_CondicionesMedio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Condiciones del Medio</h5>
      </div>
      <div class="modal-body">
        <div class="condicionesMedio">
          <label class="tituloDesinfeccion"><strong>Recuerde mínimo cada 2 horas hacer aspersión desinfectante en el área</strong></label>
          <!-- <input type="date" id="" class="form-control mb-3 fechaCondicionesMedio" readonly> -->
          <img src="../../assets/images/icon/termometro.png" alt="Temperatura" width="25px">
          <label>Temperatura</label>
          <input type="number" id="temperatura" class="form-control" style="text-align: center;" required>
          
          <img src="../../assets/images/icon/humedad.png" alt="Humedad" width="25px">
          <label>Humedad</label>
          <input type="number" id="humedad" class="form-control" style="text-align: center;" required>
        
        </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button> -->
        <button type="button" class="btn btn-primary" onclick="guardar_condicionesMedio();">Guardar</button>
      </div>
    </div>
  </div>
</div>