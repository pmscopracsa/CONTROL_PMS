<?php
session_start(); 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>REGISTRO LISTA DE DISTRIBUCION</title>
        <!-- zona css -->

        <link href="../../css/tabs.css" rel="stylesheet" type="text/css" />
        <link href="../../js/jqueryui_full_1821/css/ui-lightness/jquery-ui-1.8.21.custom.css" rel="stylesheet" type="text/css" />
        
        <!-- ZONA JS -->
        <script src="../../js/tabs/jquery-1.7.2.js" type="text/javascript"></script>
        <script src="../../js/tabs/jquery.ui.core.js" type="text/javascript"></script>
        <script src="../../js/tabs/jquery.ui.widget.js" type="text/javascript"></script>
        <script src="../../js/tabs/jquery.ui.tabs.js" type="text/javascript"></script>
        <script>
	$(function() {
		$( "#tabs" ).tabs({
			ajaxOptions: {
				error: function( xhr, status, index, anchor ) {
					$( anchor.hash ).html(
						"No se ha podido cargar la pagina, intentelo en un momento. ");
				}
			}
		});
	});
	</script>
    </head>
    <body>
        <div class="demo">
            <div id="tabs">
                <ul>
                    <li><a href="registrolistadistribucion.php">Registro</a></li>
                    <li><a href="ajax/content1.html">Edici&oacute;n</a></li>
                </ul>
            </div>
        </div>
    </body>
</html>
