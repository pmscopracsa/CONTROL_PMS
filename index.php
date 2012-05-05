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
	$(function(){
		$('#mm').accordion('select','Application');
		open1('index_embeded.php');
	});
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
        
        color: #ff99aa;
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
                    <td style="height:52px;">
                        <div style="color:#fff;font-size:22px;font-weight:bold;">
                                <a href="/index.php" style="color:#fff;font-size:22px;font-weight:bold;text-decoration:none">Control PMS</a>
                        </div>
                        <div style="color:#fff">
                                <a href="/index.php" style="color:#fff;text-decoration:none">Sistemas de Gestión de Proyectos</a>
                        </div>
                    </td>
                    <td style="padding-right:5px;text-align:right;vertical-align:bottom;">
                        <div id="topmenu">
                            <label>LOGO</label>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
        
    <div id="mainwrap">
        <div id="content">
            <h3>Men&uacute; de Opciones</h3>
            <div style="width: 200px;float: left;background: #fafafa;">
                <div class="easyui-accordion" border="false">
                    <div title="Busca Personas">
                        <ul class="pitem">
                            <li><a href="javascript:void(0)" onclick="abrir('modulos/contacto/registracompania.php')">Registro de Compa&ntilde;ias</a></li>
                            <li><a href="javascript:void(0)" onclick="abrir('modulos/contacto/registrapersona.php')">Registro de Persona</a></li>
                            <li><a href="javascript:void(0)" onclick="abrir('modulos/contacto/registrolistadistribucion.php')">Listas de Distribuci&oacute;n</a></li>
                            <li><a href="javascript:void(0)" onclick="abrir('modulos/contacto/reporteporespecialidad.php')">Reporte por Especialidad</a></li>
                        </ul>
                    </div>
                    <div title="Datos de Obra">
                    </div>
                    <div title="Gesti&oacute; de Obra - Procura">
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
                    
                </div>
            </div>
            <div class="demo-c" style="">
                <iframe id="cc" frameborder="0" scrolling="auto" style="width:100%;height:100%"></iframe>
            </div>
            <div style="clear:both"></div>
        </div>
    </div>  
        
</html>
