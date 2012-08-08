<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<?php
if(@$_POST['submit'] == 'Cargar') {
    if ($_FILES["file"]["error"] > 0) {
        echo "Error";
    } else {
        echo "Subir:".$_FILES["file"]["name"]."<br />";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>PROCURA</title>
        <link rel="stylesheet" type="text/css" href="../../css/left_menu/superfish.css" media="screen">
        <script type="text/javascript" src="../../js/jquery1.4.2.js.js"></script>
        <script type="text/javascript" src="../../js/left_menu/hoverIntent.js"></script>
        <script type="text/javascript" src="../../js/left_menu/superfish.js"></script>
        <script type="text/javascript">

        // initialise plugins
        $(document).ready(function(){
            $('ul.sf-menu').superfish();
            
            //SUBIR PARTIDA EN XLS
            $("#subirpartida").click(function(e) {
                e.preventDefault();
                $("#divSubirPresupuesto").css("display","block");
                
            });
        });

        </script>
        
    </head>
    <body>
        <ul class="sf-menu">
            <li class="current">
                <a href="#a">Partida</a>
                <ul>
                    <li>
                        <a id="subirpartida" href="#">Subir Partida</a>
                    </li>
                    <li class="current">
                        <a href="#ab">menu item</a>
                        <ul>
                            <li class="current"><a href="#">menu item</a></li>
                            <li><a href="#">Subir Partida</a></li>
                            <li><a href="#abb">menu item</a></li>
                            <li><a href="#abc">menu item</a></li>
                            <li><a href="#abd">menu item</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">menu item</a>
                        <ul>
                            <li><a href="#">menu item</a></li>
                            <li><a href="#">menu item</a></li>
                            <li><a href="#">menu item</a></li>
                            <li><a href="#">menu item</a></li>
                            <li><a href="#">menu item</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">menu item</a>
                        <ul>
                            <li><a href="#">menu item</a></li>
                            <li><a href="#">menu item</a></li>
                            <li><a href="#">menu item</a></li>
                            <li><a href="#">menu item</a></li>
                            <li><a href="#">menu item</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                    <a href="#">menu item</a>
            </li>
            <li>
                <a href="#">menu item</a>
                <ul>
                    <li>
                        <a href="#">menu item</a>
                        <ul>
                            <li><a href="#">short</a></li>
                            <li><a href="#">short</a></li>
                            <li><a href="#">short</a></li>
                            <li><a href="#">short</a></li>
                            <li><a href="#">short</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">menu item</a>
                        <ul>
                            <li><a href="#">menu item</a></li>
                            <li><a href="#">menu item</a></li>
                            <li><a href="#">menu item</a></li>
                            <li><a href="#">menu item</a></li>
                            <li><a href="#">menu item</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">menu item</a>
                        <ul>
                            <li><a href="#">menu item</a></li>
                            <li><a href="#">menu item</a></li>
                            <li><a href="#">menu item</a></li>
                            <li><a href="#">menu item</a></li>
                            <li><a href="#">menu item</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">menu item</a>
                        <ul>
                            <li><a href="#">menu item</a></li>
                            <li><a href="#">menu item</a></li>
                            <li><a href="#">menu item</a></li>
                            <li><a href="#">menu item</a></li>
                            <li><a href="#">menu item</a></li>
                        </ul>
                    </li>
                        <li>
                            <a href="#">menu item</a>
                            <ul>
                                <li><a href="#">menu item</a></li>
                                <li><a href="#">menu item</a></li>
                                <li><a href="#">menu item</a></li>
                                <li><a href="#">menu item</a></li>
                                <li><a href="#">menu item</a></li>
                            </ul>
                        </li>
                </ul>
            </li>
            <li>
                    <a href="#">menu item</a>
            </li>	
    </ul>
        <div id="centro" style="display: none">
            
        </div>   
        <div id="divSubirPresupuesto" style="display: none">
            <form action="" method="POST">
            <table>
                <tr><td><label>Presupuesto:</label></td><td><input type="file" id="presupuesto" /></td></tr>
                <tr><td></td><td><input type="submit" value="Cargar" id="btnSubirPresupuesto" /></td></tr>
            </table>
            </form>    
        </div>
    </body>
</html>
