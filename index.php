<?php
define('INCLUDE_CHECK',true);

require 'index_box/connect.php';
require 'index_box/functions.php';
// Those two files can be included only if INCLUDE_CHECK is defined

session_name('tzLogin');
// Starting the session

session_set_cookie_params(2*7*24*60*60);
// Making the cookie live for 2 weeks

session_start();

if($_SESSION['id'] && !isset($_COOKIE['tzRemember']) && !$_SESSION['rememberMe'])
{
	// If you are logged in, but you don't have the tzRemember cookie (browser restart)
	// and you have not checked the rememberMe checkbox:

	$_SESSION = array();
	session_destroy();
}


if(isset($_GET['logoff']))
{
	$_SESSION = array();
	session_destroy();
	
	header("Location: index.php");
	exit;
}

if($_POST['submit']=='Login')
{
	// Checking whether the Login form has been submitted
	
	$err = array();
	// Will hold our errors
	
	
	if(!$_POST['username'] || !$_POST['password'])
		$err[] = '¡Ambos campos son obligatorios!';
	
	if(!count($err))
	{
		$_POST['username'] = mysql_real_escape_string($_POST['username']);
		$_POST['password'] = mysql_real_escape_string($_POST['password']);
		$_POST['rememberMe'] = (int)$_POST['rememberMe'];
		
		// Escaping all input data
                $nombre_usuario = $_POST['username'];
                $password = $_POST['password'];
		//$row = mysql_fetch_assoc(mysql_query("SELECT id,usr FROM tb_empresa WHERE usr='{$_POST['username']}' AND pass='".md5($_POST['password'])."'"));
                $row = mysql_fetch_assoc(mysql_query("SELECT id,nombre,logo FROM tb_empresa WHERE nombre='$nombre_usuario' AND password='$password'"));

		if($row['nombre'])
		{
			// If everything is OK login
			
			$_SESSION['usr']=$row['nombre'];
			$_SESSION['id'] = $row['id'];
			$_SESSION['rememberMe'] = $_POST['rememberMe'];
                        $_SESSION['logo'] = $row['logo'];
			
			// Store some data in the session
			setcookie('tzRemember',$_POST['rememberMe']);
		}
		else $err[]='¡Nombre de empresa o contraseña incorrecto!';
	}
	
	if($err)
	$_SESSION['msg']['login-err'] = implode('<br />',$err);
	// Save the error messages in the session

	header("Location: index.php");
	exit;
}
else if($_POST['submit']=='Register')
{
   
	// If the Register form has been submitted
	
	$err = array();
        
        $destinatario = "miguel.alc@gmail.com";
        $asunto = "Deseo probar el sistema Control PMS";
        $cuerpo = "------------------------------------";
        
	
	if(strlen($_POST['username']) < 5 || strlen($_POST['username'])>32)
	{
		$err[]='Su nombre debe tener al menos 5 caracteres';
	}
	
	if(preg_match('/[^a-z0-9\-\_\.]+/i',$_POST['username']))
	{
		$err[]='Su nombre tiene caracteres no válidos!';
	}
	
	if(!checkEmail($_POST['email']))
	{
		$err[]='Su correo no es valido';
	}
	
	if(!count($err))
	{
            
            send_mail($_POST['email'],$destinatario,$asunto,$cuerpo);
	}

	if(count($err))
	{
		$_SESSION['msg']['reg-err'] = implode('<br />',$err);
	}	
	
	header("Location: index.php");
	exit;
}

$script = '';

