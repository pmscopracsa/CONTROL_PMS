<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();

if(isset($_GET['logoff']))
{
	$_SESSION = array();
	session_destroy();
	
	header("Location: index.php");
	exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>CONTROL PMS</title>
    </head>
    <script src="js/jquery1.4.2.js.js" type="text/javascript"></script>
    <script src="js/jquery.easyui.min.js" type="text/javascript"></script>
    
    <link href="css/menu_principal/menu_principal.css" rel="stylesheet" type="text/css" />
    <link href="css/menu_principal/easyui.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
        javascript:window.history.forward(1);
        
        $(document).ready(function(){
            $("#logo_pms").hover(function() {
		$(this).attr("src","img/pmslogo_orange.png");
			}, function() {
		$(this).attr("src","img/pmslogo.png");
            });
        });        
        
	$(function(){
		$('#mm').accordion('select','Application');
		open1('index_embeded.php');
	});
        
        function seleccion(url){
            
            $('#cc').attr('src',url);
        }
        
	function open1(url){
		$('#cc').attr('src',url);
	}
        
        function abrir(url) {
            $('#cc').attr('src',url);
        }
    </script>
    <style type="text/css">
    .accordion .accordion-header{
            background:#fafafa;
    }
    .accordion .accordion-header-selected{
            background:url('img/nav.png') center bottom no-repeat;
            height:35px;
            border:0;
    }
    .pitem{
            list-style-type:none;
            margin:0;
            padding:2px 0 10px 20px;
    }
    .pitem li{
            font-size:12px;
            line-height:18px;
    }
    .demo-c{ 
           width:845px;
            height:550px;
            float:right;
            background:#fff;
            border:1px solid #ccc;
            border-radius:5px;
            -moz-border-radius:5px;
            -webkit-border-radius: 5px;
    }
    a {
        
        color: #FF6600;
        text-decoration: none; 
    }
    a:hover {
        color: red;
    }
    </style>
    <body>
    <div id="header">
        <div id="header-inner">
            <table cellpadding="0" cellspacing="0" style="width:100%;">
                <tr>
                    <td rowspan="2" style="width:20px;">
                    </td>
                <div class="contenedor">
                    <div class="texto">
                        <h4>Control PMS</h4><br />                            
                        <p>Project Management Software</p>
                    </div>        
                    <div class="imagen">
                        <img id="logo_pms" class="logo_pms" src="img/pmslogo.png" title="CONTROL PMS"/>
                    </div>
                </div>
                <div >
                        <div id="imagen">
                            <img class="logo_cliente" src="<?='img/cliente/'.$_SESSION['logo'];?>" />
                                        <a href="?logoff">Cerrar sesi&oacute;n</a>
                                        <label>USUARIO:</label><a hrehref="#"><?=@$_SESSION['nombre_real']?></a>
                                        <label>PROYECTO:<?=$_REQUEST['proyecto']?></label>
            
                        </div>
                </div>
                </tr>
            </table>
        </div>
    </div>
        
    <div id="mainwrap">
        <div id="content">
            <h3>Men&uacute; de Opciones</h3>
            <div style="width: 200px;float: left;background: #fafafa;">
                <div class="easyui-accordion" border="false">
                    <div>
                    </div>
                    <div title="Busca Personas">
                        <ul class="pitem">
                            <li><a href="modulos/seleccion.php?frmName=compania" target="_blank">Compa&ntilde;ias</a></li>
                            <li><a href="modulos/seleccion.php?frmName=persona" target="_blank">Personas</a></li>
                            <li><a href="modulos/seleccion.php?frmName=listas&obra=<?=$_REQUEST['proyecto']?>&codigo=<?=$_REQUEST['codigObra']?>&descripcion=<?=$_REQUEST['descObra']?>" target="_blank">Listas de Distribuci&oacute;n</a></li>
                            <li><a href="#" onClick="seleccion('seleccionReporteEspecialidad.php');">Reporte por Especialidad</a></li>
                        </ul>
                    </div>
                    <div title="Datos de Obra">
                        <ul>
                            <li><a href="modulos/datosdeobra/registradatosdeobra.php?obra=<?=$_REQUEST['proyecto']?>&codigo=<?=$_REQUEST['codigObra']?>&descripcion=<?=$_REQUEST['descObra']?>" target="_blank">Datos de Obra</a></li>
                            <li><a href="modulos/seleccion.php?frmName=obrane&proyecto=<?=$_REQUEST['proyecto']?>&codigObra=<?=$_REQUEST['codigObra']?>&descObra=<?=$_REQUEST['descObra']?>" target="_blank">Datos de Obra</a></li>
                        </ul>
                    </div>
                    <div title="Gesti&oacute;n de Obra - Procura">
                        <ul>
                            <li><a href="modulos/procura/index.php" target="_blank">Gesti&oacute;n de Obra - Procura</a></li>
                        </ul>
                    </div>
                    <div title="Pagos y Rendiciones">
                    </div>
                    <div title="Gesti&oacute;n de Obra - Venta">
                    </div>
                    <div title="Aprobaciones">
                    </div>
                    <div title="Actas de Reuni&oacute;n">
                    </div>
                    <div title="Comunicaciones">
                    </div>
                    <div title="Env&iacute;o de e-mails">
                        <ul class="pitem">
                            <li><a href="modulos/mailing/mail.php" target="_blank">Escribir mail</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="demo-c" style="">
                <iframe id="cc" frameborder="0" scrolling="auto" style="width:100%;height:100%"></iframe>
            </div>
            <div style="clear:both"></div>
        </div>
    </div>  
    <!-- MODALES EMBEBIDOS -->
    <!-- ----------------- -->
    
</html>
