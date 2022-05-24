function iniciar() {
    $("#btn_entrada").click(
            function() {
                registrar_estancia(1);
            }
    );
    $("#btn_salida").click(
            function() {
                registrar_estancia(2);
            }
    );
}

function registrar_estancia(tipo) {
    $("#btn_entrada").prop('disabled', true);
    $("#btn_salida").prop('disabled', true);
    $("#hdd_tipo_estancia").val(tipo);
    $("#frm_registro_estancia").submit();
}
