modulo = 4;

loadBatch = async() => {
    await cargarInfoBatch();
    cargarTanques()
}

loadBatch()