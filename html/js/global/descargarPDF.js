/* $('#imprimirEtiquetasVirtuales').click(function (e) { 
    e.preventDefault();

    var pdf = new jsPDF ('p', 'pt', 'letter');
    //html = $('#'+contenidoID).html();
    const html = $('.contenedorEtiquetas').html();
    specialElementHandlers = {};
    margins = {
        top: 10,
        botton: 20,
        letf: 20,
        width: 522
    };
    
    pdf.fromHTML(html, margins.letf, margins.top, {'width':margins.width}, 
    function (dispose){pdf.save('Etv'+'.pdf')}, margins);
    
}); */

function imprimir(imp1){

    //COLOCAR 4 PAGINAS DE ETIQUETAS 2.5 cm x 10 cm 

        var printContents = $('#imprimirEtiquetasVirtuale').html();
        var originalContents = document.body.innerHTML;
   
        document.body.innerHTML = printContents;
   
        window.print();
   
        document.body.innerHTML = originalContents;
   
        
        }