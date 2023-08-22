<div class="card">
    <div class="card-header centrado"><b>1. INFORMACIÓN DEL PRODUCTO</b></div>
    <!-- <div class="card-body">
        <div class="group-info-ref p-3">
            <label>Referencia:</label><label class="bold ref"></label>
            <label>Nombre Referencia:</label><label id="nref"></label>
            <label>Marca:</label><label id="marca"></label>
            <label>Propietario:</label><label id="propietario"></label>
            <label>Notificación Sanitaria:</label><label id="notificacion"></label>
            <label>Presentación Comercial:</label><label id="presentacion"></label>
        </div>

        <div id="watermark" style="text-align: center;">
            <p>Eliminado.</p>
        </div>

        <hr style="width: 95%;">
        <div class="group-info-batch p-3">

            <label>Orden de Producción:</label><label class="orden" id="orden"></label>
            <label>Lote:</label><label class="lote" id="lote"></label>
            <label>Fecha:</label><label class="fecha"></label>
            <label>Tamaño del Lote por presentación (kg):</label><label id="tamanol"></label>
            <label>Tamaño del lote total (kg):</label><label id="tamanolt"></label>
            <label>Unidades por Lote solicitadas:</label><label id="unidadesLote"></label>
        </div>
        <hr style="width: 95%;"> 
        <div class="ml-3" id="infoMulti"> 
            <label for=""><b>Multipresentación</b></label>
            <div class="group-info-batch-multi p-3" id="InfoMultipresentacion"></div>
        </div>

        <hr style="width: 95%;">
        <div class="group-info-batch p-3">
            <label for="">Autorizado por:</label>
            <label id="autorizado"> <b>Jefe Producción / Director Técnico</b> </label>
        </div>
    </div> -->
    <table class="mt-3">
        <tbody>
            <tr>
                <td style="width:40px"></td>
                <td style="width:227px">Referencia:</td>
                <td style="width:227px" class="bold ref"></td>
                <td style="width:320px">Nombre Referencia:</td>
                <td id="nref"></td>
            </tr>
            <tr>
                <td style="width:40px"></td>
                <td style="width:227px">Marca:</td>
                <td style="width:227px" id="marca"></td>
                <td style="width:320px">Propietario:</td>
                <td id="propietario"></td>
            </tr>
            <tr>
                <td style="width:40px"></td>
                <td style="width:227px">Notificación Sanitaria:</td>
                <td style="width:227px" id="notificacion"></td>
                <td style="width:320px">Presentación Comercial:</td>
                <td id="presentacion"></td>
            </tr>
        </tbody>
    </table>
    <div id="watermark" style="text-align: center; display: none;">
        <p>Eliminado.</p>
    </div>
    <hr style="width: 95%;">
    <table>
        <tbody>
            <tr>
                <td style="width:40px"></td>
                <td style="width:227px">Orden de Producción:</td>
                <td style="width:227px" class="orden" id="orden"></td>
                <td style="width:320px">Lote:</td>
                <td class="lote" id="lote"></td>
            </tr>
            <tr>
                <td style="width:40px"></td>
                <td style="width:227px">Fecha:</td>
                <td style="width:227px" class="fecha"></td>
                <td style="width:320px">Tamaño del Lote por presentación (kg):</td>
                <td id="tamanol"></td>
            </tr>
            <tr>
                <td style="width:40px"></td>
                <td style="width:227px">Tamaño del lote total (kg):</td>
                <td style="width:227px" id="tamanolt"></td>
                <td style="width:320px">Unidades por Lote solicitadas:</td>
                <td id="unidadesLote"></td>
            </tr>
        </tbody>
    </table>
    <hr style="width: 95%;">
    <table id="infoMulti">
        <thead class="mb-3">
            <tr>
                <th style="width:40px"></th>
                <th>Multipresentación</th>
            </tr>
        </thead>
        <tbody id="InfoMultipresentacion">
        </tbody>
    </table>
    <hr style="width: 95%;">
    <table class="mb-3">
        <tbody>
            <tr>
                <td style="width:40px"></td>
                <td style="width:227px">Autorizado por:</td>
                <td id="autorizado">
                    <b>Jefe Producción / Director Técnico</b>
                </td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>