<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>ERDICION DE PERSONA</title>
        <!-- CSS ZONE -->
        <link href="../../../css/barrasuperior.css" rel="stylesheet" type="text/css" />
        <link href="../../../css/cuerpo.css" rel="stylesheet" type="text/css" />
        <link href="../../../css/autocomplete.css" rel="stylesheet" type="text/css" />
        <link href="../../../css/botones.css" rel="stylesheet" type="text/css" />
        <link href="../../../css/google-buttons.css" rel="stylesheet" type="text/css" />
        <link href="../../../css/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" />
        
        <!-- JS ZONE -->
        <script src="../../../js/jquery1.4.2.js.js" type="text/javascript"></script>
        <script src="../../../js/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
        <script src="../../../js/autocomplete/jquery.autocomplete.js" type="text/javascript"></script> 
        <script src="../../../js/cargarDatos.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            // BUSCAR CONTACTO A EDITAR
            $("#txtnombre").autocomplete("../../../bl/Contacto/mantenimiento/autocompletadoEmpresasPorContacto.php",{
                width:260,
                matchContains:true,
                selectFirst:false
            });
            // BOTON PARA CARGAR DATOS DE CONTACTO A EDITAR
            $("#btnBuscar").click(function() {
                if ($("#txtnombre").val() === "")
                    alert("El campo esta vacio");
                else {
                    $.ajax({
                       type:"GET",
                       dataType:"html",
                       url:"../../../bl/Contacto/actualizaPersona.php",
                       data:{
                           nombre:$("#txtnombre").val()
                       },
                       success:function(data) {
                           toHtml(data);
                           cargarDireccionPersona($("#txtnombre").val());
                       }
                    });
                }
            });
            
            function cargarDireccionPersona(id_persona){
                $.ajax({
                    type:"GET",
                    dataType:"json",
                    data:{
                        idpersona:id_persona
                    },
                    url:"../../../dl/busca_persona/DireccionPersona.json.php",
                    success:function(data){
                        printAddress(data);
                    }
                })
            }
            
            function printAddress(data) {
                var i = 1;
                $.each(data,function(index,value){
                    cargarPais(data[index].idpais,i)
                    cargarDepartamento(data[index].iddepartamento, i);
                    cargarDistrito(data[index].iddistrito, i);
                    
                    $("#direccion_full tbody").append(
                        "<tr id='tbl_direccion'>"+
                        "<td><input type='text' id='direccion' value='"+data[index].direccion+"' READONLY/></td>"+
                        "<td><td><select disabled='disabled' id='pa"+i+"'></select></td></td>"+
                        "<td><td><select disabled='disabled' id='de"+i+"'></select></td>"+
                        "<td><td><select disabled='disabled' id='di"+i+"'></select></td>"+
                        "<td><input type='button' id='btnEditarDireccion'  value='Editar'/></td>"+
                        "<td><input type='button' class='delRow' id='btnEliminarDireccion' /></td>"+
                        "<td><input type='button' class='addRow' id='btnAgregarDireccion' /></td>"+
                        "<td style='display:none'><input type='hidden' id='idDireccionHidden' value='"+i+"' /></td>"+
                        "<td style='display:none'><input type='hidden' id='idDireccion"+i+"' value='"+data[index].id+"' /></td>"+
                        "</tr>"
                    ),
                    i++
                });
            }
            function cargarPais(idpais,i) {
                $.ajax({
                    dataType:"html",
                    data:{id_pais:idpais},
                    url:"../../../bl/Contacto/cargarPaisesSelected.php",
                    success:function(data){
                        $("#pa"+i).append(data);
                    }
                })
            }
            function cargarDepartamento(iddepartamento,i) {
                $.ajax({
                    dataType:"html",
                    data:{id_departamento:iddepartamento},
                    url:"../../../bl/Contacto/cargarDepartamentosSelected.php",
                    success:function(data){
                        $("#de"+i).append(data);
                    }
                })
            }
            function cargarDistrito(iddistrito,i) {
                $.ajax({
                    dataType:"html",
                    data:{id_pais:iddistrito},
                    url:"../../../bl/Contacto/cargarDistritosSelected.php",
                    success:function(data){
                        $("#di"+i).append(data);
                    }
                })
            }
            
            function toHtml(data)
            {
                $("#tmp").html(data);  
            }
        });//end main
    </script>
    </head>
    <body class="fondo">
        <div id="barra-superior">
            <div id="barra-superior-dentro">
                <h1 id="titulo_barra">EDICION DE PERSONA</h1>
            </div>
        </div>
        <div id="main">
            <h1>EDICION DE PERSONA | <?=$_SESSION['usr']?></h1>
            <label for="nombre">Escriba el nombre de la persona:</label>
            <div id="busqueda">
                <input type="text" size="30" name="txtnombre" id="txtnombre" placeholder="NOMBRE"/>
                <input type="button" value="Buscar" id="btnBuscar" />
            </div>
            <hr/>
            <div id="tmp">
            </div>
        </div>
    </body>
</html>
