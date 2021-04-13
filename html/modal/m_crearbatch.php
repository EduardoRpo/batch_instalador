<div class="modal" id="modalCrearBatch" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="  background-color: #FF8D6D !important;">
                <h5 class="modal-title"><span class="tcrearBatch"><b>Crear Batch Record</b></span></h5>
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
                        <div class="col-md-6 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label">Producto</label>
                            <input id="producto" class="displayallinfo" readonly name="producto">
                        </div>

                        <div class="col-md-3 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label">Presentación</label>
                            <input id="presentacioncomercial" class="displayallinfo" readonly name="presentacioncomercial" style="text-align: center;" readonly>
                        </div>

                        <div class="col-md-3 col-2 align-self-center">
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
                            <input type="number" name="unidadesxlote" id="unidadesxlote" min="1" onkeyup="CalculoTamanolote(this.value);" class="form-control" min="1" required />
                        </div>
                        <div class="col-md-4 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label" type="number">Tamaño del Lote (Kg)</label>
                            <input name="tamanototallote" id="tamanototallote" class="form-control Numeric" min="1" readonly value="" style="height: 70px; font-size: xx-large; width: 200; text-align: center" />
                        </div>

                    </div>
                    <hr>
                    <div class="row page">
                        <div class="col-md-4 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label">Fecha de Programación</label>
                            <input type="date" class="form-control" id="fechaprogramacion" name="fechaprogramacion" value="" min="<?php $hoy = date("Y-m-d");
                                                                                                                                    echo $hoy; ?>">
                        </div>

                    </div>
                    <hr>
                    <div class="row page">
                        <div class="col-md-6 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label">Observaciones Pesaje / Preparación</label>
                        </div>
                    </div>

                    <div>
                        <button id="adicionarPesaje" name="adicionarPesaje" type="button" class="btn btn-primary">Adicionar</button>
                    </div>

                    <div class="row page mostrarTanque">

                        <label class="labelTanques">Tanque</label>
                        <label class="labelTanques">Cantidad</label>
                        <label class="labelTanques">Total</label>
                        <label class="labelTanques"></label>

                        <select class="form-control tnq" id="cmbTanque1" onchange="validarTanque(1);"></select>
                        <input type="number" class="form-control tnq" id="txtCantidad1" onkeyup="CalcularTanque(1)">
                        <input type="number" class="form-control tnq" id="txtTotal1">
                        <button class="btn btn-warning" id="btnEliminar1" type="button" onclick="eliminarTanque(1);">X</button>

                        <!-- <select class="form-control tnq" id="cmbTanque2" onchange="validarTanque(2);"></select>
                        <input type="number" class="form-control tnq" id="txtCantidad2" onblur="CalcularTanque(2)">
                        <input type="number" class="form-control tnq" id="txtTotal2">
                        <button class="btn btn-warning" id="btnEliminar2" type="button" onclick="eliminarTanque(2);">X</button>

                        <select class="form-control tnq" id="cmbTanque3" onchange="validarTanque(3);"></select>
                        <input type="number" class="form-control tnq" id="txtCantidad3" onblur="CalcularTanque(3)">
                        <input type="number" class="form-control tnq" id="txtTotal3">
                        <button class="btn btn-warning" id="btnEliminar3" type="button" onclick="eliminarTanque(3);">X</button>

                        <select class="form-control tnq" id="cmbTanque4" onchange="validarTanque(4);"></select>
                        <input type="number" class="form-control tnq" id="txtCantidad4" onblur="CalcularTanque(4)">
                        <input type="number" class="form-control tnq" id="txtTotal4">
                        <button class="btn btn-warning" id="btnEliminar4" type="button" onclick="eliminarTanque(4);">X</button>

                        <select class="form-control tnq" id="cmbTanque5" onchange="validarTanque(5);"></select>
                        <input type="number" class="form-control tnq" id="txtCantidad5" onblur="CalcularTanque(5)">
                        <input type="number" class="form-control tnq" id="txtTotal5">
                        <button class="btn btn-warning eliminarTanque" id="btnEliminar5" type="button" onclick="eliminarTanque(5);">X</button> -->

                        <label for="" class="labelTotalTanques">Total</label>
                        <input type="number" class="form-control sumaTanques tnq" id="sumaTanques" readonly>
                    </div>
                    <div class="mb-3 mt-3 insertarTanque">

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