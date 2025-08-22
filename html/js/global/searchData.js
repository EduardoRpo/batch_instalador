$(document).ready(function () {
  searchData = async (urlApi) => {
    try {
      console.log('🔍 searchData - Llamando a:', urlApi);
      result = await $.ajax({ url: urlApi });
      console.log('✅ searchData - Respuesta exitosa:', result);
      return result;
    } catch (error) {
      console.error('❌ searchData - Error:', error);
      console.error('❌ searchData - URL que falló:', urlApi);
      return undefined;
    }
  };

  sendDataPOST = async (urlApi, params, op) => {
    try {
      if (op == 2)
        result = await $.ajax({
          url: urlApi,
          type: 'POST',
          data: params,
          contentType: false,
          cache: false,
          processData: false,
        });
      else
        result = await $.ajax({
          url: urlApi,
          type: 'POST',
          data: params,
        });
      return result;
    } catch (error) {
      console.error(error);
    }
  };
});
