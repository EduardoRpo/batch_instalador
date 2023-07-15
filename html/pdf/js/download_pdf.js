$(document).ready(function () {
  downloadPdfBatch = async () => {
    
    try {
      /*let copy_invoice = invoice.cloneNode(true);

      copy_invoice.style.width = '1279px';
      let elementos = copy_invoice.getElementsByClassName('noImprimir');

      while (elementos.length > 0) {
        elementos[0].remove();
      }

      copy_invoice = insertBreaks(copy_invoice);

      let data = JSON.parse(localStorage.getItem('dataBatchPdf'));
      let numero_orden = data.numero_orden.replace('/', '-');

      let opt = {
        margin: [10, 30, 30, 30],
        filename: `${numero_orden}_${data.fecha_creacion}.pdf`,
        html2canvas: {
          scale: 2,
          width: 1280,
        },
        jsPDF: {
          unit: 'pt',
          format: 'a4',
          orientation: 'portrait',
        },
        pagebreak: { mode: 'avoid'}
      };

      html2pdf().from(copy_invoice).set(opt).toPdf().output('blob').then(async function (blob) {
        let form = new FormData();
        form.append('pdf', blob, `${numero_orden}_${data.fecha_creacion}.pdf`); 
          
        let resp = await sendDataPOST('/api/savePdf', form, 2);
      }).save(); */
      debugger
      let form = new FormData();
      const html = document.getElementById('invoice').outerHTML;
      // console.log(html)
      form.append('html',html);
      let resp = await sendDataPOST('/api/generate-pdf',form,2);
      
    } catch (error) {
      console.log(error);
    }
  };

  insertBreaks = (element) => {

    let allElem = element.getElementsByTagName('*');

    for (let i = 0; i < allElem.length; i++) {
      if (allElem[i].className.includes('pdfPageBreak')) {
        let marginBottom = 0;

        for (let j = i; j <= i; j--) {
          j == i ? j = j - 1 : j; 

          if(j < 0 || allElem[j].className.includes('pdfPageBreak')||marginBottom > 3000) {
            break;
          } 

          marginBottom += 200;
        }

        if(marginBottom > 3000) marginBottom = marginBottom / 3;
        else if(marginBottom > 1500) marginBottom = (marginBottom / 2.3);
        else if(marginBottom > 1000) marginBottom = (marginBottom / 1.5);
        else if(marginBottom > 700) marginBottom = (marginBottom / 1.15);
        
        allElem[i].style.marginBottom = `${(marginBottom)}px`;
        currentPageHeight = 0;
      }
    }
    return element;
  };
});
