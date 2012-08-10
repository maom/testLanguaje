<?php
if (isset($_GET[regid]) AND !empty($_GET[regid])) {
  require_once "DB.php";
  require_once "f_genericas.inc.php";
  include_once "test_lfbypefe_des.inc.php";

  $db = DBconnect($dsn); 
  $SQL = "UPDATE USUARIO SET confirmado = 'S' WHERE uniqid = '" . $_GET[regid] . "' LIMIT 1";
  $RES = dbQuery($SQL);
  if ($db->affectedRows() == 1) {
    $mensaje = "Su registro ha sido confirmado, puede ingresar al sistema.";
  } else {
    $mensaje = "El c&oacute;digo de confirmaci&oacute;n es incorrecto.";
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div align="center">
  <?=$mensaje?>
  <br />
  <br />
  <a href="index.html"><img src="img/regresar_home.jpg" width="150" height="138" border="0" /></a></div>
</body>

</html>
