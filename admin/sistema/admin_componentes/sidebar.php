<div class="sidebar" data-color="orange">
    <div class="logo">
        <!-- <a href="# class="simple-text logo-mini"></a> -->
        <a class="simple-text logo-normal" style="text-align: center;">Samara Cosmetics</a>
    </div>
    <?php if ($_SESSION['rol'] != 5) { ?>
        <div class="sidebar-wrapper contenedor-menu" id="sidebar-wrapper">
            <ul class="nav menu">
                <li id="inicio"><a href="./"><i class="now-ui-icons design_app"></i>
                        <p>Inicio</p>
                    </a></li>

                <li id="parametrosg"><a href=""><i class="fa fa-chevron-down"></i><span>Parametros Generales</span></a></li>
                <ul class="menu_generales">
                    <li><a href="modulos.php" id="link_procesos"><i class="fas fa-boxes"></i><span>Procesos</span></a></li>
                    <li><a href="condicionesMedio.php" id="link_condiciones_medio"><i class="fas fa-history"></i><span>Condiciones del Medio</span></a></li>
                    <li><a href="desinfectante.php" id="link_desinfectante"><i class="fas fa-bug"></i><span>Desinfectantes</span></a></li>
                    <li><a href="equipos.php" id="link_equipos"><i class="fas fa-list-ul"></i><span>Equipos</span></a></li>
                    <li><a href="preguntas.php" id="link_preguntas"><i class="fas fa-question-circle"></i><span>Preguntas</span></a></li>
                    <li><a href="despejedelinea.php" id="link_despeje"><i class="fas fa-clipboard-list"></i><span>Despeje</span></a></li>
                    <li><a href="tanques.php" id="link_tanques"><i class="fas fa-database"></i><span>Tanques</span></a></li>
                </ul>

                <li id="productos"><a href=""><i class="fa fa-chevron-down"></i><span>Productos</span></a></li>
                <ul class="menu_productos">
                    <li><a href="productos.php" id="link_productos"><i class="fas fa-coins    "></i><span>Maestro Productos</span></a></li>
                    <li><a href="propiedades-generales.php" id="link_generales"><i class="fas fa-chalkboard"></i><span>Generales</span></a></li>
                    <li><a href="propiedades-fisicoquimicas.php" id="link_fisico_quimicas"><i class="fas fa-atom"></i><span>Propiedades FisicoQuimicas</span></a></li>
                    <li><a href="propiedades-microbiologicas.php" id="link_microbiologicas"><i class="fas fa-biohazard"></i><span>Propiedades Microbiologicas</span></a></li>
                    <li><a href="empaques.php" id="link_empaques"><i class="fas fa-box-open"></i><span>Empaques</span></a></li>
                    <li><a href="materiaprima.php" id="link_materia_prima"><i class="fas fa-draw-polygon"></i><span>Materia Prima</span></a></li>
                    <?php if ($_SESSION['rol'] == 1) { ?>
                        <li><a href="formulas.php" id="link_formulas"><i class="fas fa-vote-yea"></i><span>Formulas</span></a></li>
                    <?php  } ?>

                    <li id="instructivos"><a href=""><i class="fa fa-chevron-down"></i><span>Instructivos</span></a></li>
                    <ul class="menu_instructivos">
                        <li><a href="bases.php" id="link_bases"><i class="fa fa-list-alt"></i><span>Bases </span></a></li>
                        <li><a href="instructivo.php" id="link_preparaciones"><i class="fa fa-bars"></i><span>Instructivo </span></a></li>
                    </ul>

                    <li><a href="multipresentacion.php" id="link_multipresentacion"><i class="fas fa-superscript"></i><span>Multipresentación</span></a></li>
                </ul>
                <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) { ?>
                    <li id="explosion_materiales"><a href=""><i class="fa fa-chevron-down"></i><span>Explosion Materiales</span></a></li>
                    <ul class="menu_explosion">
                        <li><a href="explosion_materiales.php" id="link_menu_explosion"><i class="fas fa-asterisk"></i><span>Batch Record</span></a></li>
                        <li><a href="explosion_materiales_pedidos.php" id="link_menu_explosion_pedidos"><i class="fas fa-asterisk"></i><span>Pedidos</span></a></li>
                        <li><a href="explosion_materiales_consolidado.php" id="link_menu_explosion_consolidado"><i class="fas fa-asterisk"></i><span>Consolidado</span></a></li>
                    </ul>
                <?php  } ?>
                <?php if ($_SESSION['rol'] == 1) { ?>
                    <li id="usuarios"><a href=""><i class="fa fa-chevron-down"></i><span>Usuarios</span></a></li>
                    <ul class="menu_usuarios">
                        <li><a href="usuarios.php" id="link_menu_usuarios"><i class="fas fa-user-check"></i><span>Maestro Usuarios</span></a></li>
                        <li><a href="cargos.php" id="link_cargos"><i class="fas fa-sitemap"></i><span>Cargos</span></a></li>
                    </ul>
                <?php  } ?>
                <li id="horarios"><a href=""><i class="fa fa-chevron-down"></i><span>Bath Record Automático</span></a></li>
                <ul class="menu_horarios">
                    <li><a href="horarios.php" id="link_menu_horarios"><i class="fa fa-clock-o" aria-hidden="true"></i><span>Horarios</span></a></li>
                </ul>

                <li id="pdf"><a href=""><i class="fa fa-chevron-down"></i><span>PDF</span></a></li>
                <ul class="menu_pdf">
                    <li><a href="pdf.php" id="link_menu_pdf"><i class="fas fa-sort-alpha-up"></i><span>Textos</span></a></li>
                    <li><a href="certificado.php" id="link_menu_certificado"><i class="far fa-newspaper"></i><span>Certificado</span></a></li>
                </ul>
                <li id="auditoria"><a href=""><i class="fa fa-chevron-down"></i><span>Auditoria</span></a></li>
                <ul class="menu_auditoria">
                    <li><a href="controlCondicionesMedio.php" id="link_menu_pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i><span>Condiciones del Medio</span></a></li>
                    <li><a href="controlFirmas.php" id="link_menu_pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i><span>Control de firmas</span></a></li>
                </ul>


            </ul>
        </div>
    <?php } ?>
</div>