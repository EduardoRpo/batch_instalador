$(document).ready(function () {
  searchData = async (urlApi) => {
    try {
      result = await $.ajax({ url: urlApi });
      return result;
    } catch (error) {
      console.error(error);
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
          xhrFields: {
            responseType: 'blob'
          },
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
