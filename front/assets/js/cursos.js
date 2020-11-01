$( document ).ready(function() {
    
    // Add class to header menu

    $(window).scroll(function() {    
        var scroll = $(window).scrollTop(),
        
        headH = $(".header").height();
    
        if (scroll >= headH) {
            $(".header-top").addClass("bg-dark").fadeIn( "slow" );
            $("#btn-top").addClass("d-flex");
        } else {
            $(".header-top").removeClass("bg-dark").fadeOut( "slow" );
            $("#btn-top").removeClass("d-flex");
        } 
    });

    $(window).scroll(function() {    
        var scrollT = $(window).scrollTop();
    
        if (scrollT <= 50) {
            $(".header-top").addClass("d-block");
        } else {
            $(".header-top").removeClass("d-block");
        } 
    });


});