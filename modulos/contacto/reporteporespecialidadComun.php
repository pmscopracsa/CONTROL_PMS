<?php
$CSS_PATH = '../../css/';
$css = array();
$css = scandir($CSS_PATH);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>PAGINAS AMARILLAS</title>
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
                 * AGREGAR CONTACTOS COMUNES A LA LISTA DE MIS CONTACTOS
                 */
                $("#agrega").click(function(e){
                    e.preventDefault();
                    /**
                     * TODO: validar si se tiene el dato ID de la empresa
                     * sino no se podra hacer la consulta. (Haciendo click para ver el detalle a la mano derecha)
                     */
                    $.ajax({
                        type:"POST",
                        url:'../../bl/Contacto/mantenimiento/contactoComunAgregamelo.php',
                        data:{"id_empresa":$("#empresa_id").html(),"id_persona":$("#persona_id").html(),"id_especialidad":$("#especialidad_id").html()},
                        success:function(){
                            alert("Este contacto ahora esta en su lista.");
                        },
                        error:function(){
                            alert("La importacion de este registro no se ha podido concretar. Reintentelo luego por favor.")
                        }
                    });
                });
                
                /**
                * CONTACTO COMÚN - especialidad
                */   
                $("#tbl-paginaamarilla_especialidad").jqGrid({
                    height:200,
                    width:500,
                    url:'../../dl/contacto_bl/ContactoComun_Especialidad.php?q=1&id=0',
                    datatype:"json",
                    colNames:['Id','Especialidad'],
                    colModel:[
                        {name:'id',index:'id',width:250,sortable:false,hidden:true},
                        {name:'descripcion',index:'descripcion',width:250}
                    ],
                    rowNum:10,
                    rowList:[10,20,30],
                    pager:"#paginaamarilla_especialidad-pager",
                    viewrecords:true,
                    multiselect:false,
                    sortname:'descripcion',
                    caption:"ESPECIALIDADES",
                    onSelectRow:function(ids){
                        limpiarIdAnterior();
                        obtenerIdEspecialidad(ids);
                        ocultarBotonImportar();
                        if(ids == null) {
                            ids = 0;
                            if($("#tbl-paginaamarilla_empresa").jqGrid('getGridParam','records') > 0) {
                                $("#tbl-paginaamarilla_empresa").jqGrid('setGridParam',{url:"../../dl/contacto_bl/ContactoComun_Empresa.php?q=1&id="+ids,page:1});
                                $("#tbl-paginaamarilla_empresa").jqGrid('setCaption',"EMPRESA").trigger('reloadGrid');
                                //REGARCAR ULTIMO GRID
                                var detalle = $("#detalle");
                                detalle.clearGridData();
                            }
                        }
                        else {
                            $("#tbl-paginaamarilla_empresa").jqGrid('setGridParam',{url:"../../dl/contacto_bl/ContactoComun_Empresa.php?q=1&id="+ids,page:1});
                            $("#tbl-paginaamarilla_empresa").jqGrid('setCaption',"EMPRESA").trigger('reloadGrid');
                            //recargar la ultima grilla
                            var detalle = $("#detalle");
                            detalle.clearGridData();
                        }
                    }
                });
                
                /**
                 * CONTACTO COMUN - EMPRESA
                 */
                $("#tbl-paginaamarilla_empresa").jqGrid({
                    url:'../../dl/contacto_bl/ContactoComun_Empresa.php?q=1&id=0',
                    datatype:"json",
                    height:190,
                    width:500,
                    colNames:['Id','Empresa'],
                    colModel:[
                        {name:'id',index:'id',width:250,sortable:false,hidden:true},
                        {name:'descripcion',index:'descripcion',width:250}
                    ],
                    rowNum:10,
                    rowList:[10,20,30],
                    pager:"#paginaamarilla_empresa-pager",
                    sortname:'descripcion',
                    viewrecords:true,
                    multiselect:false,
                    caption:"EMPRESA",
                    subGrid:true,
                    onSelectRow:function(row_id){
                        $.ajax({
                            data:{id:row_id},
                            type:"GET",
                            dataType:"json",
                            url:"../../dl/contacto_bl/contactoComun_empresaDetail.php",
                            success:function(data){
                                verDetalle(data);
                            }
                        });
                    },
                    subGridRowExpanded:function(subgrid_id,row_id){
                        var subgrid_table_id,pager_id;
                        var idx;
                        subgrid_table_id = subgrid_id+"_t";
                        pager_id = "p_"+subgrid_table_id;
                        $("#"+subgrid_id).html("<table id='"+subgrid_table_id+"' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>");
                        jQuery("#"+subgrid_table_id).jqGrid({ 
                            url:"../../dl/contacto_bl/ContactoComun_Contacto.php?q=2&id="+row_id, 
                            datatype: "xml", 
                            colNames: ['Id','Contacto','Email'], 
                            colModel: [ 
                                {name:"id",index:"id",width:80,key:true,hidden:true}, 
                                {name:"nombres",index:"nombres",width:130},
                                {name:"correo",index:"correo"},
                               
                            ], 
                            rowNum:20, 
                            pager: pager_id, 
                            sortname: 'num', 
                            sortorder: "asc", 
                            height: '100%',
                            width:'100%',
                            onSelectRow:function(idx){
                                $.ajax({
                                    data:{id:idx},
                                    type:"GET",
                                    dataType:"json",
                                    url:"../../dl/contacto_bl/contactoComun_personaDetail.php",
                                    success:function(data){
                                        mostrarBotonImportar();
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
                });
                /**
                 * VER DETALLE DE LA EMPRESA 
                 */
                function verDetalle(data)
                {   
                    var i = 1;
                    clearDetail(i);
                    $.each(data,function(index,value){
                       $("#derecho-content-table-data tbody").append(
                        "<tr>"+
                        "<td id=\"empresa_id\" style=\"display: none\">"+data[index].id+"</td>"+    
                        "<td>"+data[index].descripcion+"</td>"+
                        "<td>"+data[index].ruc+"</td>"+
                        "<td>"+data[index].observacion+"</td>"+
                        "<td>"+data[index].email+"</td>"+
                        "<td>"+data[index].web+"</td>"+
                        "</tr>"
                        ); 
                    });
                }
                /**
                 * VER DETALLE DE LA PERSONA QUE TRABAJA EN LA EMPRESA 
                 */
                function verDetallePersona(data)
                {
                    var i = 2;
                    clearDetail(i);
                    $.each(data,function(index,value){
                        $("#derecho-content-table-data-persona tbody").append(
                            "<tr>"+
                            "<td id=\"persona_id\" style=\"display: none\">"+data[index].id+"</td>"+    
                            "<td>"+data[index].nombres+"</td>"+
                            "<td>"+data[index].correo+"</td>"+
                            "</tr>"    
                        )
                    });
                }
                /**
                 * OBTENER EL ID DE LA ESPECIALIDAD
                 */
                function obtenerIdEspecialidad(ids)
                {
                    //alert(ids);
                    $("#tbl-idEspecialidad tbody").append(
                    "<tr>"+
                    "<td id=\"especialidad_id\" style=\"display: none\">"+ids+"</td>"+
                    "</tr>"
                    );
                }
                
                /**
                 * LIMPIAR SEGUN SEA EL CASO LAS TABLAS DE DETALLE
                 * DE LA MANO DERECHA 
                 */
                function clearDetail(i){
                    switch(i)
                    {
                        case 1:$("#derecho-content-table-data td").remove();
                            break;
                        case 2:$("#derecho-content-table-data-persona td").remove();
                            break;
                    }
                }
                
                /**
                 * LIMPIAR EL TD QUE ALMACENA EL ID DE LA ESPECIALIDAD 
                 */
                function limpiarIdAnterior() {
                    $("#tbl-idEspecialidad td").remove();
                }
                
                /**
                 * 
                 */
                function mostrarBotonImportar() {
                    $("#derecho-content-addToMyContacts").css("display","block");
                }
                
                function ocultarBotonImportar() {
                    $("#derecho-content-addToMyContacts").css("display","none");
                }
            });
        </script>
    </head>
    <body class="fondo">
        <div id="barra-superior">
            <div id="barra-superior-dentro">
                <h1 id="titulo_barra">PAGINAS AMARILLAS</h1>
            </div>
        </div>
        <div id="main">
            <div class="container">
                <div id="izquierdo">
                    <div id="izquierdo-content">
                        <table id="tbl-paginaamarilla_especialidad"></table>
                        <div id="paginaamarilla_especialidad-pager"></div>
                        <table id="tbl-paginaamarilla_empresa"></table>
                        <div id="paginaamarilla_empresa-pager"></div>
                    </div>
                </div>
                <br />
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
                                    <th class="rounded-company">Descripcion</th>
                                    <th>RUC</th>
                                    <th>Observacion</th>
                                    <th>email</th>
                                    <th class="rounded-q4">web</th>
                                </tr> 
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="rounded-foot-left"></td>
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
                                    <th class="rounded-q4">Correo</th>
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
                    <div id="derecho-content-table-mike">
                        <div id="div-empresa_detail"></div>
                    </div>
                </div>
                <div id="derecho">
                    <div id="derecho-content-addToMyContacts" style="display: none">
                        <a href="" id="agrega" class="cta cta-blue"><span class="icon-download">Agregar a mis cont&aacute;ctos</span></a>
<!--                        <input type="button" value="Agregar a mis cont&aacute;ctos" id="agregarMisContactos"/>-->
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div id="div-idEspecialidad" style="display: none">
            <table id="tbl-idEspecialidad" border="0">
                <thead></thead>
                <tfoot></tfoot>
                <tbody><tr></tr></tbody>
            </table>
        </div>
    </body>
</html>