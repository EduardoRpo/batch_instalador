<div class="modal fade" id="ModalCrearUsuarios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="title">Registro de Usuarios</h5>
                </div>
                <div class="card-body">
                  <form id="frmagregarUsuarios" method="POST" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label for="nombre">Nombres</label>
                          <input type="text" name="nombres" id="nombres" class="form-control" placeholder="Nombres Completos" required>
                        </div>
                      </div>
                      <div class="col-md-6 pl-1">
                        <div class="form-group">
                          <label>Apellidos</label>
                          <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Apellidos Completos" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label for="email">Correo Electrónico</label>
                          <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                        </div>
                      </div>
                      <div class="col-md-6 pl-1">
                        <div class="form-group">
                          <label>Cargo</label>
                          <select class="form-control" name="cargo" id="cargo">
                            <option value="" disabled selected>Selecciona una opción</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-4 pr-1">
                        <div class="form-group">
                          <label>Usuario</label>
                          <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario de Acceso" required>
                        </div>
                      </div>
                      <div class="col-md-4 pl-1">
                        <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="clave" id="clave" class="form-control" placeholder="Clave de Acceso" required>
                        </div>
                      </div>
                      <div class="col-md-4 pl-1">
                        <div class="form-group">
                          <label>Rol</label>
                          <select class="form-control" name="rol" id="rol">
                            <option value="" disabled selected>Selecciona una opción</option>
                            <option value="1">Superusuario</option>
                            <option value="2">Administrador</option>
                            <option value="3">Usuario</option>
                            <option value="4">Usuario QC</option>
                            <option value="5">Desarrollo</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="row" id="firma_y_modulo">
                      <div class="col-md-6">
                        <div class="form-group">
                          <form>
                            <label>Firma y Huella</label>
                            <div class="custom-file">
                              <input type="file" class="custom-file-input firma" name="firma" id="firma" lang="es">
                              <label class="custom-file-label" for="firma">Seleccionar Archivo</label>
                            </div>
                          </form>
                        </div>
                      </div>
                      <div class="col-md-6 pl-1">
                        <div class="form-group">
                          <label>Módulo de Acceso</label>
                          <select class="form-control" name="modulo" id="modulo">
                            <option value="" disabled selected>Selecciona una opción</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <button id="btnCerrar" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button id="btnguardarUsuarios" type="submit" class="btn btn-primary">Crear Usuario</button>
                  </form>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>