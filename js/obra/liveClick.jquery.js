jQuery(function() {
    var id_reporte;
    
    /**
     * CLICK BUTTONS
     */
    
    /** Editar fecha de inicio */
    $("#btnModificaFechaInicio").live("click",function() {
        if ($(this).val() === "Modificar") {
            $(this).attr('value', 'Guardar');
            $(".txtfinicio").removeAttr('readonly');
            $(".txtfiniciodata").show();
            $(".txtfiniciodata").datepicker();
        } else {
            if ($(".txtfinicio").val() === "") {
                alert("La fecha de inicio esta en blanco, corrija por favor.");
            } else {
                $.ajax({
                    type:"POST",
                    url:"",
                    data:{

                    },
                    success:function() {
                        $(".txtfinicio").attr('readonly', 'true');
                    }
                });
            }
        }
    });
    /** Editar fecha de fin */
    $("#btnModificaFechaFin").live("click",function() {
        if ($(this).val() === "Modificar") {
            $(this).attr('value', 'Guardar');
            $(".txtffin").removeAttr('readonly');
        } else {
            if ($(".txtffin").val() === "") {
                alert("La fecha de fin esta en blanco, corrija por favor.");
            } else {
                $.ajax({
                    type:"POST",
                    url:"",
                    data:{

                    },
                    success:function() {
                        $(".txtffin").attr('readonly', 'true');
                    }
                });
            }
        }
    });
    /** Editar direccion de obra */
    $("#btnModificaDireccion").live("click",function() {
        if ($(this).val() == "Modificar") {
            $(this).attr('value','Guardar');
            $(".direccion").removeAttr('readonly');
        } else {
            if ($(".direccion").val() === "") {
                alert("Ingrese una direccion por favor.")
            } else {
                $.ajax({
                    type:"POST",
                    url:"../../../bl/DatosObra/editaObra_BL.php?parameter=editadireccion",
                    data:{
                        new_direccion:$(".direccion").val(),
                        id_obra:$("#id_obra").val()
                    },
                    success:function() {
                        $(".direccion").attr('readonly', 'true');
                        $("#btnModificaDireccion").val('Modificar');
                    }
                });
            }
        }
    });
    /** Edita departamento */
    $("#btnEditarDepartamento").live("click",function() {
        if($(this).val() == "Modificar") {
            $(this).attr('value', 'Guardar');
            $("#departamento").removeAttr('disabled');
        } else {
            $.ajax({
                type:"POST",
                data:{
                    new_departamento:$("#departamento").val(),
                    id_obra:$("#id_obra").val()
                },
                url:"../../../bl/DatosObra/editaObra_BL.php?parameter=editadepartamento",
                success:function(){
                    $("#departamento").attr('disabled','true');
                    $("#btnEditarDepartamento").attr('value', 'Modificar');
                }
            });
        }
    });
    /** Edita moneda */
    $("#btnEditarMoneda").live("click",function() {
        if ($(this).val() == 'Modificar') {
            $(this).attr('value','Guardar');
            $("#moneda").removeAttr('disabled');
        } else {
            $.ajax({
                type:"POST",
                data:{
                    new_moneda:$("#moneda").val(),
                    id_obra:$("#id_obra").val()
                },
                url:"../../../bl/DatosObra/editaObra_BL.php?parameter=editamoneda",
                success:function() {
                    $("#moneda").attr("disabled",'true');
                    $("#btnEditarMoneda").attr('value','Modificar');
                }
            })
        }
    });
    /** Edita Cliente */
    $("#btnModificaCliente").live("click",function() {
        if($(this).val() === "Modificar") {
            $(this).attr('value', 'Guardar');
            $("#modal_cliente").dialog("open");
        } else {
            if ($(".txtcliente").val() === "") {
                $(this).attr('value', 'Modificar');
            } else {
                $.ajax({
                   type:"POST",
                   url:"../../../bl/DatosObra/editaObra_BL.php?parameter=editacliente",
                   data:{
                       new_idcliente:$("#idcliente").val(),
                       id_obra:$("#id_obra").val()
                   },
                   success:function() {
                       $("#btnModificaCliente").attr('value', 'Modificar');
                   }
                });
            }
        }
    })
    /** Edita empresa contratante */
    $("#btnModificaContratante").live("click",function() {
        if($(this).val() === "Modificar") {
            $(this).attr('value', 'Guardar');
            $("#modal_contratante").dialog("open");
        } else {
            if ($(".txtcontratante").val() === "") {
                $(this).attr('value', 'Modificar');
            } else {
                $.ajax({
                   type:"POST",
                   url:"../../../bl/DatosObra/editaObra_BL.php?parameter=editacontratante",
                   data:{
                       new_idcontratante:$("#idcontratante").val(),
                       id_obra:$("#id_obra").val()
                   },
                   success:function() {
                       $("#btnModificaContratante").attr('value', 'Modificar'); 
                   }
                });
            }
        }
    })
    /** Edita empresa gerente de proyecto */
    $("#btnModificaGerente").live("click",function() {
        if($(this).val() === "Modificar") {
            $(this).attr('value','Guardar');
            $("#modal_gerente").dialog("open");
        } else {
            if($(".txtgerente").val() === "") {
                $(this).attr('value', 'Modificar');
            } else {
                $.ajax({
                   type:"POST",
                   url:"../../../bl/DatosObra/editaObra_BL.php?parameter=editagerente",
                   data:{
                       new_gerente:$("#idgerente").val(),
                       id_obra:$("#id_obra").val()
                   },
                   success:function() {
                       $("#btnModificaGerente").attr('value', 'Modificar');
                   }
                });
            }
        }
    })
    /** Edita empresa supervisora */
    $("#btnModificaSupervisor").live("click",function(){
        if($(this).val() === "Modificar"){
            $(this).attr('value', 'Guardar');
            $("#modal_supervisor").dialog("open");
        } else {
            if($(".txtsupervisor").val() === "") {
                $(this).attr('value', 'Modificar');
            } else {
                $.ajax({
                   type:"POST",
                   url:"../../../bl/DatosObra/editaObra_BL.php?parameter=editasupervisora",
                   data:{
                       new_supervisora:$("#idsupervidor").val(),
                       id_obra:$("#id_obra").val()
                   },
                   success:function() {
                       $("#btnModificaSupervisor").attr('value','Modificar');
                   }
                });
            }
        }
    })
    /** Presupuesto venta */
    $("#btnPPtoVenta").live("click",function() {
        if ($(this).val() == "Mostrar") {
            $("#div_pptoVenta").show();
            $("#btnPPtoVenta").attr('value', 'Ocultar');
        } else {
            $("#div_pptoVenta").hide();
            $("#btnPPtoVenta").attr('value', 'Mostrar');
        }
    });
    
    /** Edita proveedor a facturar */
    $("#btnModificaProveedor").live("click",function() {
        if($(this).val() === "Modificar"){
            $(this).attr('value', 'Guardar');
            $("#modal_proveedor").dialog("open");
        } else {
            if($(".txtproveedor").val() === "") {
                $(this).attr('value', 'Modificar');
            } else {
                $.ajax({
                   type:"POST",
                   url:"../../../bl/DatosObra/editaObra_BL.php?parameter=editaproveedor",
                   data:{
                       new_proveedor:$("#idproveedor").val(),
                       id_obra:$("#id_obra").val()
                   },
                   success:function() {
                       $("#btnModificaProveedor").attr('value', 'Modificar');
                   }
                });
            }
        }
    })
    
    /** PARAMETROS DE OBRA */
    /***********************/
    // carta fianza
    $("#btnModificaCartaFianza").live("click",function() {
        if ($("#btnModificaCartaFianza").val() === "Modificar") {
            $(".txtcartafianza").removeAttr('readonly');
            $("#btnModificaCartaFianza").attr('value', 'Guardar');
        } else {
            if($(".txtcartafianza").val() == "") {
                alert("Este campo deberia tener datos.");
            } else {
                $.ajax({
                    type:"POST",
                    url:"../../../bl/DatosObra/editaObra_BL.php?parameter=editacartafianza",
                    data:{
                       new_cartafianza:$(".txtcartafianza").val(),
                       id_obra:$("#id_obra").val()
                    },
                    success:function() {
                        $(".txtcartafianza").attr('readonly','true');
                        $("#btnModificaCartaFianza").attr('value', 'Modificar');
                    }
                })
            }
        }
    });
    // dias desembolso
    $("#btnModificarDiasHabiles").live("click",function() {
        if ($("#btnModificarDiasHabiles").val() === 'Modificar') {
            $(".txtdiashabiles").removeAttr('readonly');
            $("#btnModificarDiasHabiles").attr('value','Guardar');
        } else {
            if ($(".txtdiashabiles").val() == "") {
                alert("Este campo deberia tener datos.");
            } else {
                $.ajax({
                    type:"POST",
                    url:"../../../bl/DatosObra/editaObra_BL.php?parameter=editadiashabiles",
                    data:{
                        new_diashabiles:$(".txtdiashabiles").val(),
                        id_obra:$("#id_obra").val()
                    },
                    success:function() {
                        $(".txtdiashabiles").attr('readonly', 'true');
                        $("#btnModificarDiasHabiles").attr('value','Modificar');
                    }
                });
            }
        }
    });
    // fondo retencion
    $("#btnFondoRetencion").live("click",function() {
        if($("#btnFondoRetencion").val() === 'Modificar') {
            $(".txtfondoretencion").removeAttr('readonly');
            $("#btnFondoRetencion").attr('value', 'Guardar');
        } else {
            if ($(".txtfondoretencion").val() == "") {
                alert("Este campo deberia tener datos.");
            } else {
                $.ajax({
                    type:"POST",
                    url:"../../../bl/DatosObra/editaObra_BL.php?parameter=editafondoretencion",
                    data:{
                        new_fondoretencion:$(".txtfondoretencion").val(),
                        id_obra:$("#id_obra").val()
                    },
                    success:function() {
                        $(".txtfondoretencion").attr('readonly', 'true');
                        $("#btnFondoRetencion").attr('value','Modificar');
                    }
                });
            }
        }
    });
    // dias devolucion fondo retencion
    $("#btnDiasDevolucion").live("click",function() {
        if($("#btnDiasDevolucion").val() === 'Modificar') {
            $(".txtdiasdevolucion").removeAttr('readonly');
            $("#btnDiasDevolucion").attr('value', 'Guardar');
        } else {
            if ($(".txtdiasdevolucion").val() == "") {
                alert("Este campo deberia tener datos.");
            } else {
                $.ajax({
                    type:"POST",
                    url:"../../../bl/DatosObra/editaObra_BL.php?parameter=editadiasdevolucion",
                    data:{
                        new_diasdevolucion:$(".txtdiasdevolucion").val(),
                        id_obra:$("#id_obra").val()
                    },
                    success:function() {
                        $(".txtdiasdevolucion").attr('readonly', 'true');
                        $("#btnDiasDevolucion").attr('value','Modificar');
                    }
                });
            }
        }
    });

    /**
     * CLICK ROW MODALES
     */
    $(".cliente").live("click",function() {
        var cliente = $(this).text().split("-");
        $("#idcliente").val(cliente[0]);
        $(".txtcliente").val(cliente[1]);
    })
    $(".contratante").live("click",function() {
        var contratante = $(this).text().split("-");
        $("#idcontratante").val(contratante[0]);
        $(".txtcontratante").val(contratante[1]);
    })
    $(".gerenteproyecto").live("click",function() {
        var gerente = $(this).text().split("-");
        $("#idgerente").val(gerente[0]);
        $(".txtgerente").val(gerente[1]);
    })
    $(".supervisorproyecto").live("click",function() {
        var supervisor = $(this).text().split("-");
        $("#idsupervidor").val(supervisor[0]);
        $(".txtsupervisor").val(supervisor[1]);
    })
    $(".proveedorfacturar").live("click",function() {
        var proveedor = $(this).text().split("-");
        $("#idproveedor").val(proveedor[0]);
        $(".txtproveedor").val(proveedor[1]);
    })
    
    /** BUSCADORES IN LINE DE MODALES */
    $("#btnSearchCliente").live("click",function() {
        recargaCliente($("#txt_divClienteBuscar").val());
    });
    //EMPRESA CONTRATANTE
    $("#btnSearchEmpContratante").live("click",function() {
        recargaContratante($("#txt_divEmpContratanteBuscar").val());
    });
    //EMPRESA GERENTE DE PROYECTO
    $("#btnSearchGerenProyecto").live("click",function() {
        recargaGerente($("#txt_divGerenteProyectoBuscar").val());
    });
    // EMPRESA SUPERVISORA DEL PROYECTO
    $("#btnSearchEmpSupervisora").live("click",function() {
        recargaSupervisor($("#txt_divEmpSupervisoraBuscar").val());
    });
    // PROVEEDOR A FACTURAR
    $("#btnSearchProveedorfacturar").live("click",function() {
        recargaProveedor($("#txt_divProveedorFacturarBuscar").val());
    });
    
    /** PARAMETRO PPTO VENTAS */ 
    // Tipo de valorizacion
    $("#btnEditarTipoVal").live("click",function() {
        if ($(this).val()=="Modificar") {
            $(this).attr('value', 'Guardar');
            $("#tipoval").removeAttr('disabled');
        } else {
            $.ajax({
                type:"POST",
                data:{
                    id_tipoval:$("#tipoval").val(),
                    id_obra:$("#id_obra").val()
                },
                url:"../../../bl/DatosObra/editaObra_BL.php?parameter=editatipoval",
                success:function(){
                    $("#btnEditarTipoVal").attr('value','Modificar');
                    $("#tipoval").attr('disabled', 'true');
                }
            })
        }
    });
    // Formato presupuesto
    $("#btnEditarFormato").live("click",function() {
        if ($(this).val()=="Modificar") {
            $(this).attr('value', 'Guardar');
            $("#formato").removeAttr('disabled');
        } else {
            $.ajax({
                type:"POST",
                data:{
                    id_formato:$("#formato").val(),
                    id_obra:$("#id_obra").val()
                },
                url:"../../../bl/DatosObra/editaObra_BL.php?parameter=editaformato",
                success:function(){
                    $("#btnEditarFormato").attr('value','Modificar');
                    $("#formato").attr('disabled', 'true');
                }
            })
        }
    });
    // Parametros de punto de venta
    $("#btnFactorCorreccion, #btnFondoGarantia, #btnFielCumplimiento, #btnGastoGeneralPC, #btnUtilidadPC, #btnGastoGeneralOC, #btnUtilidadOC").live("click",function() {
        var myObj = $(this);
        var value_ ;
        var columna_ = "";
        
        if(myObj.val() == 'Modificar') {
            myObj.attr('value', 'Guardar');
            $(this).parent().parent().children().children("#inputext").removeAttr('readonly');
        } else {
            switch($(this).attr('id'))
            {
                case 'btnFactorCorreccion':
                    columna_ = "factorcorreccion";
                    value_ = $(this).parent().parent().children().children(".txtfactor").val();
                    break;
                case 'btnFondoGarantia':
                    columna_ = "retencionfondogarantia";
                    value_ = $(this).parent().parent().children().children(".txtfondogarantia").val();
                    break;
                case 'btnFielCumplimiento':
                    columna_ = "retencionfielcumplimiento";
                    value_ = $(this).parent().parent().children().children(".txtfielcumplimiento").val();
                    break;
                case 'btnGastoGeneralPC':
                    columna_ = "gastogeneral_precontra";
                    value_ = $(this).parent().parent().children().children(".txtggpc").val();
                    break;
                case 'btnUtilidadPC':
                    columna_ = "utilidad_precontra";
                    value_ = $(this).parent().parent().children().children(".txtupc").val();
                    break;
                case 'btnGastoGeneralOC':
                    columna_ = "gastogeneral_ordcamb";
                    value_ = $(this).parent().parent().children().children(".txtggoc").val();
                    break;
                case 'btnUtilidadOC':
                    columna_ = "utilidad_ordcamb";
                    value_ = $(this).parent().parent().children().children(".txtuoc").val();
                    break;    
                default:
                    break;
            }
            
            $.ajax({
                type:"POST",
                url:"../../../bl/DatosObra/editaObra_BL.php",
                data:{
                    parameter:"pptoventa",
                    value:value_,
                    id_obra:$("#id_obra").val(),
                    columna:columna_
                },
                success:function() {
                    myObj.attr('value','Modificar');
                    $(this).parent().parent().children().children("#inputext").attr('readonly','true');
                }
            })
        }
    });
    
    // PARA MOSTRAR Y AGREGAR CONTACTOS A LA OBRA
    $("#btnAddContacts").live("click",function() {
        $("#modal_contactos").dialog('open');
    });
    
    // PARA ELIMINAR CONTACTOS
    // tb_contacto
    $("#del-contacto").live("click",function(e) {
        e.preventDefault();
        idContacto = $(this).parent().parent().children().children("#idContacto").attr('value');
        // VERIFICAMOS SI EL CONTACTO SE ENCUENTRA EN LA TABLA tb_firma, si se encuentra en esta tabla
        // no podremos eliminarlo, si no se encuentra si podremos eliminarlo
        $.ajax({
            type:"GET",
            dataType:"text",
            url:"../../../bl/DatosObra/editaObra_BL.php?parameter=existecontacto_tb_firma",
            data:{
                id_obra:$("#id_obra").val(),
                id_contacto:idContacto
            },
            success:function(data){
                if (data == 0){
                    $(this).parent().parent().remove();
                    $.ajax({
                        type:"POST",
                        url:"../../../bl/DatosObra/editaObra_BL.php?parameter=eliminacontacto",
                        data:{
                            id_obra:$("#id_obra").val(),
                            id_contacto:idContacto
                        }
                    });
                } else {
                    alert("Este dato no puede ser eliminado ya que es un potencial firmante de reportes.");
                    return;
                }
            }
        });
    });
    
    // PARA AGREGAR UN NUEVO CONTACTO
    $("#contactos_boxes").live("click",function() {
        myContacto = $(this).val();
        $.ajax({
            data:{id:$(this).val()},
            type:"GET",
            dataType:"json",
            url:"../../../includes/query_repository/getAllContacto.php",
            success:function(data) {
                $.each(data,function(index,value) {
                    $("#contactos-agregados tbody").append(
                        '<tr>'+
                        '<td>'+
                        data[index].nombre+
                        '<td>'+
                        data[index].descripcion+
                        '<td>'+
                        data[index].cargo+
                        '<td>'+
                        data[index].email+
                        '<td>'+
                        data[index].ruc+
                        '<td>'+
                        data[index].fax+
                        '<td><a href="#" id="del-contacto" class="button delete">Eliminar</a>'
                    ),
                    $.ajax({
                        type:"POST",
                        data:{
                            id_obra:$("#id_obra").val(),
                            id_contacto:myContacto
                        },
                        url:"../../../bl/DatosObra/editaObra_BL.php?parameter=nuevocontacto"
                    });    
                });
            }
        });
    });
    
    /** ASIGNAR FIRMAS A REPORTES */
    // Primer modal para seleccionar contactos
    $("#btnAsignaFirmas").live("click",function() {
        $("#div-firmas-1").dialog('open');
    });
    // Eliminar contactos con puestos
    // ==============================
    $("#del-contactopuesto").live("click",function(e) {
        e.preventDefault();
        idContacto = $(this).parent().parent().children().children("#idContacto").attr('value');
        
        $.ajax({
            type:"GET",
            dataType:"text",
            url:"../../../bl/DatosObra/editaObra_BL.php?parameter=existecontactopuesto_tb_contactoreporte",
            data:{
                id_obra:$("#id_obra").val(),
                id_contacto:idContacto
            },
            success:function(data) {
                if (data == 0){
                    $(this).parent().parent().remove();
                    $.ajax({
                        type:"POST",
                        url:"../../../bl/DatosObra/editaObra_BL.php?parameter=eliminacontactopuesto",
                        data:{
                            id_obra:$("#id_obra").val(),
                            id_contacto:idContacto
                        }
                    });
                } else {
                    alert("Este dato no puede ser eliminado ya que se encuentra asociado a uno o mas reportes.")
                }
            }
        })
        
        
    });
    
    // Abrir lista de contactos (solo mostrando el nombre)
    $("#btn-addContacto").live("click",function(){
        $("#modal-addContacto").dialog("open");
        $.ajax({
            type:"GET",
            dataType:"json",
            data:{
                id_obra:$("#id_obra").val()
            },
            url:"../../../dl/datos_obra/r_listacontactosporobra.php",
            success:function(data) {
                $.each(data,function(index,value){
                    $("#tblAddContacto tbody").append(
                        '<tr style="cursor:pointer;">'+
                        '<td class="contactofirma">'+
                        '<p style="display:none">'+data[index].id+"</p>"+
                        '<p style="display:none">-</p>'+
                        '<a id="agregar-contacto_modal" href="#" style="text-decoration:none;">'+data[index].nombre+'</a>'+
                        '<p style="display:none">-</p>'+
                        '<p style="display:none">'+data[index].nombre+'</p>'+
                        '</td>'+
                        '</tr>'
                    )
                });
                $("#modal-addContacto").dialog("open");
            }
        })
    });
    
    $(".contactofirma").live("click",function() {
        dataArray = $(this).text().split("-");
        $(".txt-idcontacto").val(dataArray[0]);
        $(".txt-contacto").val(dataArray[1]);
        $(".txt-compania").val(dataArray[2]);
        $("#modal-addContacto").dialog("close");
    })
    
    $("#btn-agregarContacto").live("click",function() {
        if ($(".txt-puesto").val() == ""){
             alert("¡No has ingresado el puesto del contacto!");
             $(".txt-puesto").focus();
         }
         if ($(".txt-contacto").val() == "" || $(".txt-compania").val() == ""){
             alert("¡No has seleccionado contacto alguno!");
             $(".txt-contacto").focus();
         }
         
         $.ajax({
             type:"POST",
             data:{
                 idContacto:$(".txt-idcontacto").val(),
                 puesto:$(".txt-puesto").val(),
                 id_obra:$("#id_obra").val()
             },
             url:"../../../bl/DatosObra/editaObra_BL.php?parameter=agregarcontactopuesto",
             success:function(){
                 $("#addcontactos").close("dialog"); 
                 $("#tbl-firmas1 tbody").append(
                    "<tr>"+
                    '<td>'+
                    data[index].posicion+
                    '<td>'+
                    data[index].nombre+
                    '<td>'+
                    data[index].descripcion+
                    '<input type="hidden" id="idContacto" value="'+data[index].id+'" />'+
                    '<td><a href="#" id="del-contactopuesto" class="button delete">Eliminarg</a>'  
                );
             }
         });
    });
    
    $("input[name=id_contactoReporte]").live("click",function() {
        $.ajax({
            type:"POST",
            data:{
                idcontacto:$(this).val(),
                idreporte:getIdReporte(),
                id_obra:$("#id_obra").val()
            },
            url:"../../../bl/DatosObra/editaObra_BL.php?parameter=empatacontactoreporte",
            success:function() {
                $.ajax({
                    type:"GET",
                    dataType:"json",
                    data:{
                        idreporte:getIdReporte()
                    },
                    url:"../../../dl/datos_obra/r_listafirmasreportes_tb_firma.php",
                    success:function(data) {
                        $("#tbl-empate-firmante_reporte td").remove();
                        $.each(data,function(index,value){
                            $("#tbl-empate-firmante_reporte tbody").append(
                                '<tr>'+
                                '<td>'+
                                data[index].posicion+
                                '<td>'+
                                data[index].nombre_contacto+
                                '<td>'+
                                data[index].nombre_compania+
                                '<td>'+
                                '<input type="text" name="txtpos_firma_reporte" id="pos_firma_reporte" value="" />'+
                                '<input type="hidden" id="id_contacto" value="'+data[index].id_contacto+'" />'+
                                "<td><a href='#' id='del-contacto_reporte' class='button delete'>Eliminar</a></td>"
                            )
                        })
                    }
                })
            }
        })
    });
    
    /** Consultar que contactos han sido empatados con que reportes */
    /** =========================================================== */
    $("input[name='reportes']").live("click",function(e) {
        $("#tbl-empate-firmante_reporte td").remove();
        setIdReporte($(this).val());
        $.ajax({
            type:"GET",
            dataType:"json",
            data:{
                idreporte:getIdReporte()
            },
            url:"../../../dl/datos_obra/r_listafirmasreportes_tb_firma.php",
            success:function(data) {
                $.each(data,function(index,value){
                    $("#tbl-empate-firmante_reporte tbody").append(
                        '<tr>'+
                        '<td>'+
                        data[index].posicion+
                        '<td>'+
                        data[index].nombre_contacto+
                        '<td>'+
                        data[index].nombre_compania+
                        '<td>'+
                        '<input type="text" name="txtpos_firma_reporte" id="pos_firma_reporte" value="" />'+
                        '<input type="hidden" id="id_contacto" value="'+data[index].id_contacto+'" />'+
                        "<td><a href='#' id='del-contacto_reporte' class='button delete'>Eliminar</a></td>"
                    )
                })
            }
        })
    });
    /** Almacenar temporalmente la seleccion del reporte */
    function setIdReporte(idreporte) {
        id_reporte = idreporte;
    }
    
    function getIdReporte() {
        return id_reporte;
    }
})