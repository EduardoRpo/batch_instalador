    <!-- Modal -->
    <div class="modal fade" id="m_firmar" role="dialog" tabindex="-1">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <form onsubmit="return enviar();">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel" style="color: white;">Firmar</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row page">
                <div class="col-md-12 col-2 align-self-center">
                  <label for="usuariomodal2" class="col-form-label">Usuario:</label>
                  <input type="text" class="form-control" id="usuario" name="usuario">
                </div>
              </div>
              <div class="row page">
                <div class="col-md-12 col-2 align-self-center">
                  <label for="contrasenamodal2" class="col-form-label">Contraseña:</label>
                  <input type="password" class="form-control" id="clave" name="contrasena">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <input type="submit" class="btn btn-primary" value="Firmar">
          </form>
        </div>
      </div>
    </div>
  </div>
  