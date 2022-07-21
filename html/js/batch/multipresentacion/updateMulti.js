$(document).ready(function() {

    APISEL = '/api/multiref/'
    API = '/api/multi/'

    //Actualizar Multipresentacion

    $(document).on("click", ".link-editarMulti", function(e) {
        editar = true;
        id_batch = this.id
        ref = $(this).parent().parent().children().eq(1).text();
        cargarMultipresentacion()
    });

    cargarMultipresentacion = async() => {
        await adicionarMultipresentaciones()
        resp = await buscarDataMulti(`${API}${id_batch}`)

        $("#Modal_Multipresentacion").modal("show");
        let lote = 0

        for (let i = 0; i < resp.length; i++) {
            $(`#MultiReferencia${i + 1}`).val(resp[i].referencia);
            $(`#cantidadMulti${i + 1}`).val(resp[i].cantidad);
            $(`#tamanioloteMulti${i + 1}`).val((resp[i].total).toFixed(2));
            $(`#densidadMulti${i + 1}`).val(resp[i].densidad);
            $(`#presentacionMulti${i + 1}`).val(resp[i].presentacion);
            lote = lote + resp[i].total
            $(`#sumaMulti`).val(lote);
        };
    }

    adicionarMultipresentaciones = async() => {
        const resp = await buscarDataMulti(`${API}${ref}`)
        for (let i = 0; i < resp.length; i++) {
            $("#adicionarMultipresentacion").trigger("click");
            cargarSelectMulti(resp)
        }
    }

    buscarDataMulti = (urlApi) => {
        return searchData(urlApi)
    }

});