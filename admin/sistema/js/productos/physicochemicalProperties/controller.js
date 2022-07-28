    
    $(".card_recuento_mesofilos").hide();
    $("#card_apariencia").show();
    
    $(document).ready(function() {
        
        $(document).on("click", ".controller", function(e) {
            id = this.id;
            $(`.cardPropiedades`).hide();
            $(`#card_${id}`).show();
            
        });
    });
