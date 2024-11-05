<div class="modal fade" id="m_muestrasTara" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #FF8D6D !important;">
                <h5 class="modal-title"><b>Muestras - Peso Producto</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label class="lblMuestras"><b>PESO ENVASE</b></label>
                <div class="txtMuestras">
                    <table id="pesosTable" class="table">
                        <thead>
                            <tr>
                                <th>Tara</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Las filas se agregarán aquí dinámicamente -->
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-secondary" id='idAddFilaTara'>Agregar fila</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id='idSaveTara'>Guardar</button>
            </div>
        </div>
    </div>
</div>
