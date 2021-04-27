(function($) {
    // console.log('script.js chargé');

    /* ------------- HEADER -------------------*/

    $('#burger').on('click', function(){
        event.preventDefault();
        $("#menuNav ul").slideToggle();

        $("#menuNav li").on('click', function(){
            event.preventDefault();
            $("#menuNav ul").slideUp();
        })
    })

})(jQuery);