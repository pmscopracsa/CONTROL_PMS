function agregar_direccion()
{
    var contador = 1;
    var divDireccion = $(document.createElement('div')).attr("id", 'direccion'+counter);
    divDireccion.appendTo(".areaScroll");
    //obtenermos el valor del campo: TIPO DE DIRECCION
    var tipodireccion = $('#tipodireccionid option:selected').val();
    var departamento = $('#departamentoid option:selected').val();
    var provincia = $('#provinciaid option:selected').val();
    var distrito = $('#distritoid option:selected').val();
    //alert(tipodireccion);

    $(".areaScroll").append('<input type="text" name="'+tipodireccion+'"/>"');
    $(".areaScroll").append("<input type=\"text\" name=\"departamento\""+">"+ departamento +"</input>");

    contador++;
}

function cargar_especialidadpersona()
{
    $.get("../../bl/Contacto/cargarEspecialidadPersona.php",function(resultado) {
        $("#checkbox-especialidadpersona").append(resultado);
    });
}

function cargar_viasenvio()
{
    $.get("../../bl/Contacto/cargarViaEnvio.php",function(resultado){
        $("#viaenvioid").append(resultado);
    });
}

function cargar_companias()
{
    $.get("../../bl/Contacto/cargarCompanias.php",function(resultado){
        $("#companiaseleccionada").append(resultado);
    });
}

function cargar_tipocompania()
{
    $.get("../../bl/Contacto/cargarTipoCompania.php",function(resultado){
        $("#tipocompaniaid").append(resultado); 
    });
}

function cargar_tipodireccion()
{
    $.get("../../bl/Contacto/cargarTipoDireccion.php",function(resultado){
        $("#tipodireccionid").append(resultado);
    })
}

function cargar_paises()
{
    $.get("../../bl/Contacto/cargarPaises.php",function(resultado) {
        $("#paisid").append(resultado);
    });
}

function cargar_departamentos()
{
    var code = $("#paisid").val();
    $.get("../../bl/Contacto/cargarDepartamentos.php",{code:code},function(resultado) {
            $("#departamentoid").attr("disabled",false);
            document.getElementById("departamentoid").options.length = 1;
            $('#departamentoid').append(resultado);
    });
}

//function cargar_provincias()
//{
//    var code = $("#departamentoid").val();
//    $.get("../../bl/Contacto/cargarProvincias.php",{code:code},function(resultado) {
//            $("#provinciaid").attr("disabled",false);
//            document.getElementById("provinciaid").options.length = 1;
//            $('#provinciaid').append(resultado);
//    });
//}

function cargar_distritos()
{
    var code=$("#departamentoid").val();
    $.get("../../bl/Contacto/cargarDistritos.php",{code:code},
        function(resultado)
        {
            if(resultado == false)
            {
                alert("No hay distritos");
            }
            else
            {
                $("#distritoid").attr("disabled",false);
                document.getElementById("distritoid").options.length = 1;
                $("#distritoid").append(resultado);
            }
        }
    );
}