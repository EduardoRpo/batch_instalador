$(document).ready(function () {
  /* Capacidad prePlaneada */
  api = '/api/prePlaneados';

  getDataPrePlaneacion = async () => {
    console.log('🔍 getDataPrePlaneacion - Iniciando llamada a:', api);
    resp = await searchData(api);
    console.log('🔍 getDataPrePlaneacion - Respuesta recibida:', resp);
    console.log('🔍 getDataPrePlaneacion - Tipo de respuesta:', typeof resp);
    console.log('🔍 getDataPrePlaneacion - Es array:', Array.isArray(resp));
    
    // Si la respuesta es string, intentar parsearla
    if (typeof resp === 'string') {
      console.log('🔍 getDataPrePlaneacion - Parseando string JSON...');
      try {
        resp = JSON.parse(resp);
        console.log('🔍 getDataPrePlaneacion - JSON parseado exitosamente:', resp);
        console.log('🔍 getDataPrePlaneacion - Tipo después del parse:', typeof resp);
        console.log('🔍 getDataPrePlaneacion - Es array después del parse:', Array.isArray(resp));
      } catch (error) {
        console.error('❌ getDataPrePlaneacion - Error al parsear JSON:', error);
        console.log('🔍 getDataPrePlaneacion - String original:', resp);
      }
    }
    
    loadTblCapacidadPrePlaneada(resp);
  };

  getDataPrePlaneacion();

  loadTblCapacidadPrePlaneada = (data) => {
    console.log('🚀 loadTblCapacidadPrePlaneada - Iniciando con data:', data);
    console.log('🔍 loadTblCapacidadPrePlaneada - Tipo de data:', typeof data);
    console.log('🔍 loadTblCapacidadPrePlaneada - Es array:', Array.isArray(data));
    
    semana = sessionStorage.getItem('semana');
    console.log('🔍 loadTblCapacidadPrePlaneada - Semana de sessionStorage:', semana);
    
    let capacidadPrePlaneada = calcTamanioLoteBySemana(data, parseInt(semana));
    console.log('🔍 loadTblCapacidadPrePlaneada - Capacidad calculada:', capacidadPrePlaneada);

    let rowPrePlaneados = document.getElementById(
      'tblCalcCapacidadPrePlaneadoBody'
    );

    for (i = 0; i < capacidadPrePlaneada.length; i++) {
      rowPrePlaneados.innerHTML += `
        <tr>
          <td>${capacidadPrePlaneada[i].granel}</td>
          <td>${capacidadPrePlaneada[i].capacidad}</td>
        </tr>
      `;
    }
  };

  calcTamanioLoteBySemana = (data, semana) => {
    console.log('🚀 calcTamanioLoteBySemana - Iniciando con data:', data, 'semana:', semana);
    console.log('🔍 calcTamanioLoteBySemana - Tipo de data:', typeof data);
    console.log('🔍 calcTamanioLoteBySemana - Es array:', Array.isArray(data));
    
    // Validar que data existe y es un array
    if (!data || !Array.isArray(data)) {
      console.warn('⚠️ calcTamanioLoteBySemana: data no es válido:', data);
      console.log('🔍 calcTamanioLoteBySemana - Data recibido:', data);
      console.log('🔍 calcTamanioLoteBySemana - Data es null/undefined:', data == null);
      console.log('🔍 calcTamanioLoteBySemana - Data es string:', typeof data === 'string');
      
      // Si es string, intentar parsearlo
      if (typeof data === 'string') {
        console.log('🔍 calcTamanioLoteBySemana - Intentando parsear string JSON...');
        try {
          data = JSON.parse(data);
          console.log('🔍 calcTamanioLoteBySemana - JSON parseado:', data);
          console.log('🔍 calcTamanioLoteBySemana - Es array después del parse:', Array.isArray(data));
        } catch (error) {
          console.error('❌ calcTamanioLoteBySemana - Error al parsear JSON:', error);
          return [];
        }
      }
      
      // Verificar nuevamente después del parse
      if (!Array.isArray(data)) {
        console.warn('⚠️ calcTamanioLoteBySemana: data sigue sin ser array después del parse');
        return [];
      }
    }

    console.log('🔍 calcTamanioLoteBySemana - Data es válido, procesando', data.length, 'registros');
    
    let capacidad = 0;
    for (i = 0; i < data.length; i++) {
      console.log('🔍 calcTamanioLoteBySemana - Registro', i, ':', data[i]);
      
      if (data[i].semana == semana) {
        capacidad += parseFloat(data[i].tamano_lote);
        console.log('🔍 calcTamanioLoteBySemana - Capacidad acumulada:', capacidad);
      }
    }

    console.log('🔍 calcTamanioLoteBySemana - Capacidad total calculada:', capacidad);
    return [{ granel: 'Granel-212', capacidad: capacidad }];
  };

  /* Capacidad Planeada */
  getDataPlaneacion = async () => {
    console.log('🔍 getDataPlaneacion - Iniciando llamada a batch_planeados_fetch.php');
    resp = await searchData('/html/php/batch_planeados_fetch.php');
    console.log('🔍 getDataPlaneacion - Respuesta recibida:', resp);
    console.log('🔍 getDataPlaneacion - Tipo de respuesta:', typeof resp);
    
    // Si la respuesta es string, intentar parsearla
    if (typeof resp === 'string') {
      console.log('🔍 getDataPlaneacion - Parseando string JSON...');
      try {
        resp = JSON.parse(resp);
        console.log('🔍 getDataPlaneacion - JSON parseado exitosamente:', resp);
      } catch (error) {
        console.error('❌ getDataPlaneacion - Error al parsear JSON:', error);
      }
    }
    
    loadTblCapacidadPlaneada(resp);
  };

  getDataPlaneacion();

  loadTblCapacidadPlaneada = (data) => {
    console.log('�� loadTblCapacidadPlaneada - Iniciando con data:', data);
    console.log('�� loadTblCapacidadPlaneada - Tipo de data:', typeof data);
    console.log('�� loadTblCapacidadPlaneada - Es array:', Array.isArray(data));
    
    semana = sessionStorage.getItem('semana');
    console.log('�� loadTblCapacidadPlaneada - Semana de sessionStorage:', semana);
    
    // Extraer data.data si existe
    let registros = data;
    if (data && data.data && Array.isArray(data.data)) {
      console.log('�� loadTblCapacidadPlaneada - Extrayendo data.data, registros:', data.data.length);
      registros = data.data;
    }
    
    let capacidadPlaneada = calcTamanioLoteBySemana(registros, parseInt(semana));
    console.log('�� loadTblCapacidadPlaneada - Capacidad calculada:', capacidadPlaneada);

    let rowPlaneados = document.getElementById('tblCalcCapacidadPlaneadoBody');

    for (i = 0; i < capacidadPlaneada.length; i++) {
      rowPlaneados.innerHTML += `
        <tr>
          <td>${capacidadPlaneada[i].granel}</td>
          <td>${capacidadPlaneada[i].capacidad}</td>
        </tr>
      `;
    }
  };
});
