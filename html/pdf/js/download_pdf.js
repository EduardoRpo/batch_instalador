$(document).ready(function () {
  downloadPdfBatch = () => {
    try {
      invoice = document.getElementById('invoice');

      invoice.style.width = '1200px';
      let data = JSON.parse(sessionStorage.getItem('dataBatchPdf'));

      let opt = {
        margin: [10, 30, 30, 30],
        filename: `${data.numero_orden}_${data.fecha_creacion}.pdf`,
        html2canvas: {
          scale: 2,
          width: 1201,
        },
        jsPDF: {
          unit: 'pt',
          format: 'letter',
          orientation: 'portrait',
          pagebreak: { mode: 'avoid-all', before: '.SaltoDePagina' },
        },
      };

      html2pdf().from(invoice).set(opt).toPdf().get('pdf').save();

      setTimeout(() => {
        invoice.style.width = '';
      }, 500);
    } catch (error) {
      console.log(error);
    }
  };

  // insertBreaks = (element) => {
  //   let currentPageHeight = 0;

  //   if (element.clientHeight > 3000) maxPageHeight = element.clientHeight / 3;
  //   else if (element.clientHeight > 2000)
  //     maxPageHeight = element.clientHeight / 2.4;
  //   else maxPageHeight = element.clientHeight / 2;

  //   let allElem = element.getElementsByTagName('*');

  //   for (let i = 0; i < allElem.length; i++) {
  //     if (allElem[i].className.includes('body')) {
  //       let lineHeight = allElem[i].offsetHeight;

  //       currentPageHeight = currentPageHeight + lineHeight;

  //       if (currentPageHeight >= maxPageHeight) {
  //         if (allElem[i].className.includes('descQuoteF')) {
  //           for (let j = i; j < allElem.length; j--) {
  //             let id = allElem[j].id;
  //             if (id.includes('total')) {
  //               if (allElem[j].rowSpan >= 8) {
  //                 i = j;
  //                 while (!allElem[i].className.includes('descQuoteF')) {
  //                   j--;
  //                   i = j;
  //                 }
  //                 break;
  //               }
  //             }
  //             if (j != i && allElem[j].className.includes('descQuoteF')) break;
  //           }

  //           while (currentPageHeight > allElem[i].offsetHeight) {
  //             allElem[i - 3].insertAdjacentHTML('afterend', '<br>');

  //             if (element.clientHeight > 3000)
  //               currentPageHeight -= element.clientHeight / 25;
  //             else if (element.clientHeight > 200)
  //               currentPageHeight -= element.clientHeight / 30;
  //             else currentPageHeight -= element.clientHeight / 40;
  //           }
  //         } else if (allElem[i].className.includes('descQuoteL')) {
  //           while (currentPageHeight > allElem[i].offsetHeight) {
  //             allElem[i].insertAdjacentHTML('afterend', '<br>');

  //             if (element.clientHeight > 3000)
  //               currentPageHeight -= element.clientHeight / 25;
  //             else if (element.clientHeight > 200)
  //               currentPageHeight -= element.clientHeight / 30;
  //             else currentPageHeight -= element.clientHeight / 40;
  //           }
  //         } else if (allElem[i].className.includes('descQuoteE')) {
  //           allElem[i - 1].insertAdjacentHTML('afterend', '<br>');
  //         } else allElem[i].style.padding = '.6em';
  //         currentPageHeight = 0;
  //       }
  //     }
  //   }
  //   return element;
  // };
});
