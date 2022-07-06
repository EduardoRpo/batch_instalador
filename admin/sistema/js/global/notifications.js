//Noficaciones


    const notificaciones = (data) => {
        alertify.set("notifier", "position", "top-right");

        if (data.success == true) {
            alertify.success(data.message);
            refreshTable();
        }

        if (data.info == true) {
            alertify.warning(data.message);
            return false
        }

        if (data.error == true) {
            alertify.warning(data.message);
            return false
        }
    }
    function refreshTable() {
        $('#listarCondiciones').DataTable().clear();
        $('#listarCondiciones').DataTable().ajax.reload();
    }