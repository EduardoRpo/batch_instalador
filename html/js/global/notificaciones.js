$(document).ready(function() {
    notificaciones = (data) => {

        if (data.success == true) {
            alertify.set("notifier", "position", "top-right");
            alertify.success(data.message);
        } else if (data.error == true) {
            alertify.set("notifier", "position", "top-right");
            alertify.error(data.message);
            return false
        } else if (data.info == true) {
            alertify.set("notifier", "position", "top-right");
            alertify.warning(data.message);
            return false
        }
    };

});