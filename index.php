<?php
session_start();

include("sesion.php");
include("header.php");

switch($t) {
	case              '': include('resumen.php');        break;
	case   'solicitudes': include('solicitudes.php');    break;
	case       'visitas': include('recorridos.php');     break;
	case     'productos': include('productos.php');      break;
	case       'equipos': include('equipos.php');        break;
	case  'propietarios': include('propietarios.php');   break;
	case     'contactos': include('contactos.php');      break;
	case      'usuarios': include('usuarios.php');       break;
	case     'actividad': include('actividad.php');      break;
	case 'configuracion': include('configuracion.php');	 break;
}

include('footer.php');
