<?php
date_default_timezone_set("America/Mexico_City");

$hoy = date("Y-m-d H:i:s");

include("mysql.php");

$conn = mysqli_connect("$mysql_localhost", "$mysql_username", "$mysql_password", "$mysql_database");

$a = isset($_GET['a'])? $_GET['a']: "";   // action
$f = isset($_GET['f'])? $_GET['f']: "";   // filter
$i = isset($_GET['i'])? $_GET['i']: "";   // info
$s = isset($_GET['s'])? $_GET['s']: "";   // screen
$t = isset($_GET['t'])? $_GET['t']: "";   // tab
$v = isset($_GET['v'])? $_GET['v']: "";   // value
$n = isset($_GET['n'])? $_GET['n']: "";   // number
$o = isset($_GET['o'])? $_GET['o']: "";   // number

if($a=="logout")
  {
  $conn = mysqli_connect("localhost", "$mysql_username", "$mysql_password", "$mysql_database");
  $query = "INSERT INTO actividad (id, usuario, fecha, evento) VALUES (0, ".$_SESSION['userid'].", '".$hoy."', 'Fin de sesion, usuario ".$_SESSION['username']."')";
  $rs = mysqli_query($conn, $query);
  mysqli_close($conn);
  session_destroy();
  $_SESSION['username']="";
  }

$login = 0;
$username = isset($_SESSION['username'])? $_SESSION['username']: "";

if($username=="")
  {
  $username = isset($_POST['username'])? $_POST['username']: "";
  $password = isset($_POST['password'])? $_POST['password']: "";
  if($username=="")
    {
    ?>
    <html>
    <head>
    <title>Servicio - Inicio de sesion </title>
    </head>
    <body>
	  <table width="100%" height="75%">
     <tr>
      <td align="CENTER" valign="MIDDLE">
      <h2 style="font-family:Arial narrow;color:gray"></h2><br>
       <form action="index.php?a=login" method="POST">
       <table width="454" bgcolor="#bbccdd" cellpadding="5" cellspacing="5" border="0">
        <tr> 
         <td colspan="2" bgcolor="WHITE"><img height="56" src="img/logorms.jpg" alt="Company Logo">&nbsp; </td>
        </tr>
        <tr>
         <td align="RIGHT"><font face="Verdana" size="2" color="WHITE"><b>Nombre de usuario: </b></td>
         <td><input type="TEXT" size="20" name="username"></td>
        </tr>
        <tr>
         <td align="RIGHT"><font face="Verdana" size="2" color="WHITE"><b>Contraseña: </b></td>
         <td><input type="PASSWORD" size="20" name="password"></td> 
        </tr>
        <tr>
         <td>&nbsp; </td>
         <td><input type="SUBMIT" value=" Aceptar "></td>
        </tr>
       </table><br>
       </form>
      </td>
     </tr>
    </table>
    </body>
    </html>
    
    <?php
    exit();
    }
  else
    {
	$query  = "SELECT id, username, password, nombre, apellido, compania ";
	$query .= "FROM usuarios  ";
	$query .= "WHERE username='$username' AND password='$password'";
	
	$rs = mysqli_query($conn, $query);
	
	if($row = mysqli_fetch_array($rs))
	  {
	  if($password == $row['password'] And $password != NULL)
	    {
      $_SESSION['userid']   = $row['id'];
		  $_SESSION['username'] = $row['username'];
		  $_SESSION['nombre']   = $row['nombre'];
		  $_SESSION['apellido'] = $row['apellido'];
      $_SESSION['user_cia'] = $row['compania'];

      $_SESSION['propietario'] = "";
      $_SESSION['equipo'] = "";
		  $login = 1;

      $query = "INSERT INTO actividad (id, usuario, fecha, evento) VALUES (0, ".$_SESSION['userid'].", '".$hoy."', 'Inicio de sesion, usuario ".$username."')";
      $rs = mysqli_query($conn, $query);
	    }
	  }
	else 
    {
    $query = "INSERT INTO actividad (id, usuario, fecha, evento) VALUES (0, 99, '".$hoy."', 'Intento de inicio de sesion fallido, usuario ".$username.", password ".$password." ')";
    $rs = mysqli_query($conn, $query);
    }

	if(!$login)
	  {
	  ?>
	  
	  <table width=100% height=75%>
	   <tr>
	    <td align=CENTER valign=MIDDLE>
	     <table cellpadding="8" bgcolor="red">
	      <tr>
	       <td bgcolor="#ffeeee" align="center">
	        <b><font color=RED size=4>¡Error! </font><br>
	        El nombre de usuario no esta registrado o el password es incorrecto</b><P>
	       </td>
	      </tr>
	     </table>
	     <A HREF=index.php>Volver a intentar </A>
	    </td>
	   </tr>
	  </table>
	   
	  <?php
	  exit();
      }
    }
  }




