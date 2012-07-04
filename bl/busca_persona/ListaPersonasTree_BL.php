<?php
require_once '../../dl/contacto_bl/testlistaespecialidades/ListaEspecialidadesTree.php';
$listaEspecialidades = new ListaEspecialidadesTree();
$especialidades = $listaEspecialidades->listaEspecialidades();

echo $especialidades;