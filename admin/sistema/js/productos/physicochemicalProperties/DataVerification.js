//Noficaciones

const dataVerification = (min, max) => {

    let NotificacionData;
    if (min > max || min == max) {
        NotificacionData = { error: true, message: 'El valor mínimo no puede ser mayor o igual al valor máximo' };
        return 1;
    } else if (isNaN(min) || isNaN(max)) {
        NotificacionData = { error: true, message: 'Ingrese todos los datos' };
        return 2;
    } else {
        return false
    }

};