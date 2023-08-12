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
 
      // let imagenes = copy_invoice.getElementsByClassName('img');
      
      // let href = imagenes[0].href.replace('http://batchrecord', '').replace('https://batchrecord', '');
      // imagenes[0].setAttribute('href', `../../../../..${href}`);
      
      // // let src = imagenes[1].src.replace('http://batchrecord', '').replace('https://batchrecord', '');
      // // imagenes[1].setAttribute('src', `../../../../..${src}`); 
      
      // imagenes = copy_invoice.getElementsByTagName('img');
      
      // for (let i = 0; i < imagenes.length; i++) {
      //   let src = imagenes[i].src.replace('http://batchrecord', '').replace('https://batchrecord', '');
      //   imagenes[i].setAttribute('src', `../../../../..${src}`); 
      // }

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
      // let pdfBlob = new Blob([resp], { type: 'application/pdf' });
      form.append('pdf', resp, `${data.numero_lote}-${data.id_batch}.pdf`);
      resp = await sendDataPOST('/api/savePdf', form, 2);

      window.close();
    } catch (error) {
      console.log(error);
    }
  };

});
