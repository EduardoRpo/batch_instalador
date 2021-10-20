<!-- Modal -->
<div class="modal fade" id="modalCarguePedidos" tabindex="1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="color: white;">Cargar Lista Pedidos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <form name="formDataExcel" id="formDataExcel" enctype="multipart/form-data">
                        <div>
                            <label>Seleccione el archivo de pedidos</label>
                            <input type="file" class="form-control" name="file" id="file" accept=".xls,.xlsx">
                            <div style="display:flex; justify-content:center">
                                <button type="submit" id="submit" name="import" class="btn btn-primary form-control mt-3" style="width: 50%;">Importar</button>
                            </div>
                        </div>
                    </form>
                    <!-- <form id="formDataExcel" enctype="multipart/form-data">
                        <input type="file" name="datosExcel" id="datosExcel" class="form-control">
                    </form> -->
                    <!-- <button type="button" id="btnCargarExcel" class="btn btn-primary ml-3">Cargar Archivo</button> -->
                </div>
            </div>

        </div>
    </div>
</div>