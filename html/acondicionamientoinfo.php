<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Batch Record">
  <meta name="author" content="Teenus SAS">

  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
  <title>Samara Cosmetics</title>

  <!-- Bootstrap Core CSS -->
  <link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="../../html/css/style.css" rel="stylesheet">

  <!-- You can change the theme colors from here -->
  <link rel="stylesheet" href="../../html/css/colors/blue.css" id="theme">
  <link rel="stylesheet" href="../../html/css/custom.css">
  <link rel="stylesheet" href="../../html/vendor/jquery-confirm/jquery-confirm.min.css">
  <link rel="stylesheet" type="text/css" href="../../html/vendor/datatables/datatables.min.css">
  <link rel="stylesheet" type="text/css" href="../../html/vendor/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <!-- script src="https://kit.fontawesome.com/6589be6481.js" crossorigin="anonymous"></script> -->

  <!-- Alertify -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
</head>

<body class="fix-header fix-sidebar card-no-border">

  <div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
      <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
  </div>

  <div id="main-wrapper">

     <!-- HEADER -->
     <?php include('partials/header.php'); ?>
   <!-- FIN HEADER -->


    <div class="container-fluid">
      <div class="row page-titles">
        <h1 hidden>6</h1>
        <h1 class="text-themecolor m-b-0 m-t-0"><b>Acondicionamiento</b></h1>
        <a href="../../acondicionamiento" style="background-color:#fff;color:#FF8D6D" class="btn waves-effect waves-light btn-danger pull-right btn-md" role="button">Cola de Trabajo</a>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div id="accordion">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="width: 100%">
                  INFORMACIÓN DEL PRODUCTO
                </button>
              </h5>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
              <div class="card-body">

                <div class="contenedorInfo2">

                      <div class="contenedorInfo__group">
                      <label for="recipient-name" class="col-form-label">Fecha Programación</label>
                      <input type="date" class="form-control" id="in_fecha" readonly>
                      </div>
                      <div class="contenedorInfo__group">
                      <label for="recipient-name" class="col-form-label">No Orden</label>
                      <input type="text" class="form-control" id="in_numero_orden" readonly>
                        </div>
                        <div class="contenedorInfo__group">
                        <label for="recipient-name" class="col-form-label">Referencia</label>
                        <input type="text" class="form-control" id="in_referencia" readonly>
                        </div>

                        <div class="contenedorInfo__group">
                            
                  <table id="txtobservacionesTanques" class="itemInfo table table-striped table-bordered" style="width:80%; height: 30px;">
                    <thead>
                      <tr>
                        <th>Multipresentación</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr id="fila1">
                        <td id="tanque1" style="text-align: end;font-size:14px;"></td>
                        <td id="cantidad1" style="text-align: end;font-size:14px;"></td>
                        <td id="total1" style="text-align: end;font-size:14px;"></td>
                      </tr>
                      <tr id="fila2">
                        <td id="tanque2" style="text-align: end;font-size:14px;"></td>
                        <td id="cantidad2" style="text-align: end;font-size:14px;"></td>
                        <td id="total2" style="text-align: end;font-size:14px;"></td>
                      </tr>
                      <tr id="fila3">
                        <td id="tanque3" style="text-align: end;font-size:14px;"></td>
                        <td id="cantidad3" style="text-align: end;font-size:14px;"></td>
                        <td id="total3" style="text-align: end;font-size:14px;"></td>
                      </tr>
                      <tr id="fila4">
                        <td id="tanque4" style="text-align: end;font-size:14px;"></td>
                        <td id="cantidad4" style="text-align: end;font-size:14px;"></td>
                        <td id="total4" style="text-align: end;font-size:14px;"></td>
                      </tr>
                      <tr id="fila5">
                        <td id="tanque5" style="text-align: end;font-size:14px;"></td>
                        <td id="cantidad5" style="text-align: end;font-size:14px;"></td>
                        <td id="total5" style="text-align: end;font-size:14px;"></td>
                      </tr>
                    </tbody>
                  </table>
                        </div>

                        <div class="contenedorInfo__group">
                        <label for="in_tamano_lote" class="col-form-label">Tamaño Lote (Kg)</label>
                        <input type="text" class="form-control" id="in_tamano_lote" readonly>
                        </div>

                        <div class="contenedorInfo__group">
                        <label for="recipient-name" class="col-form-label">No. Lote</label>
                        <input type="text" class="form-control" id="in_numero_lote" readonly>
                        </div>

                        <div class="contenedorInfo__group">
                        <label for="recipient-name" class="col-form-label">Linea</label>
                        <input type="text" class="form-control" id="in_linea" readonly>
                        </div>

                </div>

             
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="headingTwo">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="width: 100%">
                  <b>DESPEJE DE LINEAS Y PROCESOS</b>
                </button>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
              <div class="card-body">
                <div class="parametrosControl">
                  <h3 for="recipient-name" class="col-form-label" style="text-align: center;">Parámetros de control</h3>
                  <h3 for="recipient-name" class="col-form-label">Si</h3>
                  <h3 for="recipient-name" class="col-form-label">No</h3>
                </div>

                <div class="row parametrosControlPreguntas" id="preguntas-div"></div>

                <div class="row" style="margin: 1%">
                  <div class="col-md-12 align-self-right">
                    <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Desinfección </h3>
                  </div>
                </div>
                <div class="row" style="margin: 1%">
                  <div class="col-md-4 align-self-right">
                    <label for="sel_producto_desinfeccion" class="col-form-label">Producto de desinfección</label>
                    <select class="selectpicker form-control in_desinfeccion" id="sel_producto_desinfeccion">
                      <option selected>Seleccione</option>
                    </select>
                  </div>
                  <div class="col-md-8 align-self-center">
                    <label for="in_observaciones" class="col-form-label">Observaciones:</label>
                    <input type="text" class="form-control in_desinfeccion" id="in_observaciones">
                  </div>
                </div>
                <div class="row" style="margin: 1%">
                  <div class="col-md-4 align-self-center">
                    <label for="despeje_realizado" class="col-form-label">Realizado Por:</label>
                    <input type="text" class="form-control in_desinfeccion" id="despeje_realizado" readonly>
                  </div>

                  <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                    <input type="button" class="btn btn-danger in_desinfeccion" id="despeje_realizado" onclick="cargar(this)" style="width: 100%; height: 38px;" value="Firmar"> <!-- data-toggle="modal" data-target="#m_firmar" -->
                  </div>

                  <div class="col-md-4 align-self-center">
                    <label for="despeje_verificado" class="col-form-label">Verificado Por:</label>
                    <input type="text" class="form-control in_desinfeccion" id="despeje_verificado" readonly>
                  </div>

                  <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                    <input type="button" class="btn btn-danger in_desinfeccion" id="despeje_verificado" onclick="cargar(this)" style="width: 100%; height: 38px;" value="Firmar"> <!-- data-toggle="modal" data-target="#m_firmar" -->
                  </div>
                </div>
                <div class="row justify-content-end mt-5" style="margin: 1%; text-align: right">
                  <div class="col-md-12 align-self-end">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Aceptar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="card">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="width: 100%">
                ACONDICIONAMIENTO
              </button>
            </h5>
          </div>
          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
              <div class="row" style="margin: 1%">
                <div class="col-md-12 align-self-center">
                  <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Recepcion Material</h3>
                </div>
                <div class="col-md-12 align-self-center">
                  <div class="card">
                    <div class="card-block">

                      <div class="table-responsive">

                        <table class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th>Referencia</th>
                              <th>Descripción</th>
                              <th>Cantidad Recibida</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>Etiquetas</td>
                              <td>Auto</td>
                              <td>Unidades con la que sc reo el Batch Record</td>
                            </tr>
                            <tr>
                              <td>Bandas</td>
                              <td>Auto</td>
                              <td>Unidades con la que sc reo el Batch Record</td>
                            </tr>
                            <tr>
                              <td>Sellos de Seguridad</td>
                              <td>Auto</td>
                              <td>Unidades con la que sc reo el Batch Record</td>
                            </tr>
                            <tr>
                              <td>Cajas</td>
                              <td>Auto</td>
                              <td> Unidades con la que se creo el Batch Record / la unidad de empaque, se aproxima por el mayor y es entero</td>
                            </tr>
                            <tr>
                              <td>Otros</td>
                              <td>Auto</td>
                              <td>Unidades con la que sc reo el Batch Record</td>
                            </tr>

                        </table>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row buttons-group-container" style="margin: 1%">
                <!-- <div class="col-md-12 col-2 align-self-center" style="margin-left: 85%"> -->
                  <div>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-primary" onclick="window.location.href = '../html/acondicionamiento.html';">Aceptar</button>
                  </div>
                <!-- /div> -->
              </div>
              <div class="col-md-12 align-self-center">
                <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Línea de Producción</h3>
              </div>
              <div class="linea-produccion">
                <label for="recipient-name" class="col-form-label">Linea de Producción No</label>
                <label for="recipient-name" class="col-form-label">Banda Transportadora</label>
                <label for="recipient-name" class="col-form-label">Etiquetadora</label>
                <label for="recipient-name" class="col-form-label">Tunel Termo</label>

                <select class="selectpicker form-control" id="select-Linea">
                  <option selected hidden></option>
                  <option>LIQUIDOS</option>
                  <option>SOLIDOS</option>
                  <option>SEMISOLIDOS</option>
                </select>

                <input type="text" class="form-control" id="txtBanda" readonly><!-- <div class="col-md-4 col-2 align-self-center"> -->
                <input type="text" class="form-control" id="txtEtiqueteadora" readonly>
                <input type="text" class="form-control" id="txtTunel" readonly>

              </div>
              <div class="row" style="margin: 1%">
                <div class="col-md-12 align-self-center">
                  <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Control de proceso</h3>
                </div>

                <div class="col-md-3 align-self-center" style="margin-top: 1%">
                  <label for="recipient-name" class="col-form-label">Cantidad de Muestras</label>
                </div>
                <div class="col-md-3 align-self-center" style="margin-top: 1%">
                  <input type="text" class="form-control" id="Muestras">
                </div>
                <div class="col-md-1 align-self-center" style="margin-top: 1%">
                  <button type="button" class="btn waves-effect waves-light btn-danger" style="width: 180px; height: 38px;">Iniciar</button>
                </div>
              </div>
              <div class="row" style="margin: 1%">
                <div class="col-md-4 align-self-center">
                  <label for="recipient-name" class="col-form-label">Realizado Por</label>
                  <input type="text" class="form-control" id="recipient2-name" readonly>
                </div>
                <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                  <button type="button" class="btn waves-effect waves-light btn-danger" style="width: 180px; height: 38px;">Firmar</button>
                </div>

                <div class="col-md-4 align-self-center">
                  <label for="recipient-name" class="col-form-label">Verificado Por</label>
                  <input type="text" class="form-control" id="recipient2-name" readonly>
                </div>
                <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                  <button type="button" class="btn waves-effect waves-light btn-danger" style="width: 180px; height: 38px;">Firmar</button>
                </div>
              </div>
              <div class="col-md-12 align-self-center">
                <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Devolución Material Sobrante</h3>
              </div>

              <div class="col-md-12 align-self-center">
                <div class="card">
                  <div class="card-block">

                    <div class="table-responsive">

                      <table class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>Referencia</th>
                            <th>Descripción</th>
                            <th>Recibida</th>
                            <th>Utilizadas</th>
                            <th>Averias</th>
                            <th>Sobrante</th>
                            <th>Total</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td></td>
                            <td>Cod etiqueta</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td>Cod etiqueta</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td>Cod etiqueta</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>
                        </tbody>
                      </table>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="row" style="margin: 1%">
                  <div class="col-md-4 align-self-center">
                    <label for="recipient-name" class="col-form-label">Realizado Por</label>
                    <input type="text" class="form-control" id="recipient2-name" readonly>
                  </div>
                  <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                    <button type="button" class="btn waves-effect waves-light btn-danger" style="width: 180px; height: 38px;">Firmar</button>
                  </div>

                  <div class="col-md-4 align-self-center">
                    <label for="recipient-name" class="col-form-label">Verificado Por</label>
                    <input type="text" class="form-control" id="recipient2-name" readonly>
                  </div>
                  <div class="col-md-2 align-self-center" style="margin-top: 2.8%">
                    <button type="button" class="btn waves-effect waves-light btn-danger" style="width: 180px; height: 38px;">Firmar</button>
                  </div>
                </div>
                <div class="row " style="margin: 1%">
                  <div class="col-md-12 align-self-center">
                    <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Conciliación Rendimiento</h3>
                  </div>
                </div>
                <div class="conciliacionrendimiento">

                  <div class="conciliacionrendimiento__group">
                  <label for="recipient-name" class="col-form-label">Unidades Producidas:</label>
                  <input type="number" class="form-control centrado" id="txtUnidadesProducidas"> <!-- Este valor se valide con lo envasado por el usuario en envasado txtEnvasado1 Alert(Las unidades producidads son diferentes a las envasadas, notificar al jefe de producción) -->
                  </div>
              
                  <div class="conciliacionrendimiento__group">
                  <label for="recipient-name" class="col-form-label">No Muestras de Retención:</label>
                  <input type="number" class="form-control centrado" id="txtMuestras-Retencion" onkeyup="conciliacionRendimiento(this.value);"><!-- impresion etiquetas para muestras (No produccion, lote, cod barras, cod producto, fecha ) -->
                  </div>
             

                  <div class="conciliacionrendimiento__group">
                  <label for="recipient-name" class="col-form-label">Total Cajas:</label>
                  <input type="text" class="form-control centrado" id="txtTotal-Cajas" readonly>
                    </div>
          

                  <div class="conciliacionrendimiento__group">
                  <label for="recipient-name" class="col-form-label">Total a Entregar Bodega/Cliente:</label>
                  <input type="text" class="form-control centrado" id="txtEntrega-Bodega" readonly>
                    </div>
               

                  <div class="conciliacionrendimiento__group">
                  <label for="recipient-name" class="col-form-label">Rendimiento Producto:</label>
                  <input type="text" class="form-control centrado" id="txtRendimiento-Producto">
                    </div>
         

                  <div class="conciliacionrendimiento__group">
                  <label for="recipient-name" class="col-form-label">Porcentaje Unidades:</label>
                  <input type="text" class="form-control centrado" id="txtPorcentaje-Unidades">
                    </div>
  

                  <div class="conciliacionrendimiento__group">
                  <label for="recipient-name" class="col-form-label">No Movimiento Ofimatica:</label>
                  <input type="number" class="form-control centrado" id="txtNoMovimiento">
                    </div>
  

                  <div class="conciliacionrendimiento__group">
                  <label for="recipient-name" class="col-form-label">Responsable Movimiento Ofimatica:</label>
                  <input type="text" class="form-control centrado" id="txtReponsable" value="Director de Producción (CRC)" readonly>
                    </div>
     

                </div>

                <div class="firma mt-5">
                  <label for="recipient-name" class="col-form-label entrego-acon">Entregó</label>
                  <input type="text" class="form-control" id="recipient2-name" style="width: 180px" readonly>

                  <button type="button" class="btn waves-effect waves-light btn-danger" style="width: 180px; height: 38px;">Firmar</button>
                </div>

                <!-- <div class="row" style="margin: 1%"> -->
                <!--          <div class="col-md-12 col-2 align-self-center">
                    <h3 for="recipient-name" class="col-form-label" style="text-align: center; background-color: #C0C0C0">Almacen Despachos</h3>
                  </div>
                   <div class="almacen-despachos">
                    <label for="recipient-name"  class="col-form-label">Número del Traslado ofimatico</label>
                    <input type="text" class="form-control" id="Notraslado">
                    <label for="recipient-name" class="col-form-label" style="display: flex; justify-content:flex-end">Recibió</label>
                    <input type="text" class="form-control" id="recipient2-name">

                    input total cajas y total entrega cliente
                    informativo input muestras de retencion
                    input total a facturar unidades validadas + muestras de retencion

        
                </div> -->
                <div class="row buttons-group-container" style="margin: 1%">
                 <!--  <div class="col-md-12 col-2 align-self-center" style="margin-left: 85%"> -->
                   <div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="" ;">Aceptar</button>
                <!--   </div> -->

                </div>
                </div>
              </div>

            </div>
          </div>

        </div>



        <!-- jquery -->
        <script src="../../assets/plugins/jquery/jquery.min.js"></script>

        <!-- Bootstrap tether Core JavaScript -->
        <script src="../../assets/plugins/bootstrap/js/tether.min.js"></script>
        <script src="../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

        <!-- Datatables -->
        <script type="text/javascript" src="../../html/vendor/datatables/datatables.min.js"></script>

        <!-- slimscrollbar scrollbar JavaScript -->
        <script src="../../html/js/utils/jquery.slimscroll.js"></script>

        <!--Wave Effects -->
        <script src="../../html/js/utils/waves.js"></script>

        <!--Menu sidebar -->
        <script src="../../html/js/utils/sidebarmenu.js"></script>

        <!--stickey kit -->
        <script src="../../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>

        <!--Custom JavaScript -->
        <script src="../../html/js/utils/custom.min.js"></script>
        <script src="../../html/vendor/jquery-confirm/jquery-confirm.min.js"></script>
        <!-- <script src="../../html/js/datatables.js"></script> -->
        <script src="../../html/js/global/loadinfo-global.js"></script>
        <script src="../../html/js/pesaje/pesajeinfo.js"></script>
        <script src="../../html/js/firmar/firmar.js"></script>
        <script src="../../html/js/global/despeje.js"></script>
        <script src="../../html/js/global/tanques.js"></script>
        <script src="../../html/js/global/equipos.js"></script>
        <script src="../../html/js/global/condicionesdelMedio.js"></script>
        <script src="../../html/js/global/cargarDespeje.js"></script>
        <script src="../../html/js/acondicionamiento/acondicionamientoinfo.js"></script>
        <!-- <script src="../../html/js/validadores.js"></script> -->
        <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
        <!-- Toastr.js Después -->

        <!--Alertify-->
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

</body>

</html>