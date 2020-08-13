<?php 
    require_once('/Desarrollo/BatchRecord/htdocs/conexion.php');
?>

<div class="modal fade" id="ModalCrearUsuarios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <h5 class="title">Registro de Usuarios</h5>
              </div>
              <div class="card-body">
                <form id="frmagregarUsuarios" method="POST">
                <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label for="nombre">Nombres</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombres Completos" required>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Apellidos</label>
                        <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Apellidos Completos" required>
                      </div>
                    </div>
                  </div> 
                    <div class="row">
                      <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label for="email">Correo Electrónico</label>
                          <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                        </div>
                      </div> 

                      <?php 
                        $query_modulo = mysqli_query($conn, "SELECT * FROM modulo");
                        $result_modulo = mysqli_num_rows($query_modulo);
                      ?>

                      <div class="col-md-6 pl-1">
                        <div class="form-group">
                        <label>Cargo</label>
                        <?php 
                          $query_cargo = mysqli_query($conn, "SELECT * FROM cargo");
                          $result_cargo = mysqli_num_rows($query_cargo);
                        ?>
                        <select class="form-control" name="cargo" id="cargo">
                        <option value="" disabled selected>Selecciona una opción</option>
                        <?php 
                          if($result_cargo > 0){
                            while($cargo = mysqli_fetch_array($query_cargo)){
                        ?>            
                            <option value="<?php echo $cargo['id'] ?>"> <?php echo $cargo['cargo'] ?> </option>        
                        <?php            
                                }
                            }
                        ?>       
                        </select> 
                        </div>
                      </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-4">
                     <div class="form-group">
                        <label>Firma y Huella</label>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFileLang" lang="es">
                            <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                          </div>
                      
                      </div>
                    
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Módulo de Acceso</label>
                        <?php 
                          $query_modulo = mysqli_query($conn, "SELECT * FROM modulo");
                          $result_modulo = mysqli_num_rows($query_modulo);
                        ?>
                
                        <select class="form-control" name="modulo" id="modulo">
                        <option value="" disabled selected>Selecciona una opción</option>
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
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="clave" id="clave" class="form-control" placeholder="Clave de Acceso" required>
                      </div>
                    </div>
                  </div>

                  <button id="btnCerrar" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <button id="btnguardarUsuarios" type="submit" class="btn btn-primary">Crear Usuario</button>
                  
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
