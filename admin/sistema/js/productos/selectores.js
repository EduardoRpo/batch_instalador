/* Cargar selectores y data */
$(document).ready(function() {

    cargarDatosProductos = () => {
        let sel = [];
        let j = 0;

        $("select").each(function() {
            let id_sel = $(this).prop("id");
            if (id_sel != "bases_instructivo" && $(this).prop("id") != "instructivo")
                sel.push($(this).prop("id"));
        });

        for (i = 1; i <= sel.length; i++) {
            propiedad = sel[j];
            cargarselectores(propiedad);
            j++;
        }
        /* cargar bases */
        cargar_selector_bases();
    }

    /* Cargar selectores para adicionar productos */

    function cargarselectores(selector) {
        $.ajax({
            //method: "POST",
            //url: "php/c_productos.php",
            //data: { tabla: selector, operacion: 4} 
            url: `/api/loadSelector/${selector}`,
            data :{ tabla : selector }
            ,

            success: function(response) {
                var info = JSON.parse(response);

                let $select = $(`#${selector}`);
                $select.empty();

                $select.append(
                    "<option disabled selected>" + "Seleccionar" + "</option>"
                );
                $.each(info.data, function(i, value) {
                    $select.append(
                        `<option value = ${value.id}> ${value.id} - ${value.nombre} </option>`
                    );
                });
            },
            error: function(response) {
                console.log(response);
            },
        });
    }

    /* cargar selectores bases */

    function cargar_selector_bases() {
        $.ajax({
            //method: "POST",
            //url: "php/c_productos.php",
            //data: { operacion: 5 },
            url: "/api/findBase",
            success: function(response) {
                var info = JSON.parse(response);

                let $select = $(`#instructivo`);
                $select.empty();
                $select.append(
                    "<option disabled selected>" + "Seleccionar" + "</option>"
                );

                $.each(info.data, function(i, value) {
                    $select.append(
                        '<option value ="' + value.id + '">' + value.producto_base + "</option>"
                    );
                });
            },
            error: function(response) {
                console.log(response);
            },
        });
    }

    cargarDatosProductos();
});