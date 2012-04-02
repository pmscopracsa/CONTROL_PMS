<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><REGISTRO DE PERSONAS</title>
        <!-- zona css -->
        <link href="../../css/cuerpo.css" rel="stylesheet" type="text/css" />
        <!--    ZONA JS -->
        <script src="../../js/jquery1.4.2.js.js" type="text/javascript"></script>
        <script src="../../js/tfijo.js" type="text/javascript"></script>
        <script>
        
        </script>
        
    </head>
    <body>
        <h1>REGISTRO DE PERSONAS</h1>
        <form action="" method="POST">
            <table>
                <tr>
                    <td><label>D.N.I</label></td>
                    <td><input type="text" size="9" name="dni"</td>
                </tr>
                <tr>
                    <td><label>Nombre</label></td>
                    <td><input type="text" size="9" name="nombre"</td>
                </tr>
                <tr>
                    <td><label>Compania</label></td>
                    <td>
                        <select name="companiaseleccionada" id="companiaseleccionada">
                            <option value="0">Seleccione una compania</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Cargo</label></td>
                    <td><input type="text" size="9" name="cargo"</td>
                </tr>
                <tr>
                   <td><label for="telefono_fijo">Tel&eacute;fono Fijo:</label></td>
                   <td>
                       <table border="0" class="atable">
                           <tr>
                               <th></th>
                               <th colspan="2"></th>
                           </tr>
                           <tr>
                               <td><input type="text" size="15" name="telefonofijo" /></td>
                               <td><input type="button" class="addRow" value="+" /></td>
                               <td><input type="button" class="delRow" value="-" /></td>
                           </tr>
                           <input type="hidden" class="rowCount" name="filas_tfijo" />
                       </table>
                       <script type="text/javascript">
                       (function($){
                           $(document).ready(function(){
                              $(".addRow").btnAddRow({displayRowCountTo:"rowCount"});
                              $(".delRow").btnDelRow();
                           });
                       })(jQuery);
                       </script>
                   </td>
               </tr>
               <tr>
                   <td><label for="telefono_movil">Tel&eacute;fono M&oacute;vill:</label></td>
                   <td>
                   <table>
                       <tr>
                           <th></th>
                           <th colspan="2"></th>
                       </tr>
                       <tr>
                           <td><input type="text" size="15" name="telefonomovil" /></td>
                           <td><input type="button" class="addRow" value="+" /></td>
                           <td><input type="button" class="delRow" value="-" /></td>
                       </tr>
                       <input type="hidden" class="rowCount" name="filas_tmovil" />
                   </table>
                   
               </td>
               </tr>
               <tr>
                   <td><label for="telefono_nextel">Tel&eacute;fono Nextel:</label></td>
                   <td>
                       <table>
                       <tr>
                           <th></th>
                           <th colspan="2"></th>
                       </tr>
                       <tr>
                           <td><input type="text" size="15" name="telefononextel" /></td>
                           <td><input type="button" class="addRow" value="+" /></td>
                           <td><input type="button" class="delRow" value="-" /></td>
                       </tr>
                       <input type="hidden" class="rowCount" name="filas_tnextel" />
                   </table>
                   </td>
               </tr>
               <tr>
                   <td><label for="direccion">Direcci&oacute;n:</label></td>
                   <td>
                       <table border="0" class="atable">
                           <tr>
                               <th>Tipo de Direcci&oacute;n</th>
                               <th>Direcci&oacute;n</th>
                               <th>Departamento</th>
                               <th>Provincia</th>
                               <th>Distrtito</th>
                               <th colspan="2"></th>
                           </tr>
                           <tr>
                               <td>
                                   <select name="tipodireccionseleccionada" id="tipodireccionseleccionada">
                                       <option value="0">Seleccionar tipo de Direccion</option>
                                   </select>
                               </td>
                               <td><input type="text" size="25" name="direccion" /></td>
                               <td>
                                   <select name="departamentoseleccionada" id="departamentoseleccionada">
                                       <option value="0">Seleccionar departamento</option>
                                   </selected>
                               </td>
                               <td>
                                   <select name="provinciaseleccionada" id="provinciaseleccionada">
                                       <option value="0">Seleccione una provincia</option>
                                   </select> 
                               </td>
                               <td>
                                   <select name="distritoseleccionada" id="distritoseleccionada">
                                       <option value="0">Seleccione un distrito</option>
                                   </select>
                               </td>
                               <td><input type="button" class="addRow" value="+" /></td>
                               <td><input type="button" class="delRow" value="-" /></td>
                           </tr>
                           <input type="hidden" class="rowCount" name="filas" />
                       </table>
                       
                   </td>
               </tr>
               <tr>
                   <td><label>Observaci&oacute;n</label></td>
                   <td><textarea></textarea></td>
               </tr>
               <tr>
                   <td><label for="email">Email:</label></td>
                   <td><input type="text" size="30" placeholder="" name="email"</td>
               </tr>
               <tr>
                   <td><label for="web">Web:</label></td>
                   <td><input type="text" size="30" placeholder="" name="web" /></td>
               </tr>
               <tr>
                   <td><label for="fax">Fax:</label></td>
                   <td><input type="text" size="30" placeholder="" name="fax" /></td>
               </tr>
               <tr>
                   <td><label for="via_envio">V&iacute;a de Env&iacute;o:</label></td>
                   <td>
                       <select name="viaenvioseleccionada" id="viaenvioseleccionada">
                           <option value="0">Seleccione una V&iacute;a de Env&iacute;o</option> 
                       </select>
                   </td>
               </tr>
            </table>
        </form>
    </body>
</html>
