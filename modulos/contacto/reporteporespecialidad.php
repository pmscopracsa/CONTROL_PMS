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
        <script src="../../js/jqgrid/gridtree/js/jquery.jqGrid.min.js" type="text/javascript"></script>
        
        <script>
        $(function(){
            
            $("#lista-especialidades").jqGrid({
                url:'../../dl/contacto_bl/testlistaespecialidades/parent.php?q=2',
                datatype:"json",
                colNames:['Id','Especialidad'],
                colModel:[
                    {name:'id',index:'id',width:350,hidden:true},
                    {name:'descripcion',index:'descripcion',width:250}
                ],
                rowNum:10,
                rowList:[10,20,30],
                pager:'#pager-especialidades',
                sortname:'descripcion',
                viewrecords:true,
                sortorder:"asc",
                multiselect:false,
                caption:"Especialidades",
                onSelectRow:function(ids) {
                    if(ids == null) {
                        ids = 0;
                        if($("#lista-especialidades-detalle").jqGrid('getGridParam','records') > 0) {
                            $("#lista-especialidades-detalle").jqGrid('setGridParam',{url:"../../dl/contacto_bl/testlistaespecialidades/hijo.php?q=1&id="+ids,page:1});
                            $("#lista-especialidades-detalle").jqGrid('setCaption',"Empresa-Especialidad:"+ids).trigger('reloadGrid');
                            //REGARCAR ULTIMO GRID
                            var detalle = $("#detalle");
                            detalle.clearGridData();
                        }
                    }
                    else {
                            $("#lista-especialidades-detalle").jqGrid('setGridParam',{url:"../../dl/contacto_bl/testlistaespecialidades/hijo.php?q=1&id="+ids,page:1});
                            $("#lista-especialidades-detalle").jqGrid('setCaption',"Empresa-Especialidad:"+ids).trigger('reloadGrid');
                            //recargar la ultima grilla
                            var detalle = $("#detalle");
                            detalle.clearGridData();
                    }
                }
            });//$("#lista-especialidades").jqGrid('navGrid','#pager-especialidades',{add:true,edit:true,del:false});
            
            $("#lista-especialidades-detalle").jqGrid({
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
                caption:"Empresa-Especialidad",
                onSelectRow:function(id) {
                    if(id == null || id == "") {
                        id = 0;
                        if($("#detalle").jqGrid('getGridParam','records') > 0) {
                            $("#detalle").jqGrid('setGridParam',{url:"../../dl/contacto_bl/testlistaespecialidades/detalle.php?q=1&id="+id,page:1});
                            $("#detalle").jqGrid('setCaption',"Persona:"+id).trigger('reloadGrid');
                        }
                    }
                    else {
                            $("#detalle").jqGrid('setGridParam',{url:"../../dl/contacto_bl/testlistaespecialidades/detalle.php?q=1&id="+id,page:1});
                            $("#detalle").jqGrid('setCaption',"Persona:"+id).trigger('reloadGrid');
                    }
                }
            });//.navGrid('#pager-especialidades-detalle',{add:false,edit:false,del:false});
            
            $("#detalle").jqGrid({
                height:100,
                url:'../../dl/contacto_bl/testlistaespecialidades/detalle.php?q=1&id=0',
                datatype:"json",
                colNames:['Id','Detalle'],
                colModel:[
                    {name:'id',index:'id',width:250,hidden:true},
                    {name:'descripcion',index:'descripcion',width:250}
                ],
                rowNum:10,
                rowList:[10,20,30],
                pager:"#pager-detalle",
                sortname:'nombre',
                viewrecords:true,
                sortorder:"asc",
                multiselect:false,
                caption:"Persona",
                onSelectRow:function(id) {
                    $.ajax({
                        data:{id:id},
                        type:"GET",
                        dataType:"json",
                        url:"../../dl/contacto_bl/testlistaespecialidades/last-detail.php",
                        success:function(data){
                            verDetalle(data)
                        },
                        error:function(){
                            errorDetalle();
                        }
                    })
                }
            });
            
            /**
             * DETALLE QUE SE MUESTRA AL LADO DERECHO
             */
            function verDetalle(data) 
            {
                clear_detail();
                $.each(data,function(index,value){
                    $("#derecho-content-table-data tbody").append(
                    "<tr>"+
                    "<td>"+data[index].nombre+"</td>"+
                    "<td>"+data[index].dni+"</td>"+
                    "<td>"+data[index].cargo+"</td>"+
                    "<td>"+data[index].fax+"</td>"+
                    "<td>"+data[index].email+"</td>"+
                    "<td>"+data[index].web+"</td>"+
                    "</tr>"
                    );
                });
            }
            
            function clear_detail()
            {
                /**
                 * limpiar tabla de detalles
                 * TODO: LAYOUT Estilizado
                 */
                $("#derecho-content-table-data td").remove();
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
                        <h1>DETALLES</h1>
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
                                    <th>DNI</th>
                                    <th>Cargo</th>
                                    <th>Fax</th>
                                    <th>Email</th>
                                    <th class="rounded-q4">Web</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="rounded-foot-left"></td>
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