let flagWeight = false
let lotes = []
modulo = 2

loadBatch = async() => {
    await cargarInfoBatch();
    cargarTanques()
}

loadBatch()

// creacion de fechas

Date.prototype.toDateInputValue = function() {
    var local = new Date(this)
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset())
    return local.toJSON().slice(0, 10)
}

$('#in_fecha_pesaje').val(new Date().toDateInputValue())
$('#in_fecha_pesaje').attr('min', new Date().toDateInputValue())