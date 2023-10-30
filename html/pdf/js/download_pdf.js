$(document).ready(function () {
  downloadPdfBatch = async () => {
    
    try {
      let data = JSON.parse(localStorage.getItem('dataBatchPdf'));
      let copy_invoice = invoice.cloneNode(true);

      let elementos = copy_invoice.getElementsByClassName('noImprimir');

      while (elementos.length > 0) {
        elementos[0].remove();
      }

      elementos = copy_invoice.getElementsByTagName('body');
      elementos[0].style.width = '1000px';
      elementos[0].style.margin = '-10px';
      elementos[0].style.fontSize = 'small'; 

      let form = new FormData();
      let html = copy_invoice.outerHTML;

      form.append('html', html);
      form.append('pdf', `${data.numero_lote}-${data.id_batch}.pdf`);

      let resp = await $.ajax({
        url: '/api/generate-pdf',
        type: 'POST',
        data: form,
        contentType: false,
        cache: false,
        processData: false,
        xhrFields: {
          responseType: 'blob'
        },
      });
      
      let url = URL.createObjectURL(new Blob([resp], { type: 'application/pdf' }));
    
      const a = document.createElement('a');
      a.style.display = 'none';
      a.href = url;
      a.download = `${data.numero_lote}-${data.id_batch}.pdf`;
      document.body.appendChild(a);
    
      a.click();
      
      form = new FormData(); 
      form.append('pdf', resp, `${data.numero_lote}-${data.id_batch}.pdf`);
      resp = await sendDataPOST('/api/savePdf', form, 2);

      window.close();
    } catch (error) {
      console.log(error);
    }
  };

});
