<?php
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
        foreach ($css as $value) {
            if ($value === '.' || $value === '..'){continue;}
            echo '<link href="../../css/'.$value.'" rel="stylesheet" type="text/css" />'; 
        }
        ?>
        <link href="../../js/jqgrid/gridtree/src/css/ui.jqgrid.css" rel="stylesheet" type="text/css"/>
        <link href="../../js/jqgrid/gridtree/src/css/ui.multiselect.css" rel="stylesheet" type="text/css"/>
        <!-- ZONA JS -->
        <script src="../../js/jquery1.4.2.js.js" type="text/javascript"></script>
        <script src="../../js/jqgrid/gridtree/js/i18n/grid.locale-es.js" type="text/javascript"></script>
        <script src="../../js/jqgrid/gridtree/js/jquery.jqGrid.src.js" type="text/javascript"></script>
        
        <script>
        $(function(){
            /**
             * GRILLA ESPECIALIDAD
             */
            $("#lista-especialidades").jqGrid({
                height:150,
                width:500,
                url:'../../dl/contacto_bl/testlistaespecialidades/parent.php?q=2',
                datatype:"json",
                colNames:['Id','Especialidad'],
                colModel:[
                    {name:'id',index:'id',width:550,hidden:true},
                    {name:'descripcion',index:'descripcion',width:250}
                ],
                rowNum:10,
                rowList:[10,20,30],
                pager:'#pager-especialidades',
                sortname:'descripcion',
                viewrecords:true,
                sortorder:"asc",
                multiselect:false,
                caption:"ESPECIALIDAD",
                onSelectRow:function(ids) {
                    if(ids == null) {
                        ids = 0;
                        if($("#lista-especialidades-detalle").jqGrid('getGridParam','records') > 0) {
                            $("#lista-especialidades-detalle").jqGrid('setGridParam',{url:"../../dl/contacto_bl/testlistaespecialidades/hijo.php?q=1&id="+ids,page:1});
                            $("#lista-especialidades-detalle").jqGrid('setCaption',"EMPRESA").trigger('reloadGrid');
                            //REGARCAR ULTIMO GRID
                            var detalle = $("#detalle");
                            detalle.clearGridData();
                        }
                    }
                    else {
                            $("#lista-especialidades-detalle").jqGrid('setGridParam',{url:"../../dl/contacto_bl/testlistaespecialidades/hijo.php?q=1&id="+ids,page:1});
                            $("#lista-especialidades-detalle").jqGrid('setCaption',"EMPRESA").trigger('reloadGrid');
                            //recargar la ultima grilla
                            var detalle = $("#detalle");
                            detalle.clearGridData();
                    }
                }
            });//$("#lista-especialidades").jqGrid('navGrid','#pager-especialidades',{add:true,edit:true,del:false});
            
            /**
             * GRILLA EMPRESA
             */
            $("#lista-especialidades-detalle").jqGrid({
                height:150,
                width:500,
                url:'../../dl/contacto_bl/testlistaespecialidades/hijo.php?q=1&id=0',
                datatype:"json",
                colNames:['Id','Empresa'],
                colModel:[
                    {name:'id',index:'id',width:250,hidden:true},
                    {name:'descripcion',index:'descripcion',width:250}
                ],
                rowNum:5,
                rowList:[5,10,20],
                pager:'#pager-especialidades-detalle',
                sortname:'descripcion',
                viewrecords:true,
                sortorder:"asc",
                multiselect:false,
                caption:"EMPRESA...",
                subGrid:true,
                onSelectRow:function(idx){
                    $.ajax({
                        data:{id:idx},
                        type:"GET",
                        dataType:"json",
                        url:"../../dl/contacto_bl/testlistaespecialidades/contacto_empresaDetail",
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
                    });
                    jQuery("#"+subgrid_table_id).jqGrid('navGrid',"#"+pager_id,{edit:false,add:false,del:false})
                },
                subGridRowColapsed:function(subgrid_id,row_id){
                }
            });//.navGrid('#pager-especialidades-detalle',{add:false,edit:false,del:false});
            
            /**
             * DETALLE QUE SE MUESTRA AL LADO DERECHO
             */
            function verDetalle(data) 
            {
                var i = 1;
                clear_detail(i);
                $.each(data,function(index,value){
                    $("#derecho-content-table-data tbody").append(
                    "<tr>"+
                    "<td>"+data[index].descripcion+"</td>"+
                    "<td>"+data[index].ruc+"</td>"+
                    "</tr>"
                    );
                });
            }
            
            function verDetallePersona(data){
                var i = 2;
                clear_detail(i);
                $.each(data,function(index,value){
                    $("#derecho-content-table-data-persona tbody").append(
                    "<tr>"+
                    "<td>"+data[index].nombre+"</td>"+
                    "<td>"+data[index].dni+"</td>"+
                    "<td>"+data[index].cargo+"</td>"+
                    "</tr>"
                    );
                });
            }
            
            function clear_detail(i)
            {
                /**
                 * limpiar tabla de detalles
                 */
                switch(i)
                {
                    case 1:$("#derecho-content-table-data td").remove();
                        break;
                    case 2:$("#derecho-content-table-data-persona td").remove();    
                        break;
                }
                
            }
            
            function errorDetalle()
            {
                $("#error").fadeIn(1000, function(){
                    $("#error").fadeOut(1000);
                })
            }
        });
        </script>
    </head>
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
                        <h1>DETALLES DE LA EMPRESA</h1>
                        <div id="error" style="display: none">
                        <h3>No se puede consultar los datos de detalle</h3>
                        </div>
                    </div>
                </div>
                <div id="derecho">
                    <div id="derecho-content-table">
                        <table id="derecho-content-table-data" class="rounded-corner" border="0">
                            <thead>
                                <tr>
                                    <th class="rounded-company">Nombre</th>
                                    <th class="rounded-q4">RUC</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="1" class="rounded-foot-left"></td>
                                    <td class="rounded-foot-right">&nbsp;</td>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="derecho">
                    <div id="derecho-content">
                        <h1>DETALLES DEL CONTACTO</h1>
                        <div id="error" style="display: none">
                        <h3>No se puede consultar los datos de detalle</h3>
                        </div>
                    </div>
                </div>
                
                <div id="derecho">
                    <div id="derecho-content-table">
                        <table id="derecho-content-table-data-persona" class="rounded-corner" border="0">
                            <thead>
                                <tr>
                                    <th class="rounded-company">Nombre</th>
                                    <th>Cargo</th>
                                    <th class="rounded-q4">DNI</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="2" class="rounded-foot-left"></td>
                                    <td class="rounded-foot-right">&nbsp;</td>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </body>
</html>