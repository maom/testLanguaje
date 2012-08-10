<?php
require_once "../TEST/clases/Test_Clases_AccionesFormulario.php";
require_once "../TEST/clases/f_genericas_inc.php";
require_once "DB.php";
include_once "test_lfbypefe_des.inc.php";
$fase_num = 2;  
$obj_acciones_form = new Test_Clases_AccionesFormulario('', '', '', '');
$obj_acciones_form->authTest('1');
$obj_acciones_form = new Test_Clases_AccionesFormulario($dsn, $fase_num, $_SESSION['Sess_clave_test'], $_SESSION['Sess_clave_test_respondidos']);
require_once "../TEST/clases/Test_Clases_GenerarFases.php";
 


$obj_generar_fases = new Test_Clases_GenerarFases($dsn, $_SESSION['Sess_clave_test'], $fase_num);

//se verifica que el usuario no contesto ya esta fase
$flag = $obj_acciones_form->verificarClaveTestYClaveFaseEnRespuestasUsuasrios();
if($flag == 'true'){
	header("location: TEST_inglesfase3.php");
}
if (isset($_POST['enviar']) AND $_POST['enviar'] == "TRUE") {
	$res = $obj_acciones_form->guardarFaseTest($_POST);
	$_SESSION['Sess_time_t'] = $_POST['time_t'];
	if($res['error'] == 'true'){
		header("location: TEST_inglesfase3.php");
	} 
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>::::..:: Practical Education for Executives:.:.:  SISTEMA DE TEST EN LINEA</title>


<link href="SCRIPTS/estilos.css" rel="stylesheet" type="text/css">
<?php
$time = explode(':', $_SESSION['Sess_time_t']);
echo"<script language = 'javascript'>
	var minutos1 = $time[0]
	var segundos1 = $time[1]
	var decimas1 = $time[2]
</script>\n";
?>
<?php include "SCRIPTS/script_mouseover.js";?>
<?php include "SCRIPTS/FECHA.js";?>

</head>

<body onLoad="<?php include "SCRIPTS/precarga.js";?>">
<table width="977" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td background="img/fondo_encabezado.gif"><table width="977" border="0" cellpadding="0" cellspacing="0" id="ENCABEZADO">
      <tr>
        <td width="411" rowspan="3"><img src="img/logo.gif" width="411" height="100" border="0" /></td>
        <td width="566"></td>
      </tr>
      <tr>
        <td valign="top" align="right" class="texto_verdana_10px_gris"><strong>
          <script language="JavaScript" type="text/javascript">  
MostrarFecha();   
    </script>
          <img src="img/pixel.gif" width="20" height="20" /></strong></td>
      </tr>
      <tr>
        <td valign="bottom"><table width="134" border="0" align="right" cellpadding="0" cellspacing="0" id="MENU">
            <tr>
              <td width="134"><a href="TEST_ingles_instrucciones_ventana.php" target="_blank" onMouseOver="MM_swapImage('MENU_instrucciones','','img/MENU_instrucciones_test1.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="img/MENU_instrucciones_test.gif" name="MENU_contacto" width="134" height="44" border="0" id="MENU_instrucciones" /></a></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td background="img/fondo_contenido.gif" bgcolor="#393B3F"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td><img src="img/pixel.gif" width="10" height="10" /></td>
      </tr>
      <tr>
        <td align="center"><table border="0" align="right" cellpadding="0" cellspacing="0">
          <tr>
            <td><img src="img/pixel.gif" width="30" height="10" /></td>
            <td><table border="0" cellpadding="0" cellspacing="0" class="texto_verdana_10px_gris">
              <tr>
                <td>Inicio de sesi&oacute;n</td>
                <td><img src="img/pixel.gif" width="5" height="5" /></td>
                <td>Instrucciones</td>
                <td><img src="img/pixel.gif" width="5" height="5" /></td>
                <td>Fase 1</td>
                <td><img src="img/pixel.gif" width="5" height="5" /></td>
                <td>Fase 2</td>
                <td><img src="img/pixel.gif" width="5" height="5" /></td>
                <td>Fase 3</td>
                <td><img src="img/pixel.gif" width="5" height="5" /></td>
                <td>Fase 4</td>
                <td><img src="img/pixel.gif" width="5" height="5" /></td>
                </tr>
              <tr>
                <td bgcolor="#E46E0E">&nbsp;</td>
                <td bgcolor="#E46E0E"><img src="img/pixel.gif" width="5" height="5" /></td>
                <td bgcolor="#E46E0E">&nbsp;</td>
                <td bgcolor="#E46E0E"><img src="img/pixel.gif" width="5" height="5" /></td>
                <td bgcolor="#E46E0E">&nbsp;</td>
                <td bgcolor="#E46E0E"><img src="img/pixel.gif" width="5" height="5" /></td>
                <td bgcolor="#E46E0E">&nbsp;</td>
                <td bgcolor="#E46E0E"><img src="img/pixel.gif" width="5" height="5" /></td>
                <td bgcolor="#FEF3EB">&nbsp;</td>
                <td bgcolor="#FEF3EB"><img src="img/pixel.gif" width="5" height="5" /></td>
                <td bgcolor="#FEF3EB">&nbsp;</td>
                <td bgcolor="#FEF3EB"><img src="img/pixel.gif" width="5" height="5" /></td>
                </tr>
            </table></td>
            <td><img src="img/pixel.gif" width="120" height="8" /></td>
            <td align="right"><img src="img/titulo_TEST_ingles.jpg" width="400" height="39" /></td>
            <td><img src="img/pixel.gif" width="30" height="10" /></td>
          </tr>
        </table>          </td>
      </tr>
      <tr>
        <td><img src="img/pixel.gif" width="10" height="10" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
	   <tr>
	  	<td align="center" class="error_mensaje"><?=$res['mensaje']?></td>
	  </tr>
      <tr>
        <td><table width="90%" border="0" align="center" cellpadding="2" cellspacing="2" class="texto_verdana_11px_blanco">
         <form class="ing2Form" action="<?=$PHP_SELF?>" method="post" id="ing2Form">
		<?php $obj_generar_fases->generarFase()?>
          <tr valign="top">
            <td class="textocontenido"><p align="center">
              <input type="hidden" name="enviar" value="TRUE">
              <input name="Submit" type="image" class="textocontenido2" value="Enviar mis datos y respuestas de este cuestionario" src="img/boton_seguir.png">
            </p></td>
          </tr>
		  <tr>
		  	<td><input type="hidden" name="time_t" id="time_t" value=""></td>
		  </tr>
		  </form>
        </table></td>
      </tr>
      <tr>
        <td class="texto_verdana_10px_gris" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td class="texto_verdana_10px_gris" align="center"><?php include "PIE.php";?></td>
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
<script type="text/javascript" src="SCRIPTS/cronometro.js"></script>
</html>
