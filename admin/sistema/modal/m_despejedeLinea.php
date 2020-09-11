<?php 
    require_once('./conexion.php');
?>

<div class="modal fade" id="modalDespejedeLinea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <!-- <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> -->
      <div class="modal-body">
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="title tpregunta">Registro de Preguntas de Control</h5>
              </div>
              <div class="card-body">
                <form id="frmpreguntas" method="POST">
                <div class="row">
                    <div class="col-md-11 pr-1">
                      <div class="form-group">
                        <label for="pregunta"><b>Pregunta</b></label>
                        <input type="text" name="pregunta" id="pregunta" class="form-control" placeholder="Pregunta" required>
                      </div>
                    </div>
                  </div> 

                  <hr>
                  <div class="row">
                  <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label><b>Respuesta</b> </label>
                        <select class="form-control" name="resp" id="resp" required>
                            <option value="" disabled selected>Seleccione una opción</option>
                            <option value="1">Si</option>
                            <option value="0">No</option>
                        </select>
                      
                        <!-- <label>Respuesta</label> -->
                        <!-- <input type="text" name="respuesta" id="respuesta" class="form-control" placeholder="Respuesta"> -->
                      </div>
                    </div>
                  <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label> <b>Módulo de Acceso</b></label>
                        <?php 
                          $query_modulo = mysqli_query($conn, "SELECT * FROM modulo");
                          $result_modulo = mysqli_num_rows($query_modulo);
                        ?>
                
                        <select class="" name="modulo" id="modulo" multiple="multiple" required>
                        <!-- <option value="" disabled selected>Seleccione una opción</option> -->
                        <?php 
                            if($result_modulo > 0){
                                while($modulo = mysqli_fetch_array($query_modulo)){
                        ?>            
                            <option value="<?php echo $modulo['id'] ?>"> <?php echo $modulo['modulo'] ?> </option>        
                        <?php            
                                }
                            }
                        ?>
                        </select>
  
                      </div>
                    </div>
                  </div>

                  <button id="btnCerrar" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <button id="btnguardarPregunta" type="submit" class="btn btn-primary">Crear Parametro</button>
                  
                <!-- <div> <?php //echo ($alert); ?> </div> -->
                </form>
              </div>
            </div>
          </div>
        
        </div>
      </div>
      </div>
<!--       <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>
