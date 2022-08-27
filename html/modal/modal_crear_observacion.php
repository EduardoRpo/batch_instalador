<div class="modal fade" id="modalObservacion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel" style="color: white;">Observaciones</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                <div class="page-content-wrapper mt--45">
                    <div class="container-fluid">
                        <div class="vertical-app-tabs" id="rootwizard">
                            <div class="col-md-12 col-lg-12 InputGroup">
                                <form id="formCreatemodalObservacion">
                                    <div class="row mt-5">
                                        <div class="col-12 col-lg-12">
                                            <div class="form-group floating-label enable-floating-label show-label">
                                                <label for="message-text" class="col-form-label">Comentario:</label>
                                                <textarea class="form-control" id="comment"></textarea>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeObservacion">Cerrar</button>
                <button type="button" class="btn btn-primary" id="addObservacion">Crear</button>
            </div>
        </div>
    </div>
</div>