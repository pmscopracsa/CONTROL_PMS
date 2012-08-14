<?php
//require_once '../includes/phpmailer/phpmailer.inc.php';
//require_once '../includes/phpmailer/smtp.inc.php';
//$mail = new phpmailer();
//$body = "PRUEBA";
//$mail->IsSMTP();
//$mail->Host = "mail.google.com";
//$mail->SMTPDebug = 2;
//$mail->smtp

?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>PMS CONTROL</title>
        <script type="text/javascript" src="../js/jquery1.4.2.js.js"></script>
        <script>
        $(document).ready(function() {
            $("#btnresetpassword").click(function() {
                if ($("#txtusuariosistema").val() == "") {
                    $("#msgerror").css("display","block");
            } else {
                $("#msgerror").css("display","none");
                
                destino = "http://192.168.1.5/control_pms";
                $("body").fadeOut(5000,redireccionar(destino));
            }
                
            });
            
            function redireccionar(destino) {
                window.location = destino;
            }
        }) ;   
        </script>    
        <style>
        body {
            background-color: #f6f5ef;
        }    
        .recuperarPassword {margin: 3em 14 em; background-color: #FFCC99}
        .recuperarPassword h1 {color: #555; font-size: 24px;font-weight: 700;margin-left: 141px;line-height: 2.1;}
        .recuperarPassword form {font-size: .8em}
        .recuperarPassword p {margin: 10px 0 10px 141px; width: 760px;}
        .recuperarPassword form {margin: 0 0 7em}
        .recuperarPassword label {float:left;margin-left: 20px}
        #msgerror p {color: #EE5757}
        #msgexito p {color: #00BBFF}
        </style>
    </head>
    <body>
        <!-- login normal -->
        <div id="logIn">
            
        </div>
        <!-- ayuda por demanda -->
        <div id="recuperarPassword">
            <h1>Identifica tu cuenta</h1>
            <form action="" method="POSt">
            <p><b>Ingrese su nombre de usuario <a href="#" title="Puedes usar: Tu nombre de usuario del sistema.">(?)</a></b></p><br />
            <input type="text" id="txtusuariosistema" size="45" placeholder="Usuario de PMS Control" />
            <input type="button" id="btnresetpassword" value="Resetar mi contraseña &raquo;" />
            <div id="msgerror" style="display: none">
                <b><p>No ha ingresado ninugn dato.</p></b>
            </div> 
            <div id="msgexito" style="display: none">
                <b><p>Se ha mandado un correo a su cuenta asociada.</p></b>
            </div>   
            </form>
        </div>
    </body>
</html>
