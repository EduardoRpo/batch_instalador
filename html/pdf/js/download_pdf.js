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
      elementos[0].style.width = '720px';
      elementos[0].style.margin = '-10px';

      let form = new FormData();
      let html = copy_invoice.outerHTML;

      form.append('html', html);
      form.append('pdf', `${data.numero_lote}-${data.fecha_creacion}.pdf`);

      let resp = await sendDataPOST('/api/generate-pdf', form, 2);
            
      let url = URL.createObjectURL(new Blob([resp], { type: 'application/pdf' }));
    
      const a = document.createElement('a');
      a.style.display = 'none';
      a.href = url;
      a.download = `${data.numero_lote}-${data.fecha_creacion}.pdf`; 
      document.body.appendChild(a);
    
      a.click();     
      
    } catch (error) {
      console.log(error);
    }
  };

});
