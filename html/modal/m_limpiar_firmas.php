    <!-- Modal -->
    <div class="modal" id="m_firmar" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="color: white;">Comprobar Firmas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row page cardInputsFirmas">
                            <div class="col-sm-4">
                                <label>Batch Inicial:</label>
                                <input type="number" id="minBatch" class="form-control text-center">
                            </div>
                            <div class="col-sm-4">
                                <label>Batch Final:</label>
                                <input type="number" id="maxBatch" class="form-control text-center">
                            </div>
                            <div class="col-sm-4">
                                <label>Estado Actual</label>
                                <input type="number" id="currentState" class="form-control text-center" disabled>
                            </div>
                        </div>
                        <div class="spinner"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="btnCloseModalControlFirmas">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="btnSendControlFirmas">Aceptar</button>
                </form>
            </div>
        </div>
    </div>
    </div>