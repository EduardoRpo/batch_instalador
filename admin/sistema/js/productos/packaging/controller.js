$(".cardPackaging").hide();

$(document).ready(function() {

    $(document).on("click", ".controller", function(e) {
        id = this.id;
        $(`.cardPackaging`).hide();
        $(`.${id}`).show();

    });
});