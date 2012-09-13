jQuery(function() {
    $("#modal_cliente").dialog({
        autoOpen:false,
        height:350,
        width:450,
        resizable:false,
        closeOnEscape:false,
        modal:true,
        buttons:{
            "Cerrar":function(){
                $(this).dialog("close");
            }
        }
    });
    $("#modal_contratante").dialog({
        autoOpen:false,
        height:350,
        width:450,
        resizable:false,
        closeOnEscape:false,
        modal:true,
        buttons:{
            "Cerrar":function(){
                $(this).dialog("close");
            }
        }
    });
    $("#modal_gerente").dialog({
        autoOpen:false,
        height:350,
        width:450,
        resizable:false,
        closeOnEscape:false,
        modal:true,
        buttons:{
            "Cerrar":function(){
                $(this).dialog("close");
            }
        }
    });
    $("#modal_supervisor").dialog({
        autoOpen:false,
        height:350,
        width:450,
        resizable:false,
        closeOnEscape:false,
        modal:true,
        buttons:{
            "Cerrar":function(){
                $(this).dialog("close");
            }
        }
    });
    $("#modal_proveedor").dialog({
        autoOpen:false,
        height:350,
        width:450,
        resizable:false,
        closeOnEscape:false,
        modal:true,
        buttons:{
            "Cerrar":function(){
                $(this).dialog("close");
            }
        }
    });
    /**
     * MODAL PARAMETROS PRESUPUESTO
     * DE VENTAS
     */
    $("#modal_contactos").dialog({
        autoOpen:false,
        height:350,
        width:450,
        resizable:false,
        closeOnEscape:false,
        modal:true,
        buttons:{
            "Cerrar":function(){
                $(this).dialog("close");
            }
        }
    });
    
    $("#div-firmas-1").dialog({
        autoOpen:false,
        height:300,
        width:750,
        resizable:false,
        closeOnEscape:false,
        modal:true,
        buttons:{
            "Agregar contactos":function() {
                $("#div-addcontactos").dialog("open");
            },
            "Asignar firmas a reportes":function() {
                $.ajax({
                    type:"GET",
                    dataType:"json",
                    url:"../../../dl/datos_obra/r_listareportes.php",
                    success:function(data){
                        $("#tblListaReportes td").remove();
                        $("#tblListaReportes tr").remove();
                        $("#tbl-empate-firmante_reporte td").remove();
                        
                        $.each(data,function(index,value) {
                            $("#tblListaReportes tbody").append(
                                '<tr>'+
                                '<td class="contactofirma">'+
                                '<input type="radio" name="reportes" value="'+data[index].id+'">'+
                                data[index].descripcion+
                                '<p class="descx" style="display:none">'+data[index].descripcion+'</p>'+
                                '</td>'+
                                '</tr>'
                             );
                        })
                    }
                })
                $("#modal-listareportes").dialog("open");
            },
            "Cerrar":function(){
                $(this).dialog("close");
            }
        }
    });
    $("#div-addcontactos").dialog({
        show:"blind",
        autoOpen:false,
        height:300,
        width:350,
        resizable:false,
        closeOnEscape:false,
        modal:true,
        buttons:{
            "Cerrar":function(){
                $(this).dialog("close");
            }
        }
     });
     
     // lista por nombres solamente de los contactos (aun no tiene puesto ni
     // mucho menos reporte
     $("#modal-addContacto").dialog({
        autoOpen:false,
        height:300,
        width:350,
        resizable:false,
        closeOnEscape:false,
        modal:true,
        buttons:{
            "Cerrar":function(){
                $(this).dialog("close");
            }
        }
    });
    
    // lista de reportes y contactos para empatarlos
    $("#modal-listareportes").dialog({
        show:"blind",
        autoOpen:false,
        height:600,
        width:650,
        resizable:false,
        closeOnEscape:false,
        modal:true,
        buttons:{
            "Agregar firmantes":function() {
                if($("input[name:'reportes']:radio").is(':checked')) {
                    limpiaPreviaTabla("reportes");
                    listaContactoPosicion();
                } else {
                    alert("Debe seleccionar un reporte de la lista");
                }
            },
            "Cerrar":function(){
                $(this).dialog("close");
            }
        }
     });
     
     /** FUNCION PARA EVITAR "N"PLICAR LOS DATOS
      ** AL MOSTRALOS EN EL MODAL QUE CONSULTA LAS TABLAS TEMPORALES **/
     function limpiaPreviaTabla(which_table)
     {
         switch(which_table)
         {
             case "reportes":
                 $("#tblr_listaContactoPosicion td").remove();
                 $("input[name=id_contactoReporte]").attr('checked',false);
                 break;
             case "opciones":
                 $("#tblr_listaUsuarioSistema td").remove();
                 $("input[name=id_usuarioOpcion]").attr('checked',false);
                 break;
         }
     }
  
     /** Lista de contactos que han sido agregados en el modal Firmas
      ** y que tienen un puesto en la abra definido                   
      **/
      function listaContactoPosicion()
      {
         $.ajax({
             type:"GET",
             dataType:"json",
             data:{
                 id_obra:$("#id_obra").val()
             },
             url:"../../../dl/datos_obra/r_listaContactoPosicion_tb_firma.php",
             success:function(data) {
                 $.each(data,function(index,value) {
                     $("#tblr_listaContactoPosicion tbody").append(
                        '<tr>'+
                        '<td>'+
                        data[index].txt_puesto+
                        '<td>'+
                        data[index].nombre_contacto+
                        '<td>'+
                        '<input type="checkbox" name="id_contactoReporte" id="idcontactoReporte" value="'+data[index].id_contacto+'"/>'+
                        '</tr>'    
                     )
                 });
             }
         });
         $("#modal_r_listaContactoPosicion").dialog("open");
     }
     
     $("#modal_r_listaContactoPosicion").dialog({
        show:"blind",
        autoOpen:false,
        height:350,
        width:550,
        resizable:false,
        closeOnEscape:false,
        modal:true,
        buttons:{
            "Cerrar":function() {
                $(this).dialog("close");
            }
        }
     });
})