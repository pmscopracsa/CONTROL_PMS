<?php
class LimpiarVariable 
{
    public function Filtro($cadena)
    {
        $cadena = trim($cadena);
        $cadena = strip_tags($cadena);
        $cadena = htmlentities($cadena);
        $cadena = strtolower($cadena);
        //$cadena = mysql_real_escape_string($cadena);
        //$cadena = preg_replace('/\s+/', '', $cadena);
        
        return $cadena;
    }
}