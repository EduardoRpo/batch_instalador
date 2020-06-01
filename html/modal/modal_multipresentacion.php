
<div class="modal fade" id="Modal_Multipresentacion" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong style="color: white;">Multipresentación</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input class="btn btn-primary" id="masMulti" type="button" value="Adicionar" style="margin-bottom: 10px;">  
      <div class="multi" style="display: flex;">
        
          <table id="tablaMulti">
          
            <tr>
              <td><select class="form-control" name="MultiReferencia" id="MultiReferencia" required></select></td>
              <td><input type="text" class="form-control" id="cantidadMulti" name="cantidadMulti" placeholder="Unidades"></td>  
              <td><input type="text" class="form-control" id="tamanoloteMulti" name="tamanoloteMulti" readonly placeholder="Lote"></td>
              <!-- <td><input class="btn btn-primary" id="masMulti" type="button" value="+"></td> -->
              <td class="menosMulti"><input class="btn btn-warning" type="button" value="-"></td>
            </tr>
          </table>
           
          <input type="text" class="form-control" id="densidadMulti" name="densidadMulti" placeholder="Densidad" hidden>
          <input type="text" class="form-control" id="presentacionMulti" name="presentacionMulti" placeholder="Presentación" hidden>
        </div>        
      </div>
      <div class="inputcalculoTotal" style="display: flex; justify-content:flex-end; margin-right:45px; margin-bottom:10px">  
        <label for="" style="padding-right: 10px;">Total</label>
        <input id="totalMulti" type="text" class="form-control" style="width: 28%;">
      </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Aceptar</button>
      </div>
    </div>
  </div>
</div>
