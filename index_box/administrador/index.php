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
        
        <link rel="stylesheet" href="../../css/tabs.css">
        <link rel="stylesheet" href="../../css/jquery-ui-1.8.18.custom.css">
        <script>
        $(document).ready(function() {
            
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
            }
        });    
        </script>
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
                   <li><a href="#tabs-empresa_personalizar">Personalizar</a></li>
                   <li><a href="#tabs-empresa_editar">Editar</a></li>
               </div>
               <div id="tabs-empresa_personalizar">
                   
               </div>
               <div id="tabs-empresa_editar">
                   
               </div>
           </div>
           <div id="tabs-2">
               <div id="directorios">
                   <li><a href="#directorio_crear">Crear</a></li>
                   <li><a href="#directorio_editar">Editar</a></li>
               </div>
               <div id="directorio_crear">
                   
               </div>
               <div id="directorio_editar">
                   
               </div>
           </div>
           <div id="tabs-3">
               <div id="obras">
                   <li><a href="#obra_crear">Crear</a></li>
                   <li><a href="#obra_editar">Editar</a></li>
               </div>
               <div id="obra_crear">
                   
               </div>
               <div id="obra_editar">
                   
               </div>
           </div>
           <div id="tabs-4">
               <div id="usuarios">
                   <li><a href="#usuarios_crear">Crear</a></li>
                   <li><a href="#usuarios_editar">Editar</a></li>
               </div>
               <div id="usuarios_crear">
                   
               </div>
               <div id="usuarios_editar">
                   
               </div>
           </div>
       </div>
       
<!--       <div id="tabs">
            <ul>
                <li><a href="#tabs-1">EMPRESA</a></li>
                <li><a href="#tabs-2">DIRECTORIOS</a></li>
                <li><a href="#tabs-3">PROYECTOS</a></li>
                <li><a href="#tabs-4">USUARIOS</a></li>
            </ul>
           <div id="tabs-1">
               <div id="tabs_tablero_control">
                   <ul>
                       <li><a href="#tabs_tc_1">Crear nueva obra</a></li>
                       <li><a href="#tabs_tc_2">Asignar opciones a usuarios</a></li>
                       <li><a href="#tabs_tc_3">C</a></li>
                   </ul>
                   <div id="tabs_tc_1">
                       <table>
                           <tr><td><label>Codificaci&oacute;n:</label><td><input type="text" id="txtObraCodificacion" />
                           <tr><td><label>Nombre:</label><td><input type="text" id="txt" />
                           <tr><td><td><input type="button" value="Crear" id="btnCrearObra" class="ui-button ui-widget ui-state-default ui-corner-all"/>        
                       </table>
                   </div>
                   <div id="tabs_tc_2">
                       <table>
                           <tr><td><label>Usuarios para aprobaci&oacute;n:</label><td><input type="button" value="Seleccionar usuarios" id="btnSelUsuarios" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                       </table>
                   </div>
                   <div id="tabs_tc_3">
                       <table>
                           <tr><td><label>UQ</label>
                       </table>
                   </div>
               </div>
           </div>
            <div id="tabs-2">
                <table>
                    <tr><td><label>Empresa:</label><td><?= strtoupper($_SESSION['usr'])?>
                    <tr><td><label>Subir logo:</label><td><input type="file" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                </table>
            </div>
           <div id="tabs-3">
               <table>
                   <tr><td><label>Nombres:</label><td><input type="text" id="txtnombreusuario" />
                   <tr><td><label>Apellidos:</label><td><input type="text" id="txtapellidosusuario" />        
                   <tr><td><label>Usuario:</label><td><input type="text" id="txtusuario" />        
                   <tr><td><label>Password:</label><td><input type="password" id="txtpassword" READONLY/><td><input type="button" value="Generar" id="btnGeneraPass" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                   <tr><td><td><input type="button" value="Crear" id="btnCrearUsuario" class="ui-button ui-widget ui-state-default ui-corner-all" />        
               </table>
           </div>
           <div id="tabs-4">
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
       </div>-->
    </body>
</html>
