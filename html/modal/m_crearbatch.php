<div class="modal" id="modalCrearBatch" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="  background-color: #FF8D6D !important;">
                <h5 class="modal-title"><span class="tcrearBatch"><b>Crear Batch Record</b></span></h5>
                <!-- <div>
                    <input type="text" class="form-control">
                </div> -->
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
                            <input id="inpNombreReferencia" class="displayallinfo" name="nombrereferencia" readonly>
                            <select id="nombrereferencia" class="displayallinfo" name="nombrereferencia"></select>
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

                        <input type="text" id="densidad_producto" hidden>
                        <input type="text" id="ajuste" hidden>
                    </div>
                    <hr>
                    <div class="row page">
                        <div class="col-md-4 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label">Unidades por Lote</label>
                            <input type="number" name="unidadesxlote" id="unidadesxlote" min="1" class="form-control" min="1" style="height: 70px; font-size: xx-large; width: 200; text-align: center" readonly />
                        </div>
                        <div class="col-md-4 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label" type="number">Tamaño del Lote (Kg)</label>
                            <input name="tamanototallote" id="tamanototallote" class="form-control Numeric" min="1" readonly value="" style="height: 70px; font-size: xx-large; width: 200; text-align: center" />
                        </div>

                    </div>
                    <hr>
                    <div class="row page">
                        <div class="col-md-4 col-2 align-self-center mt-4">
                            <button class="btn btn-primary" id="calcTamanioLote">Calcular Tamaño Lote</button>
                        </div>
                        <div class="col-md-4 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label">Fecha de Programación</label>
                            <input type="date" class="form-control" id="fechaprogramacion" name="fechaprogramacion" value="" min="<?php $hoy = date("Y-m-d");
                                                                                                                                    echo $hoy; ?>">
                        </div>
                        <div class="col-md-4 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label"><b>Fecha de Pesaje (Sugerida)</b></label>
                            <input type="date" class="form-control" id="fechaProgramacionSugerida" name="fechaProgramacionSugerida" value="" readonly min="<?php $hoy = date("Y-m-d");
                                                                                                                                                            echo $hoy; ?>">
                        </div>

                    </div>
                    <hr>
                    <!-- <div class="row page">
                        <div class="col-md-6 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label">Observaciones Pesaje / Preparación</label>
                        </div>
                    </div> -->

                    <div class="row page mostrarTanque">
                        <label class="labelTanques">Tanque</label>
                        <label class="labelTanques">Cantidad</label>
                        <label class="labelTanques">Total</label>
                        <label class="labelTanques"></label>

                        <select class="form-control tnq" id="cmbTanque1"></select> <!-- onchange="validarTanque(1);" -->
                        <input type="number" class="form-control tnq" id="txtCantidad1"> <!-- onkeyup="CalcularTanque(1) -->
                        <input type="number" class="form-control tnq" id="txtTotal1" readonly>
                        <!-- <button class="btn btn-warning" id="btnEliminar1" type="button" onclick="eliminarTanque(1);">X</button> -->

                        <label for="" class="labelTotalTanques">Total</label>
                        <input type="number" class="form-control sumaTanques tnq" id="sumaTanques" readonly>
                    </div>
                    <div class="mb-3 mt-3 insertarTanque">

                    </div>
                    <div class="modal-footer">
                        <?php if ($_SESSION['rol'] != 6) {  ?>
                            <button type="button" onclick="guardarDatos();" class="btn btn-primary crearbatch" name="guardarBatch" id="guardarBatch">Crear</button>
                        <?php  }  ?>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>