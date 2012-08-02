<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>PMS CONTROL</title>
        <script type="text/javascript" src="../js/jquery1.4.2.js.js"></script>
        <script>
        $(document).ready(function() {          
        <?php
        switch ($_REQUEST['ctx']) {
            case "recover":
            ?>
       $("#recuperarPassword").css("display","block");             
                <?php    
                break;
            default:
                break;
        }
        ?>
        });          
        </script>    
    </head>
    <body>
        <!-- login normal -->
        <div id="logIn">
            
        </div>
        <!-- ayuda por demanda -->
        <div id="recuperarPassword" style="display: none">
            <h2>Identifica tu cuenta</h2>
            <hr />
            <p><b>Usuario del sistema <a href="#" title="Puedes usar: Tu nombre de usuario del sistema.">(?)</a></b></p><br />
            <input type="text" id="txtusuariosistema" size="45" placeholder="Usuario de PMS Control" />
        </div>
    </body>
</html>
