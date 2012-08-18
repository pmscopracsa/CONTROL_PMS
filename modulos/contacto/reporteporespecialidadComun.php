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
        <script src="../../js/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
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
                    height:550,
                    width:500,
                    url:'../../dl/contacto_bl/ContactoComun_Especialidad.php?q=1&id=0',
                    datatype:"json",
                    colNames:['Id','Especialidad'],
                    colModel:[
                        {name:'id',index:'id',width:550,hidden:true},
                        {name:'descripcion',index:'descripcion',width:250}
                    ],
                    rowNum:25,
                    rowList:[10,20,30],
                    pager:"#paginaamarilla_especialidad-pager",
                    viewrecords:true,
                    sortorder:'asc',
                    multiselect:false,
                    sortname:'descripcion',
                    caption:"ESPECIALIDADES",
                    hidegrid:false,
                    subGrid:true,
                    subGridRowExpanded:function(subgrid_id,row_id) {
                        var subgrid_table_id, pager_id;
                        subgrid_table_id = subgrid_id+"_t";
                        pager_id = "p_"+subgrid_table_id+"_t";
                        $("#"+subgrid_id).html("<table id='"+subgrid_table_id+"' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>");
                        jQuery("#"+subgrid_table_id).jqGrid({
                            url:"../../dl/contacto_bl/ContactoComun_Empresa.php?q=1&id=0"+row_id,
                            datatype:"json",
                            colNames:['Id','Empresa'],
                            colModel:[
                                {name:'id',index:'id',width:250,hidden:true},
                                {name:'descripcion',index:'descripcion',width:250}
                            ],
                            rowNum:15,
                            pager:pager_id,
                            subGrid:true,
                            sortname:'descripcion',    
                            sortorder:'asc',
                            height:'100%',
                            onSelectRow:function(row_id){
                                $.ajax({
                                    data:{id:row_id},
                                    type:"GET",
                                    dataType:"json",
                                    url:"../../dl/contacto_bl/contactoComun_empresaDetail.php",
                                    success:function(data){
                                        verDetalle(data);
                                    }
                                })
                            },
                            subGridRowExpanded:function(subgrid_id,row_id) {
                                var subgrid_table_id, pager_id;
                                var idx;
                                subgrid_table_id = subgrid_id+"_t";
                                pager_id = "p_"+subgrid_table_id;
                                $("#"+subgrid_id).html("<table id='"+subgrid_table_id+"' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>");
                                jQuery("#"+subgrid_table_id).jqGrid({
                                    url:"../../dl/contacto_bl/ContactoComun_Contacto.php?q=2&id="+row_id, 
                                    datatype:"xml",
                                    colNames:['Id','Contacto','Email'],
                                    colModel:[
                                        {name:"id",index:"id",width:80,key:true,hidden:true}, 
                                        {name:"nombres",index:"nombres",width:130},
                                        {name:"correo",index:"correo"},
                                    ],
                                    rowNum:10,
                                    pager:pager_id,
                                    sortname:"nombres",
                                    sortorder:"asc",
                                    height:'100%',
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
                                });$("#"+subgrid_table_id).jqGrid('navGrid',"#"+pager_id,{search:true,edit:false,add:false,del:false})
                            }
                        });$("#"+subgrid_table_id).jqGrid('navGrid',"#"+pager_id,{search:true,edit:false,add:false,del:false})
                    }
                });$("#tbl-paginaamarilla_especialidad").jqGrid('navGrid',"#paginaamarilla_especialidad-pager",{search:true,edit:false,add:false,del:false})
                /**
                 * VER DETALLE DE LA EMPRESA 
                 */
                function verDetalle(data)
                {   
                    var i = 1;
                    clearDetail(i);
                    
                    $.each(data,function(index,value){
                        $("#derecho-content-table-data tbody").append(
                            "<tr><th>Descripcion<td>"+data[index].descripcion+
                            "<tr><th>Ruc<td>"+data[index].ruc+
                            "<tr><th>Observacion<td>"+data[index].observacion+
                            "<tr><th>Email<td>"+data[index].email+
                            "<tr><th>Web<td>"+data[index].web
                        );
                    });
                   
                }
                
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
                        url:"../../dl/contacto_bl/contactoComun_empresatf.php",
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
                        url:"../../dl/contacto_bl/contactoComun_empresatm.php",
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
                        url:"../../dl/contacto_bl/contactoComun_empresatn.php",
                        success:function(data){
                            $.each(data,function(index,value){
                                $("#telefonosnextel-empresa tbody").append(
                                    "<tr><th>#<td>"+data[index].numero
                                );
                            });
                        }
                    });
                }
                
