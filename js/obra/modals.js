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
})