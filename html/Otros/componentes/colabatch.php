<div class="col-md-12 col-2 align-self-right">
      <div class="card">
        <div class="card-block">
          <div class="table-responsive">
            <table class="table table-striped table-bordered" id="example">
              <thead>
                <tr>
                  <th></th>
                  <th>Orden</th>
                  <th>Referencia</th>
                  <th>Nombre</th>
                  <th>Presentacion</th>
                  <th>Lote</th>
                  <th>Linea</th>
                  <th>Propietario</th>
                  <th>Fecha Creación</th>
                  <th>Fecha Programación</th>
                  <th>Estado</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              
                <?php
                    //while ($rows = mysqli_fetch_assoc($sql6)) {
                ?>
                  <tr>
                    <td><input type="radio" id='express' name="optradio" value="<?= $rows['id_batch']; ?>"></td>
                    <td><?//= $rows['numero_orden']; ?></td>
                    <td><?//= $rows['referencia']; ?></td>
                    <td><?//= $rows['nombre_referencia']; ?></td>
                    <td><?//= $rows['presentacion']; ?></td>
                    <td><?//= $rows['numero_lote'] ?></td>
                    <td><?//= $rows['nombre_linea']; ?></td>
                    <td><?//= $rows['nombre']; ?></td>
                    <td><?//= $rows['fecha_creacion']; ?></td>
                    <td><?//= $rows['fecha_programacion']; ?></td>
                    <td><?//= $rows['estado'] == 1 ? "Activo" : "Inactivo" ?></td>
                    
                    <td><a href="crear-batch.php?edit=<?= $rows['id_batch']; ?>" class="edit"><i class="material-icons" data-toggle="tooltip" title="Editar" style="color:rgb(255, 193, 7)">&#xE254;</i></a></td>
                    <td><a href="#" onclick="deleteBatch(event)" attr-id="<?= $rows['id_batch']; ?>" class="delete"><i class="material-icons" data-toggle="tooltip" title="Eliminar" style="color:rgb(234, 67, 54)">&#xE872;</i></a></td>
                  </tr>
                <?php
                   // } 
                ?>
              </tbody>
            </table>
            <div id="result"></div>
          </div>
        </div>
      </div>
    </div>