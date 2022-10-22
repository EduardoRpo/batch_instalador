<div class="modal" id="m_observaciones" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="color: white;">Gestión Pedido Pendientes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="addComment">
                    <textarea id="comment" name="comment" class="form-control" placeholder="Observacion..." minlength="20" maxlength="250" rows="1"></textarea>
                    <br>
                </div>
                <p class="mt-3">Historial Seguimiento</p>
                <br>
                <table class="table table-striped table-bordered dataTable no-footer text-center" aria-describedby="tablaPreBatch_info">
                    <thead>
                        <tr>
                            <th class="text-center">Fecha Registro</th>
                            <th class="text-center">Observación</th>
                        </tr>
                    </thead>
                    <tbody id="tBody">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="saveObs">Agregar</button>
            </div>
        </div>
    </div>
</div>