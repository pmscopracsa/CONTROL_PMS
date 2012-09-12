jQuery(function() {
    /** CARGA INICIAL POR DEFECTO */
    $("#modal_cliente").load("../modales/clientes_div.php?filtro=1");
    $("#modal_contratante").load("../modales/empcontratante_div.php?filtro=1");
    $("#modal_gerente").load("../modales/empgerproyecto_div.php?filtro=1");
    $("#modal_supervisor").load("../modales/empsupproyecto_div.php?filtro=1");
    $("#modal_proveedor").load("../modales/proveedorfacturar_div.php?filtro=1");
    $("#modal_contactos").load("../modales/contactos_div.php?filtro=1");
});

/** RELOAD FORM */
function reload(){
    
}

/** RECARGA POR FILTRO */
function recargaCliente(filtro) { $("#modal_cliente").load("../modales/clientes_div.php?filtro="+filtro); }
function recargaContratante(filtro) { $("#modal_contratante").load("../modales/empcontratante_div.php?filtro="+filtro); }
function recargaGerente(filtro) { $("#modal_gerente").load("../modales/empgerproyecto_div.php?filtro="+filtro) }
function recargaSupervisor(filtro) { $("#modal_supervisor").load("../modales/empsupproyecto_div.php?filtro="+filtro); }
function recargaProveedor(filtro) { $("#modal_proveedor").load("../modales/proveedorfacturar_div.php?filtro="+filtro); }

/** CARGA DE COMBOBOXES SELECCIONADAS*/
function cargarDepartamento(iddepartamento) {
    cargarDepartamentoSelected(iddepartamento);
    $("#div_iddepartamento tbody").append(
        "<td><select disabled='disabled' id='departamento'><select>"+
        "<td><input type='button' id='btnEditarDepartamento' value='Modificar' class='ui-button ui-widget ui-state-default ui-corner-all'/>"    
    )
}

function cargarDepartamentoSelected(iddepartamento) {
    $.ajax({
        dataType:"html",
        data:{id_departamento:iddepartamento},
        url:"../../../bl/Contacto/cargarDepartamentosSelected.php",
        success:function(data){
            $("#departamento").append(data);
        }
    });
}

function cargarMoneda(idmoneda) {
    cargarMonedaSelected(idmoneda);
    $("#div_idmoneda tbody").append(
        "<td><select disabled='disabled' id='moneda'><select>"+
        "<td><input type='button' id='btnEditarMoneda' value='Modificar' class='ui-button ui-widget ui-state-default ui-corner-all'/>"    
    )
}

function cargarMonedaSelected(idmoneda) {
    $.ajax({
        dataType:"html",
        data:{id_moneda:idmoneda},
        url:"../../../bl/DatosObra/cargarTipoMonedaSelected.php",
        success:function(data){
            $("#moneda").append(data);
        }
    });
}

function cargarTipoValorizacion(idtipoval) {
    cargarTipoValSelected(idtipoval);
    $("#div_idtipoval tbody").append(
        "<td><select disabled='disabled' id='tipoval'><select>"+
        "<td><input type='button' id='btnEditarTipoVal' value='Modificar' class='ui-button ui-widget ui-state-default ui-corner-all'/>"    
    )
}

function cargarTipoValSelected(idtipoval) {
    $.ajax({
        dataType:"html",
        data:{id_valorizacion:idtipoval},
        url:"../../../bl/DatosObra/cargarTipoValorizacionSelected.php",
        success:function(data){
            $("#tipoval").append(data);
        } 
    })
}

function cargarFormatoPresupuesto(idformato){
    cargarFormatoPresupuestoSelected(idformato);
    $("#div_idpresupuesto tbody").append(
        "<td><select disabled='disabled' id='formato'><select>"+
        "<td><input type='button' id='btnEditarFormato' value='Modificar' class='ui-button ui-widget ui-state-default ui-corner-all'/>"    
    )
}

function cargarFormatoPresupuestoSelected(idformato){
    $.ajax({
        dataType:"html",
        data:{id_formato:idformato},
        url:"../../../bl/DatosObra/cargarFormatoPresupuestoSelected.php",
        success:function(data){
            $("#formato").append(data);
        }
    })
}

function cargarContactos(idobra)
{
    $.ajax({
        type:"GET",
        dataType:"json",
        data:{
            id_obra:idobra
        },
        url:"../../../dl/datos_obra/r_listacontactosporobra.php",
        success:function(data) {
            muestraContactos(data);
        }
    })
}

function muestraContactos(data) {
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
            '<input type="hidden" id="idContacto" value="'+data[index].id+'" />'+
            '<td><a href="#" id="del-contacto" class="button delete">Eliminar</a>'
        )
    })
}

// cargar contactos con sus puestos en la obra
function cargarContactoPuesto(idobra)
{
    $.ajax({
        type:"GET",
        dataType:"json",
        data:{
            id_obra:idobra
        },
        url:"../../../dl/datos_obra/r_listacontactosfirmasporobras.php",
        success:function(data) {
            $.each(data,function(index,value) {
                $("#tbl-firmas1 tbody").append(
                    '<tr>'+
                    '<td>'+
                    data[index].posicion+
                    '<td>'+
                    data[index].nombre+
                    '<td>'+
                    data[index].descripcion+
                    '<input type="hidden" id="idContacto" value="'+data[index].id+'" />'+
                    '<td><a href="#" id="del-contactopuesto" class="button delete">Eliminar</a>'
                )
            })
        }
    })
}