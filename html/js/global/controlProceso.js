$(document).ready(function () {
    almacenarControlProceso = async (user) => {
        modulo == 6 ? (operacion = 3) : (operacion = 1);
        let muestras = JSON.parse(sessionStorage.getItem(presentacion + ref_multi + modulo));
        // result = await muestrasRecolectadas(muestras);
        let data = new FormData();
        data.append('idBatch', idBatch);
        data.append('modulo', modulo);
        data.append('muestras', muestras);
        data.append('ref_multi', ref_multi);
        let result = await sendDataPost('/api/muestras-envasado', data, 2);

        alertify.set('notifier', 'position', 'top-right');
        if (result.success) {
            result = await almacenarEquipos()
            firmaControlProcesoEnvasado(user);

            alertify.success(resp.message);
        } else if (resp.error == true) alertify.error(resp.message);
        else if (resp.info == true) alertify.notify(resp.message);
    }
});