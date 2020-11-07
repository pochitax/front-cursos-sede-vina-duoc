$(function(){
        $("#RegionStudent").on('change', function(){
                cargarComunas();
        })

});

$('input').on('blur', function() {
        if ($("#signupForm").valid()) {
            $('#form-btn').prop('disabled', false);
        } else {
            $('#form-btn').prop('disabled', 'disabled');
        }
    });

$("#form-btn").click(function() {
        if(($('#signupForm').validate().checkForm())){
                console.log("Validación correcta");
                envioFormulario();
        }
        else{
                console.log('Validación incorrecta');
        }
});

function cargarComunas(){
        var valorComuna = document.getElementById('RegionStudent').value;
        var parametros = {
            "v_region" : document.getElementById('RegionStudent').value,
        }
        
        $.ajax({
                data:  parametros,
                url:   '../src/CargarComunas.php',
                type:  'get',
                beforeSend: function () {
                        
                },
                success:  function (response) {
                        var objComunas = JSON.parse(response);
                        var listComunas= document.getElementById("comuna");
                        while (listComunas.options.length) {
                            listComunas.remove(0);
                        }

                        if(valorComuna == 0){
                                var comuna = new Option('Selecciono la Comuna', '0');
                                listComunas.options.add(comuna);
                        }
                        if (objComunas) {
                                var i;
                                for (i = 0; i < objComunas.length; i++) {
                                        var comuna = new Option(objComunas[i].desc, objComunas[i].cod);
                                        listComunas.options.add(comuna);
                                }
                        }
        }
        });
};

function envioFormulario(){
var x = document.getElementById("NameStudent").required;
var y = document.getElementById("LastName1").required;
var z = document.getElementById("LastName2").required;
    var parametros = {
        "v_nombre" : document.getElementById('NameStudent').value,
        "v_lastname" : document.getElementById('LastName1').value,
        "v_lastname2" : document.getElementById('LastName2').value,
        "v_rut" : document.getElementById('RutStudent').value,
        "v_email" : document.getElementById('EmailStudent').value,
        "v_phone" : document.getElementById('PhoneStudent').value,
        "v_region" : document.getElementById('RegionStudent').value,
        "v_comuna" : document.getElementById('comuna').value,
        "v_curso" : document.getElementById('CursoId').value
    };

    $.ajax({
            data:  parametros,
            url:   '../src/EnvioFormulario.php',
            type:  'post',
            beforeSend: function () {
                    //$("#resultado").html("Espere por favor...");
            },
            success:  function (response) {
                console.log(response);
                    var respuesta = JSON.parse(response);
                    if(respuesta.success == true){
                        //$("#resultado").html("Inscripcion envíada.");
                        $('#ModalInscrispcion').modal('show');
                        
                        if(respuesta.nombres != null){
                                $('#saludo_modal').html(respuesta.nombres);
                        }
                    }else{
                            console.log(response);
                        console.log(respuesta.errores.error.msg);
                        $('#ModalError').modal('show');
                        $("#TextoError").html(respuesta.errores.error.msg); 
                    }
            }
    });
};

