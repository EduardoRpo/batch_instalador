modulo = 7;
let flag = 0;


loadBatch = async() => {
    await cargarInfoBatch();
    await busqueda_multi();
}

loadBatch()

//$("#in_fecha_programacion").prop("min", new Date().toDateInputValue());