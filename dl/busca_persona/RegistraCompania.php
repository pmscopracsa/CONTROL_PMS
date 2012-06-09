<?php

/**
 * @Descripcion:
 * @Tablas:
 * tb_companiacontacto // representante
 * tb_telefonofijocompania
 * tb_telefonomovilcompania
 * tb_telefononextelcompania
 * tb_giro
 * 
 * tb_viaenvio
 * tb_tipocompania
 */
class RegistraCompania 
{
    protected $id;
    protected $tipoCompania;
    protected $ruc;
    protected $nombre;
    protected $nombreComercial; 
    protected $partidaRegistral;
    protected $giro;
    protected $actividadPrincipal;
    protected $telefonoFijo;
    protected $telefonoMobile;
    protected $telefonoNextel;
    protected $direccion;
    protected $especialidad;
    protected $representate;
    protected $observacion;
    protected $email;
    protected $web;
    protected $viaEnvio;
    
    public function __construct() {
        ;
    }
    
    public function i_RegistraCompania()
    {
        
    }
    
    public function u_RegistraCompania()
    {
        
    }
    
    public function d_RegistraCompania()
    {
        
    }
}

?>
