<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>ADMINISTRADOR DE <?=  strtoupper($_SESSION['usr']);?></title>
        <script src="../../js/tabs/jquery-1.7.2.js"></script>
        <script src="../../js/tabs/jquery.ui.core.js"></script>
        <script src="../../js/tabs/jquery.ui.widget.js"></script>
        <script src="../../js/tabs/jquery.ui.tabs.js"></script>
        <script src="../../js/jquery-ui-1.8.18.custom.min.js"></script>
        <script src="../../js/ajaxfileupload.js"></script>
        
        <link rel="stylesheet" href="../../css/tabs.css">
        <link rel="stylesheet" href="../../css/jquery-ui-1.8.18.custom.css">
        
        <script>
        function cargarDirectorios() {
            $("#divSeleccionaDirectorio").load("../../index_box/administrador/modales/directorios_div.php");
        }
        $(document).ready(function() {
            
            /* div de directorios carga por defecto*/
            $("#divSeleccionaDirectorio").load("../../index_box/administrador/modales/directorios_div.php");
            /* div usuarios por ddefecto */
            $("#divSeleccionUsuarios").load("../../modulos/datosdeobra/modales/usuarios_div.php?filtro=1");
            /* div proyectos por defecto */
            $("#divSeleccionaProyecto").load("modales/proyectos_div.php")
 
            /**
             * OCULTAR POR DEFCTO CAMPOS PARA CAMBIO DE PASSWORD
             */
            $("input[name=changepassword]").click(function() {
                if($(this).val() == "si") {
                    $("#password_change_old").css("display","block");
                    $("#password_change_new").css("display","block");
                    $("#password_change_repeat").css("display","block");
                    
                }
                else {
                    $("#password_change_old").css("display","none");
                    $("#password_change_new").css("display","none");
                    $("#password_change_repeat").css("display","none");
                    $("#password_change_button").css("display","none");
                }
            });
            
            /*
             * VER SI EXISTE PASSWORD
             */
            $("#txtoldpassword").focusout(function() {
                $.ajax({
                    type:"GET",
                    data:{old_pass:$("#txtoldpassword").val(),id_empresa:<?=$_SESSION['id']?>},
                    url:"../../bl/EmpresaCliente_BL.php?parameter=existePassword",
                    success:function(data) {
                        if (data == "incorrecto")
                            $("#oldpasswrong").css("display","block");
                        else
                            $("#password_change_button").css("display","block");
                    }
                });
            });
            
            /*
             * VerIfiar igualdad en password
             */
            $("#btnActualizapass").click(function() {
                if($("#txtnewpassword").val() === $("#txtrepassword").val()){
                    $.ajax({
                        type:"POST",
                        data:{new_pass:$("#txtnewpassword").val(),id_empresa:<?=$_SESSION['id']?>},
                        url:"../../bl/EmpresaCliente_BL.php?parameter=resetpassword",
                        success:function(data){
                            if(data == "correcto")
                                alert("Password actualizado correctamente");
                            else
                                alert("No se pudo actualizar");
                        }
                    });
                }else{
                    alert("my bad");
                }
            }) 
             
            
            /*
             * CARGAR USUARIOS EN TABLA 
             */
            $("#listaUsuarios").load("../../modulos/datosdeobra/modales/usuarios_div.php?filtro=1");
            
            // CREAR LOS TABS
            $("#tabs").tabs();
            $("#tabs_tablero_control").tabs();
            $("#usuarios").tabs();
            $("#obras").tabs();
            $("#directorios").tabs();
            $("#empresa").tabs();
            $("#usuariosaprobacion").tabs();
            
            // GENERAR PASSWORD ALEATORIO
            $("#btnGeneraPass").click(function() {
                $("#txtpassword").val(generarPassword(5,true));
            });
            
            $("#btnFillUsuario").click(function() {
                $("#tblUserData").css("display","block");
            })
            
            //CLICK PARA CARGAR Y FILTRAR USUARIOS PARA APROBACION
            $("#btnSelUsuarios").click(function() {
                $("#listaUsuarios").dialog("open");
            });
            
            // USUARIOS APROBACION - PRIMER DIALOG - FILTRA POTENCIALES USUARIOS (O SEA TODOS)
            $("#listaUsuarios").dialog({
                autoOpen:false,
                height:500,
                width:400,
                resizable:false,
                closeOnEscape:false,
                modal:true,
                buttons:{
                    "Asignar Aprobaciones":function() {
                        
                    },
                    "Salir":function() {
                        $(this).dialog("close");
                    }
                }
            });
            
            // DETECTAR SELECCION DE USUARIOS POTENCIALES
            $("#chkSeleccionaUsuario").live("click",function() {
                if ($("#chkSeleccionaUsuario").attr("checked")) { //HACIENDO CHECK PARA INGRESAR A LA DB
                    $.ajax({
                        type:"POST",
                        data:{},
                        url:"",
                        success:function() {
                            
                        }
                    });
                    alert("checked");
                }else{ // HACIENDO CHECK PARA SACARLO DE LA DB
                    $.ajax({
                        type:"GET",
                        data:{},
                        url:"",
                        success:function() {
                            
                        }
                    });
                }
            }); 
            
            function generarPassword(length,special) {
                var iteration = 0;
                var password = "";
                var randomNumber;
                if(special == undefined){
                var special = false;
                }
                while(iteration < length){
                    randomNumber = (Math.floor((Math.random() * 100)) % 94) + 33;
                    if(!special){
                    if ((randomNumber >=33) && (randomNumber <=47)) { continue; }
                    if ((randomNumber >=58) && (randomNumber <=64)) { continue; }
                    if ((randomNumber >=91) && (randomNumber <=96)) { continue; }
                    if ((randomNumber >=123) && (randomNumber <=126)) { continue; }
                }
                iteration++;
                password += String.fromCharCode(randomNumber);
                }
                return password;     
            };
            
            /****
             * EDITAR DIRECTORIO
             */
            $("#btnEncuentraDirectorio").click(function() {
                $("#tbl_datosEditarDirectorio").css("display","block");
              
            });
            
            /******
             * DIRECTORIO
             */
            //CREAR DIRECTORIO
            $("#btnCrearDirectorio").click(function() {
                if ($("#txtnombredirectorio").val() === "" || $("#txtdescripciondirectorio").val() === "") {
                    alert("Ambos campos son obligatorios");
                } else {
                  $.ajax({
                    type:"POST",
                    data:{
                        nombre:$("#txtnombredirectorio").val()
                        ,descripcion:$("#txtdescripciondirectorio").val()
                        ,id_empresa:<?=$_SESSION['id']?>
                    },
                    url:"../../bl/DirectorioCliente_BL.php?parameter=crearDirectorio",
                    success:function() {
                        $("#txtnombredirectorio").val("");
                        $("#txtdescripciondirectorio").val("");
                        alert("si");
                    },
                    error:function() {
                        alert("no");
                        }
                    });
                }
                

            });
            //ACTUALIZAR DIRECTORIO
            $("#btnBuscarDirectorio").click(function() {
                $("#divSeleccionaDirectorio").dialog("open");
            });
            $("#divSeleccionaDirectorio").dialog({
                autoOpen:false,
                height:350,
                width:450,
                resizable:false,
                closeOnEscape:false,
                modal:true,
                buttons:{
                    "Salir":function() {
                        $(this).dialog("close");
                    }
                }
            });
            //carga para modificar el directrorio
            $(".directorio").live("click",function(){
                var directorio = $(this).text().split("-");
                
                var nombre = directorio[1];
                var descripcion = directorio[2];
                
                $("#txtnombredirectoriobsucar").val(nombre);
                $("#txtnombredirectorioEdit").val(nombre);
                $("#txtdescripciondirectorioEdit").val(descripcion);
                $("#id_directorio").val(directorio[0]);
            });
            $("#btnActualizarDirectorio").click(function() {
                $.ajax({
                    type:"POST",
                    data:{
                        nombre_editar:$("#txtnombredirectorioEdit").val()
                        ,descripcion_editar:$("#txtdescripciondirectorioEdit").val()
                        ,id_empresa:<?=$_SESSION['id']?>
                        ,id_directorio:$("#id_directorio").val()
                    },
                    url:"../../bl/DirectorioCliente_BL.php?parameter=actualizarDirectorio",
                    success:function() {
                        $("#succcesseditdirectorio").fadeIn("slow", function() {
                            $("#succcesseditdirectorio").fadeOut(4000); 
                            $("#txtnombredirectorioEdit").val("");
                            $("#txtdescripciondirectorioEdit").val("");
                            $("#txtnombredirectoriobsucar").val("");
                            $("#tbl_datosEditarDirectorio").css("display","none");
                        });
                    },
                    error:function() {
                        
                    }
                });
            });
            /******
             * USUARIOS PARA APROBACION
             */
            //filtrar los usuarios
            $("#btnSeleccionUsuarios").click(function() {
                $("#divSeleccionUsuarios").dialog("open");
            });
            $("#divSeleccionUsuarios").dialog({
                 autoOpen:false,
                 heigh:500,
                 width:350,
                 resizable:false,
                 closeOnEscape:false,
                 modal:true,
                 buttons:{
                     "Salir":function() {
                         $(this).dialog("close");
                     }
                 }
            });
            
            $("#listausuarios").live("click",function() {
                $.ajax({
                    data:{id:$(this).val()},
                    dataType:"json",
                    url:"../../includes/query_repository/getAllUsuarios.php",
                    success:function(data) {
                        resultados(data);
                    }
                });
            });
            function resultados(data) {
                $.each(data,function(index, value) {
                    $("#tbllista_usuarios tbody").append(
                    '<tr id="tbl_listausuariosgrid">'+
                    '<td>'+data[index].nombre+"</td>"+
                    '<input type="hidden" name="usuario" value="'+data[index].id+'" />'+
                    '<td><a href="#" id="del-usuario" class="button delete">Eliminar</a></td>'
                    )
                });
            }
            $("#del-usuario").live("click",function(e) {
                alert($(this).parent().parent().html());
            })
            
            /*****
             * OBRAS
             */
            //CREAR OBRA(PROYECTO) MINIMO
            $("#btnCrearObra").click(function() {
                if ($("#txtObraCodificacion").val() === "" || $("#txtObraNombre").val() === "") {
                    alert("Ambbos campos son requeridos");
                } else {
                    $.ajax({
                        type:"POST",
                        data:{
                            obracodificacion:$("#txtObraCodificacion").val()
                            ,obranombre:$("#txtObraNombre").val()
                            ,id_empresa:<?=$_SESSION['id']?>
                        },
                        url:"../../bl/obraClienteAdministrador.php?parameter=crearProyectoBasico",
                        success:function() {
                            $("#divExitoCrearObra").fadeIn("slow", function() {
                                $("#divExitoCrearObra").fadeOut(4000);
                                $("#txtObraCodificacion").val("");
                                $("#txtObraNombre").val("");
                            });
                            
                        }
                    });
                }
            });
            //EDITAR OBRA(PROYECTO) MINIMO
            $("#btnListarObras").click(function() {
                $("#divSeleccionaProyecto").dialog("open");
            });
            $("#divSeleccionaProyecto").dialog({
                autoOpen:false,
                height:350,
                width:450,
                resizable:false,
                closeOnEscape:false,
                modal:true,
                buttons:{
                    "Salir":function() {
                        $(this).dialog("close");
                    }
                }
            });
            //DETECTAR SELECCION DE PROYECTO
            $(".proyecto").live("click",function() {
                var proyecto = $(this).text().split("-");
                $("#txtnombreobraEdit").val(proyecto[2]);
                $("#id_proyecto").val(proyecto[0]);
                $("#txtproyectoeditacodigo").val(proyecto[1]);
                $("#txtproyectoeditanombre").val(proyecto[2]);
            });
            // CLICK EN EL BOTON BUSCAR
            $("#btnBuscarObraEdit").click(function() {
                $("#tbl_Editarproyecto").css("display","block");
            });
            // ACTUALIZAR PROYECTO
            $("#btnUpdateProject").click(function() {
                $.ajax({
                    type:"POST",
                    data:{
                        codigoobra:$("#txtproyectoeditacodigo").val()
                        ,descripcion:$("#txtproyectoeditanombre").val()
                        ,idproyecto:$("#id_proyecto").val()
                    },
                    url:"../../bl/obraClienteAdministrador.php?parameter=editarProyectoBasico",
                    success:function() {
                        $("#successupdateproyecto").fadeIn("slow", function() {
                            $("#successupdateproyecto").fadeOut(4000);
                            $("#txtnombreobraEdit").val("");
                            $("#txtproyectoeditacodigo").val("");
                            $("#txtproyectoeditanombre").val("");
                        });
                    }
                });
            });
        });    
        </script>
        <style>
            #password_change_old, #password_change_new,#password_change_repeat,#password_change_button {display:none;}
        </style>
    </head>
    <body>
        <!-- MODAL SELECCION USUARIOS -->
        <div id="divSeleccionUsuarios" title="Seleccion de usuarios">
            <table id="tbl_seleccionusuarios">
                <thead>
                    <tr>
                        <th>Usuario
                </thead>
                <tbody>
                    <tr></tr>
                </tbody>
            </table>    
        </div>
        
        <!-- MODAL DIRECTORIOS -->
        <div id="divSeleccionaDirectorio" title="Seleccione el directorio"></div> 
        
        <!-- MODAL PROYECTOS -->
        <div id="divSeleccionaProyecto" title="Seleccione el proyecto"></div>
        
       <!-- MODALES -->
       <div id="listaUsuarios" title="Usuarios para aprobaciones">
           <table>
               <thead>
                   <tr class="ui-widget-header">
                       <th>Nombre
                       <th>Usuario    
                   </tr>
               </thead>
           </table>
       </div>
       
       <div id="tabs">
           <ul>
                <li><a href="#tabs-1">EMPRESA</a></li>
                <li><a href="#tabs-2">DIRECTORIOS</a></li>
                <li><a href="#tabs-3">PROYECTOS</a></li>
                <li><a href="#tabs-4">USUARIOS</a></li>
                <li><a href="#tabs-5">APROBACION</a></li>
            </ul>
           <div id="tabs-1">
               <div id="empresa">
                    <ul>
                        <li><a href="#tabs-empresa-1">Personalizar</a></li>
                        <li><a href="#tabs-empresa-2">Editar</a></li>
                    </ul>

                    <div id="tabs-empresa-1">
                        <form method="POST" action="index.php" enctype="multipart/form-data">
                            <table>
                                    <?php
                                    if (isset($_SESSION['logo'])) {
                                        echo '<tr><td><label>Logo actual de su empresa.</label>';
                                        echo "<tr><td><img src='../../img/cliente/".$_SESSION['logo']."' width='80px' height='74px' alt='logo'/>";
                                    }    
                                    else {
                                        echo 'Esta empresa aun no tiene logo';
                                    ?>
                                    <tr><td><label>Empresa:</label><td><?= strtoupper(@$_SESSION['usr'])?>
                                    <tr><td><input type="hidden" name="MAX_FILE_SIZE" value="100000" />      
                                    <tr><td><label>Seleccionar logo:</label><td><input name="archivo" type="file" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                                    <tr><td><td><input type="submit" value="Subir logo" id="btnSubirLogo" />
                                            <input type="hidden" name="action" value="upload" />
                                            <?php
                                            if(@$_POST["action"] == "upload") {
                                                $nombre_archivo = $_FILES['archivo']['name'];
                                                $tipo_archivo = $_FILES['archivo']['type'];
                                                $tamano_archivo = $_FILES['archivo']['size'];
                                                $safe_filename = preg_replace( 
                                                    array("/\s+/", "/[^-\.\w]+/"), 
                                                    array("_", ""), 
                                                    trim(rand(0, 500).$_FILES['archivo']['name'])); 

                                                

                                                if ($nombre_archivo != "" && (strpos($tipo_archivo, "png")) && ($tamano_archivo <= 1048576)) {
                                                    $destino = "../../img/cliente/".$safe_filename;
                                                    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $destino)) {
                                                        echo '<p>El logo se ha subido correctamente: </p>'.$safe_filename;
                                                        //VERFICAR SI EXISTE PREVIAMENTE UN LOGO, SI EXISTE EL LOGO REEMPLAZARLO
                                                        
                                                        
                                                    } else {
                                                        echo 'Houdson, tenemos problemas.';
                                                    }
                                                } else {
                                                    echo '<p>El tipo de archivo debe ser png y el tamano menor a 1 MB.</p>';
                                                    echo 'Usted ha intetado subir un archivo de tipo:'.$tipo_archivo.". Con un peso de: ".$tamano_archivo;
                                                }
                                            }
                                    }        
                                            ?>
                            </table>
                            
                         </form>
                    </div>
                    <div id="tabs-empresa-2">
                        <form method="POST" action="index.php" enctype="multipart/form-data">
                            <table>
                                
                                <tr><td><label>Seleccionar logo</label><td><input type="file" name="newlogo" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                                
                                <tr><td><input type="submit" value="Subir logo" />
                                        <input type="hidden" name="action_edit" value="upload_editlogo" />
                                        <?php
                                        
                                        if (@$_POST['action_edit'] == "upload_editlogo") {
                                            echo 'Quieren subir algo....'.$_FILES['newlogo']['name'];
                                            
                                            $nombre_archivo = $_FILES['newlogo']['name'];
                                            $tipo_archivo = $_FILES['newlogo']['type'];
                                            $tamano_archivo = $_FILES['newlogo']['size'];
                                            $safe_filename = preg_replace( 
                                                array("/\s+/", "/[^-\.\w]+/"), 
                                                array("_", ""), 
                                                trim(rand(0, 500).$_FILES['newlogo']['name'])); 

                                            if ($nombre_archivo != "" && (strpos($tipo_archivo, "png")) && ($tamano_archivo <= 1048576)) {
                                                $destino = "../../img/cliente/".$safe_filename;
                                                if (move_uploaded_file($_FILES['newlogo']['tmp_name'], $destino)) {
                                                    //unlink("../../img/cliente/".$_SESSION['logo'].".png");
                                                    echo '<p>El logo se ha subido correctamente: </p>'.$safe_filename;
                                                    //VERFICAR SI EXISTE PREVIAMENTE UN LOGO, SI EXISTE EL LOGO REEMPLAZARLO
                                                    require_once '../../dl/Conexion.php';
                                                    
                                                    try {
                                                        $conexion = new Conexion();
                                                        $cn = $conexion->conectar();
                                                        
                                                        if(!$cn)
                                                            throw new Exception("No se pude conectar: ".  mysql_error());
                                                    
                                                        $sql = "UPDATE tb_empresa SET logo = '".$safe_filename."' WHERE id = ".$_SESSION['id'];
                                                        $row = mysql_fetch_assoc(mysql_query("SELECT id,nombre,logo FROM tb_empresa WHERE id=".$_SESSION['id']));
                                                        $_SESSION['logo'] = $row['logo'];
                                                        
                                                        $rs = mysql_query($sql,$cn);
                                                        if(!$rs)
                                                            throw new Exception("No se pude consultar".  mysql_error());
                                                    } catch(Exception $ex) {
                                                        echo 'Error: '.$ex->getMessage();
                                                    }

                                                } else {
                                                    echo 'Houdson, tenemos problemas.';
                                                }
                                            } else {
                                                echo '<p>El tipo de archivo debe ser png y el tamano menor a 1 MB.</p>';
                                                echo 'Usted ha intetado subir un archivo de tipo:'.$tipo_archivo.". Con un peso de: ".$tamano_archivo;
                                            }
                                        }
                                        ?>
                                <tr><td><label>¿Desea cambiar el password?</label><input type="radio" name="changepassword" value="no" checked>NO<input type="radio" name="changepassword" value="si">SI
                                <tr id="password_change_old"><td><label>Ingrese su password actual:</label></td><td><input type="password" name="txtoldpassword" id="txtoldpassword"/><td><div id="oldpasswrong" style="display: none">No es correcto</div>
                                <tr id="password_change_new"><td><label>Ingrese su password nuevo:</label></td><td><input type="password" name="txtnewpassword" id="txtnewpassword" /></td></tr>
                                <tr id="password_change_repeat"><td><label>Repita su password nuevo:</label></td><td><input type="password" name="txtrepassword" id="txtrepassword"/></td></tr>
                                <tr id="password_change_button"><td><td><input type="button" value="Actualizar password" id="btnActualizapass"/>
                            </table>
                        </form>
                    </div>
               </div>    
           </div>
           <div id="tabs-2">
               <div id="directorios">
                   <ul>
                        <li><a href="#directorio_crear-1">Crear</a></li>
                        <li><a href="#directorio_editar-2">Editar</a></li>
                   </ul>
               
                    <div id="directorio_crear-1">
                        <table>
                            <tr><td><label>Nombre:</label><td><input type="text" name="txtnombredirectorio" id="txtnombredirectorio" />
                            <tr><td><label>Descripci&oacute;n:</label><td><input type="text" name="txtdescripciondirectorio" id="txtdescripciondirectorio" />
                            <tr><td><td><input type="button" value="Crear" id="btnCrearDirectorio" class="ui-button ui-widget ui-state-default ui-corner-all"/>        
                        </table>
                    </div>
                    <div id="directorio_editar-2">
                        <table>
                            <tr><td><label>Nombre:</label><td><input type="text" name="txtnombredirectoriobsucar" id="txtnombredirectoriobsucar" READONLY/><td><input type="button" value="Seleccionar directorio" id="btnBuscarDirectorio" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                            <tr><td><input type="button" value="Buscar" id="btnEncuentraDirectorio" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                                    <table id="tbl_datosEditarDirectorio" style="display: none">
                                        <tr><td><label>Nombre:</label><td><input type="text" name="txtnombredirectorioEdit" id="txtnombredirectorioEdit" />
                                        <tr><td><label>Descripci&oacute;n:</label><td><input type="text" name="txtdescripciondirectorioEdit" id="txtdescripciondirectorioEdit" />
                                                <input type="hidden" id="id_directorio" />
                                        <tr><td><td><input type="button" id="btnActualizarDirectorio" value="Actualizar" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                                                <div id="succcesseditdirectorio" style="display: none">El directorio se ha actualizado correctamente</div>
                                                <div id="erroreditdirectorio" style="display: none">No se ha podido actualizar el registro.</div>
                                    </table>    
                        </table>
                    </div>
               </div>    
           </div>
           <div id="tabs-3">
               <div id="obras">
                   <ul>
                        <li><a href="#obra_crear-1">Crear</a></li>
                        <li><a href="#obra_editar-2">Editar</a></li>
                   </ul>
               
                    <div id="obra_crear-1">
                        <table>
                           <tr><td><label>Codificaci&oacute;n:</label><td><input type="text" id="txtObraCodificacion" />
                           <tr><td><label>Nombre:</label><td><input type="text" id="txtObraNombre" />
                           <tr><td><td><input type="button" value="Crear" id="btnCrearObra" class="ui-button ui-widget ui-state-default ui-corner-all"/>        
                                   <div id="divExitoCrearObra" style="display: none">El proyecto se ha creado correctamente.</div>
                        </table>
                    </div>
                    <div id="obra_editar-2">
                        <table>
                            <tr><td><label>Nombre</label><td><input type="text" id="txtnombreobraEdit" READONLY /><td><input type="button" id="btnListarObras" value="Seleccione proyecto" class="ui-button ui-widget ui-state-default ui-corner-all" />
                            <tr><td><input type="button" value="Buscar" id="btnBuscarObraEdit" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                                    <table id="tbl_Editarproyecto" style="display: none">
                                        <tr><td><label>Codificaci&oacute;n:</label><td><input type="text" name="txtproyectoeditacodigo" id="txtproyectoeditacodigo" />
                                        <tr><td><label>Nombre:</label><td><input type="text" name="txtproyectoeditanombre" id="txtproyectoeditanombre" />
                                                <input type="hidden" id="id_proyecto" />
                                        <tr><td><td><input type="button" value="Actualizar proyecto" id="btnUpdateProject" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                                                <div id="successupdateproyecto" style="display: none">El proyecto se ha actualizado correctamente.</div>
                                    </table>    
                        </table>
                    </div>
               </div>
           </div>
           <div id="tabs-4">
               <div id="usuarios">
                   <ul>
                        <li><a href="#usuarios_crear-1">Crear</a></li>
                        <li><a href="#usuarios_editar-2">Editar</a></li>
                   </ul>
               
                    <div id="usuarios_crear-1">
                        <table>
                            <tr><td><label>Nombres:</label><td><input type="text" id="txtnombreusuario" /><td><input type="button" value="..." />
                            <tr><td><label>Apellidos:</label><td><input type="text" id="txtapellidosusuario" />        
                            <tr><td><label>Usuario:</label><td><input type="text" id="txtusuario" />        
                            <tr><td><label>Password:</label><td><input type="password" id="txtpassword" READONLY/><td><input type="button" value="Generar" id="btnGeneraPass" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                            <tr><td><td><input type="button" value="Crear" id="btnCrearUsuario" class="ui-button ui-widget ui-state-default ui-corner-all" />        
                        </table>
                    </div>
                    <div id="usuarios_editar-2">
                        <table>
                            <tr><td><label for="nombreusuario">Usuario</label><td><input type="text" id="txtusuario" size="40"/><td><input type="button" id="btnBuscarusuario" value="..." class="ui-button ui-widget ui-state-default ui-corner-all"/>
                            <tr><td><td><input type="button" id="btnFillUsuario" value="Buscar" class="ui-button ui-widget ui-state-default ui-corner-all"/>        
                            <tr><td colspan="3"><hr>        
                            <tr><td>
                                    <table id="tblUserData" style="display: none">
                                        <tr><td><label>Nombre(s)</label><td><input type="text" id="txteditfullname" />
                                        <tr><td><label>Apellidos</label><td><input type="text" id="txteditlastname" />
                                        <tr><td><label>Usuario</label><td><input type="text" id="txteditusername" />
                                        <tr><td><label>Email</label><td><input type="text" id="txteditemail" />        
                                        <tr><td><label>Rol</label><td>
                                                <select>
                                                    <optgroup label="Administrativo">
                                                        <option value="">Administrador Sistema</option>
                                                        <option value="">Gerente</option>
                                                    </optgroup>
                                                    <optgroup label="Licencia">
                                                        <option value="">Full</option>
                                                        <option value="">Acceso Retringido</option>
                                                    </optgroup>
                                                </select>
                                        <tr><td><td><input type="button" id="btnUpdateUserData" value="Actualizar" class="ui-button ui-widget ui-state-default ui-corner-all"/>        
                                    </table>
                        </table>
                    </div>
               </div>    
           </div>
           <div id="tabs-5">
               <div id="usuariosaprobacion">
                   <ul>
                       <li><a href="#usuarioaprobacionasigna-1">Asignar</a></li>
                       <li><a href="#usuarioaprobacionedita-2">Editar</a></li>
                   </ul>
                   <div id="usuarioaprobacionasigna-1">
                       <table>
                           <tr><td><label>Seleccionar usuarios:</label></td><td><input type="button" id="btnSeleccionUsuarios" value="..." class="ui-button ui-widget ui-state-default ui-corner-all"/></td></tr>
                           <tr><td>
                                   <table class="areaScrollModal" id="tbllista_usuarios">
                                       <thead>
                                           <tr class="ui-widget-header">
                                               <th>Usuario</th>
                                           </tr>
                                       </thead>
                                       <tbody>
                                           <tr></tr>
                                       </tbody>
                                   </table>
                       </table>
                   </div>
                   <div id="usuarioaprobacionedita-2">
                       <table>  
                       </table>
                   </div>
               </div>
           </div>    
       </div>
    </body>
</html>