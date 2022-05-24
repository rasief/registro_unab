function iniciar() {
    $("#btn_registrar").click(
            function() {
                registrar_persona();
            }
    );
}

function registrar_persona() {
    $("#btn_registrar").prop('disabled', true);
    if (validar_persona()) {
        $("#d_error_registro").removeClass("d-block");
        $("#d_error_registro").addClass("d-none");
        
        $("#frm_registro").submit();
    } else {
        $("#btn_registrar").prop('disabled', false);
        $("#d_error_registro").html("Debes registrar todos los datos");
        $("#d_error_registro").removeClass("d-none");
        $("#d_error_registro").addClass("d-block");
    }
}

function validar_persona() {
    var resultado = true;
    
    if (trim($("#txt_nombres").val()) === "") {
        resultado = false;
    }
    if (trim($("#txt_apellidos").val()) === "") {
        resultado = false;
    }
    if (trim($("#txt_e_mail").val()) === "" || !validar_email($("#txt_e_mail").val())) {
        resultado = false;
    }
    if ($("input:radio[name=rad_tipo_persona]:checked").val() === undefined) {
        resultado = false;
    }
    
    return resultado;
}
