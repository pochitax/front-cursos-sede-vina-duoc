// alerta de validación

/* $.validator.setDefaults( {
    submitHandler: function () {
        form.submit();
    }
} ); */

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
		MinWidth : 0, //'767px'
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
    
    $('#drop-all-courses').click(function(){
        $('#myTabResponsive').css({'background-color':'#FFB800', 'border-color': '#FFB800'});
    });

    $('#drop-business').click(function(){
        $('#myTabResponsive').css({'background-color':'#9521B2', 'border-color': '#9521B2'});
    });

    $('#drop-comunication').click(function(){
        $('#myTabResponsive').css({'background-color':'#BF0249', 'border-color': '#BF0249'});
    });

    $('#drop-design').click(function(){
        $('#myTabResponsive').css({'background-color':'#C1D541', 'border-color': '#C1D541'});
    });

    $('#drop-it-course').click(function(){
        $('#myTabResponsive').css({'background-color':'#939393', 'border-color': '#939393'});
    });

    $('#drop-health').click(function(){
        $('#myTabResponsive').css({'background-color':'#37A7C6', 'border-color': '#37A7C6'});
    });

    $('.drop').on('click', function (e) {
        var href = $(this).attr('href');
        $('html, body').animate({scrollTop:$('#coursesSedeVina').position().top}, 'slow');
        e.preventDefault();
    });

    // ejercicio de validar campos

    jQuery.validator.addMethod("phonenu", function (value, element) {
        if ( /^(\+?56)?(\s?)(0?9)(\s?)[9876543]\d{7}$/g.test(value)) {
            return true;
        } else {
            return false;
        };
    }, "Invalid phone number");

    $( "#signupForm" ).validate( {
        rules: {
            firstname: "required",  // requerido
            lastname1: "required",   // requerido
            lastname2: "required",   // requerido
            email: {
                required: true,
                email: true
            },
            rut: "required",
            phone: {
                phonenu: true,
                required: true
            },
        },
        messages: {
            firstname: "Por favor ingresa tu nombre",
            lastname1: "Por favor ingresa tu apellido paterno",
            lastname2: "Por favor ingresa tu apellido materno",
            email: "Por favor ingresa un correo válido",
            rut: "Ingresa un rut válido por favor",
            phone: "Por favor ingresa un número de teléfono válido",
        },
        errorElement: "span",
        errorPlacement: function ( error, element ) {
            // Add the `help-block` class to the error element
            error.addClass( "help-block" );
            if ( element.prop( "type" ) === "checkbox" ) {
                error.insertAfter( element.parent( "label" ) );
            } else {
                error.insertAfter( element );
            }
        },
        highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
        },
        unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-error" );
        }
    } );

    // rut

    //$("#rut").rut();

    $("#RutStudent").rut({formatOn: 'keyup', validateOn: 'keyup'
        }).on('rutInvalido', function(){ 
            $('.rut-validate').html('<span id="rut-error" class="error">Tu rut no es válido</span>');
            $('.rut-validate').parents('.form-group').removeClass('has-success');
            $('.rut-validate').parents('.form-group').addClass('has-error');
        }).on('rutValido', function(){ 
            $('.rut-validate').empty();
            $('.rut-validate').parents('.form-group').removeClass('has-error');
            $('.rut-validate').parents('.form-group').addClass('has-success');
    });

});