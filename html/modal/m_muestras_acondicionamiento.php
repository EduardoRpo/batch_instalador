<div class="modal fade" id="m_muestras_acond" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="  background-color: #FF8D6D !important;">
                <h5 class="modal-title"><span class="tcrearBatch"><b>Muestras</b></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label class="lblMuestras"><b>MUESTRAS ACONDICIONAMIENTO</b></label>
                <form action="">
                    <div class="muestras_acondicionamiento">
                        <!-- muestras -->
                        <table class="table table-bordered" id="table_muestras_acondicionamiento">
                            <thead>
                                <tr>
                                    <th class="centrado">No</th>
                                    <th class="centrado"></th>
                                    <th class="centrado">Apariencia Etiquetas
                                        <!-- (Arrugas, quiebres, sucios, alineada, adherencia) -->
                                    </th>
                                    <th class="centrado">Apariencia Termoencogible <br>Aplica <input type="checkbox" id="aplicaTermoencogible"> </br>
                                        <!-- (Cuando Aplique) -->
                                    </th>
                                    <th class="centrado">Apariencia Lote</th>
                                    <th class="centrado">Unid Emp y Pos en la Caja</th>
                                    <th class="centrado">Rotulo Caja</th>
                                </tr>
                            </thead>

                        </table>

                        <!-- fin muestras -->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="guardar_muestras_acondicionamiento">Guardar</button>
            </div>

        </div>
    </div>
</div>