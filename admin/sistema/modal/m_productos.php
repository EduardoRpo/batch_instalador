<div class="modal fade" id="m_productos" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <!-- <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> -->
      <div class="modal-body">
        <div class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="title">Registro de Productos</h5>
                </div>
                <div class="card-body">
                  <form id="frmagregarProductos">

                    <div class="row">
                      <div class="col-md-2 pr-1">
                        <div class="form-group">
                          <label for="referencia">Referencia</label>
                          <input type="text" name="referencia" id="referencia" class="form-control" placeholder="Referencia" required>
                        </div>
                      </div>
                      <div class="col-md-8 pl-1">
                        <div class="form-group">
                          <label for="nombre">Nombre</label>
                          <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" required>
                        </div>
                      </div>
                      <div class="col-md-2 pl-1">
                        <div class="form-group">
                          <label for="empaque">Unidad Empaque</label>
                          <input type="number" name="empaque" id="empaque" class="form-control" placeholder="Cantidad" required>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label for="producto">Producto</label>
                          <select class="form-control" name="nombre_producto" id="nombre_producto"></select>
                        </div>
                      </div>

                      <div class="col-md-3 pl-1">
                        <div class="form-group">
                          <label for="notificacion">Notificación Sanitaria</label>
                          <select class="form-control" name="notificacion_sanitaria" id="notificacion_sanitaria"></select>
                        </div>
                      </div>

                      <div class="col-md-3 pl-1">
                        <div class="form-group">
                          <label for="linea">Linea</label>
                          <select class="form-control" name="linea" id="linea"></select>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="marca">Marca</label>
                          <select class="form-control" name="marca" id="marca"></select>
                        </div>
                      </div>
                      <div class="col-md-6 pl-1">
                        <div class="form-group">
                          <label for="propietario">Propietario</label>
                          <select class="form-control" name="propietario" id="propietario"></select>
                        </div>
                      </div>
                      <div class="col-md-2 pl-1">
                        <div class="form-group">
                          <label for="presentacion">Presentación</label>
                          <select class="form-control" name="presentacion_comercial" id="presentacion_comercial"></select>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="color">Color</label>
                          <select class="form-control" name="color" id="color"></select>
                        </div>
                      </div>
                      <div class="col-md-6 pl-1">
                        <div class="form-group">
                          <label for="olor">Olor</label>
                          <select class="form-control" name="olor" id="olor"></select>
                        </div>
                      </div>

                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="apariencia">Apariencia</label>
                          <select class="form-control" name="apariencia" id="apariencia"></select>
                        </div>
                      </div>
                      <div class="col-md-8">
                        <div class="form-group">
                          <label for="untuosidad">Untuosidad</label>
                          <select class="form-control" name="untuosidad" id="untuosidad"></select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="poder">Poder Espumoso</label>
                          <select class="form-control" name="poder_espumoso" id="poder_espumoso"></select>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="mesofilos">Mesofilos</label>
                          <select class="form-control" name="recuento_mesofilos" id="recuento_mesofilos"></select>
                        </div>
                      </div>
                      <div class="col-md-4 pl-1">
                        <div class="form-group">
                          <label for="pseudomona">Pseudomona</label>
                          <select class="form-control" name="pseudomona" id="pseudomona"></select>
                        </div>
                      </div>
                      <div class="col-md-4 pl-1">
                        <div class="form-group">
                          <label for="escherichia">Escherichia</label>
                          <select class="form-control" name="escherichia" id="escherichia"></select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="staphylococcus">Staphylococcus</label>
                          <select class="form-control" name="staphylococcus" id="staphylococcus"></select>
                        </div>
                      </div>
                      <!-- </div> -->
                      <!--  <div class="row"> -->
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="ph">PH</label>
                          <select class="form-control" name="ph" id="ph"></select>
                        </div>
                      </div>
                      <div class="col-md-4 pl-1">
                        <div class="form-group">
                          <label for="viscosidad">Viscosidad</label>
                          <select class="form-control" name="viscosidad" id="viscosidad"></select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="densidad">Densidad</label>
                          <select class="form-control" name="densidad_gravedad" id="densidad_gravedad"></select>
                        </div>
                      </div>
                      <div class="col-md-4 pl-1">
                        <div class="form-group">
                          <label for="alcohol">Alcohol</label>
                          <select class="form-control" name="grado_alcohol" id="grado_alcohol"></select>
                        </div>
                      </div>
                    </div>

                    <button id="btnCerrar" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button id="btnguardarUsuarios" type="submit" class="btn btn-primary">Crear Producto</button>

                    <!-- <div> <?php //echo ($alert); 
                                ?> </div> -->
                  </form>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      <!--       <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>