//                function telefonosfijos(data) {
//                    $.each(data,function(index,value){
//                        $("#telefonosfijo-empresa tbody").append(
//                            "<tr><th>Descripcion<td>"+data[index].numero
//                        );
//                    });
//                }
                
                /**
                 * VER DETALLE DE LA PERSONA QUE TRABAJA EN LA EMPRESA 
                 */
                function verDetallePersona(data)
                {
                    clearDetail(2);
                    var codigo;
                    
                    $.each(data,function(index,value){
                        var email = "";
                        if (data[index].coreo != "<i><b>No est&aacute; especificado</b></i>")
                            email = "<td><input type='button' value='Enviar email' id='enviaremail' />";
                        else
                            email = "<td>";
                        
                        codigo = data[index].id;
                        $("#derecho-content-table-data-persona tbody").append(
                            "<tr><th>Nombre<td>"+data[index].nombres+"<td>"+
                            "<tr><th>Email<td>"+data[index].correo+"<td>"+    
                            email+
                            "<tr><th>Cargo<td>"+data[index].cargo+"<td>"
                        );    
                        verTFEmpresa(codigo);
                        verTMEmpresa(codigo);
                        verTNEmpresa(codigo);
                    });
                }
                
                /**
                 * OBTENER EL ID DE LA ESPECIALIDAD
                 */
                function obtenerIdEspecialidad(ids)
                {
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
                
                /**
                 * LIMPIAR EL TD QUE ALMACENA EL ID DE LA ESPECIALIDAD 
                 */
                function limpiarIdAnterior() {
                    $("#tbl-idEspecialidad td").remove();
                }

                function cleanAll() {
                    $("#derecho-content-table-data td").remove();
                    $("#derecho-content-table-data th").remove();
                            
                    $("#derecho-content-table-data-persona td").remove();
                    $("#derecho-content-table-data-persona th").remove();  
                    
                    $("#telefonosfijo-empresa tbody td").remove();
                    $("#telefonosfijo-empresa tbody th").remove();

                    $("#telefonosmoviles-empresa td").remove();
                    $("#telefonosmoviles-empresa th").remove();

                    $("#telefonosnextel-empresa td").remove();
                    $("#telefonosnextel-empresa th").remove();
                }
                /**
                 * BOTON QUE SE MUESTRA POR DEMANDA
                 */
                function mostrarBotonImportar() {
                    $("#derecho-content-addToMyContacts").css("display","block");
                }
                
                function ocultarBotonImportar() {
                    $("#derecho-content-addToMyContacts").css("display","none");
                }
                
                            $("#enviaremail").live("click",function() {
                $("#email_form").dialog("open");
            });
        
              $("#email_form").dialog({
                    autoOpen:false,
                    height:300,
                    width:550,
                    modal:true,
                    buttons:{
                        "Enviar":function() {
                            $(this).dialog("close");
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
                <td>
                    <label for="asunto">Asunto *</label>
                </td>
                <td>
                    <input type="text" name="txtasunto" maxlength="50" size="30" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="cuerpo">Mensaje *</label>
                </td>
                <td>
                    <textarea name="mensaje" maxlength="100" cols="25" rows="6"></textarea> 
                </td>
            </tr>
        </table>
    </div>
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
                        <h2 class="titulo">DETALLES DE LA EMPRESA</h2>
                        <div id="error" style="display: none">
                        <h3>No se puede consultar los datos de detalle</h3>
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
                        <h3>No se puede consultar los datos de detalle</h3>
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
                        <h2 class="titulo">TELEFONO(S) MOVIL(ES)</h2>
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
                <div id="derecho">
                    <div id="derecho-content-table-mike">
                        <div id="div-empresa_detail"></div>
                    </div>
                </div>
                <div id="derecho">
                    <div id="derecho-content-addToMyContacts" style="display: none">
                        <a href="" id="agrega" class="cta cta-blue"><span class="icon-download">Agregar a mis cont&aacute;ctos</span></a>
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