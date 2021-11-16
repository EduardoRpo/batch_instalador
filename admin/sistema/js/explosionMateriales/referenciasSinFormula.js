async function referencias() {
    let result

    result = await $.ajax({
        url: '/api/explosionMaterialesReferencias',
    })

    return result
}

/* Referencias sin formula */

$('#btnReferenciasSinFormula').click(function(e) {
    e.preventDefault()

    referencias().then((data) => {
        sessionStorage.setItem('referencias', JSON.stringify(data))
        referenciasSinFormula(data)
    })

})

/* Cargar excel */

const referenciasSinFormula = (Data) => {
    let ws = XLSX.utils.json_to_sheet(Data)
    let wb = XLSX.utils.book_new()
    XLSX.utils.book_append_sheet(wb, ws, 'Referencias')

    XLSX.writeFile(wb, 'referenciasSinFormula.xlsx')
}


let pathname = window.location.pathname;
let explosion = pathname.split("/");

/* Calcular referencias Batch y Pedidos*/

$.get("/api/explosionMaterialesCantidades",
    function(data, textStatus, jqXHR) {

        if (explosion[3] == 'explosion_materiales.php') {
            $('#cantidadesExplosion').append(` 
                <p id="batchExplosion"><b>Batch:</b> ${data[0].total_batch}</p>
                <p id="pedidosExplosion"><b>Referencias:</b>  ${data[1].total_referencias_batch}</p>
                <p id="pedidosExplosion"><b>No. Materias Primas:</b>  ${data[2].total_id_materiaprima}</p>
            `);

        }
        if (explosion[3] == 'explosion_materiales_pedidos.php') {
            $('#cantidadesExplosion').append(` 
                <p id="pedidosExplosion"><b>Pedidos:</b>  ${data[3].total_pedidos}</p>
                <p id="pedidosExplosion"><b>Referencias:</b>  ${data[4].total_referencias_pedidos}</p>
                <p id="pedidosExplosion"><b>No. Materias Primas:</b>  ${data[5].total_MP_pedidos}</p>
                `);

        }
        if (explosion[3] == 'explosion_materiales_consolidado.php') {
            $('#cantidadesExplosion').append(` 
                <p id="batchExplosion"><b>Batch:</b> ${data[0].total_batch}</p>
                <p id="pedidosExplosion"><b>Pedidos:</b>  ${data[3].total_pedidos}</p>
                <p id="pedidosExplosion"><b>Referencias:</b>  ${data[1].total_referencias_batch}</p>
                <p id="pedidosExplosion"><b>Referencias:</b>  ${data[4].total_referencias_pedidos}</p>
                <p id="pedidosExplosion"><b>No. Materias Primas:</b>  ${data[2].total_id_materiaprima}</p>
                <p id="pedidosExplosion"><b>No. Materias Primas:</b>  ${data[5].total_MP_pedidos}</p>
                `);
        }



    },
);