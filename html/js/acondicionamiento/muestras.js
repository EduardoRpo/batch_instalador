$(document).ready(function() {
    /* Crear selects de muestras en la ventana de muestras acondicionamiento */

    muestras_acondicionamiento = () => {
        muestras = $(`#muestras${id_multi}`).val();
        let recoveredData = sessionStorage.getItem(presentacion + ref_multi + modulo);
        j = 1;

        /* Elimina los campos para muestras */
        for (let i = 1; i <= 60; i++) $(`#fila${i}`).closest("tr").remove();

        /* crea tabla para registrar muestras */
        for (let j = 1; j <= muestras; j++) {
            $("#table_muestras_acondicionamiento").append(`
                        <tbody>    
                        <tr id="fila${j}">
                        <td>${j}</td>
                        <td>
                        <div class="form-check">
                        <input type="checkbox" class="check${j}" id="${j}" onclick="cumple_muestras(this)">
                        </div>
                        </td>
                        <td>
                        <select class="form-control apariencia_etiquetas${j}" name="" id="apariencia_etiquetas${j}">
                        <option disabled selected></option>    
                        <option value="1">Cumple</option>
                        <option value="2">No Cumple</option>
                        <option value="3">No Aplica</option>
                        </select>
                        </td>
                        <td><select class="form-control" name="" id="apariencia_termoencogible${j}">
                        <option disabled selected></option>
                        <option value="1">Cumple</option>
                        <option value="2">No Cumple</option>
                        <option value="3">No Aplica</option>
                    </select>
                    </td>
                    <td><select class="form-control" name="" id="cumplimiento_empaque${j}">
                    <option disabled selected></option>        
                    <option value="1">Cumple</option>
                    <option value="2">No Cumple</option>
                    <option value="3">No Aplica</option>
                    </select>
                    </td>
                    <td><select class="form-control" name="" id="posicion_producto${j}">
                        <option disabled selected></option>        
                        <option value="1">Cumple</option>
                        <option value="2">No Cumple</option>
                        <option value="3">No Aplica</option>
                        </select>
                        </td>
                <td><select class="form-control" name="" id="rotulo_caja${j}">
                <option disabled selected></option>        
                <option value="1">Cumple</option>
                <option value="2">No Cumple</option>
                <option value="3">No Aplica</option>
                    </select>
                </td>
            </tr>
        </tbody>`);
        }

        /* Recuperar muestras si existen*/
        j = 0;
        if (recoveredData !== null) {
            let data = JSON.parse(recoveredData);
            for (let i = 1; i <= data.length; i++) {
                $(`#apariencia_etiquetas${i}`).val(data[j]);
                j++;
                $(`#apariencia_termoencogible${i}`).val(data[j]);
                j++;
                $(`#cumplimiento_empaque${i}`).val(data[j]);
                j++;
                $(`#posicion_producto${i}`).val(data[j]);
                j++;
                $(`#rotulo_caja${i}`).val(data[j]);
                j++;
            }
        } else {
            $.ajax({
                type: "POST",
                url: "../../html/php/muestras.php",
                data: { operacion: 4, idBatch, modulo, ref_multi },

                success: function(response) {
                    if (response == 3) return false;

                    let info = JSON.parse(response);
                    i = 1;

                    for (let j = 0; j < info.data.length; j++) {
                        $(`#apariencia_etiquetas${i}`).val(info.data[j].apariencia_etiquetas);
                        $(`#apariencia_termoencogible${i}`).val(
                            info.data[j].apariencia_termoencogible
                        );
                        $(`#cumplimiento_empaque${i}`).val(info.data[j].cumplimiento_empaque);
                        $(`#posicion_producto${i}`).val(info.data[j].posicion_producto);
                        $(`#rotulo_caja${i}`).val(info.data[j].rotulo_caja);
                        i++;
                    }
                },
            });
        }
    }

    $("#guardar_muestras_acondicionamiento").click(function(e) {
        e.preventDefault();
        muestras_acon = $(`#muestras${id_multi}`).val();

        let cantidad_muestras = $(`#muestras${id_multi}`).val();
        let muestras = [];
        let recoveredData = sessionStorage.getItem(presentacion + ref_multi + modulo);

        if (recoveredData !== "") {
            sessionStorage.removeItem(presentacion + ref_multi + modulo);
        }

        /* cargar el array con las muestras */

        for (i = 1; i <= muestras_acon; i++) {
            //muestra = parseInt($(`#txtMuestra${i}`).val());
            let ae = $(`#apariencia_etiquetas${i}`).val();
            let at = $(`#apariencia_termoencogible${i}`).val();
            let ce = $(`#cumplimiento_empaque${i}`).val();
            let pp = $(`#posicion_producto${i}`).val();
            let rc = $(`#rotulo_caja${i}`).val();

            if (ae !== null) muestras.push(ae);
            else break;

            if (at !== null) muestras.push(at);
            else break;

            if (ce !== null) muestras.push(ce);
            else break;

            if (pp !== null) muestras.push(pp);
            else break;

            if (rc !== null) muestras.push(rc);
            else break;
        }

        /* almacena las muestras */

        sessionStorage.setItem(
            presentacion + ref_multi + modulo,
            JSON.stringify(muestras)
        );
        i = muestras.length;
        sessionStorage.setItem(`totalmuestras${id_multi}`, JSON.stringify(i));

        $("#m_muestras_acond").modal("hide");
        validar_condicionesMedio();
    });

    /* Genera cumple para todas las opciones en acondicionamiento */

    cumple_muestras = (obj) => {
        id = obj.id;
        $(`#apariencia_etiquetas${id}`).val(1);
        $(`#apariencia_termoencogible${id}`).val(3);
        $(`#cumplimiento_empaque${id}`).val(1);
        $(`#posicion_producto${id}`).val(1);
        $(`#rotulo_caja${id}`).val(1);
    }

    $("#aplicaTermoencogible").click(function(e) {
        e.preventDefault();
        for (let i = 1; i <= muestras; i++)
            $(`#apariencia_termoencogible${i}`).val(1);
    });

});