function hora($arg) {
  $sufix = (intval(substr($arg, 11, 2))>12)? "PM": "AM";
  return abs(substr($arg, 11, 2)).":".substr($arg, 14, 2)." ".$sufix;
}

function fecha($arg) {
  $nom_mes = array(1=>"enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
  if(substr($arg, 5, 2)==0) return "";
  return abs(substr($arg, 8, 2))."-".ucfirst(substr($nom_mes[abs(substr($arg, 5, 2))], 0, 3))."-".substr($arg, 0, 4);
}

function fecha2($arg) {
  if(substr($arg, 5, 2)==0) return "";
  return substr($arg, 8, 2)."-".substr($arg, 5, 2)."-".substr($arg, 0, 4);
}

function transcurrido($date1, $date2, $tipo="normal") {
  if (!is_integer($date1)) $date1 = strtotime($date1);
  if (!is_integer($date2)) $date2 = strtotime($date2);
  $minutos = floor(abs($date1 - $date2) / 60);
  $horas = floor($minutos / 60);
  $dias = floor($horas / 24);

  if($tipo=="dias") {
    if($dias>1)
      return $dias." dias ";
    else {
      if($dias==1)
        return "1 dia ";
      else 
        return "hoy";
    }
  }

  if($dias>0)
    {
    if($dias>1) return $dias." dias ".($horas%24).' horas';
    else return "1 dia ".($horas%24).' horas';
    }

  if($horas>0)
    {
    if($horas>1) return $horas." horas";
    else return "1 hora";
    }

  if($minutos>0)
    {
    if($minutos>1) return $minutos." minutos";
    else return "1 minuto";
    }
  return "un momento";
}




class GRID {

  var $connection;
  var $Titles       = "Id";
  var $querySelect  = "id";
  var $queryFrom    = "usuarios";
  var $queryWhere   = "1";
  var $queryOrderBy = "id";
  var $url          = "index.php";

  function display() {

    echo '<table class="upper">';
    echo '<tr>';
    echo '<td nowrap>&nbsp;</td>';
    echo '<td width="99%" align="right"><div id="label"></div></td>';
    echo '</tr>';
    echo '</table>';

    echo '<table class="grid" cellspacing="1"><tr>';

    $titles = explode(', ', $this->Titles);
    foreach($titles as $title) {
      echo '<th>'.$title.'</th>';
    }
    echo '</tr>';

    $query  = 'SELECT '.$this->querySelect.' FROM '.$this->queryFrom.' WHERE '.$this->queryWhere.' ORDER BY '.$this->queryOrderBy;
    $result = mysqli_query($this->connection, $query);

    $n=0;
    $num_rows = 0;
    while($reg = mysqli_fetch_array($result)) {

      // Color de fondo por renglones pares e impares
      echo ($num_rows%2)? '<tr class="odd">': '<tr class="even">';

      $items = explode(', ', $this->querySelect);

      $n=0;
      foreach ($items as $i) {
        echo '<td onClick="location.href=\''.$this->url.$reg['id'].'\'">'.$reg[$n++].'</td>';
      }
      echo '</tr>';

      $num_rows++;
    }
    if($num_rows==0)
      echo '<tr><td colspan="99">&nbsp;</td></tr>';
    echo '<tr><td colspan="'.$n.'" bgcolor="#ddd">&nbsp;</td></tr>';
    echo '</table>';

    echo "<script> var x = document.getElementById('label').innerHTML='".$num_rows." Resultado(s)'; </script>";

  }

}


?>
