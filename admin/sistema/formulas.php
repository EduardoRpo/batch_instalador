<?php require_once('php/sesion/sesion.php'); ?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Samara Cosmetics | formulas</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
  <link href="../sistema/css/estilos.css" rel="stylesheet" />

  <!-- Datatables -->
  <!-- <link rel="stylesheet" href="../assets/datatables/datatables.min.css">
  <link rel="stylesheet" href="./htdocs/assets/datatables/DataTables-1.10.21/css/dataTables.bootstrap4.css"> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
  <!-- Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />

  <!-- Alertify -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />



</head>

<body class="">
  <div class="wrapper ">

    <?php include('./admin_componentes/sidebar.php'); ?>

    <div class="main-panel" id="main-panel">
      <?php include('./admin_componentes/navegacion.php'); ?>
      <div class="panel-header panel-header-sm">

      </div>

      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Formulas</h5>
                <p class="category">Samara Cosmetics <a href=""></a></p>
              </div>
              <div class="card-body">
                <div class="selproductos">
                  <select name="cmbReferenciaProductos" id="cmbReferenciaProductos" class="form-control" style="width: 200px;">
                  </select>
                  <input type="text" class="form-control ml-3" id="txtnombreProducto">
                </div>

                <hr>
                <div class="alert alert-warning alertFormula" role="alert">
                  La formula <b>no cumple</b> con el <b>100%</b>
                </div>

                <hr>

                <button type="button" class="btn btn-primary" id="adicionarFormula">Adicionar</button>

                <form id="frmadFormulas" style="display: none;">
                  <div class="formula ml-5">
                    <label class="mr-3"> <b>Seleccionar: </b> </label>
                    <input type="radio" class="radioFormula" id="formula_r" name="formula" value="1">
                    <label for="formula_r" class="mr-3">Formula</label>
                    <input type="radio" class="radioFormula" id="formula_f" name="formula" value="0">
                    <label for="formula_f" class="mr-3">Formula Invima</label>
                  </div>

                  <label for=""></label>
                  <label for=""><b>Referencia</b></label>
                  <label for="">Materia Prima</label>
                  <label for="">Alias</label>
                  <label for="">%</label>
                  <input type="text" id="textReferencia" class="form-control">
                  <select name="" id="cmbreferencia" class="form-control"></select>
                  <input type="text" name="txtMateria-Prima" id="txtMateria-Prima" class="form-control" placeholder="Materia Prima">
                  <input type="text" name="alias" id="alias" class="form-control" placeholder="alias">
                  <input type="number" name="porcentaje" id="porcentaje" class="form-control" placeholder="%" style="text-align: center;">
                  <button type="button" class="btn btn-primary" id="guardarFormula" onclick="guardarFormulaMateriaPrima();">Guardar</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="row" id="formulas">
          <div class="col-md-12">
            <div class="card" id="cardformula_r">
              <div class="card-body">
                <div class="table-responsive">
                  <label for="">Formulas</label>
                  <table id="tblFormulas" class="table-striped row-borde" style="width:100%">

                  </table>
                  <div style="display: flex;justify-content: flex-end;">
                    <input type="text" id="totalPorcentajeFormulas" style="border: none;margin-right:100px;text-align:center" disabled>
                  </div>
                </div>
              </div>
              <!-- <form id="formDataExcel1" enctype="multipart/form-data">
                <input type="file" name="datosExcel1" id="datosExcel1" class="form-control datosExcel mb-3 ml-3" style="width: 600px; display:inline-flex">
                <button type="button" id="btnCargarExcel1" class="btn btn-primary ml-3 btnCargarExcel" onclick="comprobarExtension(this.form, this.form.datosExcel1.value, 'formula',1);" disabled="disabled">Cargar Datos</button>
                <div id="spinner" class="spinner-border text-danger" style="display: none;"></div>
              </form> -->
            </div>
          </div>
        </div>

        <div class="row" id="allformulas">
          <div class="col-md-12">
            <div class="card" id="cardformula_r">
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tblFormulastodas" class="table-striped row-borde" style="width:100%">
                    <label for="">Formulas</label>
                    <thead>

                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                  <div style="display: flex;justify-content: flex-end;">
                    <input type="text" id="totalPorcentajeFormulas" style="border: none;margin-right:100px;text-align:center" disabled>
                  </div>
                </div>
              </div>
              <!-- <form id="formDataExcel1" enctype="multipart/form-data">
                <input type="file" name="datosExcel1" id="datosExcel1" class="form-control datosExcel mb-3 ml-3" style="width: 600px; display:inline-flex">
                <button type="button" id="btnCargarExcel1" class="btn btn-primary ml-3 btnCargarExcel" onclick="comprobarExtension(this.form, this.form.datosExcel1.value, 'formula',1);" disabled="disabled">Cargar Datos</button>
                <div id="spinner" class="spinner-border text-danger" style="display: none;"></div>
              </form> -->
            </div>
          </div>
        </div>

        <div class="row" id="formghost">
          <div class="col-md-12">
            <div class="card" id="cardformula_f">
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tbl_formulas_f" class="table-striped row-borde" style="width:100%">
                    <thead>
                      <tr>
                        <th>Referencia</th>
                        <th>Materia Prima</th>
                        <th>Alias</th>
                        <th>Porcentaje</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                  <div style="display: flex;justify-content: flex-end;">
                    <input type="text" id="totalPorcentajeFormulasInvima" style="border: none;margin-right:100px;text-align:center" disabled>
                  </div>
                </div>
              </div>
              <form id="formDataExcel1" enctype="multipart/form-data">
                <input type="file" name="datosExcel1" id="datosExcel2" class="form-control datosExcel mb-3 ml-3" style="width: 600px; display:inline-flex">
                <button type="button" id="btnCargarExcel1" class="btn btn-primary ml-3 btnCargarExcel" onclick="comprobarExtension(this.form, this.form.datosExcel1.value, 'formula', 1);" disabled="disabled">Cargar Datos</button>
                <div id="spinner" class="spinner-border text-danger" style="display: none;"></div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php include('./admin_componentes/footer.php'); ?>
    </div>
  </div>


  <!--   Core JS Files   -->
  <!-- <script src="../assets/js/core/jquery.min.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script>

  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

  <script src="/admin/sistema/js/global/cargarReferencias.js"></script>
  <script src="/admin/sistema/js/global/notifications.js"></script>
  <script src="/admin/sistema/js/global/rawMaterials.js"></script>

  <script src="/admin/sistema/js/productos/formulas/formulas.js"></script>
  <script src="/admin/sistema/js/productos/formulas/validarReferencia.js"></script>
  <script src="/admin/sistema/js/productos/formulas/tblFormulas.js"></script>
  <script src="/admin/sistema/js/productos/formulas/tblAllFormulas.js"></script>
  <script src="/admin/sistema/js/productos/formulas/tblFormulasInvima.js"></script>

  <script src="/admin/sistema/js/importarProductos.js"></script>
  <script src="/admin/sistema/js/menu.js"></script>

</body>

</html>