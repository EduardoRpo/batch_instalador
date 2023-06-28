$(document).ready(function () {
  downloadPdfBatch = async () => {
    try {
      let copy_invoice = invoice.cloneNode(true);

      copy_invoice.style.width = '1200px';
      let elementos = copy_invoice.getElementsByClassName('noImprimir');

      while (elementos.length > 0) {
        elementos[0].remove();
      }

      let data = JSON.parse(localStorage.getItem('dataBatchPdf'));
      let numero_orden = data.numero_orden.replace('/', '-');

      let opt = {
        margin: [10, 30, 30, 30],
        filename: `${numero_orden}_${data.fecha_creacion}.pdf`,
        html2canvas: {
          scale: 2,
          width: 1201,
        },
        jsPDF: {
          unit: 'pt',
          format: 'letter',
          orientation: 'portrait',
        },
      };

      let pdfDocGenerator = pdfMake.createPdf(opt);
      let blob = await new Promise((resolve) => {
        pdfDocGenerator.getBlob(resolve);
      });
      let form = new FormData();

      form.append('pdf', blob, `${numero_orden}_${data.fecha_creacion}.pdf`);

      let resp = await sendDataPOST('/api/savePdf', form);
      html2pdf().from(copy_invoice).set(opt).toPdf().get('pdf').save();
    } catch (error) {
      console.log(error);
    }
  };
});
