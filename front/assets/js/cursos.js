$( document ).ready(function() {
    
    // Menu fixed duoc admision

    /*  
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
    }); */

    // pinBox

    $(".pinBox").pinBox({
		//default 0px
		Top : '0', // 100px al agregar el menu fixed
		//default '.container' 
		Container : '#coursesSedeVina',
		//default 20 
		ZIndex : 200,
		//default '767px' if you disable pinBox in mobile or tablet
		MinWidth : '767px'
		//events if scrolled or window resized 
    });
    
    // Anchor links courses top

    $('.tabs-courses a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
      })  
          
    $('.tabs-courses a.nav-link').on('click', function (e) {
        var href = $(this).attr('href');
        $('html, body').animate({scrollTop:$('#coursesSedeVina').position().top}, 'slow');
        e.preventDefault();
    });

    // dropdown menu responsive

    $(".drop").click(function(){
        $(this).parent().removeClass("active");
        var content = $(this).text();
        $(".dropdown-toggle").text(content+" ");
        $(".dropdown-toggle").append("<span class='caret'></span>");
        $(".dropdown-item").removeClass("active");
    });
     
});