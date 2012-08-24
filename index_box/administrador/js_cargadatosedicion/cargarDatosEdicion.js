function cargar_Directorios(idEmpresa)
{
    $.get("../../bl/DirectorioCliente_BL.php?parameter=cargarDirectorioEditarlo&idEmpresa="+idEmpresa,function(resultado) {
        $("#selDirectorio").append(resultado);
    });
}
