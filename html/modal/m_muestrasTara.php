<div class="modal fade" id="m_muestrasTara" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #FF8D6D !important;">
                <h5 class="modal-title"><b>Muestras - Peso Producto</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
    <!-- Campo para ingresar la Densidad Final global -->
    <label class="lblMuestras"><b>Densidad Final</b></label>
    <div class="txtMuestras">
        <input type="number" class="form-control" id="densidadFinalInput" placeholder="Ingrese la Densidad Final" required>
    </div>

    <!-- Tabla donde se mostrarán los valores de Tara y Densidad Final -->
    <table id="pesosTable" class="table">
        <thead>
            <tr>
                <th>Tara Jesus</th>
                <th>Densidad Final</th>
            </tr>
        </thead>
        <tbody>
            <!-- Las filas se agregarán aquí dinámicamente -->
        </tbody>
    </table>
</div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="guardarMuestrasTara()">Guardar</button>
            </div>
        </div>
    </div>
</div>
