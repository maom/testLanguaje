<?php
	session_start();
	if($_SESSION['flag_test']== 'SI'){
		echo"<script language = 'javascript'>
			alert('Usted ya ingreso o respondio este TEST, para realizarlo nuevamente envienos un mensaje en contacto o bien comun\u00edquense con nosotros v\u00eda telef\u00f3nica');
		</script>\n";
	} 
	$_SESSION['flag_test'] = 'NO';
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>::::..:: Practical Education for Executives  :.:.:  SISTEMA DE TEST EN LINEA</title>


<link href="SCRIPTS/estilos.css" rel="stylesheet" type="text/css">
<?php include "SCRIPTS/script_mouseover.js";?>
<?php include "SCRIPTS/FECHA.js";?>
</head>

<body onLoad="<?php include "SCRIPTS/precarga.js";?>">
<table width="977" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><?php include "ENCABEZADO.html";?></td>
  </tr>
  <tr>
    <td background="img/fondo_contenido.gif" bgcolor="#393B3F"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td><img src="img/pixel.gif" width="10" height="10" /></td>
      </tr>
      <tr>
        <td align="center"><img src="img/titulosistema.jpg" width="511" height="117" /></td>
      </tr>
      <tr>
        <td><img src="img/pixel.gif" width="10" height="10" /></td>
      </tr>
      <tr>
        <td><table border="0" align="center">
          <tr>
            <td><img src="img/pixel.gif" width="40" height="10" /></td>
            <td align="center"><a href="TEST_ingles.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('TEST_1','','img/ventana_test_ingles1.png',1)"><img src="img/ventana_test_ingles.png" name="TEST_1" width="230" height="164" border="0" id="TEST_1" /></a></td>
            <td><img src="img/pixel.gif" width="40" height="10" /></td>
            <td align="center"><a href="TEST_liderazgo.html" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('TEST_2','','img/ventana_test_liderazgo1.png',1)"><img src="img/ventana_test_liderazgo.png" name="TEST_2" width="230" height="164" border="0" id="TEST_2" /></a></td>
            <td><img src="img/pixel.gif" width="40" height="10" /></td>
            <td align="center"><a href="TEST_percepcion.html" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('TEST_3','','img/ventana_test_percepcion1.png',1)"><img src="img/ventana_test_percepcion.png" name="TEST_3" width="230" height="164" border="0" id="TEST_3" /></a></td>
            <td><img src="img/pixel.gif" width="40" height="10" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table border="0" align="center">
          <tr>
            <td><img src="img/pixel.gif" width="40" height="10" /></td>
            <td align="center"><a href="TEST_dominancia.html" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('TEST_4','','img/ventana_test_dominancia1.png',1)"><img src="img/ventana_test_dominancia.png" name="TEST_4" width="230" height="164" border="0" id="TEST_4" /></a></td>
            <td><img src="img/pixel.gif" width="40" height="10" /></td>
            <td align="center"><a href="TEST_inteligencia.html" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('TEST_5','','img/ventana_test_inteligencia1.png',1)"><img src="img/ventana_test_inteligencia.png" name="TEST_5" width="230" height="164" border="0" id="TEST_5" /></a></td>
            <td><img src="img/pixel.gif" width="40" height="10" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td class="texto_verdana_10px_gris" align="center"><?php include "PIE.html";?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td><img src="img/pixel.gif" width="1" height="2"></td>
  </tr>
</table>
</body>
</html>
