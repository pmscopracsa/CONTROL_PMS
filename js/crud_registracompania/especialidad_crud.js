function ActualizarDatos() {
    var id_especialidadcompania = $("#id_especialidadcompania").attr('value');
    var desc_especialidadcompania = $("#desc_especialidadcompania").attr('value');
    
    $.ajax({
        url:'',
        type:"POST",
        data:"submit=&id_especialidadcompania="+id_especialidadcompania+"&desc_especialidadcompania="+desc_especialidadcompania,
        success:function(datos) {
            ConsultaDatos();
            $("#formulario").hide();
            $("#tabla").show();
        }
    });
    return false;
}

function ConsultaDatos() {
    $.ajax({
        url:'',
        cache:false,
        type:"GET",
        success:function(datos) {
            $("#tabla").html(datos);
        }
    });
}

function EliminarDato(id_perfil) {
    var msg = confirm("¿Desea eliminar el dato?")
    if(msg) {
        $.ajax({
            url:'',
            type:"GET",
            data:"id_especialidadcompania="+id_especialidadcompania,
            success:function(datos) {
                $("#fila-"+id_especialidadcompania).remove();
            }
        });
    }
    return false;
}

function Cancelar() {
    $("#formulario").hide();
    $("#tabla").show();
    return false;
}