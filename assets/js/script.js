(function($) {
    // console.log('script.js chargé');

    /* ------------- HEADER -------------------*/

    // $('nav').hide();
    var hauteur = 580;
    $(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > hauteur) {
                $('nav').css("display", "flex")
                 .fadeIn();
            } else {
                $('nav').hide();
            }
        });
    });

    $('#burger').on('click', function(){
        event.preventDefault();
        $("#menuNav ul").slideToggle();

        $("#menuNav li").on('click', function(){
            event.preventDefault();
            $("#menuNav ul").slideUp();
        })
    })

})(jQuery);