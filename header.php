<!DOCTYPE html>

<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Servicio </title>
  <link rel="shortcut icon" href="img/elicon.ico">
  
  
  <link rel="stylesheet" type="text/css" href="config/stylesheet.css">
  
  <script type="text/javascript" src="config/jquery-1.8.2.min.js"></script>
  <script type="text/javascript" src="config/javascript.js"></script>
 
  <script>

  document.onkeydown = function(){  
    if(window.event && window.event.keyCode == 116){ 
      window.event.keyCode = 505;  
    } 
    if(window.event && window.event.keyCode == 505){  
      return false;     
    }  
  }
  
 </script>

 <!--[if gte IE 5]> 
  <style type="text/css"> #blanket {filter:alpha(opacity=65);}</style>
 <![endif]-->

</head>

<body topmargin="8" <?php if($t!='' && $s=='') echo 'onLoad="filtro.focus();filtro.select()"' ?>>

<div id="blanket" style="display:none;"></div>

<table width="100%" cellspacing="0" cellpadding="0" border="0">
 <tr>
  <td rowspan="2" width="10%">
    <img src="img/logo_small.jpg" height="100">
  </td>
  <td>
  
   <table width="100%" cellspacing="2" cellpadding="0" border="0">
    <tr>
     <td width="20%" valign="top">
      
     </td>
     <td id="top_title" nowrap>
      Gestion de Servicio
      <div style="font:24px 'Monotype corsiva';color:black">
        Remantts Mantenimiento y Suministros
      </div>
        
      
     </td>
     <td id="top_session" width="33%" valign="top">
      Usuario: <b><?php echo $_SESSION['nombre'].' '.$_SESSION['apellido'] ?></b><br>
      [<a href="index.php?a=logout">Cerrar sesion</a>] </div>
     </td>
    </tr>
   </table>
   
  </td>
 </tr>
 <tr>
  <td align="left" valign="bottom">
   
   <table cellspacing="0">
    <tr>
      <td class="tab<?php echo $t==''? '_s': ''; ?>"><a href="index.php">Inicio</a></td>
      <td>&nbsp; </td>

      <td class="tab<?php echo $t=='visitas'? '_s': ''; ?>">
        <a href="index.php?t=visitas">Visitas</a></td>
      <td>&nbsp; </td>

      <td class="tab<?php echo $t=='solicitudes'? '_s': ''; ?>">
        <a href="index.php?t=solicitudes">Solicitudes</a></td>
      <td>&nbsp; </td>

      <td class="tab<?php echo $t=='equipos'? '_s': ''; ?>">
        <a href="index.php?t=equipos">Equipos</a></td>
      <td>&nbsp; </td>

      <?php if($_SESSION['user_cia']=="0"): ?>
      <td class="tab<?php echo $t=='contactos'? '_s': ''; ?>">
        <a href="index.php?t=contactos">Contactos</a></td>
      <td>&nbsp; </td>
      <?php endif ?>

      <?php if($_SESSION['user_cia']=="0"): ?>
      <td class="tab<?php echo $t=='propietarios'? '_s': ''; ?>">
        <a href="index.php?t=propietarios">Propietarios</a></td>
      <td>&nbsp; </td>
      <?php endif ?>

      <?php if($_SESSION['user_cia']=="0"): ?>
      <td class="tab<?php echo $t=='productos'? '_s': ''; ?>">
        <a href="index.php?t=productos">Productos</a></td>
      <td>&nbsp; </td>
      <?php endif ?>

      <?php if($_SESSION['userid']=="1"): ?>
      <td class="tab<?php echo $t=='usuarios'? '_s': ''; ?>">
        <a href="index.php?t=usuarios">Usuarios</a></td>
      <td>&nbsp; </td>
      <?php endif ?>

      <?php if($_SESSION['userid']=="1"): ?>
      <td class="tab<?php echo $t=='actividad'? '_s': ''; ?>">
        <a href="index.php?t=actividad">Actividad</a></td>
      <td>&nbsp; </td>
      <?php endif ?>

      <td class="tab<?php echo $t=='configuracion'? '_s': ''; ?>">
        <a href="index.php?t=configuracion">Configuracion</a></td>
      <td>&nbsp; </td>
    </tr>
   </table>
    
  </td>
 </tr>
 <tr>
  <td colspan="2" bgcolor="#d52b1e" height="8">

  </td>
 </tr>
</table>

<?php

$hoy = date("Y-m-d H:i:s");

?>