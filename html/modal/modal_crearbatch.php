<div class="modal fade" id="myModal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="  background-color: #FF8D6D !important;">
                <h5 class="modal-title" id="exampleModalLabel"><span class="tcrearBatch"><b>Crear Batch Record</b></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="savebatch.php" onsubmit="return onSubmit();" id="form-submit-batch" method="post" autocomplete="off">
                    <input type="hidden" name="idbatch" value="<?= $idbatch; ?>">
                    <div class="row page">
                        <div class="col-md-12 col-2 align-self-center">
                            <?php if ($update == false) : ?>
                                <label for="recipient-name" class="col-form-label">No. Referencia:</label>
                                <select class="form-control " name="noreferencia" id="name" required onchange="cargarData()" value="<?= $noreferencia; ?>">
                                    <option value="<?= $noreferencia; ?>">Seleccione...</option>
                                    <?php
                                    while ($row = mysqli_fetch_array($sql5)) {
                                        echo "<option value='" . $row['referencia'] . "'>" . $row['referencia'] . "</option>";
                                    }
                                    ?>
                                </select>
                            <?php else : ?>
                                <label for="recipient-name" class="col-form-label">No. Referencia:</label>
                                <select class="form-control " name="noreferencia" id="name" required onchange="cargarData()" value="<?= $noreferencia; ?>">

                                    <?php
                                    while ($row = mysqli_fetch_array($sql5)) { ?>
                                        <option value='<?= $row['referencia'] ?>' <?= $row['referencia'] == $noreferencia ? "selected" : "" ?>> <?= $row['referencia'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            <?php endif ?>
                        </div>
                        <div class="col-md-2 col-2 align-self-center d-none">
                            <input type="button" class="btn btn-primary" id="name-submit" style="margin-top: 43%; background-color: #FF8D6D !important; border:#FF8D6D !important " value="Cargar">
                        </div>
                    </div>
                    <div class="row page">
                        <div class="col-md-6 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label">Nombre Referencia</label><br>
                            <input id="name-data" class="displayallinfo" readonly name="nombrereferencia">
                        </div>
                        <div class="col-md-6 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label">Marca</label>
                            <input id="name-data2" class="displayallinfo" readonly name="marca">
                        </div>
                    </div>

                    <input type="text" name="fechahoy" value="<?= date('Y-m-d'); ?>" readonly class="form-control datepicker" hidden>
                    <div class="row page">
                        <div class="col-md-6 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label">Notificación Sanitaria</label>
                            <input id="name-data3" class="displayallinfo" readonly name="notificacionsanitaria">
                        </div>
                        <div class="col-md-6 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label">Propietario</label>
                            <input id="name-data4" class="displayallinfo" readonly name="propietario">
                        </div>
                      <input type="text" hidden id="densidad_in">
                    </div>
                    <div class="row page">
                        <div class="col-md-6 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label">Nombre Producto</label>
                            <input id="name-data5" class="displayallinfo" readonly name="nombreproducto" value="">
                        </div>
                        <div class="col-md-6 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label">Presentación Comercial</label>
                            <input id="name-data6" class="displayallinfo" readonly name="presentacion" readonly value="">
                        </div>
                    </div>
                    <div class="row page">

                        <?php if ($update == false) : ?>
                            <div class="col-md-6 col-2 align-self-center d-none">
                                <label for="recipient-name" class="col-form-label">Estado</label><br>
                                <select class="selectpicker form-control" id="filtrar1" name="numerodelote" style="width: 80%">
                                    <option value="0">Detenido</option>
                                    <option value="1">Activo</option>
                                </select>
                            </div>
                        <?php else : ?>
                            <div class="col-md-6 col-2 align-self-center">
                                <label for="recipient-name" class="col-form-label">Estado</label><br>
                                <select class="selectpicker form-control" id="filtrar1" name="numerodelote" style="width: 80%" value="<?= $estado; ?>">
                                    <option value="0">Detenido</option>
                                    <option value="1">Activo</option>
                                    <option value="2">En proceso</option>
                                </select>
                            </div>
                        <?php endif ?>

                        <div class="col-md-6 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label">Linea</label>
                            <input id="name-data7" class="displayallinfo" readonly name="linea" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="row page">
                        <div class="col-md-4 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label">Unidades por Lote</label>
                            <input type="text" name="unidadesxlote" id="unidadesxlote" class="form-control" min="1" value="<?= $unidadesxlote; ?>" required />
                        </div>
                        <div class="col-md-4 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label" type="number">Tamaño del Lote (Kg)</label>
                            <input type="number" name="tamanototallote" id="tamanototallote" class="form-control Numeric" min="1" readonly value="<?= $tamanototallote; ?>" />
                        </div>
                        <div class="col-md-4 col-2 align-self-center d-none">
                            <label for="recipient-name" class="col-form-label">Tamaño del Lote por Presentación</label>
                            <input type="number" name="tamanolotepresentacion" id="tamanolotepresentacion" class="form-control" min="1" value="<?= $tamanolotepresentacion; ?>" />
                        </div>
                    </div>
                    <hr>
                    <div class="row page">
                        <div class="col-md-6 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label">Fecha de Programación</label>
                            <input type="date" class="form-control" id="fecha" name="fechaprogramacion" value="<?= $fechaprogramacion; ?>" min="<?php $hoy = date("Y-m-d"); echo $hoy; ?>">
                        </div>
                        <!-- <div class="col-md-6 col-2 align-self-center">
                            <button type="button" class="btn waves-effect waves-light btn-danger pull-center" data-toggle="modal" data-target="#ClonarModal" data-dismiss="modal" aria-label="Close" style="width: 80%; margin-top: 12%">Clonar Batch
                            </button>
                        </div> -->
                    </div>
                    <hr>
                    <div class="row page">
                        <div class="col-md-12 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label">Observaciones Pesaje</label>
                            <input type="text" class="form-control" id="obpesaje" name="obpesaje" required>
                        </div>
                    </div>
                    <div class="row page">
                        <div class="col-md-12 col-2 align-self-center">
                            <label for="recipient-name" class="col-form-label">Observaciones Preparación</label>
                            <input type="text" class="form-control" id="obpreparacion" name="obpreparacion" required>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <?php if ($update == false) : ?>
                            <button type="submit" class="btn btn-primary" name="save">Crear</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                Cancelar
                            </button>
                        <?php else : ?>
                            <button type="submit" class="btn btn-primary" name="update">Modificar
                            </button>
                            <script type="text/javascript">
                                $(window).on('load', function() {
                                    $('#myModal').modal('show');
                                });
                            </script>
                        <?php endif ?>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>