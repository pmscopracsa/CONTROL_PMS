<?php
session_start();

/**
 * VARIABLE ALEATORIA QUE NOS SERVIRA PARA
 * LA ELIMINACION DE LA TABLA TEMPORAL EN LAS SIGUIENTES SITUACIONES:
 * abandonar la pagina y|o recargar la paginay no dejar datos huerfanos
 * darle al boton eliminar en el formulario 
 */
mt_srand(time());
$aleatorio = mt_rand(1, 250);
$_SESSION['aleatorio'] = $aleatorio;

$CSS_PATH = '../../css/';
$css = array();
$css = scandir($CSS_PATH);

function __autoload($name) {
    $fullpath = '../../dl/contacto_bl/'.$name.'.php';
    if (file_exists($fullpath))        require_once ($fullpath);
    
    $fullpath_procura = '../../dl/procura_dl/'.$name.'.php';
    if (file_exists($fullpath_procura)) require ($fullpath_procura); 
}

//$especialidadCompania = new EspecialidadCompaniaDL();
//$especialidades = $especialidadCompania->mostrarEspecialidades();

$clienteCompania = new CompaniaContactoDL();
//$clientes = $clienteCompania->mostrarCompaniaContacto();

//$empresa_contacto = $clienteCompania->mostrarEmpresaContacto();
$empresa_contacto = $clienteCompania->mostrarContactosTemporal();

//$contactoPersona = new ContactoPersona();
//$contactos = $contactoPersona->mostrarContactos();

/**
 *AUTOLOAD DE MODELOD DE CARTA Y CONTRATO 
 */