if($_SESSION['msg'])
{
	// The script below shows the sliding panel on page load
	
	$script = '
	<script type="text/javascript">
	
		$(function(){
		
			$("div#panel").show();
			$("#toggle a").toggle();
		});
	
	</script>';	
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CONTROL PMS</title>
    
    <link rel="stylesheet" type="text/css" href="index_box/index.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="index_box/login_panel/css/slide.css" media="screen" />
    
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    
    <!-- PNG FIX for IE6 -->
    <!-- http://24ways.org/2007/supersleight-transparent-png-in-ie6 -->
    <!--[if lte IE 6]>
        <script type="text/javascript" src="login_panel/js/pngfix/supersleight-min.js"></script>
    <![endif]-->
    
    <script src="index_box/login_panel/js/slide.js" type="text/javascript"></script>
    
    <?php echo $script; ?>
</head>
    <script>
    function newPopup(url) {
        popupWindow = window.open(
        url,'popupWindow','height=700,width=800,left=50,top=20,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=yes'
        )
    }   
        
    </script>    
<body>


<!-- Panel -->
<div id="toppanel">
	<div id="panel">
		<div class="content clearfix">
			<div class="left">
				<h1>CONTROL PMS</h1>
                                <h2>La soluci&oacute;n a sus proyectos</h2>		
				<p class="grey">Control PMS Project Management Software, nace a partir de la necesidad de concentrar la información y
                                    compartirla a través de un Servidor con todo el personal de una empresa.
                                    <a href="Javascript:newPopup('info.html');">(Seguir leyendo)</a></p>
				
			</div>
            
            
                    <?php	
                    if(!$_SESSION['id']):

                    ?>
			<div class="left">
				<!-- Login Form -->
				<form class="clearfix" action="" method="post">
                                    <h1>Inicio de sesi&oacute;n</h1>

                    <?php
						
						if($_SESSION['msg']['login-err'])
						{
							echo '<div class="err">'.$_SESSION['msg']['login-err'].'</div>';
							unset($_SESSION['msg']['login-err']);
						}
					?>
					
					<label class="grey" for="username">Empresa:</label>
					<input class="field" type="text" name="username" id="username" value="" size="23" />
                                        <label class="grey" for="password">Contrasen&ntilde;a:</label>
					<input class="field" type="password" name="password" id="password" size="23" />
                                        <label><input name="rememberMe" id="rememberMe" type="checkbox" checked="checked" value="1" /> &nbsp;Recordarme</label>
        			<div class="clear"></div>
					<input type="submit" name="submit" value="Login" class="bt_login" />
				</form>
			</div>
			<div class="left right">			
				<!-- Register Form -->
				<form action="" method="post">
                                    <h1>¿A&uacute;n no ha probado CONTROL PMS?</h1>		
                                    <h3>Br&iacute;ndenos los siguientes datos por favor:</h3>
                    
                    <?php
						
						if($_SESSION['msg']['reg-err'])
						{
							echo '<div class="err">'.$_SESSION['msg']['reg-err'].'</div>';
							unset($_SESSION['msg']['reg-err']);
						}
						
						if($_SESSION['msg']['reg-success'])
						{
							echo '<div class="success">'.$_SESSION['msg']['reg-success'].'</div>';
							unset($_SESSION['msg']['reg-success']);
						}
					?>
                    		
					<label class="grey" for="username">Nombre de contacto:</label>
					<input class="field" type="text" name="username" id="username" value="" size="23" />
                                        <label class="grey" for="email">Correo electr&oacute;nico:</label>
					<input class="field" type="text" name="email" id="email" size="23" />
                                        <label>Un representante se pondr&aacute; en contacto con usted.</label>
					<input type="submit" name="submit" value="Enviar" class="bt_register" />
				</form>
			</div>
            
            <?php
			
			else:
			
			?>
            
            <div class="left">
            
                <h1>Panel de <?=$_SESSION['usr']?></h1>
                <img src="<?='img/cliente/'.$_SESSION['logo'].'.png'; ?>" alt="logo_empresa" height="85" width="185"/>
            
            <p>TODO: Informaci&oacute;n relevenante para la empresa</p>
            <a href="index_box/registered.php">PANEL DE ADMINISTRACION</a>
            <p>- o -</p>
            <a href="?logoff">Cerrar sesi&oacute;n</a>
            
            </div>
            
            <div class="left right">
            </div>
            
            <?php
			endif;
			?>
		</div>
	</div> <!-- /login -->	

    <!-- The tab on top -->	
	<div class="tab">
		<ul class="login">
	    	<li class="left">&nbsp;</li>
	        <li>¡Bienvenido <?php echo $_SESSION['usr'] ? $_SESSION['usr'] : 'Invitado';?>!</li>
			<li class="sep">|</li>
			<li id="toggle">
				<a id="open" class="open" href="#"><?php echo $_SESSION['id']?'Abrir Panel':'Log In';?></a>
				<a id="close" style="display: none;" class="close" href="#">Cerrar</a>			
			</li>
	    	<li class="right">&nbsp;</li>
		</ul> 
	</div> <!-- / top -->
	
</div> <!--panel -->

<div class="pageContent">
    <div id="main">
      <div class="container">
        <h1>Control PMS</h1>
        <h2>Sistema de Gesti&oacute;n de Proyectos</h2>
        </div>
        
        <div class="container">
        
          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
              Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
          <div class="clear"></div>
        </div>
        
      <div class="container tutorial-info">
      Lorem Ipsum is simply dummy text of the printing and typesetting industry. </div>
    </div>
</div>
</body>
</html>
