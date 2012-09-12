jQuery(function() {
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
    // 
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
        
        
        
    })
})