$modelos = new ProcuraDL();
$cartas = $modelos->mostrarCartas();
$contratos = $modelos->mostrarContratos();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>REGISTRAR DATOS DE OBRA</title>
        <?php
        foreach($css as $value) {
            if ($value === '.' || $value === '..'){continue;}
            echo '<link href="../../css/'.$value.'" rel="stylesheet" type="text/css" />'; 
        }
        ?>
        <!-- ZONA JS -->
        <script src="../../js/jquery1.4.2.js.js" type="text/javascript"></script>
        <script src="../../js/jquery.qtip-1.0.0-rc3.min.js" type="text/javascript"></script>
        <script src="../../js/calendar/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
        <script src="../../js/calendar/jquery.ui.datepicker-es.js" type="text/javascript"></script>
        <script src="../../js/cargarDatos.js" type="text/javascript"></script>
        <script src="../../js/jquery-tooltip/js/jtip.js" type="text/javascript"></script>
        <script src="../../js/monedas_formato.js" type="text/javascript"></script>
        <link href="../../js/jquery-tooltip/css/global.css" rel="stylesheet" type="text/css" />
        
        <script>
            
        /**
         * FUNCIONES DE RECAR SIN PARAMETROS (PARA LIMPIAR) Y CON PARAMETRO PARA FILTRAR LISTA
         **/    
        function recargarClientes() {
            $("#divSeleccionaCliente").load("modales/clientes_div.php?filtro=1");
        }   
        function recargarClientesPorFiltro(filtro) {
            $("#divSeleccionaCliente").load("modales/clientes_div.php?filtro="+filtro);
        }
        function recargarEmpresaContratante() {
            $("#divSeleccionaEmpContratante").load("modales/empcontratante_div.php?filtro=1");
        }
        function recargarEmpresaContratantePorFiltro(filtro) {
            $("#divSeleccionaEmpContratante").load("modales/empcontratante_div.php?filtro="+filtro)
        }
        
        function recargarEmpGerenteProyecto() {
            $("#divSeleccionaEmpGerenteProyecto").load("modales/empgerproyecto_div.php?filtro=1");
        }
        function recargarEmpGerenteProyectoPorFiltro(filtro) {
            $("#divSeleccionaEmpGerenteProyecto").load("modales/empgerproyecto_div.php?filtro="+filtro);
        }
        function recargarEmpSupervisoraProyecto() {
            $("#divSeleccionaEmpSupProyecto").load("modales/empsupproyecto_div.php?filtro=1");
        }
        function recargarEmpSupervisoraProyectoPorFiltro(filtro) {
            $("#divSeleccionaEmpSupProyecto").load("modales/empsupproyecto_div.php?filtro="+filtro);
        }
        function recargarProveedorFacturar() {
            $("#divSeleccionaProvFacturar").load("modales/proveedorfacturar_div.php?filtro=1");
        }
        function recargarProveedorFacturarPorFiltro(filtro) {
            $("#divSeleccionaProvFacturar").load("modales/proveedorfacturar_div.php?filtro="+filtro)
        }
        function recargarContactos() {
            $("#modal-contactos").load("modales/contactos_div.php?filtro=1");
        }
        function recargarContactosPorFiltro(filtro) {
            $("#modal-contactos").load("modales/contactos_div.php?filtro="+filtro);
        }
        
        $(document).ready(function(){
            /**
             * CARGAR DATOS DE LA OBRA QUE YA FUE CREADA POR EL ADMINISTRADOR EL SISTEMA
             */ 
//            $(".txtCodigo").val(<?=$_REQUEST['codigo']?>);
//            $(".txtDescripcion").val(<?=$_REQUEST['descripcion']?>);
//            $.ajax({
//                type:"GET",
//                url:"../../bl/DatosObra/datosObra_BL.php?parameter=cargarDatosIniciales",
//                data:{
//                    id_obra:<?=$_REQUEST['obra']?>
//                },
//                success:function(data) {
//                    $.each(data,function(index,value) {
//                        alert(data[index].descripcion);
//                    });
//                },
//                error:function() {
//                    alert("Error");
//                }
//            });
            
            /**
             * PONER LOS LIMITES INFERIOS Y SUPERIOR EN LOS MONTOS A CONTRATAR
             * Y SUS SIMBOLOS MONETARIOS RESPECTIVAMENTE, PRIMERO
             * DETECTAR CON QUE MONEDA SE VA A TRABAJAR
             */
            //$("#moneda-id").change(function() {
                /**
                 * PRIMERO NOS FIJAMOS SI YA EXISTEN MONTOS
                 * EN LAS CAJAS DE TEXTO, SI EXISTE NOS FIJAMOS QUE
                 * MONEDA HEMOS SELECCIONADO 
                 *//*
                if($(".txtmayora").val()!="") {
                    if($("#moneda-id").val()=="Dolares") {
                        $(".txtmayora").val(formatNumber($(".txtmayora").val(),"$"));
                    } else {
                        $(".txtmayora").val(formatNumber($(".txtmayora").val(),"S/."));
                    }
                }
            });*/
            
            $(".txtmayora").focusout(function() {
                var moneda;
                //alert($("#moneda-id option:selected").text());
                if ($("#moneda-id option:selected").text() == "Dolares")
                    moneda = "$";
                else
                    moneda = "S/.";
                
                // PONIENDO EL VALOR
                $("#txt_sfmontomayora").val($(".txtmayora").val());
                $(".txtmayora").val(formatNumber($(".txtmayora").val(), moneda));
                $(".txtlimiteinferior").val($(".txtmayora").val());
            });
            $(".txtmenora").focusout(function() {
                var moneda;
                if ($("#moneda-id option:selected").text() == "Dolares")
                    moneda = "$";
                else
                    moneda = "S/.";
                
                $("#txt_sfmonotmenora").val($(".txtmenora").val());
                $(".txtmenora").val(formatNumber($(".txtmenora").val(), moneda));
                $(".txtlimitesuperior").val($(".txtmenora").val());
            });
            /**
             * PONER EL SIMBOLO DE PORCENTAJE 
             */
            $(".txtcartafianza_p").focusout(function() {
                $("#txt_sfcartafianza").val($(".txtcartafianza_p").val());
                $(".txtcartafianza_p").val($(".txtcartafianza_p").val()+'%');
            });
            $(".txtfondoretencion_p").focusout(function() {
                $("#txt_sffondoretencion").val($(".txtfondoretencion_p").val());
                $(".txtfondoretencion_p").val($(".txtfondoretencion_p").val()+'%');
            });
            /**
             * VALIDAR QUE LOS DIAS SEAN NUMEROS ENTEROS
             */
            $(".txtdiasdesembolso").focusout(function() {
                if($(".txtdiasdesembolso").val() % 1 != 0) {
                    alert("Este valor debe ser un entero, Se redondeará.");
                    $(".txtdiasdesembolso").val(Math.round($(".txtdiasdesembolso").val()));
                }
            });
            $(".txtdiasdevolucion").focusout(function() {
                if($(".txtdiasdevolucion").val() % 1 != 0) {
                    alert("Este valor debe ser un entero, Se redondeará.");
                    $(".txtdiasdevolucion").val(Math.round($(".txtdiasdevolucion").val()));
                }
            });
            
            /**
             * CARGAR DIV CON DATOS Y PREPARAOS PARA BUSCARLOS
             * CARGA POR DEFECTO SIN FILTRO - PRIMERA CARGA
             */
            $("#divSeleccionaCliente").load("modales/clientes_div.php?filtro=1");
            $("#divSeleccionaEmpContratante").load("modales/empcontratante_div.php?filtro=1");
            $("#divSeleccionaEmpGerenteProyecto").load("modales/empgerproyecto_div.php?filtro=1");
            $("#divSeleccionaEmpSupProyecto").load("modales/empsupproyecto_div.php?filtro=1");
            $("#divSeleccionaProvFacturar").load("modales/proveedorfacturar_div.php?filtro=1");
            $("#modal-contactos").load("modales/contactos_div.php?filtro=1");
            $("#modal_usuariosempresa").load("modales/usuarios_div.php?filtro=1");
            
            /**
             * ELIMINAR DATOS DE LA TABLA TEMPORAL SI SE DETECTA
             * RECARGA DE LA PAGINA, EL VALOR ALEATORIO IDENTIFICAR 
             * LA SESSION DE CADA USUARIO
             */
            $(window).bind('beforeunload', function() {
                var aleatorio = <?=$aleatorio?>;
                $.ajax({
                    type:"POST",
                    data:{aleatorio:aleatorio},
                    url:"../../dl/datos_obra/truncate_temporal.php"
                });
            });
            
            /**
             * CONTADOR PARA LOS CONTACTOS
             */
            var contador_contactos = 0;
            var contador_firmas = 0;
            var contador_puesto = 0;
            var contador_contacto = 0;
            var Contador_empresa = 0;
            var contador_usuarios = 0;
            
            /**
             * FECHAS DE INICIO Y FIN DE OBRA
             */
            $(".fecha_desde").datepicker({
                defaultDate:"+1w",
                changeMonth:true,
                numberOfMonths:1,
                dateFormat:"yy-mm-dd",
                changeMonth:true,
                changeYear:true,
                onSelect:function(selectedDate) {
                    $(".fecha_hasta").datepicker("option","minDate",selectedDate);
                }
            });
            $(".fecha_hasta").datepicker({
                defaultDate:"+1w",
                changeMonth:true,
                numberOfMonth:1,
                dateFormat:"yy-mm-dd",
                changeMonth:true,
                changeYear:true,
                onSelect:function(selectedDate) {
                    $(".fecha_desde").datepicker("option","maxDate",selectedDate);
                }
            });
            //$("#datepicker_i,#datepicker_f").datepicker({dateFormat:'yy-mm-dd'},{showAnim:'fold'});
            
            /**
             * BOTONES PARA ABRIR MODALES PADRES
             * =================================
             * BOTON PARA ABRIR EL MODAL DE SELECCION DE LOS CLIENTES
             * 
             **/
            // BOTON: "Buscar Contactos"
            // MODAL: "Selecciona los contactos de la obra"
            // DESC.: Lista los contactos a ser seleccionados, uno por uno con un checkbox
            $("#mostrarcontactos").click(function(){
                $("#modal-contactos").dialog("open");
            });
            
            $("#agregar-cliente").click(function() { // MODAL PARA SELECCIONAR A LOS CLIENTES
                $("#divSeleccionaCliente").dialog("open");
            })
            
            $("#modal-cliente").dialog({
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
            
            $("#agregar-contratante").click(function() {
//                $("#modal-contratante").dialog("open");
//                return false;
                $("#divSeleccionaEmpContratante").dialog("open");
            });
            
            $("#modal-contratante").dialog({
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
            
            $("#agregar-gerenteproyecto").click(function() {
//                $("#modal-gerenteproyecto").dialog("open");
//                return false;
                $("#divSeleccionaEmpGerenteProyecto").dialog("open");
            })
            
            $("#modal-gerenteproyecto").dialog({
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
            
            $("#agregar-supervisorproyecto").click(function() {
                $("#divSeleccionaEmpSupProyecto").dialog("open");
            })
            
            $("#modal-supervisorproyecto").dialog({
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
            
            $("#agregar-proveedorfacturar").click(function() {
//                $("#modal-proveedorfacturar").dialog("open");
//                return false;
                $("#divSeleccionaProvFacturar").dialog("open");
            })
            
            $("#modal-proveedorfacturar").dialog({
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
             * MODAL PRESUPUESTO VENTA
             */
            $("#btn-parametrospptoventa").click(function(){
                $("#div-modal-pptoventa").dialog("open");
            }); 
            var ppto_venta = $("#div-modal-pptoventa").dialog({
                autoOpen:false,
                heigh:950,
                width:550,
                resizable:false,
                closeOnEscape:false,
                modal:true,
                buttons:{
                    "Cerrar":function(){
                        $(this).dialog("close");
                    }
                }
            });ppto_venta.parent().appendTo($("#frm_datosobra")); 
            
            /**
             * MODAL ASIGNAR USUARIOS PARA APROBACION
             */
             $("#usuarios-aprobacion").click(function(){
                //$("#modal_usuariosempresa").dialog("open");
                $("#div-modal-asigna_aprobacion").dialog("open");
             });
             
             //DIALOG - PRIMER FILTRO (USUARIOS APROBACION)
             
             
             /**
              * DETECTA SELECCION EN CHECKBOX DE SUPER OPCIONES RELACIONADAS CON ALGUN USUARIO
              */
             $('#chk_cambiarid').live("click",function() {
                 alert($(this).parent().parent().html());
             });
             
             $("#div-modal-asigna_aprobacion").dialog({
                 autoOpen:false,
                 heigh:500,
                 width:350,
                 resizable:false,
                 closeOnEscape:false,
                 modal:true,
                 buttons:{
                     "Seleccionar usuarios":function() {
                        $("#modal_usuariosempresa").dialog("open");
                     },
                     "Asignar opciones":function() {
                         $.ajax({
                             type:"GET",
                             dataType:"json",
                             data:{aleatorio:<?=$aleatorio?>},
                             url:"../../dl/datos_obra/r_listaopciones.php",
                             success:function(data) {
                                mostrarEmpatarUsuariosOpciones(data);
                             }
                         });
                         $("#modal-listaopciones").dialog("open");
                     },
                     "Cerrar":function(){
                         $(this).dialog("close");
                     }
                 }
             });
             function mostrarEmpatarUsuariosOpciones(data) {
                $("#tblListaOpciones td").remove(); 
                $("#tblListaOpciones tr").remove();
                $("#tbl-empate-usuario_opcion td").remove();
                $.each(data,function(index,value) {
                    $("#tblListaOpciones tbody").append(
                        "<tr>"+
                        '<td class="usuarioopcion">'+
                        '<input type="radio" name="opciones" value="'+data[index].id+'">'+
                        data[index].descripcion+
                        '<p class="descxdescripcion" style="display:none">'+data[index].descripcion+'</p>'+
                        '</td>'+
                        '</tr>'
                    );
                });
             }
             
             /**
              * MODAL MODELO DE CARTA DE ADJUDICACION Y CONDICIONES GENERALES
              */
             $("#btn-modelocartaadjudicacion").click(function(){
                $("#div-modal-modelocartaadjudicacion").dialog("open");
                return false;
             }); 
             $("#div-modal-modelocartaadjudicacion").dialog({
                 autoOpen:false,
                 height:500,
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
              
             /**
              * MODAL MODELO DE CONTRATO 
              */
             $("#btn-modelocartacontrato").click(function(){
                $("#div-modal-modelocartacontrato").dialog("open");
                return false;
             }); 
             $("#div-modal-modelocartacontrato").dialog({
                 autoOpen:false,
                 height:500,
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
            
            /**
             * MODALES PARA LA ASIGNACION DE FIRMAS
             * ====================================
             */
             // BOTON: ...
             // MODAL: Firmas
             // DESC.: Este modal nos permitirá seleccionar a los firmantes. 
             // Al seleccionar a un contacto, seleccionaremos automaticamente: Puesto, Contacto y Empresa
             $("#btn-asignarfirmasreportes").click(function(){
                $("#div-firmas-1").dialog("open");
             });
             $("#div-firmas-1").dialog({
                 autoOpen:false,
                 height:300,
                 width:750,
                 resizable:false,
                 closeOnEscape:false,
                 modal:true,
                 buttons:{
                     "Agregar contactos":function(){
                         $("#div-addcontactos").dialog("open");
                     },
                     "Asignar firmas a reportes ":function(){
                         var aleatorio = <?=$aleatorio?>;
                         $.ajax({
                             type:"GET",
                             dataType:"json",
                             data:{aleatorio:aleatorio},
                             url:"../../dl/datos_obra/r_listareportes.php",
                             success:function(data) {
                                 mostrarEmpatarFirmasPersonas(data);
                             }
                         });
                         $("#modal-listareportes").dialog("open");
                     },
                     "Cerrar":function(){
                         $(this).dialog("close");
                     }
                 }
             });
             // MODAL: Asignar firmas a reportes
             // DESC.: Modal que nos mostrará la lista de los documentos a firmar
             // Se selecciona un documento y se selecciona 1 o más contactos a firmar en dicho documento.
             function mostrarEmpatarFirmasPersonas(data)
             {
                 $("#tblListaReportes td").remove();
                 $("#tblListaReportes tr").remove();
                 $("#tbl-empate-firmante_reporte td").remove();
                 //$("#tbl-empate-firmante_reporte tr").remove();
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
                 });
             }
             
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
             
             /**
              * DETECTAR CLICK EN UN RADIO BUTTON (REPORTE) Y HACER LA CONSULTA
              * DE QUE SI EXISTE O AUN NO "ALGUN USUARIO O USUARIOS EMPATADOS
              * CON DICHO REPORTE
              **/
              $("input[name='reportes']").live("click",function(e) {
                  setReporte($("input[name='reportes']:checked").val());
                  var checked = $("input[name='reportes']:checked").val();
                  var aleatorio = <?=$aleatorio?>;
                  $.ajax({
                      type:"GET",
                      dataType:"json",
                      data:{checked:checked,aleatorio:aleatorio},
                      url:"../../dl/datos_obra/r_listafirmasreportes.php",
                      success:function(data){
                          mostrarFirmasAsignadas(data);
                      }
                  });
              });
              /**
               * DETECTAR CLICK EN UN RADIO BUTTON (OPCION) Y HACER LA CONSULTA
               * DE QUE SI EXISTE O AUN NO "ALGUN USUARIO DEL SISTEMA" EMPATADO
               * CON UNA OPCI0ON DE LA LISTA
               */
              $("input[name='opciones']").live("click",function(e) {
                  setOpcion($("input[name='opciones']:checked").val());
                  $.ajax({
                      type:"GET",
                      dataType:"json",
                      data:{id_opcion:$("input[name='opciones']:checked").val(), id_aleatorio:<?=$aleatorio?>},
                      //url:"../../dl/datos_obra/r_listausuariosopciones.php",
                      url:"../../dl/datos_obra/r_usuariosopciontemporal.php",
                      success:function(data){
                          mostrarOpcionesAsignadas(data);
                      }
                  })
              })
              
              /**
               * GETTER Y SETTER DEL REPORTE A USAR EN EL MODAL: FIRMAS
               **/
              var reporte = "";
              function setReporte(reporte_x) {
                reporte = reporte_x;
              }
              function getReporte() {
                  return reporte;
              }
              var opcion = "";
              function setOpcion(opcion_x) {
                  opcion = opcion_x;
              }
              function getOpcion() {
                  return opcion;
              }
              /**
               * MODAL: ASIGNAR FIRMAS A REPORTES
               * DESCRIPCION: FUNCION QUE AL DARLE CLICK SOBRE UN RADIO BUTTON
               * SE HACE LA CONSULTA PARA SABER QUE USUARIOS ESTAN EMPATADOS
               * CON EL REPORTE SELECCIONADO
               */
              function mostrarFirmasAsignadas(data)
              {
                 $("#tbl-empate-firmante_reporte td").remove();
                  $.each(data,function(index,value) {
                      $("#tbl-empate-firmante_reporte tbody").append(
                        "<tr>"+
                        "<td>"+
                        data[index].posicion+
                        "</td>"+
                        "<td>"+
                        data[index].nombre_contacto+
                        "</td>"+
                        "<td>"+
                        data[index].nombre_compania+
                        "</td>"+
                        "<td>"+
                        '<input type="text" name="txtpos_firma_reporte" id="pos_firma_reporte" value="'+data[index].numero_posi+'">'+
                        "</td>"+
                        "<td><a href='#' id='del-contacto_reporte' class='button delete'>Eliminarr</a></td>"+
                        "<td>"+
                        '<p id="id_contacto" style="display:none">'+data[index].id_contacto+"</p>"+
                        "</td>"+
                        "</tr>"    
                      )
                  });
              }
              /**
               * MODAL: ASIGNAR OPCIONES A USUARIOS
               * DESCRIPCION: FUNCION QUE AL DARLE CLICK A UN RADIO BUTTON DE ALGUNA OPCION
               * NOS MUESTRA LOS USUARIOS O USUARIO EMPATADO CON DICHA OPCION
               */
              function mostrarOpcionesAsignadas(data)
              {
                  $("#tbl-empate-usuario_opcion td").remove(); //->modal-mostraropcionesusuarios.php
                  $.each(data,function(index,value) {
                      $("#tbl-empate-usuario_opcion tbody").append(
                        "<tr>"+
                        "<td>"+
                        data[index].nombre+
                        "</td>"+
                        "<td>"+
                        data[index].nombreusuario+
                        "</td>"+
                        "<td><a href='#' id='del-asignar_opciones_usuarios' class='button delete'>Eliminar</a></td>"+
                        "<td>"+
                        '<p style="display:none">'+data[index].id+"</p>"+
                        "</td>"+
                        "</tr>"
                      )
                  });
              }
              
              /**
               * ELIMINAR A USUARIO EMPATADO CON OPCION
               */
              $("#del-asignar_opciones_usuarios").live("click",function(e){
                  var value = $(this).parent().parent().html();
                  //alert(value);
                  //alert(getOpcion());
                  var matches = value.match(new RegExp("(\\d+)","gi"));
                  //alert(matches);
                  e.preventDefault();
                  $(this).parent().parent().remove();
                  
                  $.ajax({
                      data:{id:matches[0], aleatorio:<?=$aleatorio?>,id_opcion:getOpcion()},
                      type:"POST",
                      url:"../../dl/datos_obra/d_eliminarusuariosopciontemporal.php"
                  });
              });
              
              /**
               *  COLOCARLE EL NUMERO DE POSICION DE LA FIRMA 
               **/
              $("#pos_firma_reporte").live("focusout",function() {
//                alert($(this).val());
                    var td_padre = $(this).parent().parent().html();
                    var matches = td_padre.match(new RegExp("\\d+","gi"));
//                    alert(td_padre);
//                    alert(matches[1]);
                  $.ajax({
                        data:{aleatorio:<?=$aleatorio?>,posi_reporte:$(this).val(),reporte:getReporte(),id_contacto:matches[1]},
                        type:"POST",
                        url:"../../dl/datos_obra/i_posicionfirmareporte.php"
                   });
              }); 

             /**
              * EMPATAR REPORTES Y FIRMANTES
              */
             $("#modal-listareportes").dialog({
                show:"blind",
                autoOpen:false,
                height:600,
                width:650,
                resizable:false,
                closeOnEscape:false,
                modal:true,
                buttons:{
                    "Agregar firmantes":function() {//SELECCIONAR DATOS DE LA TABLA -> tb_firmascontactotemporal
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
             /**
              * ASIGNAR OPCIONES A USUARIOS
              * ===========================
              */
              $("#modal-listaopciones").dialog({
                show:"blind",
                autoOpen:false,
                height:350,
                width:400,
                resizable:false,
                closeOnEscape:false,
                modal:true,
                buttons:{
                    "Agregar usuarios":function() {
                        if($("input[name:'opciones']:radio").is(':checked')) {
                            limpiaPreviaTabla("opciones");
                            listaUsuarios();
                        } else {
                            alert("Debe seleccionar una opci\xf3n de la lista");
                        }
                    },
                    "Cerrar":function() {
                        $(this).dialog("close");
                    }
                }
              });
             
             /**
              * FUNCION PARA EVITAR "N"PLICAR LOS DATOS
              * AL MOSTRALOS EN EL MODAL QUE CONSULTA LAS TABLAS TEMPORALES
              **/
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
             
             /**
              * MODAL: Firmas
              * DESC.: Ya habiendo seleccionado un reporte se empata con un contacto
              */
             function listaContactoPosicion()
             {
                 var aleatorio = <?=$aleatorio?>;
                 // Se consulta a tabla tb_firmascontactotemporal
                 // en caso de exito llama al modal: modal_r_listaContactosPosicion
                 $.ajax({
                     type:"GET",
                     dataType:"json",
                     data:{aleatorio:aleatorio,reporte:getReporte()},
                     url:"../../dl/datos_obra/r_listaContactoPosicion.php",
                     success:function(data) {
                         $.each(data,function(index,value) {
                             $("#tblr_listaContactoPosicion tbody").append(
                                '<tr>'+
                                '<td>'+
                                data[index].txt_puesto+
                                '</td>'+
                                '<td>'+
                                data[index].nombre_contacto+
                                '</td>'+
                                '<td>'+
                                '<input type="checkbox" name="id_contactoReporte" value="'+data[index].id_contacto+'"/>'+
                                '</td>'+
                                '</tr>'    
                             )
                         });
                     }
                 });
                 $("#modal_r_listaContactoPosicion").dialog("open");
             }
             
             /**
              * MODAL: Usuarios 
              */
              function listaUsuarios()
              {
                  $.ajax({
                      type:"GET",
                      dataType:"json",
                      data:{aleatorio:<?=$aleatorio?>,opcion:getOpcion()},
                      url:"../../dl/datos_obra/r_listaUsuariosSistemaTemporal.php",
                      success:function(data) {
                          $.each(data,function(index,value){
                            $("#tblr_listaUsuarioSistema tbody").append(
                                '<tr>'+
                                '<td>'+
                                data[index].nombre+
                                '</td>'+
                                '<td>'+
                                data[index].nombreusuario+
                                '</td>'+
                                '<td>'+
                                '<input type="checkbox" name="id_usuarioOpcion" value="'+data[index].id_usuario+'"/>'+
                                '</td>'+
                                '</tr>'
                            )
                          });
                      }
                  });$("#modal_r_listaUsuarioSistema").dialog("open");
              }
              
             /**
              * DETECTA CLICK EN MODAL FIRMAS: QUE ES DONDE SE EMPATAN LOS REPORTES Y LOS CONTACTOS
              * LOS DATOS SE INGRESAN A LA TABLA: tb_contactoreportetemporal
              */
             $("input[name=id_contactoReporte]").live("click",function() {
                $.ajax({
                    type:"POST",
                    data:{aleatorio:<?=$aleatorio?>,id_contacto:$(this).val(),id_reporte:getReporte()},
                    url:"../../dl/datos_obra/i_contactoreportetemporal.php",
                    success:function() {
                         // SI SE HA TENIDO EXITO INGRESANDO A LA DDBB ACTUALIZAR EL DIV
                        $.ajax({
                            type:"GET",
                            dataType:"json",
                            data:{checked:getReporte(),aleatorio:<?=$aleatorio?>},
                            url:"../../dl/datos_obra/r_listafirmasreportes.php",
                            success:function(data) {
                                mostrarFirmasAsignadas(data);
                            }
                        });
                    }
                });
             });
             
             /**
              * MODAL: USUARIOS
              * DESCRIPCION: DETECTA CLICK EN CHECKBOX Y LO MANDA AL
              * MODAL ANTERIOR, EMPATANDOLO CON LA "OPCION" SELECCIONADA PREVIAMENTE 
              * EL MODAL ANTERIOR SE VOLVERA A CARGAR CON ESE RADIOBUTTON SELECCIOADO
              * PARA MOSTRAR UN EFECTO DE REFRESCO DEL LADO DEL USUARIO
              */ 
              $("input[name=id_usuarioOpcion]").live("click",function() {
                $.ajax({
                    type:"POST",
                    data:{id_aleatorio:<?=$aleatorio?>,id_opcion:getOpcion(),id_usuario:$(this).val()},
                    url:"../../dl/datos_obra/i_usuariosopciontemporal.php",
                    success:function() {
                        $.ajax({
                            type:"GET",
                            dataType:"json",
                            data:{id_opcion:getOpcion(),id_aleatorio:<?=$aleatorio?>},
                            url:"../../dl/datos_obra/r_usuariosopciontemporal.php",
                            success:function(data) {
                                mostrarOpcionesAsignadas(data);
                            }
                        });
                    }
                });
              });
              
             
             /**
              * MODAL: FIRMAS
              * ACCION: OBTENER EL VALOR DE LA CAJA DE TEXTO: POSICION DE FIRMA EN REPORTE
              * ARCHIVO_PHP: i_posicionfirmareporte.php
              **/
             $("#posi_firma_reporte").live("click",function() {
                var td_padre = $(this).parent().parent().html();
                var matches = td_padre.match(new RegExp("(\\d+)","gi"));
                
                $(this).focusout(function() {
                    $.ajax({
                       data:{reporte:getReporte(), id_contacto:matches[0], id_aleatorio:<?=$aleatorio?>, posi_reporte:$(this).val()},
                       type:"POST",
                       url:"../../dl/datos_obra/i_posicionfirmareporte.php"
                    });
                });
             });
             
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
             
             /**
              * MODAL PARA MOSTRAR A LOS USUARIOS, Y SELECCIONARLOS CON UN CLICK EN EL
              * CHECKBOX PARA EMPATARLOS CON UNA "OPCION"
              */
              $("#modal_r_listaUsuarioSistema").dialog({
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
              })
             
             /**
              * MODAL PARE RECUPERAR LOS DATOS DE LA TABLA TEMPORAL
              */
             $("#btn-addContacto").click(function() {
                var aleatorio = <?=$aleatorio?>;

                $.ajax({
                    type:"GET",
                    dataType:"json",
                    data:{aleatorio:aleatorio},
                    url:"../../dl/datos_obra/r_contactostemporal.php",
                    success:function(data) {
                        mostrarContactosTemporal(data);
                    }
                });
             });
             
             function mostrarContactosTemporal(data)
             {
                 $("#tblAddContacto td").remove();
                 $("#tblAddContacto tr").remove();

                 /**
                  *  MODAL: Agregar contactos
                  */
                 $.each(data,function(index,value) { 
                     //$("#tblAddContacto > tbody:last").append(
                     $("#tblAddContacto tbody").append(
                        '<tr style="cursor:pointer;">'+
                        '<td class="contactofirma">'+
                        '<p style="display:none">'+data[index].id+"</p>"+
                        '<p style="display:none">-</p>'+
                        '<a id="agregar-contacto_modal" href="#" style="text-decoration:none;">'+data[index].nombre+'</a>'+
                        '<p style="display:none">-</p>'+
                        '<p style="display:none">'+data[index].descripcion+'</p>'+
                        '</td>'+
                        '</tr>'
                     );
                 });
                 
                 /**
                  * ABRIMOS EL MODAL
                  */
                 $("#modal-addContacto").dialog("open");
                 return false;
             }
             
             /**
              * Cerramos el modal modal-addContacto - "modal-addContacto"
              */
             $("#agregar-contacto_modal").live("click",function(e) {
                e.preventDefault();
                $("#modal-addContacto").dialog('close');
             });
            
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
            
            $(".contactofirma").live("click",function(e) {
                var data_array = $(this).text().split("-");
                var id_persona = data_array[0];
                var persona = data_array[1];
                var empresa = data_array[2];
                $(".txt-idcontacto").val(id_persona);
                $(".txt-contacto").val(persona);
                $(".txt-compania").val(empresa);
            });
            
            /**
             * MODALES PADRES
             * ==============
             */
            $("#divSeleccionaCliente").dialog({ //MODAL PARA SELECCIONAR A LOS CLIENTES
                autoOpen:false,
                height:350,
                width:450,
                resizable:false,
                closeOnEscape:false,
                modal:true,
                buttons:{
                    /***
                     * ESTA FUNCION DE BUSCAR DEBE SER REEMPLAZADA
                     
                    "Buscar":function() {
                        $("#txt_nombreCliente").val("");
                        buscarCliente();
                        $("div_clientebuscar").live("click")
                        $("#div_clientebuscar").css("display","block");
                    },*/
                    "Limpiar":function() {
                        recargarClientes();
                    },
                    "Cerrar":function() {
                        $(this).dialog("close");
                    }
                }
            });
            
            $("#divSeleccionaEmpContratante").dialog({
               autoOpen:false,
                height:350,
                width:450,
                resizable:false,
                closeOnEscape:false,
                modal:true,
                buttons:{
                    /*"Buscar":function() {
                        $("#txt_empresacontratante").val("");
                        buscarEmpresaContratante()
                    },*/
                    "Limpiar":function() {
                        recargarEmpresaContratante();
                    },
                    "Cerrar":function() {
                        $(this).dialog("close");
                    }
                }
            });
            
            $("#divSeleccionaEmpGerenteProyecto").dialog({
                autoOpen:false,
                height:350,
                width:450,
                resizable:false,
                closeOnEscape:false,
                modal:true,
                buttons:{
                    /*"Buscar":function() {
                        $("#txt_empresagerenteproyecto").val("");
                        buscarEmpresaGerenteProyecto()
                    },*/
                    "Limpiar":function() {
                        recargarEmpGerenteProyecto();
                    },
                    "Cerrar":function() {
                        $(this).dialog("close");
                    }
                }
            });
            
            $("#divSeleccionaEmpSupProyecto").dialog({
                autoOpen:false,
                height:350,
                width:450,
                resizable:false,
                closeOnEscape:false,
                modal:true,
                buttons:{
                    /*"Buscar":function() {
                        $("#txt_empsupervisoraproyecto").val("");
                        buscarEmpresaSupervisoraProyecto()
                    },*/
                    "Limpiar":function() {
                        recargarEmpSupervisoraProyecto();
                    },
                    "Cerrar":function() {
                        $(this).dialog("close");
                    }
                }
            });
            
            $("#divSeleccionaProvFacturar").dialog({
                autoOpen:false,
                height:350,
                width:450,
                resizable:false,
                closeOnEscape:false,
                modal:true,
                buttons:{
                    /*"Buscar":function() {
                        $("#txt_proveedorfacturar").val("");
                        buscarProveedorAFacturar()
                    },*/
                    "Limpiar":function() {
                        recargarProveedorFacturar();
                    },
                    "Cerrar":function() {
                        $(this).dialog("close");
                    }
                }
            });
            // MODAL: "Selecciona los contactos de la obra"
            // DESC.: Los datos(contactos) seleccionados son almacenados en la tabla: temporal
            // La tabla "temporal" será limpiada haciendo un match con el id de la sesion actual.
            $("#modal-contactos").dialog({
                autoOpen:false,
                height:350,
                width:450,
                resizable:false,
                closeOnEscape:false,
                modal:true,
                buttons:{
                    /*"Buscar":function() {
                        $("#txt_contacto").val("");
                        buscarContacto()
                    },*/
                    "Limpiar":function() {
                        recargarContactos();
                    },
                    "Cerrar":function() {
                        $(this).dialog("close");
                    }
                }
            });
            // MODAL: "Lista de usuarios"
            // DESC: Permite seleccionar de una lista a 1 o varios usuarios del sistema ligados 
            // a la empresa e.g:foo@empresa.com
            $("#modal_usuariosempresa").dialog({
                autoOpen:false,
                height:350,
                width:750,
                resizable:false,
                closeOnEscape:false,
                modal:true,
                buttons:{
                    "Cerrar":function() {
                        $(this).dialog("close");
                    }
                }
            })
            
            /**
             * FUNCIONES PARA LLAMAR A LOS MODALES DE BUSQUEDA
             * ===============================================
             */
            function buscarCliente()
            {
                $("#modal_buscarClientePorNombre").dialog("open");
            }
            function buscarEmpresaContratante()
            {
                $("#modal_buscarEmpContratantePorNombre").dialog("open");
            }
            function buscarEmpresaGerenteProyecto()
            {
                $("#modal_buscarEmpGerenteProyecto").dialog("open");
            }
            function buscarEmpresaSupervisoraProyecto()
            {
                $("#modal_buscarEmpSupervisoraProyecto").dialog("open");
            }
            function buscarProveedorAFacturar()
            {
                $("#modal_buscarProveedorAFacturar").dialog("open");
            }
            function buscarContacto()
            {
                $("#modal_buscarContacto").dialog("open");
            }
            
            /***
             * MODAL PARA LAS BÚSQUEDAS
             * ========================
             * USCAR CLIENTE POR NOMBRE
             */
            $("#modal_buscarClientePorNombre").dialog({
                autoOpen:false,
                height:100,
                width:450,
                resizable:false,
                closeOnEscape:false,
                modal:true,
                buttons:{
                    "¡Busca!":function() {
                        if($("#txt_nombreCliente").val() == "")
                            alert("Ingrese dato a buscar");
                        recargarClientesPorFiltro($("#txt_nombreCliente").val());
                    },
                    "Cerrar":function(){
                        $(this).dialog("close");
                    }
                }
            });
            $("#modal_buscarEmpContratantePorNombre").dialog({
                autoOpen:false,
                height:100,
                width:450,
                resizable:false,
                closeOnEscape:false,
                modal:true,
                buttons:{
                    "¡Busca!":function() {
                        if($("#txt_empresacontratante").val() == "")
                            alert("Ingrese dato a buscar");
                        recargarEmpresaContratantePorFiltro($("#txt_empresacontratante").val());
                    },
                    "Salir":function(){
                        $(this).dialog("close");
                    }
                }
            });
            $("#modal_buscarEmpGerenteProyecto").dialog({
                autoOpen:false,
                height:100,
                width:450,
                resizable:false,
                closeOnEscape:false,
                modal:true,
                buttons:{
                    "¡Busca!":function() {
                        if($("#txt_empresagerenteproyecto").val() == "")
                            alert("Ingrese dato a buscar");
                        recargarEmpGerenteProyectoPorFiltro($("#txt_empresagerenteproyecto").val());
                    },
                    "Salir":function(){
                        $(this).dialog("close");
                    }
                }
            });
            $("#modal_buscarEmpSupervisoraProyecto").dialog({
                autoOpen:false,
                height:100,
                width:450,
                resizable:false,
                closeOnEscape:false,
                modal:true,
                buttons:{
                    "¡Busca!":function() {
                        if($("#txt_empsupervisoraproyecto").val() == "")
                            alert("Ingrese dato a buscar");
                        recargarEmpSupervisoraProyectoPorFiltro($("#txt_empsupervisoraproyecto").val());
                    },
                    "Salir":function(){
                        $(this).dialog("close");
                    }
                }
            });
            $("#modal_buscarProveedorAFacturar").dialog({
                autoOpen:false,
                height:100,
                width:450,
                resizable:false,
                closeOnEscape:false,
                modal:true,
                buttons:{
                    "¡Busca!":function() {
                        if($("#txt_proveedorfacturar").val() == "")
                            alert("Ingrese dato a buscar");
                        recargarProveedorFacturarPorFiltro($("#txt_proveedorfacturar").val());
                    },
                    "Salir":function(){
                        $(this).dialog("close");
                    }
                }
            });
            $("#modal_buscarContacto").dialog({
                autoOpen:false,
                height:100,
                width:450,
                resizable:false,
                closeOnEscape:false,
                modal:true,
                buttons:{
                    "¡Busca!":function() {
                        if($("#txt_contacto").val() == "")
                            alert("Ingrese dato a buscar");
                        recargarContactosPorFiltro($("#txt_contacto").val());
                    },
                    "Salir":function() {
                        $(this).dialog("close");
                    }
                }
            });
             
             /**
              * MODAL: Contactos
              * FIELDS: Contacto, Posicion, Compania
              * DESC. : Pasa los datos del modal "Contactos" al modal "Firmas".
              * TODO: 
              * 1. Mostrar aviso de que se ha agregado los datos al modal "Firmas"
              * 2. Limpiar el modal "COntactos" 
              */
             $("#btn-agregarContacto").click(function(){
                 if ($(".txt-puesto").val() == ""){
                     alert("¡No has ingresado el puesto del contacto!");
                     $(".txt-puesto").focus();
                     return false;
                 }
                 if ($(".txt-contacto").val() == "" || $(".txt-compania").val() == ""){
                     alert("¡No has seleccionado contacto alguno!");
                     $(".txt-contacto").focus();
                     return false;
                 }
                 
                contador_firmas++; //fixed bug, not my bug, desktop bug
                /*
                 * TODO: Obtener los ID
                 * OBTENER LOS ID DE LOS DATOS PARA EL SISTEMA
                 */
                
                /*
                 * OBTENER LOS VALORES PARA EL USUARIO
                 */
                var puesto = $(".txt-puesto").val();
                var contacto = $(".txt-contacto").val();
                var empresa = $(".txt-compania").val();
                
                /**
                 * INGRESAR VALORES: id_contacto, puesto, empresa a tabla temporal para luego
                 * empatarlas con los reportes
                 */
                var aleatorio = <?=$aleatorio?>;
                var id_contacto = $(".txt-idcontacto").val();
                var puesto = $(".txt-puesto").val();

                $.ajax({
                    type:"POST",
                    data:{id_contacto:id_contacto,puesto: puesto,aleatorio:aleatorio},
                    url:"../../dl/datos_obra/i_ingresafirmascontactotemporal.php",
                    success:function(data) {/* DATOS ALMACENADOS EN TABLA: tb_firmascontactotemporal */
                    }
                });  
                /**
                 * LIMIPIAR CAJAS DE TEXTO DEL MODAL "Contactos"
                 */
                $(".txt-puesto").val("");
                $(".txt-contacto").val("");
                $(".txt-compania").val("");
                
                /*
                 * Modal: Firmas
                 * Fields: 
                 * Desc. Muestra la grilla con los siguientes datos:
                 * - Puesto
                 * - Contacto
                 * - Compañia
                 * Todo:
                 * 1. Validar si ya existe el registro para no poder volver a
                 *    ingresaro a la tabla temporal.
                 */
                $("#tbl-firmas1 tbody").append(
                    "<tr name=\"firmas\" id='tbl_firmas1grid'>"+
                    '<input id="id_contacto" type="hidden" value="'+id_contacto+'" />'+    
                    '<td id="id_puesto" name="puesto'+contador_firmas+'"><input id="puesto_editar" type="text" value="' +puesto+'" /></td>'+
                    '<td name="contacto'+contador_firmas+'">'+contacto+"</td>"+
                    '<td name="empresa'+contador_firmas+'">'+empresa+"</td>"+
                    '<td>'+'<a href="#" id="del-firma" class="button delete">Eliminar</a>'+'</td>'+
                    "</tr>"    
                );
                    
                $("#div-addcontactos").dialog("close");    
                return false;    
             });
             
             /**
              * botón de eliminarcontacto del modal "Firmas"
              */
             $("#del-firma").live("click",function(e){
                 var value = $(this).parent().parent().html();
                 var matches = value.match(new RegExp("(\\d+)","gi"));
                 e.preventDefault();
                 contador_firmas--;
                 $(this).parent().parent().remove();

                 $.ajax({
                     data:{id:matches[0],aleatorio:<?=$aleatorio?>},
                     type:"POST",
                     url:"../../dl/datos_obra/d_eliminaFirmaContacto.php?accion=1",
                     success:function(data) {
                         if (data == "1") {
                             alert("Usted no puede eliminar a este contacto porque ya se le ha asigado algun reporte para firmarlo.");
                             return;
                         } else {
                             /**
                              * FUNCION AJAX PARA ELIMINAR VALOR
                              * DE LA TABLA tb_contactoreportetemporal
                              */
                             $.ajax({
                                 data:{id:matches[0],aleatorio:<?=$aleatorio?>},
                                 type:"POST",
                                 url:"../../dl/datos_obra/d_eliminaFirmaContacto.php?accion=2",
                                 success:function(){
                                     $("#tbl_firmas1grid").remove();
                                 }
                             })
                         }
                     }
                 });
             });
             
             /**
              * BTON DE ELIMINAR CONTACTO - POSICION
              */
             $("#del-contacto_reporte").live("click",function(e) {
                 var value = $(this).parent().parent().html();
                 var matches = value.match(new RegExp("(\\d+)","gi"));
                 e.preventDefault();
                 $(this).parent().parent().remove();
                 //alert(value);
                 //alert(matches);
                 $.ajax({
                     data:{id:matches[0],aleatorio:<?=$aleatorio?>},
                     type:"POST",
                     url:"../../dl/datos_obra/d_eliminaContactoPosicion.php"
                 });
             });
             
             /**
              * EDITAR POSICION DEL CONTACTO, AFECTA AL FORMULARIO
              * Y A LA BASE DE DATOS
              */
             $("#puesto_editar").live("click",function() {
                //alert($(this).val());
                var td_padre = $(this).parent().parent().html();
                var matches = td_padre.match(new RegExp("(\\d+)","gi"));
                /*alert(matches);
                alert(matches[4]);*/
                var aleatorio = <?=$aleatorio?>;
                
                $(this).focusout(function(){
                    $.ajax({
                        data:{aleatorio:aleatorio,codigo:matches[0],posicion:$(this).val()},
                        type:"POST",
                        url:"../../dl/datos_obra/u_posicion.php"
                    });
                });
             })
             
            /**
             * CARGA DE DATA PARA COMBOS DEL FOMRULARIO
             */
            cargar_departamentos_peru();
            cargar_monedas();
            cargar_tipovalorizacion();
            cargar_formatopresupuesto();
            
            /**
             * SELECCIONAR Y AGREGAR CONTACTOS PARA DATOS DE OBRA
             * ==================================================
             **/
//            $('input:checkbox[name=contacto[]]').click(function(){
//                var id = $(this).val();
//                $.ajax({
//                    data:{id:id},
//                    type:"GET",
//                    dataType:"json",
//                    url:"../../includes/query_repository/getAllContacto.php",
//                    success:function(data) {
//                        resultados(data);
//                    }
//                });
//            });
            
            $("#contactos_boxes").live("click",function() {
                $.ajax({
                    data:{id:$(this).val()},
                    type:"GET",
                    dataType:"json",
                    url:"../../includes/query_repository/getAllContacto.php",
                    success:function(data) {
                        resultados(data);
                    }
                });
            });
            /*
             * AGREGAR DATOS DE CONTACTOS A TABLA
             */
            function resultados(datos)
            {
                /**
                 * FUNCION AJAX CON POST PARA INGRESAR LOS DATOS
                 * EN LA TABLA TEMPORAL "temporal"
                 */
                contador_contactos++;
                var codigo;
                var aleatorio = <?=$aleatorio?>;
                $.each(datos,function(index,value){
                    codigo = datos[index].id;
                    $("#contactos-agregados tbody").append(
                    "<tr id='tbl_listacontactogrid'>"+
                    "<td>"+datos[index].nombre+"</td>"+
                    "<td>"+datos[index].empresa+"</td>"+
                    "<td>"+datos[index].cargo+"</td>"+
                    "<td>"+datos[index].email_persona+"</td>"+
                    "<td>"+datos[index].ruc_empresa+"</td>"+
                    "<td>"+datos[index].fax_empresa+"</td>"+
                    "<td>"+datos[index].tf+"</td>"+
                    "<td>"+datos[index].tm+"</td>"+
                    "<td>"+datos[index].tn+"</td>"+
                    "<td>"+"<a href='#' id='del-contacto' class='button delete'>Eliminar</a>"+"</td>"+
                    '<input id="codigo" type="hidden" name="contacto'+contador_contactos+'" value="'+datos[index].id+'" />'+
                    "</tr>"    
                    ),
                    //
                    $.ajax({
                        type:"POST",
                        data:{
                            idcontacto:codigo,
                            idobra:<?=$_REQUEST['obra']?>
                            ,aleatorio:aleatorio},
                        url:"../../dl/datos_obra/i_ingresacontacto.php"
                    });
                });
            }
            
            /**
             * OBTENER LOS USUARIOS DEL SISTEMA
             * ================================
             */
            $("#usuarios_boxes").live("click",function() {
                $.ajax({
                    data:{id:$(this).val()},
                    type:"GET",
                    dataType:"json",
                    url:"../../includes/query_repository/getAllUsuarios.php",
                    success:function(data) {
                        resultadoUsuarios(data);
                    }
                });
            });
            
            /**
             * MOSTRAR LOS USUARIOS DEL SISTEMA SELECCIONADOS
             * ==============================================
             */
            function resultadoUsuarios(data) {
                contador_usuarios++;
                var codigo;
                $.each(data,function(index,value){
                    codigo = data[index].id;
                    $("#tbl_usuariossistema tbody").append(
                        "<tr>"+
                        "<td>"+data[index].nombre+"</td>"+
                        "<td>"+data[index].nombreusuario+"</td>"+
                        "<td>"+"<a href='#' id='del-usuario' class='button delete'>Eliminaraw</a>"+"</td>"+
                        '<input id="codigo_usuario" type="hidden" name="usuario'+contador_usuarios+'" value="'+data[index].id+'" />'+
                        "</tr>"
                    ),
                    $.ajax({ // INGRESAR LOS USUARTIOS DEL SISTEMA ELEGIDOS A LA DB TEMPROAL DE USUARIOS: tb_usuariosaprobaciontemporal
                        type:"POST",
                        data:{id:codigo,aleatorio:<?=$aleatorio?>},
                        url:"../../dl/datos_obra/i_ingresausuarioatemporal.php"
                    });    
                });
            }
             
            /**
             * EVENTOS PARA OBTENER LOS NUMEROS DE TELEFONO 
             **/
            $("#btn_tfijo").live("mouseover",function() {
                var codigo = $(this).parent().parent().html();
                codigo = codigo.match(
                    new RegExp("(\\d+)","gi")
                );
                $.ajax({
                    type:"GET",
                    dataType:"json",
                    data:{id_contacto:codigo[2]},
                    url:"../../dl/datos_obra/r_telefonosPersonaContacto.php?tipotelefono=1",
                    success:function(data) {
                        mostrarTelefonos(data,1);
                    }
                });    
            }).live("mouseout",function(){
                $("#telefonos").hide("slow")
                $("#telefono p").remove();
            });
            $("#btn_tmobile").live("mouseover",function() {
                var codigo = $(this).parent().parent().html();
                codigo = codigo.match(
                    new RegExp("(\\d+)","gi")
                );
                $.ajax({
                    type:"GET",
                    dataType:"json",
                    data:{id_contacto:codigo[2]},
                    url:"../../dl/datos_obra/r_telefonosPersonaContacto.php?tipotelefono=2",
                    success:function(data) {
                        mostrarTelefonos(data,2);
                    }
                });    
            });
            $("#btn_tnextel").live("mouseover",function() {
                var codigo = $(this).parent().parent().html();
                codigo = codigo.match(
                    new RegExp("(\\d+)","gi")
                );
                $.ajax({
                    type:"GET",
                    dataType:"json",
                    data:{id_contacto:codigo[2]},
                    url:"../../dl/datos_obra/r_telefonosPersonaContacto.php?tipotelefono=3",
                    success:function(data) {
                        mostrarTelefonos(data,3);
                    }
                });    
            });
            
            
            /**
             * MOSTRAR EN TOOLTIIP LOS TELEFONOS
             * =================================
             */
            function mostrarTelefonos(data,tipo) {
                $("#telefonos").show("slow");
                $.each(data,function(index,value){
                    $("#telefonos").append(
                        "<p id='telefono'>"+data[index].numero+"</p>"+
                        "<br>"
                    )
                });
            }
            
            /*
             * ELIMINAR CONTACTO DE TABLA TEMPORAL
             * ===================================
             **/
            $("#del-contacto").live("click", function(e) {
                var value = $(this).parent().parent().html();

                e.preventDefault();
                var aleatorio = <?=$aleatorio?>;
                
                var matches = value.match(new RegExp("(\\w+)","gi"));
                var id =     matches[matches.length-3];                        
                //alert(matches[matches.length-3]);
                
                //alert(rs);
                if (!temporalon(id,<?=$aleatorio?>))
                    {
                        alert("No puede eliminar el dato");
                    }
                else
                    {
                        $(this).parent().parent().remove();
                    }
                /**
                 * COMPROBAR SI EL USUARIO ES UN POTENCIAL FIRMANTE
                 * CONSULTANDO A LA TABLA: tb_firmascontactotemporal
                 *//*
                $.ajax({
                    data:{id:id, aleatorio:aleatorio},
                    dataType:"text",
                    url:"../../dl/datos_obra/d_eliminacontacto.php?accion=1",
                    success:function(data) {
                        if (data == "1") {
                            alert("Usted no puede eliminar a este contacto por ser un potencial firmante.")
                            return false;
                        } else {
                           /**
                            * FUNCION AJAX CON POST PARA ELIMINAR VALOR
                            * DE LA TABLA TEMPORAL
                            *//*
                            $.ajax({
                                data:{id:id,aleatorio:aleatorio},
                                type:"POST",
                                url:"../../dl/datos_obra/d_eliminacontacto.php?accion=2",
                                success:function(){
                                    alert($(this).parent().parent().html());
                                    $(this).parent().parent().remove();
                                    //$("#tbl_listacontactogrid").remove();
                                    
                                }
                            });
                        }
                    }
                });*/
            });
            function temporalon(id,aleatorio) {
                //alert(id);
                //alert(aleatorio);
                rs = true;
                $.ajax({
                    data:{id:id, aleatorio:aleatorio},
                    dataType:"text",
                    url:"../../dl/datos_obra/d_eliminacontacto.php?accion=1",
                    success:function(data) {
                        if (data == "1") {
                            rs = false;
                        } else {
                           /**
                            * FUNCION AJAX CON POST PARA ELIMINAR VALOR
                            * DE LA TABLA TEMPORAL
                            */
                            $.ajax({
                                data:{id:id,aleatorio:aleatorio},
                                type:"POST",
                                url:"../../dl/datos_obra/d_eliminacontacto.php?accion=2"
                            });
                        }
                    }
                });
                alert("devuelvo: "+rs);
                if (rs)
                    return true;
                else
                    return false;
            }
            // ELIMINAR DE TABLA FIMAS

            
            /**
             * ELIMINA USUARIO DE SISTEMA DE TABLA TEMPORAL
             * MODAL. usuarios acreditados
             * TABLA: tb_usuariosaprobaciontemporal
             */
            $("#del-usuario").live("click",function(e) {
                e.preventDefault();
                var value = $(this).parent().parent().html();
                $(this).parent().parent().remove();
                var matches = value.match(new RegExp("(\\d+)","gi"));
               
               $.ajax({
                   data:{aleatorio:<?=$aleatorio?>,id:matches[1]},
                   type:"POST",
                   url:"../../dl/datos_obra/d_eliminarusuarioaprobaciontemporal.php"
               });
            });
            
            /**
             * 
             * Agregar datos a los input - INPUT BY DEFAULT READONLY
             * COMENTADO MOMENTANEO ------- OJO QUE ESTE SI FUNCIONA
             */
            $(".cliente").live("click",function() {
                //alert($(this).text());
                var cliente_array = $(this).text().split("-");
                var cli = cliente_array[1];
                var id_cliente =  cliente_array[0];
                $(".cliente-text").val(cli);
                $(".cliente-id").val(id_cliente);
            })
            
            $('.contratante').live("click",function(){
                var contratante_array = $(this).text().split("-");
                var cli = contratante_array[1];
                var contratante_id = contratante_array[0];
                $(".empresacontratante-text").val(cli);
                $(".contratante_id").val(contratante_id);
            });
            
            $('.gerenteproyecto').live("click",function(){
                var gerente_array = $(this).text().split("-");
                var cli = gerente_array[1];
                var gerente_id = gerente_array[0];
                $(".empresagerente-text").val(cli);
                $(".gerente_id").val(gerente_id);
            });
            
            $('.supervisorproyecto').live("click",function(){
                var supervisor_array = $(this).text().split("-");
                var cli = supervisor_array[1];
                var supervisor_id = supervisor_array[0];
                $(".empresasupervisora-text").val(cli);
                $(".supervisor_id").val(supervisor_id);
            });
            
            $('.proveedorfacturar').live("click",function(){
                
                var proveedor_array = $(this).text().split("-");
                var cli = proveedor_array[1];
                var proveedor_id = proveedor_array[0];
                //alert(proveedor_array[0])
                $(".proveedorfacturar-text").val(cli);
                $(".proveedor_id").val(proveedor_id);
            });
            
            $('.carta').click(function(){
                var carta_array = $(this).text().split("-");
                var carta = carta_array[1];
                var carta_id = carta_array[0];
                $(".cls-modelocarta").val(carta);
                $(".carta_id").val(carta_id);
            });
            
            $('.contrato').click(function(){
                var contrato_array = $(this).text().split("-");
                var contrato = contrato_array[1];
                var contrato_id = contrato_array[0];
                $(".cls-modelocontrato").val(contrato);
                $(".contrato_id").val(contrato_id);
            });
            
            /**
             * BUSCADORES IN LINE - WTF
             */
            //CLIENTE
            $("#btnSearchCliente").live("click",function() {
                recargarClientesPorFiltro($("#txt_divClienteBuscar").val());
            });
            //EMPRESA CONTRATANTE
            $("#btnSearchEmpContratante").live("click",function() {
                recargarEmpresaContratantePorFiltro($("#txt_divEmpContratanteBuscar").val());
            });
            //EMPRESA GERENTE DE PROYECTO
            $("#btnSearchGerenProyecto").live("click",function() {
                recargarEmpGerenteProyectoPorFiltro($("#txt_divGerenteProyectoBuscar").val());
            });
            // EMPRESA SUPERVISORA DEL PROYECTO
            $("#btnSearchEmpSupervisora").live("click",function() {
                recargarEmpSupervisoraProyectoPorFiltro($("#txt_divEmpSupervisoraBuscar").val());
            });
            // PROVEEDOR A FACTURAR
            $("#btnSearchProveedorfacturar").live("click",function() {
                recargarProveedorFacturarPorFiltro($("#txt_divProveedorFacturarBuscar").val());
            });
            // CONTACTO
            $("#btnSearchContacto").live("click",function() {
                recargarContactosPorFiltro($("#txt_divContactoBuscar").val());
            });
            
            /**  */
            $("#frm_datosobra").submit(function(){
                $.ajax({
                    type:"POST",
                    data:{
                        aleatorio:<?=$aleatorio?>,
                        idobra:<?=$_REQUEST['obra']?>
                    },
                    url:"../../dl/datos_obra/RegistraDatosObra_mvTmp.php?parameter=move"
                });
            });
        })    
        
        </script>
        <style>
            #inner-textfield-modal{padding: 5px 5px 5px 5px;}
            #inner-textfield{padding: 25px 25px 25px 25px;}
            #hr{padding-top: 10px;padding-bottom: 15px;}
        </style>
    </head>
    <body class="fondo">
        <div id="barra-superior"><div id="barra-superior-dentro"><h1 id="titulo_barra">REGISTRO DE DATOS DE OBRA</h1></div></div>
        
        <!--VENTANA MODAL PARA SELECCIONAR LOS CONTACTOS-->
        <?php 
        include_once 'modales/cliente-modal.php';
        include_once 'modales/modal-contratante.php';
        include_once 'modales/modal-gerenteproyecto.php';
        include_once 'modales/modal-supervisorproyecto.php';
        include_once 'modales/modal-proveedorfacturar.php';
        include_once 'modales/modal-addContacto.php';
        include_once 'modales/modal-modelocarta.php';
        include_once 'modales/modal-modelocontrato.php';
        include_once 'modales/modal-mostrarlistareportes.php';
        include_once 'modales/modal-mostraropcionesusuarios.php';
        include_once 'modales/modal_r_listaContactoPosicion.php';
        include_once 'modales/modal_r_listaUsuarioSistema.php';
        ?>
        
        <!-- MODALES PADRES  -->
        <!-- ++++++++++++++  -->
        <div id="divSeleccionaCliente" title="Seleccionar Cliente" style="display: none"></div>
        <div id="divSeleccionaEmpContratante" title="Seleccionar la Empresa Contratante" style="display: none"></div>
        <div id="divSeleccionaEmpGerenteProyecto" title="Seleccionar la Empresa Gerente del Proyecto" style="display: none"></div>
        <div id="divSeleccionaEmpSupProyecto" title="Seleccionar la Empresa Supervisora del Proyecto" style="display: none"></div>
        <div id="divSeleccionaProvFacturar" title="Seleccionar la Empresa Supervisora del Proyecto" style="display: none"></div>
        <div id="modal-contactos" title="Selecciona los contactos de la obra" style="display: none"></div>
        <div id="modal_usuariosempresa" title="Lista de usuarios" style="display: none"></div>
        

        
        <!-- INICIO DE FORMULARIO --> 
        <!-- ******************** -->
        <form id="frm_datosobra" action="../../bl/DatosObra/registraObra_BL.php?random=<?=$aleatorio?>" method="POST">
<!--        <form id="frm_datosobra" action="datosdeobratest.php" method="POST">-->
        <!-- TEXT INPUT INVISIBLES PARA PASAR DATOS SIN FORMATOS : sf == sin formato-->
        <!-- VALORES SIN FORMATO -->
            <input type="hidden" id="txt_sfcartafianza" name="txtsfcartafianza" />
            <input type="hidden" id="txt_sffondoretencion" name="txt_sffondoretencion" />
            <input type="hidden" id="txt_sfmontomayora" name="txt_sfmontomayora" />
            <input type="hidden" id="txt_sfmonotmenora" name="txtsfmonotmenora" />
            <input type="hidden" name="proyecto" value="<?=$_REQUEST['obra']?>" />
        
        <!--VENTANA MODAL PARA SETEO DEL PRESUPUESTO DE VENTA-->
        <div  id="div-modal-pptoventa" title="Seteo Presupuesto Venta">
            <div class="">
                <fieldset>
                    <div id="inner-textfield-modal">
                        <table>
                            <tr>
                                <td><label>Tipo de valorizaci&oacute;n</label></td>
                                <td>
                                    <select name="cmb_tipovalorizacion-name" id="cmb_tipovalorizacion">
                                        <option value="0">Seleccionar tipo de valorizaci&oacute;n</option> 
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                </fieldset>
                <fieldset>
                    <div id="inner-textfield-modal">
                        <table>
                            <tr>
                                <td><label>Formato presupuesto</label></td>
                                <td>
                                    <select name="cmb_formatopresupuesto-name" id="cmb_formatopresupuesto">
                                        <option value="0">Seleccionar formato de presupuesto</option> 
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Factor de correcci&oacute;n</label></td>
                                <td><input size="5" id="inputext" type="text" name="txt-factorcorreccion" /></td>
                            </tr>
                            <tr>
                                <td><label>Retenci&oacute;n Fondo de Garant&iacute;a</label></td>
                                <td><input size="5" id="inputext" type="text" name="txt-retenciongarantia" />&#37;</td>
                            </tr>
                            <tr>
                                <td><label>Retenci&oacute;n Fiel Cumplimiento</label></td>
                                <td><input size="5" id="inputext" type="text" name="txt-retencioncumplimiento" />&#37;</td>
                            </tr>
                        </table>
                    </div>
                </fieldset>
                <fieldset>
                        <legend>Presupuesto Contractual</legend>
                        <div id="inner-textfield-modal">
                        <table>    
                        <tr>
                            <td><label>Gasto General</label></td>
                            <td><input size="5" id="inputext" type="text" name="txt-gastogeneral_pc" />&#37;<td>
                        </tr>
                        <tr>
                            <td><label>Utilidad</label></td>
                            <td><input size="5" id="inputext" type="text" name="txt-utilidad_pc" />&#37;</td>
                        </tr>
                        </table>
                    </div>
                </fieldset>
                <fieldset>
                        <legend>Presupuesto con &oacute;rdenes de cambio</legend>
                        <div id="inner-textfield-modal">
                        <table>
                        <tr>
                            <td><label>Gasto General</label></td>
                            <td><input size="5" id="inputext" type="text" name="txt-gastogeneral_oc" />&#37;</td>
                        </tr>
                        <tr>
                            <td><label>Utilidad</label></td>
                            <td><input size="5" type="text" id="inputext" name="tx-utilidad_oc" />&#37;</td>
                        </tr>
                        </table>
                    </div>
                </fieldset>
            </div>    
        </div>
        <!--VENTANA MODAL PARA ASIGNAR LAS FIRMAS A LOS REPORTES-->
        <div style="display: none" id="div-firmas-1" title="Firmas">
            <table id="tbl-firmas1">
                <thead>
                    <tr class="ui-widget-header">
                        <th>Puesto</th>
                        <th>Contacto</th>
                        <th>Compa&ncaron;&iacute;a</th>
                    </tr>
                </thead>
                <tbody>
                    <tr></tr>
                </tbody>
            </table>
        </div>
        <!-- VENTANA MODAL PARA ASIGNAR USUARIOS PARA APROBACION -->
        <div style="display: none" id="div-modal-asigna_aprobacion" title="Usuarios acr&eacute;ditados">
            <table id="tbl_usuariossistema">
                <thead>
                    <tr class="ui-widget-header">
                        <th>Nombre</th>
                        <th>Usuario</th>
                    </tr>
                </thead>
                <tbody>
                    <tr></tr>
                </tbody>
            </table>
        </div>
        <!-- ********************************************** -->
        <!-- BUSCAR CONTACTOS QUE SOLO EXISTEN EN LA GRILLA -->
        <!-- Contacto [...] -->
        <!-- Posición -->
        <!-- Compañia [...] - REDONLY-->
        <div style="display: none" id="div-addcontactos" title="Contactos">
            <table border="0" class="atable">
               <tr>
                    <td class="tr-padding">
                        <label>Contacto</label>
                        <input type="text" size="30" class="txt-contacto" id="inputext" name="contacto" READONLY />
                        <input type="button" id="btn-addContacto" value="..." class="ui-button ui-widget ui-state-default ui-corner-all"/>
                        <input type="hidden" class="txt-idcontacto" name="txt_idcontacto" />
                        
               <tr>
                    <td class="tr-padding">
                        <label>Posici&oacute;n</label>
                        <input type="text" size="30" class="txt-puesto" id="inputext" name="posicion" />         
                        
               <tr>
                    <td class="tr-padding">
                        <label>Compa&nacute;&iacute;a</label>
                        <input type="text" size="30" class="txt-compania" id="inputext" name="compania" READONLY />
                        
               <tr>
                   <td class="tr-padding">
                       <input type="button" id="btn-agregarContacto" class="ui-button ui-widget ui-state-default ui-corner-all" value="Agregar" />
            </table>
        </div>
        
        <div style="display: none" id="div-firmas-reportes" title="Reportes">
        </div>    
        <!-- LO DE ARRIBA ES MODAL -->   
        <div id="main">
             <div class="info">
            Los campos obligatorios est&aacute;n marcados con <img src="../../img/required_star.gif" alt="dato requerido" />
            </div>
            <table>
                <tr>
                    <td><label>C&oacute;digo:</label><input id="inputext" type="text" size="15" name="codigo" value="<?=$_REQUEST['codigo']?>" READONLY/><span class="formInfo"><a href="../../js/jquery-tooltip/ajax.htm" class="jTip" id="one" name="El codigo debe tener el siguiente formato">!</a></span></td>
                </tr>
                <tr>
                    <td><label>Nombre:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label><input id="inputext" type="text" size="35" name="nombre" value="<?=$_REQUEST['descripcion']?>" READONLY/></td> 
                </tr>
                <tr>
                    <td><label>Fecha inicio obra:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label><input id="inputext" class="fecha_desde" type="text" name="f_inicio" /></td>
                </tr>
                <tr>
                    <td><label>Fecha fin de obra:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label><input id="inputext" class="fecha_hasta" type="text" name="f_fin" /></td>                    
                </tr>
                <tr>
                    <td><label>Direcci&oacute;n de la obra:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label><input type="text" id="inputext" size="30" name="direccion_obra" /></td>
                </tr>
                <tr>
                    <td><label>Departamento:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label>
                        <select name="departamento" id="departamento-peru">
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Moneda:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label>
                        <select name="moneda" id="moneda-id">
                            <option value="0">Seleccionar moneda</option>
                        </select>
                    </td>
                </tr>
            </table>
            <div id="hr"><hr /></div>
            <table>
                <tr>
                    <!-- tb_companiacontacta -->
                    <td><label>Cliente:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                    <td><input id="inputext" class="cliente-text" type="text" size="45" name="cliente" READONLY /><input id="agregar-cliente" type="button" value="..." class="ui-button ui-widget ui-state-default ui-corner-all"/></td>
                    <td><input type="hidden" class="cliente-id" name="cliente--id"</td>
                    <!-- MODAL PARA BUSCAR POR NOMBRE { CLIENTES } -->
                    <div id="modal_buscarClientePorNombre" title="Buscar cliente" style="display:none">
                        <label>Nombre del cliente:</label>
                        <input type="text" id="txt_nombreCliente" />
                    </div>    
                </tr>
                <tr>
                    <td><label>Empresa Contratante:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                    <td><input type="text" id="inputext" class="empresacontratante-text" size="45" name="empresa-contratante" READONLY/><input id="agregar-contratante" type="button" value="..." class="ui-button ui-widget ui-state-default ui-corner-all"/></td>
                    <td><input type="hidden" class="contratante_id" name="contratante--id" /></td>
                    <!-- MODAL PARA BUSCAR POR NOMBRE { EMPRESA CONTRATANTE } -->
                    <div id="modal_buscarEmpContratantePorNombre" title="Buscar Empresa Contratante" style="display:none">
                        <label>Nombre de la empresa:</label>
                        <input type="text" id="txt_empresacontratante" />
                    </div>   
                </tr>
            </table>
            <div id="hr"><hr /></div>
            <table>
                <tr>
                    <td><label>Empresa Gerente de proyecto:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                    <td><input id="inputext" class="empresagerente-text" type="text" size="45" name="gerente-proyecto" READONLY/><input id="agregar-gerenteproyecto" type="button" value="..." class="ui-button ui-widget ui-state-default ui-corner-all"/></td>
                    <td><input type="hidden" class="gerente_id" name="gerente--id" /></td>
                    <!-- MODAL PARA BUSCAR POR NOMBRE [ EMPRESA GERENTE DE PROYECTO ] -->
                    <div id="modal_buscarEmpGerenteProyecto" title="Buscar empresa gerente de Proyecto" style="display:none">
                        <label>Nombre de la empresa:</label> 
                        <input type="text" id="txt_empresagerenteproyecto" />
                    </div>   
                </tr>
                <tr>
                    <td><label>Empresa Supervisora de proyecto:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                    <td><input type="text" class="empresasupervisora-text" id="inputext" size="45" name="supervisora-proyecto" READONLY/><input id="agregar-supervisorproyecto" type="button" value="..." class="ui-button ui-widget ui-state-default ui-corner-all"/></td>
                    <input type="hidden" class="supervisor_id" name="supervisor--id" />
                    <!-- MODAL PARA BUSCAR POR NOMBRE [ EMPRESA SUPERVISORA DE PROEYCTO ] -->
                    <div id="modal_buscarEmpSupervisoraProyecto" title="Buscar Empresa Supervisora de Proyecto" style="display:none">
                        <label>Nombre de la empresa:</label>
                        <input type="text" id="txt_empsupervisoraproyecto" />
                    </div>     
                </tr>
            </table>
            <div id="hr"><hr /></div>
            <table>
                <tr>
                    <td><label>Par&aacute;metros Ppto. de ventas:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                    <td><input id="btn-parametrospptoventa" type="button" value="..." class="ui-button ui-widget ui-state-default ui-corner-all"/></td>
                </tr>
<!--             SE MUEVE A ADMINISTRACION   <tr>
                    <td><label>Usuarios para aprobaci&oacute;n:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                    <td><input id="usuarios-aprobacion" type="button" value="..." class="ui-button ui-widget ui-state-default ui-corner-all"/></td>
                </tr>-->
            </table>
            <div id="hr"><hr /></div>
            <table>
                <tr>
                    <td><label>Proveedor facturar a:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                    <td><input type="text" class="proveedorfacturar-text" id="inputext" size="45" name="proveedor-a-facturar" READONLY/><input id="agregar-proveedorfacturar" type="button" value="..." class="ui-button ui-widget ui-state-default ui-corner-all"/></td>
                    <input type="hidden" class="proveedor_id" name="proveedor--id" />
                </tr>
            </table>
            <div id="hr"><hr /></div>
            <table>
                <tr>
                    <!-- MODAL PARA BUSCAR POR NOMBRE [ PROVEEDOR A FACTURAR ] -->
                    <div id="modal_buscarProveedorAFacturar" title="Buscar proveedor a facturar" style="display:none">
                        <label>Nombre del proveedor</label>
                        <input type="text" id="txt_proveedorfacturar" />
                    </div>
                </tr>
                
                <tr>
                    <td>Lista de contactos:</td>
                        <td>
                            <!-- MODAL PARA BUSCAR POR NOMBREW [ CONTACTO ] -->
                            <div id="modal_buscarContacto" title="Buscar contacto" style="display: none">
                                <label>Nombre del contacto</label>
                                <input type="text" id="txt_contacto" />
                            </div>
                            <input type="button" id="mostrarcontactos" value="Buscar contactos" class="ui-button ui-widget ui-state-default ui-corner-all"/>
                            <div class="areaScrollModal" id="lista-contactos">
                                <table id="contactos-agregados">
                                    <thead>
                                        <tr class="ui-widget-header">
                                            <th>Nombre de Contacto</th>
                                            <th>Empresa</th>
                                            <th>Cargo</th>
                                            <th>Correo Electr&oacute;nico</th>    
                                            <th>RUC</th>
                                            <th>Fax</th>
                                            <th>T. Fijo</th>
                                            <th>T. Mobile</th>
                                            <th>T. Nextel</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr></tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <!-- { TELEFONOS } -->
                    <div id="telefonos"  style="display: none">
                        
                    </div>
            </table>
            <br />
            <hr />
            <table>
                <tr>
                    <td><label>Asignar firmas a reportes:<em><img src="../../img/required_star.gif" alt="dato requerido" /></em></label></td>
                    <td><input id="btn-asignarfirmasreportes" type="button" value="..." class="ui-button ui-widget ui-state-default ui-corner-all"/></td>
                </tr>
            </table>
            <br />
            <hr/>
            <fieldset>
                <legend>Par&aacute;metros obras(para proveedores)</legend>
                <div id="inner-textfield">
                    <table>
                        <tr>
                            <td>
                                <input type="text" class="txtcartafianza_p" id="inputext" name="txtcarta-fianza" size="5"/>
                            </td>
                            <td>
                                <p>Porcentaje de la carta fianza fiel cumplimiento para Contratistas/Proveedores</p>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                                <input type="text" id="inputext" class="txtdiasdesembolso" name="txtdias-desembolso" size="5"/>
                            </td>
                            <td>
                                <p>D&iacute;as h&aacute;biles para el desembolso, despues de presentada la factura</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="txtfondoretencion_p" id="inputext" name="txtfondo-retencion" size="5"/>
                            </td>
                            <td>
                                <p>Porcentaje de fondo de retenci&oacute;n</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" id="inputext" class="txtdiasdevolucion" name="txtdias-devolucion-fondoretencion" size="5"/>
                            </td>
                            <td>
                                <p>Dias habiles para la devolucion del fondo de retencion, contados a partir de la retencion de obra sin observaciones(Acta definitiva)</p>
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td><p>Monto contratado mayor a:</p></td>
                            <td><input type="text" class="txtmayora" id="inputext" name="txtmayor-a" size="10"/></td>
                            <td></td>
                            <td></td>
                            <td>
                                <p><input type="checkbox" name="oc_oc_mayora" CHECKED DISABLED/>OC/OT</p>
                            </td>
                            <td>
                                <p><input type="checkbox" name="ca_cg_mayora"/>CA y CG</p>
                            </td>
                            <td>
                                <p><input type="checkbox" name="contrato_mayora"/>Contrato</p>
                            </td>
                        </tr>
                        <tr>
                            <td><p>Monto contratado entre:</p></td>
                            <td><input type="text" class="txtlimiteinferior" id="inputext" name="txtentre-inferior" size="10" READONLY/></td>
                            <td> y </td>
                            <td><input type="text" class="txtlimitesuperior" id="inputext" name="txtentre-superior" size="10" READONLY/></td>
                            <td>
                                <p><input type="checkbox" name="oc_oc_entre"CHECKED DISABLED/>OC/OT</p>
                            </td>
                            <td>
                                <p><input type="checkbox" name="ca_cg_entre"/>CA y CG</p>
                            </td>
                            <td>
                                <p><input type="checkbox" name="contrato_entre"/>Contrato</p>
                            </td>
                        </tr>
                        <tr>
                            <td><p>Monto contratado menor a:</p></td>
                            <td><input type="text" class="txtmenora" id="inputext" name="txtmenor-a" size="10"/></td>
                            <td></td>
                            <td></td>
                            <td>
                                <p><input type="checkbox" name="oc_oc_menora" CHECKED DISABLED/>OC/OT</p>
                            </td>
                            <td>
                                <p><input type="checkbox" name="ca_cg_menora"/>CA y CG</p>
                            </td>
                            <td>
                                <p><input type="checkbox" name="contrato_menora"/>Contrato</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </fieldset>
            <br />
            <fieldset>
                <div id="inner-textfield">
                    <table>
                        <tr>
                            <td><p>Selecione modelo de carta de adjudicacion y condiciones generales</p></td>
                            <td><input class="cls-modelocarta" type="text" size="45" id="inputext" READONLY/><input id="btn-modelocartaadjudicacion" type="button" value="..." class="ui-button ui-widget ui-state-default ui-corner-all"/></td>
                            <input type="hidden" class="carta_id" name="carta--id" />
                        </tr>
                        <tr>
                            <td><p>Selecione modelo de contrato</p></td>
                            <td><input class="cls-modelocontrato" type="text" size="45" id="inputext" READONLY/><input id="btn-modelocartacontrato" type="button" value="..." class="ui-button ui-widget ui-state-default ui-corner-all"/></td>
                            <input type="hidden" class="contrato_id" name="contrato--id" />
                        </tr>
                    </table>
                </div>
            </fieldset>
            <div id="footer"><hr/></div>
        <input type="submit" value="Guardar" class="ui-button ui-widget ui-state-default ui-corner-all" />
        </div>
        </form>
    </body>
</html>