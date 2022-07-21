$(document).ready(function() {

    //Actualizar Multipresentacion

    $(document).on("click", ".link-editarMulti", function(e) {
        editar = true;
        id_batch = this.id
        cargarMultipresentacion(id_batch)
    });

    adicionarMultipresentaciones = async(id_batch) => {
        const resp = await busquedaMultiByBatch(id_batch)
        for (let i = 0; i < resp.length; i++)
            $("#adicionarMultipresentacion").trigger("click");
    }

    busquedaMultiByBatch = async(id_batch) => {
        //let result
        try {
            result = await $.ajax({ url: `/api/multi/${id_batch}` })
            return result
        } catch (error) {
            console.error(error)
        }
    }

    cargarMultipresentacion = async(id_batch) => {
        await adicionarMultipresentaciones(id_batch)
        await cargarSelectMulti(result)
        $("#Modal_Multipresentacion").modal("show");

        resp = result
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

});