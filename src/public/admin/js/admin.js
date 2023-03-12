(function($) {

    // Suppression du message flash
    $('.close').click(function() {
        $(this).parent().parent().fadeOut();
    })

    // Pour la page Joueur de l'administration de Pingpress
    $("#content-box").sortable({
        placeholder: "ui-state-highlight",
        axis: "y",
        cursor: "crosshair",
        stop: function() {
            $(".ui-sortable-handle.ui-state-default > :input").each(function(indice, element) {
            element.value = indice;
        })
        },
    });

    $("#content-box").disableSelection();

})(jQuery)