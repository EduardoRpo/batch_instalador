<div class="modal fade" id="m_batch_pdf" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="color: white;">PDF</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="card">
          <div class="card-header" style="background: none;"></div>
          <div class="card-body">
            <div class='mb-3'>
              <label for="" class="ml-3">Buscar</label>
              <input type="text" class="form-control" id="search" style="width: 30%;" data-toggle="popover" data-placement="top" data-content="Puede buscar por Batch Record o Lote">
              <button class="btn btn-primary" id="buscar_batch">Buscar</button>
              <label class="ml-3" id="titleBatchEliminado" style="color:red">Batch Eliminado</label>
            </div>
          </div>
        </div>

        <div class="card-header" style="background: none;">
          <h4 class="card-title" id='batchpdf'></h4>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col" class="centrado">Referencia</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Lote</th>
                    <th scope="col" class="centrado">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td id="ref" class="centrado"></td>
                    <td id="prod"></td>
                    <td id="lote"></td>
                    <td id="accions" class="centrado"></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- <div class="table-responsive">
          <table class="table table-striped table-bordered" id="tabla_batch_pdf" name="tabla_batch_pdf">
            <thead>
              <tr>
                <th>No</th>
                <th>Orden</th>
                <th>Lote</th>
                <th>Tamaño</th>
                <th>Referencia</th>
                <th>Presentación</th>
                <th>Unidad</th>
                <th>F.Creación</th>
                <th>F.Programación</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>