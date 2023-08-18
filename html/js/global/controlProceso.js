$(document).ready(function () {
    almacenarControlProceso = async (user) => {
        modulo == 6 ? (operacion = 3) : (operacion = 1);
        let muestras = sessionStorage.getItem(presentacion + ref_multi + modulo);
        // result = await muestrasRecolectadas(muestras);
        let data = new FormData();
        data.append('idBatch', idBatch);
        data.append('modulo', modulo);
        data.append('muestras', muestras);
        data.append('ref_multi', ref_multi);
        let result = await sendDataPOST('/api/muestras-envasado', data, 2);

        alertify.set('notifier', 'position', 'top-right');
        if (result.success) {
            await almacenarEquipos()
            firmaControlProcesoEnvasado(user);

            // alertify.success(result.message);
        } else if (result.error == true) alertify.error(result.message);
        else if (result.info == true) alertify.notify(result.message);
    }
});