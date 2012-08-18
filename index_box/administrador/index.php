<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();

if(@$_POST["action"] == "upload") {
    move_uploaded_file($filename, $destination);
}
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
        
        <link rel="stylesheet" href="../../css/tabs.css">
        <link rel="stylesheet" href="../../css/jquery-ui-1.8.18.custom.css">
        <script>
        $(document).ready(function() {
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
                }
                    
            });
            /*
             * CARGAR USUARIOS EN TABLA 
             */
            $("#listaUsuarios").load("../../modulos/datosdeobra/modales/usuarios_div.php?filtro=2");
            
            // CREAR LOS TABS
            $("#tabs").tabs();
            $("#tabs_tablero_control").tabs();
            $("#usuarios").tabs();
            $("#obras").tabs();
            $("#directorios").tabs();
            $("#empresa").tabs();
            
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
            
            /***
             * SUBIR LOGO A LA EMPRESA 
             */
            $("#btnSubirLogo").click(function() {
                
            })
        });    
        </script>
        <style>
            #password_change_old, #password_change_new,#password_change_repeat {display:none;}
        </style>
    </head>
    <body>
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
            </ul>
           <div id="tabs-1">
               <div id="empresa">
                    <ul>
                        <li><a href="#tabs-empresa-1">Personalizar</a></li>
                        <li><a href="#tabs-empresa-2">Editar</a></li>
                    </ul>

                    <div id="tabs-empresa-1">
                        <form method="post" action="">
                            <table>
                                    <tr><td><label>Empresa:</label><td><?= strtoupper(@$_SESSION['usr'])?>
                                    <tr><td><label>Seleccionar logo:</label><td><input type="file" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                                    <tr><td><td><input type="button" value="upload" id="btnSubirLogo" />

                            </table>
                         </form>
                    </div>
                    <div id="tabs-empresa-2">
                        <table>
                            <tr><td><label>Cambiar logo</label><td><input type="file" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                            <tr><td><label>¿Desea cambiar el password?</label><input type="radio" name="changepassword" value="no" checked>NO<input type="radio" name="changepassword" value="si">SI
                            <tr id="password_change_old"><td><label>Ingrese su password actual:</label></td><td><input type="text" name="txtoldpassword" /></td></tr>
                            <tr id="password_change_new"><td><label>Ingrese su password nuevo:</label></td><td><input type="text" name="txtnewpassword" /></td></tr>
                            <tr id="password_change_repeat"><td><label>Repita su password nuevo:</label></td><td><input type="text" name="txtrepassword" /></td></tr>
                            <tr><td><input type="button" value="Actualizar" />
                        </table>
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
                            <tr><td><label>Nombre:</label><td><input type="text" name="txtnombredirectorio" />
                            <tr><td><label>Descripci&oacute;n:</label><td><input type="text" name="txtdescripciondirectorio" />
                        </table>
                    </div>
                    <div id="directorio_editar-2">
                        <table>
                            <tr><td><label>Nombre:</label><td><input type="text" name="txtnombredirectoriobsucar" READONLY/><td><input type="button" value="..." id="btnBuscarDirectorio" />
                            <tr><td><input type="button" value="Buscar" id="btnEncuentraDirectorio" />
                                    <table id="tbl_datosEditarDirectorio" style="display: none">
                                        <tr><td><label>Nombre:</label><td><input type="text" name="txtnombredirectorioEdit" />
                                        <tr><td><label>Descripci&oacute;n:</label><td><input type="text" name="txtdescripciondirectorioEdit" />
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
                           <tr><td><label>Nombre:</label><td><input type="text" id="txt" />
                           <tr><td><td><input type="button" value="Crear" id="btnCrearObra" class="ui-button ui-widget ui-state-default ui-corner-all"/>        
                        </table>
                    </div>
                    <div id="obra_editar-2">
                        <table>
                            <tr><td><label>Nombre</label><td><input type="text" id="txtnombreobraEdit" READONLY /><td><input type="button" id="btnListarObras" value="..." />
                            <tr><td><input type="button" value="Buscar" id="btnBuscarObraEdit" />        
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
       </div>
       
<!--       <div id="tabs">

           <div id="tabs-1">
               <div id="tabs_tablero_control">

                   <div id="tabs_tc_2">
                       <table>
                           <tr><td><label>Usuarios para aprobaci&oacute;n:</label><td><input type="button" value="Seleccionar usuarios" id="btnSelUsuarios" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                       </table>
                   </div>
               </div>
           </div>
           <div id="tabs-3">
               
           </div>
           <div id="tabs-4">
               
           </div>
       </div>-->
    </body>
</html>
