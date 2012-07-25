<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>¡&Aacute;rea de usuarios registrados!</title>
    <link rel="stylesheet" type="text/css" href="index.css" media="screen" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <script>
$(document).ready(function()
{
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
			  $(this).html('Logging in.....').addClass('messageboxok').fadeTo(900,1,
              function()
			  { 
                              if (data == 'administrador')
                                  document.location='secure.php';
                              else if (data == 'usuario')
                                  document.location = '../modulos/selecciondirectorio/selecciondirectorio.php';
                                  //document.location = '../index.php';
			  });
			  
			});
		  }
		  else 
		  {
		  	$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Inicio de sesion inválido...').addClass('messageboxerror').fadeTo(900,1);
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
        color:#008000;session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
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
                <label class="grey" for="username">Usuario:</label>
                <input class="field" type="text" name="txtusuario" id="idtxtusuaorio" value="" size="23" />
                <div style="margin-top: 5px">
                    <label class="grey" for="password">Contrase&ntilde;a:</label> 
                    <input class="field" type="password" name="txtpassword" id="idtxtpassword" size="23" />
                </div>
                <div id="buttondiv">
                    <input type="submit" value="Iniciar sesion" style="margin-left: -10px; height: 23px" /> 
                    <span id="msgbox"style="display: none"></span>
                </div>    
            </form>
        </div>
        <?php
        }
	else echo '<h1>Por favor, <a href="../index.php">inicie sesion</a> y vuelva luego</h1>';
    ?>
    </div>
    
  <div class="container tutorial-info">
      Lorem Ipsum is simply dummy text of the printing and typesetting industry. <a href="../index.php">Inicio</a></div>
</div>


</body>
</html>