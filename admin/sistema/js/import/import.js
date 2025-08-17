// Cargar librería XLSX si no está disponible
if (typeof XLSX === 'undefined') {
  var script = document.createElement('script');
  script.src = '/assets/plugins/xlsx/xlsx.full.min.js';
  script.onload = function() {
    console.log('XLSX library loaded successfully');
  };
  document.head.appendChild(script);
}

$(document).ready(function () {
  importFile = (selectedFile) =>
    new Promise((resolve, reject) => {
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
    });
});
