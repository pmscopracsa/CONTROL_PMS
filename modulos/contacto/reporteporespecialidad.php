<?php
session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();

$CSS_PATH = '../../css/';
$css = array();
$css = scandir($CSS_PATH);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>REPORTE POR ESPECIALIDAD</title>
        <!-- zona css -->
        <?php  
        /*foreach ($css as $value) {
            if ($value === '.' || $value === '..'){continue;}
            echo '<link href="../../css/'.$value.'" rel="stylesheet" type="text/css" />'; 
        }*/
        ?>
        <link href="../../css/!style.css" rel="stylesheet" type="text/css" />
        <link href="../../css/barrasuperior.css" rel="stylesheet" type="text/css" />
        <link href="../../css/botones.css" rel="stylesheet" type="text/css" />
        <link href="../../css/cuerpo.css" rel="stylesheet" type="text/css" />
        <link href="../../css/dos-columnas.css" rel="stylesheet" type="text/css" />
        <link href="../../css/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" />
        <link href="../../css/barrasuperior.css" rel="stylesheet" type="text/css" />
        <link href="../../css/google-buttons.css" rel="stylesheet" type="text/css" />
        <link href="../../css/tabla-border.css" rel="stylesheet" type="text/css" />
        
        
        <link href="../../js/jqgrid/gridtree/src/css/ui.jqgrid.css" rel="stylesheet" type="text/css"/>
        <link href="../../js/jqgrid/gridtree/src/css/ui.multiselect.css" rel="stylesheet" type="text/css"/>
        <!-- ZONA JS -->
        <script src="../../js/jquery1.4.2.js.js" type="text/javascript"></script>
        <script src="../../js/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
        <script src="../../js/jqgrid/gridtree/js/i18n/grid.locale-es.js" type="text/javascript"></script>
        <script src="../../js/jqgrid/gridtree/js/jquery.jqGrid.src.js" type="text/javascript"></script>
        <script>
        $(function(){
            /**
             * GRILLA ESPECIALIDAD
             */
            $("#lista-especialidades").jqGrid({
                height:550,
                width:500,
                url:'../../dl/contacto_bl/testlistaespecialidades/parent.php?q=2',
                datatype:"json",
                colNames:['Id','Especialidad'],
                colModel:[
                    {name:'id',index:'id',width:550,hidden:true},
                    {name:'descripcion',index:'descripcion',width:250}
                ],
                rowNum:25,
                rowList:[10,20,30],
                pager:'#pager-especialidades',
                sortname:'descripcion',
                viewrecords:true,
                sortorder:"asc",
                multiselect:false,
                caption:"ESPECIALIDAD",
                hidegrid:false,
                subGrid:true,
                subGridRowExpanded:function(subgrid_id,row_id){
                    var subgrid_table_id, pager_id;
                    subgrid_table_id = subgrid_id+"_t";
                    pager_id = "p_"+subgrid_table_id;
                    $("#"+subgrid_id).html("<table id='"+subgrid_table_id+"' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>");
                    jQuery("#"+subgrid_table_id).jqGrid({
                        url:"../../dl/contacto_bl/testlistaespecialidades/hijo.php?q=1&id="+row_id,
                        datatype:"json",
                        colNames:['Id','Empresa'],
                        colModel:[
                            {name:'id',index:'id',width:250,hidden:true},
                            {name:'descripcion',index:'descripcion',width:250}
                        ],
                        rowNum:15,
                        pager:pager_id,
                        subGrid:true,
                        height:'100%',
                        onSelectRow:function(idx){
                            $.ajax({
                                data:{id:idx},
                                type:"GET",
                                dataType:"json",
                                url:"../../dl/contacto_bl/testlistaespecialidades/contacto_empresaDetail.php",
                                success:function(data){
                                    verDetalle(data);
                                },
                                error:function(){
                                    errorDetalle();
                                }
                            });

                        },
                        subGridRowExpanded:function(subgrid_id,row_id){
                            var subgrid_table_id, pager_id;
                            var idx;
                            subgrid_table_id = subgrid_id+"_t";
                            pager_id = "p_"+subgrid_table_id;
                            $("#"+subgrid_id).html("<table id='"+subgrid_table_id+"' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>");
                            jQuery("#"+subgrid_table_id).jqGrid({
                                url:"../../dl/contacto_bl/testlistaespecialidades/detalle.php?q=2&id="+row_id,
                                datatype:"xml",
                                colNames:['Id','Nombre'],
                                colModel:[
                                    {name:"id",index:"id",key:true,hidden:true},
                                    {name:"nombre",index:"nombre"},
                                ],
                                rowNum:10,
                                pager:pager_id,
                                sortname:'nombre',
                                sortorder:"asc",
                                height:'100%',
                                onSelectRow:function(idx){
                                    $.ajax({
                                        data:{id:idx},
                                        type:"GET",
                                        dataType:"json",
                                        url:"../../dl/contacto_bl/testlistaespecialidades/last-detail.php",
                                        success:function(data){
                                            verDetallePersona(data);
                                        },
                                        error:function(){
                                            errorDetalle();
                                        }
                                    });
                                }
                            });$("#"+subgrid_table_id).jqGrid('navGrid',"#"+pager_id,{search:true,edit:false,add:false,del:false})
                        }
                    });$("#"+subgrid_table_id).jqGrid('navGrid',"#"+pager_id,{search:true,edit:false,add:false,del:false})
                }
            });$("#lista-especialidades").jqGrid('navGrid','#pager-especialidades',{search:true,add:false,edit:false,del:false});
            
            
            /**
             * DETALLE QUE SE MUESTRA AL LADO DERECHO
             */
            function verDetalle(data) 
            {
                var i = 1;
                clear_detail(i);
                
                $.each(data,function(index,value){
                    $("#derecho-content-table-data tbody").append(
                        "<tr><th>Descripcion<td>"+data[index].descripcion+
                        "<tr><th>RUC<td>"+data[index].ruc    
                    )
                });
            }
            
            /**
             * DETALLE DE LOS TELEFONOS
             */
             function verTFEmpresa(codigo)
                {
                    // LIMPIAR TELEFONOS
                    $("#telefonosfijo-empresa tbody td").remove();
                    $("#telefonosfijo-empresa tbody th").remove();
                    
                    // MUESTRA NUMEROS TELEFONICOS
                    
                    $.ajax({
                        data:{id:codigo},
                        type:"GET",
                        dataType:"json",
                        url:"../../dl/contacto_bl/reporteEspecialidades/contacto_empresatf.php",
                        success:function(data){
                            $.each(data,function(index,value){
                                $("#telefonosfijo-empresa tbody").append(
                                    "<tr><th>#<td>"+data[index].numero
                                );
                            });
                        }
                    });
                }
                
                function verTMEmpresa(codigo)
                {
                    //LIMPIAR 
                    $("#telefonosmoviles-empresa td").remove();
                    $("#telefonosmoviles-empresa th").remove();
                    //
                    $.ajax({
                        data:{id:codigo},
                        type:"GET",
                        dataType:"json",
                        url:"../../dl/contacto_bl/reporteEspecialidades/contacto_empresatm.php",
                        success:function(data){
                            $.each(data,function(index,value){
                                $("#telefonosmoviles-empresa tbody").append(
                                    "<tr><th>#<td>"+data[index].numero
                                );
                            });
                        }
                    });
                }
                
                function verTNEmpresa(codigo)
                {
                    // LIMPIAR
                    $("#telefonosnextel-empresa td").remove();
                    $("#telefonosnextel-empresa th").remove();
                    //MUESTRA
                    $.ajax({
                        data:{id:codigo},
                        type:"GET",
                        dataType:"json",
                        url:"../../dl/contacto_bl/reporteEspecialidades/contacto_empresatn.php",
                        success:function(data){
                            $.each(data,function(index,value){
                                $("#telefonosnextel-empresa tbody").append(
                                    "<tr><th>#<td>"+data[index].numero
                                );
                            });
                        }
                    });
                }
            
            function verDetallePersona(data){
                clear_detail(2);
                var codigo;
                
                $.each(data,function(index,value){
                    var email = "";
                    if(data[index].email != "<i>No tiene</i>")
                        email = "<td><input type='button' value='Enviar email' id='enviaremail' />";
                    else
                        email = "<td>";
                    
                    codigo = data[index].id;
                    $("#derecho-content-table-data-persona tbody").append(
                    "<tr><th>Nombre<td>"+data[index].nombre+"<td>"+
                    "<tr><th>DNI<td>"+data[index].dni+"<td>"+
                    "<tr><th>Cargo<td>"+data[index].cargo+"<td>"+
                    "<tr><th>Email<td>"+data[index].email+
                    email
                    );
                    verTFEmpresa(codigo);
                    verTMEmpresa(codigo);
                    verTNEmpresa(codigo);    
                });
            }
            
            function clear_detail(i)
            {
                /**
                 * limpiar tabla de detalles
                 */
                switch(i)
                {
                    case 1:
                        $("#derecho-content-table-data td").remove();
                        $("#derecho-content-table-data th").remove();
                        break;
                    case 2:
                        $("#derecho-content-table-data-persona td").remove();    
                        $("#derecho-content-table-data-persona th").remove();    
                        break;
                }
                
            }
            
            function errorDetalle()
            {
                
                $("#error").fadeIn(1000, function(){
                    $("#error").fadeOut(1000);
                });
            }
            
            $("#enviaremail").live("click",function() {
                $("#email_form").dialog("open");
            });
        
            $("#email_form").dialog({
                autoOpen:false,
                height:350,
                width:350,
                modal:true,
                buttons:{
                    "Enviar":function() {
                        
                    },
                    "Salir":function() {
                        $(this).dialog("close");
                    }
                }
            });
        });
        </script>

    </head>
    <div id="email_form" title="Enviar correo">
        <table>
            <tr>
                <td id="cap">
                    <label id="cap" for="asunto">Asunto *</label>
                </td>
                <td>
                    <input type="text" name="txtasunto" maxlength="50" size="40" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="cuerpo">Mensaje *</label>
                </td>
                <td>
                    <textarea name="mensaje" maxlength="100" cols="40" rows="14"></textarea> 
                </td>
            </tr>
        </table>
    </div> 
    <body class="fondo">
        <div id="barra-superior">
            <div id="barra-superior-dentro">
                <h1 id="titulo_barra">REPORTE POR ESPECIALIDAD</h1>
            </div>
        </div>
        <div id="main">
            <div class="container">
                <div id="izquierdo">
                    <div id="izquierdo-content">
                    <table id="lista-especialidades"></table>
                    <div id="pager-especialidades"></div>
                    <br />
                    <table id="lista-especialidades-detalle"></table>
                    <div id="pager-especialidades-detalle"></div>
                    <br/>
                    <table id="detalle"></table>
                    <div id="pager-detalle"></div>
                    <br 
                    <table id="last-detail"></table>
                    </div>
                </div>
                <div id="derecho">
                    <div id="derecho-content">
                        <h2 class="titulo">DETALLES DE LA EMPRESA</h2>
                        <div id="error" style="display: none">
                        <h3>No se puede consultar los detalles de la empresa</h3>
                        </div>
                    </div>
                </div>
                <div id="derecho">
                    <div id="derecho-content-table">
                        <table id="derecho-content-table-data" class="rounded-corner" border="0">
                            <tbody>
                                <tr></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="derecho">
                    <div id="derecho-content">
                        <h2 class="titulo">DETALLES DEL CONTACTO</h2>
                        <div id="error" style="display: none">
                        <h3>No se puede consultar los detalles del contacto</h3>
                        </div>
                    </div>
                </div>
                
                <div id="derecho">
                    <div id="derecho-content-table">
                        <table id="derecho-content-table-data-persona" class="rounded-corner" border="0">
                            <tbody>
                                <tr></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!---->
                <div id="derecho">
                    <div id="derecho-content">
                        <h2 class="titulo   ">TELEFONO(S) FIJO(S)</h2>
                    </div>
                    <div id="div-tfijo" title="Telefonos Fijos" style="display: none">
                    </div>
                </div>
                <div id="derecho">
                    <div id="derecho-content-table">
                        <table id="telefonosfijo-empresa" class="rounded-corner" border="0">
                            <tbody>
                                <tr></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!---->
                <!---->
                <div id="derecho">
                    <div id="derecho-content">
                        <h2 class="titulo   ">TELEFONO(S) MOVIL(ES)</h2>
                    </div>
                    <div id="div-tfijo" title="Telefonos Moviles" style="display: none">
                    </div>
                </div>
                <div id="derecho">
                    <div id="derecho-content-table">
                        <table id="telefonosmoviles-empresa" class="rounded-corner" border="0">
                            <tbody>
                                <tr></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!---->
                <!---->
                <div id="derecho">
                    <div id="derecho-content">
                        <h2 class="titulo">TELEFONO(S) NEXTEL</h2>
                    </div>
                    <div id="div-tfijo" title="Telefonos Nextel" style="display: none">
                    </div>
                </div>
                <div id="derecho">
                    <div id="derecho-content-table">
                        <table id="telefonosnextel-empresa" class="rounded-corner" border="0">
                            <tbody>
                                <tr></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
               
                <!---->
            </div>
            <div class="clear"></div>
        </div>
    </body>
</html>