<div class="modal fade" id="modalCrearBatch" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="  background-color: #FF8D6D !important;">
                <h5 class="modal-title" id="exampleModalLabel"><span class="tcrearBatch"><b>Crear Batch Record</b></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="formBatch" name="formBatch" method="POST" autocomplete="off">
                    <input id="idbatch" class="displayallinfo" name="idbatch" hidden required>

                    <div class="row page">
                        <div class="col-md-3 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label">Referencia</label>
                            <input id="referencia" type="" class="displayallinfo" name="referencia" readonly>
                            <select class="form-control" name="cmbNoReferencia" id="cmbNoReferencia" required></select>
                        </div>

                        <div class="col-md-9 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label">Nombre</label><br>
                            <input id="nombrereferencia" class="displayallinfo" readonly name="nombrereferencia">
                        </div>

                    </div>
                    <hr>
                    <div class="row page">

                        <div class="col-md-4 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label">Marca</label>
                            <input id="marca" class="displayallinfo" readonly name="marca">
                        </div>
                        <div class="col-md-8 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label">Propietario</label>
                            <input id="propietario" class="displayallinfo" readonly name="propietario">
                        </div>
                    </div>

                    <div class="row page">
                        <div class="col-md-4 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label">Producto</label>
                            <input id="producto" class="displayallinfo" readonly name="producto">
                        </div>
                        <div class="col-md-4 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label">Presentación Comercial</label>
                            <input id="presentacioncomercial" class="displayallinfo" readonly name="presentacioncomercial" readonly>
                        </div>
                        <!-- 
                        <div class="col-md-1 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label">ML</label>
                        </div> -->

                        <div class="col-md-4 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label">Linea</label>
                            <input id="linea" class="displayallinfo" readonly name="linea" readonly>
                        </div>
                    </div>

                    <hr>

                    <div class="row page">
                        <div class="col-md-4 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label">Notificación Sanitaria</label>
                            <input id="notificacionSanitaria" class="displayallinfo" readonly name="notificacionSanitaria" required>
                        </div>

                        <input type="text" id="densidad" hidden>
                    </div>
                    <hr>
                    <div class="row page">
                        <div class="col-md-4 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label">Unidades por Lote</label>
                            <input type="number" name="unidadesxlote" id="unidadesxlote" onkeyup="CalculoTamanolote(this.value);" class="form-control" min="1" required />
                        </div>
                        <div class="col-md-4 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label" type="number">Tamaño del Lote (Kg)</label>
                            <input type="number" name="tamanototallote" id="tamanototallote" class="form-control Numeric" min="1" readonly value="" style="height: 70px; font-size: xx-large; width: 160; text-align: center" />
                        </div>

                    </div>
                    <hr>
                    <div class="row page">
                        <div class="col-md-4 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label">Fecha de Programación</label>
                            <input type="date" class="form-control" id="fechaprogramacion" name="fechaprogramacion" value="" min="<?php $hoy = date("Y-m-d"); echo $hoy; ?>">
                        </div>

                    </div>
                    <hr>
                    <div class="row page">
                        <div class="col-md-6 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label">Observaciones Pesaje / Preparación</label>
                        </div>
                    </div>
                    <div class="row page">
                        <div class="col-md-6 col-2 align-self-center">
                            <button id="adicionarPesaje" name="adicionarPesaje" type="button" class="btn btn-primary">Adicionar</button>
                            <!-- <label for="">Cantidad</label>-->
                            <input type="number" class="form-control col-md-4" id="transito" hidden readonly>
                            <input type="number" class="form-control col-md-4" id="sumaTanques" readonly>
                        </div>
                    </div>
                    <div class="mb-3 mt-3 insertarTanque">
                        <!-- <select class="form-control" name="cmbtanque" id="cmbTanque">
                            <option disabled selected>Tanque(Kg)</option>
                        </select>
                        <input type="number" class="form-control" id="txtCantidad" name="txtCantidad[]" placeholder="Cantidad" value="0" onkeyup="CalcularTanque(this.value)">
                        <input type="number" class="form-control" id="txtTotal" name="txtTotal[]" placeholder="Total" readonly>
                        <button class="btn btn-warning eliminar" type="button">X</button> -->
                    </div>

                    <div class="modal-footer">
                        <button type="button" onclick="guardarDatos();" class="btn btn-primary crearbatch" name="guardarBatch" id="guardarBatch">Crear</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>