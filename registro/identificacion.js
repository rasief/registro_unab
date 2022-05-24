function iniciar() {
    $("#btn_aceptar_prev1").click(
            function () {
                solicitar_validar_id();
            }
    );
    $("#btn_aceptar_prev2").click(
            function () {
                comparar_id();
            }
    );
}

function solicitar_validar_id() {
    if ($("#txt_id_prev1").val().length >= 5) {
        $("#d_error_id1").removeClass("d-block");
        $("#d_error_id1").addClass("d-none");
        $("#d_in_id1").removeClass("d-block");
        $("#d_in_id1").addClass("d-none");
        $("#d_in_id2").removeClass("d-none");
        $("#d_in_id2").addClass("d-block");
    } else {
        $("#d_error_id1").html("Debes ingresar un dato v&aacute;lido");
        $("#d_error_id1").removeClass("d-none");
        $("#d_error_id1").addClass("d-block");
        $("#txt_id_prev1").focus();
    }
}

function comparar_id() {
    if ($("#txt_id_prev2").val().length >= 5) {
        $("#d_error_id2").removeClass("d-block");
        $("#d_error_id2").addClass("d-none");
        
        if ($("#txt_id_prev1").val() === $("#txt_id_prev2").val()) {
            $("#frm_prev").submit();
        } else {
            $("#txt_id_prev2").val("");
            $("#d_error_id1").html("Los valores no coinciden, por favor vuelve a intentarlo");
            $("#d_error_id1").removeClass("d-none");
            $("#d_error_id1").addClass("d-block");
            $("#d_in_id2").removeClass("d-block");
            $("#d_in_id2").addClass("d-none");
            $("#d_in_id1").removeClass("d-none");
            $("#d_in_id1").addClass("d-block");
        }
    } else {
        $("#d_error_id2").html("Debes ingresar un dato v&aacute;lido");
        $("#d_error_id2").removeClass("d-none");
        $("#d_error_id2").addClass("d-block");
        $("#txt_id_prev2").focus();
    }
}
