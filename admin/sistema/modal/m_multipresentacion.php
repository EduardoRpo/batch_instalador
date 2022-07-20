<div class="modal fade" id="ModalCrearMulti" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="title">Multipresentación</h5>
                                </div>
                                <div class="card-body">
                                    <div class="ms-multi">
                                        <input type="text" class="form-control" id="busquedaproductos" placeholder="Bucar Productos">
                                        <select multiple="multiple" id="cmbproductos" name="cmbproductos[]" class="form-control List mt-3 mb-3">

                                        </select>
                                        <div class="centrado">
                                            <button class="btn btn-primary" id="seleccionar">▼</button>
                                            <button class="btn btn-primary" id="borrar">▲</button>
                                        </div>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="busquedamulti" placeholder="Buscar Multipresentacion">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" id="btnBuscarMulti">Buscar</button>
                                            </div>
                                        </div>
                                        <label style="font-style: italic; color:red; font-weight:bolder" class="warning" hidden>Ingrese una referencia</label>

                                        <select multiple="multiple" id="cmbmulti" name="cmbmulti[]" class="form-control mt-3">
                                        </select>

                                        <div class="derecha mt-5">
                                            <button class="btn btn-primary" id="btnCrearMulti">Crear</button>
                                            <button class="btn btn-secondary" id="btnEliminarMulti" >Eliminar</button>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <div class="card-body">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>