    
    $(".cardPackaging").hide();
    $("#card_tapa").show();
    
    $(document).ready(function() {
        
        $(document).on("click", ".controller", function(e) {
            id = this.id;
            $(`.cardPackaging`).hide();
            $(`#card_${id}`).show();
            
        });
    });