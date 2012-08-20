<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>¡&Aacute;rea de usuarios registrados!</title>
    <link rel="stylesheet" type="text/css" href="index.css" media="screen" />
    <script type="text/javascript" src="../js/jquery1.4.2.js.js"></script>
    <script>
$(document).ready(function()
{
    $("#idtxtusuaorio").focus();
	$("#login_usuario").submit(function()
	{
		//remove all the class add the messagebox classes and start fading
		$("#msgbox").removeClass().addClass('messagebox').text('Validando....').fadeIn(1000);
		//check the username exists or not from ajax
		$.post("../security/sec_user.php",{ user_name:$('#idtxtusuaorio').val(),password:$('#idtxtpassword').val()} ,function(data)
                {
		  if(data=='administrador' || data=='usuario') //if correct login detail
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Accediendo.....').addClass('messageboxok').fadeTo(900,1,
              function()
			  { 
                              if (data == 'administrador') {
                                  document.location='administrador/index.php';//missing file
                              }
                              else if (data == 'usuario') { // ANTES DE MOSTRAR LA PANTALLA DE CONFIGURACION VALIDAMOS SI YA EXISTE DATOS EN EL CAMBIO DEL DIA
                                  $.ajax({
                                      type:"GET",
                                      url:"../bl/ConfiguracionGeneral/configuracionGeneral.php?parametro=existecambio",
                                      data:{id_empresa:<?=$_SESSION['id']?>},
                                      success:function(res) {
                                          if (res == "already") {
                                              window.location.href = '../modulos/selecciondirectorio/selecciondirectorioalready.php?dev='+Math.floor(Math.random()*11);
                                          }
                                          else if (res == "notyet") {
                                              window.location.href = '../modulos/selecciondirectorio/selecciondirectorio.php?dev='+Math.floor(Math.random()*11);       
                                          }
                                      }
                                  });
                              }
                              else if (data == 'pasivo' ) {
                                  document.location = 'visor/visor.php';//missing file
                              }
			  });
			  
			});
		  }
		  else 
		  {
		  	$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Inicio de sesion inválido...').addClass('messageboxerror').fadeTo(900,1,function() {
                            $("#idtxtusuaorio").val("");
                            $("#idtxtpassword").val("");
                            $("#idtxtusuaorio").focus();
                          });
			});		
                  }
				
        });
 		return false; //not to post the  form physically
	});
	//now call the ajax also focus move from 
	$("#password").blur(function()
	{
		$("#login_usuario").trigger('submit');
	});
});
    </script>
<style>
    #buttondiv {
        margin-top: 10px;
    }
    .messageboxok{
        position:absolute;
        width:auto;
        margin-left:30px;
        border:1px solid #349534;
        background:#C9FFCA;
        padding:3px;
        font-weight:bold;
        color:#008000;
    }
    .messageboxerror{
        position:absolute;
        width:auto;
        margin-left:30px;
        border:1px solid #CC0000;
        background:#F7CBCA;
        padding:3px;
        font-weight:bold;
        color:#CC0000;
    }
</style>
</head>

<body>

<div id="main">
  <div class="container">
    <h1>¡Solamente usuarios registrados!</h1>
    <h2>Para mayor seguridad se le est&aacute; haciendo seguimiento de su n&uacute;mero IP</h2>
    </div>
    
    <div class="container">
    
    <?php
	if($_SESSION['id']) {
            echo '<h1>¡Bienvenido a CONTROL PMS de '.  strtoupper($_SESSION['usr']).'!</h1>';
        ?>
        <div class="left">
            <form class="clearfix" action="" method="post" id="login_usuario">
                <table>
                    <tr>
                        <td><label class="grey" for="username" >Usuario:</label></td>
                        <td><input class="field" type="text" name="txtusuario" id="idtxtusuaorio" value="" size="23" /></td>
                    </tr>
                    <tr>
                        <td><label class="grey" for="password" >Contrase&ntilde;a:</label></td>
                        <td><input class="field" type="password" name="txtpassword" id="idtxtpassword" size="23" /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="checkbox" checked="checked"/>Recordarme</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><label><a href="../ayuda/identificarseusuario.php">¿Olvidaste tu contrase&ntilde;a?</a></label></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Iniciar sesion" style="margin-left: -10px; height: 23px" /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div id="buttondiv">
                            <span id="msgbox"style="display: none"></span>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <?php
        }
	else echo '<h1>Por favor, <a href="../index.php">inicie sesion</a> y vuelva luego</h1>';
    ?>
    </div>
  <div class="container tutorial-info">
      <a href="administrador/index.php">ADMINISTRADOR</a> | <a href="visor/visor.php">VISOR</a> |<a href="../index.php">Inicio</a></div>
</div>
</body>
</html>