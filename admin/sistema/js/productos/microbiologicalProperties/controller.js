    
    $(".cardMicro").hide();
    $("#card_apariencia").show();
    
    $(document).ready(function() {
        
        $(document).on("click", ".controller", function(e) {
            id = this.id;
            $(`.cardMicro`).hide();
            $(`#card_${id}`).show();
            
        });
    });