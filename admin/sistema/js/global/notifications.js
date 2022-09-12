//Noficaciones

const notificaciones = (data) => {
    alertify.set('notifier', 'position', 'top-right');

    if (data.success == true) {
        alertify.success(data.message);
    }

    if (data.info == true) {
        alertify.warning(data.message);
        return false;
    }

    if (data.error == true) {
        alertify.error(data.message);
        return false;
    }
};