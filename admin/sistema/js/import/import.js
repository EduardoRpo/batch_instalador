// Función para cargar XLSX de forma asíncrona
function loadXLSX() {
  return new Promise((resolve, reject) => {
    if (typeof XLSX !== 'undefined') {
      resolve(XLSX);
      return;
    }

    var script = document.createElement('script');
    script.src = '/assets/plugins/xlsx/xlsx.full.min.js';
    script.onload = function() {
      console.log('XLSX library loaded successfully');
      resolve(XLSX);
    };
    script.onerror = function() {
      console.error('Failed to load XLSX library');
      reject(new Error('XLSX library not found'));
    };
    document.head.appendChild(script);
  });
}

$(document).ready(function () {
  importFile = (selectedFile) =>
    new Promise(async (resolve, reject) => {
      try {
        // Asegurar que XLSX esté cargado
        const XLSX = await loadXLSX();
        
        let fileReader = new FileReader();
        fileReader.readAsBinaryString(selectedFile);

        fileReader.onload = (event) => {
          let data = event.target.result;
          let workbook = XLSX.read(data, {
            type: 'binary',
          });
          workbook.SheetNames.forEach((sheet) => {
            rowObject = XLSX.utils.sheet_to_row_object_array(
              workbook.Sheets[sheet],
              {
                raw: false,
                dateNF: 'dd-mm-yyyy',
              }
            );
          });
          resolve(rowObject);
        };
      } catch (error) {
        console.error('Error loading XLSX:', error);
        reject(error);
      }
    });
});
