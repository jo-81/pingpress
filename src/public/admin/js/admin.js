(function($) {

    // Suppression du message flash
    $('.close').click(function() {
        $(this).parent().parent().fadeOut();
    })

})(jQuery)