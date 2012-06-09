<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/dojo/1.6/dijit/themes/claro/claro.css">
        <script src="http://ajax.googleapis.com/ajax/libs/dojo/1.7.2/dojo/dojo.js" data-dojo-config="async:true"></script>
<script>
require(["dijit/Tooltip","dojo/parser","dojo/domReady!"],function(Tooltip){
    var tip = new Tooltip({
        label:'<div class="tip1">Proveedores registrados por mi empresa</div>',
        showDelay:250,
        connectId:["mis"]
    });
    var tip2 = new Tooltip({
        label:'<div class="tip2">Proveedores generales</div>',
        showDelay:250,
        connectId:["recomendados"]
    })
})    
</script>
        <style>
        a {
            text-decoration: none;
        }
        </style>
    </head>
    <body class="claro">
        <ul>
            <li><a href="modulos/contacto/reporteporespecialidad.php" target="_blank" id="mis">Mis proveedores</a></li>
            <li><a href="modulos/contacto/reporteporespecialidadComun.php" target="_blank" id="recomendados">Proveedores recomendados</a></li>
        </ul>
    </body>
</html>