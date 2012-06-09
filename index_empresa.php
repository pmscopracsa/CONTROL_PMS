<!DOCTYPE HTML>
<html>
	<head>
            <title>CONTROL PMS | Panel &raquo; Ingresar</title>
            <link rel="stylesheet" href="css/blueprint/screen.css" type="text/css" media="screen, projection" />
            <link rel="stylesheet" href="css/blueprint/print.css" type="text/css" media="print" />
            <link rel="stylesheet" href="css/login1.css" type="text/css" media="screen" />
            <!--[if IE]><link rel="stylesheet" href="blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->
			<script src="js/jquery-1.3.1.min.js" type="text/javascript" charset="utf-8">	
			</script>
			<script>
			
			</script>
	</head>
	<body>
            <div id="demo-top-bar">
                <div id="demo-bar-inside">
                    <div class="span-24 prepend-1 last">
                        <br />
                        
                    </div>
                    <div class="clear"></div>
                    <div style="text-align: center">
                        <h1>CONTROL PMS</h1>
                    </div>
                    <div class="clear"></div>
                     <?php
                            if($_GET["errorusuario"] == "si") {
                        ?>
                        <div class="error">
                            Datos incorrectos
                        </div>
                        <?php
                            } else {
                        ?>
                    
                        <?php
                            }
                        ?>
                </div>
            </div>
            <div>
                <div class="form-box">
                    <form id="login-form" method="POST" action="capaDatos/control.php">
                        <fieldset>
                            
                                <label>Usuario</label>
                                <input autofocus="autofocus" type="text" id="login" name="txtlogin">
                                <div class="clear"></div>
                            
                            
                                <label>Contrase&ntilde;a</label>
                                <input type="password"  id="password" name="txtpass"/>
                                <div class="clear"></div>
                            
                                <div class="clear"></div>
                                
                                <br />
                                    <input class="button" type="submit" tabindex="100" value="INGRESAR &raquo;"/>
                        </fieldset>
                    </form>
                </div>  
            </div>
	</body>
</html>