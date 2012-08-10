<?php
include_once "funciones_test.php";
authTest("1");
require_once "DB.php";
require_once "f_genericas.inc.php";
include_once "test_lfbypefe_des.inc.php";
    
$db = DBconnect($dsn);    

if (isset($_POST['enviar']) AND $_POST['enviar'] == "TRUE") {
    header("location: TEST_inglesfase2.php");
}

$SQL = "SELECT * FROM FASES_TEST WHERE clave_test = '". $_SESSION['Sess_clave_test'] . "';";
$RES = DBquery($SQL);
$ROW = $RES->fetchRow();
$clave_fase         = $ROW[0];
$titulo_fase        = $ROW[1];
$instrucciones_fase = $ROW[2];

$SQL_SECCION = "SELECT * FROM SECCIONES_FASE WHERE clave_fase = '$clave_fase ' ORDER BY clave_seccion;";
$RES_SECCION = DBquery($SQL_SECCION);
$ROW_SECCION = $RES_SECCION->fetchRow();

$db->disconnect;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>::::..:: Practical Education for Executives  :.:.:  SISTEMA DE TEST EN LINEA</title>


<link href="SCRIPTS/estilos.css" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script>
  $().ready(function(){
    $("#ing1Form").validate();
  });
  function saveIng1(){
	  alert("Valid: " + $("#ing1Form").valid());
	  return false;
  }
</script>
<style type="text/css">
* { font-family: Verdana; font-size: 96%; }
label { width: 10em; float: left; }
label.error { float: none; color: red; padding-left: .5em; vertical-align: top; }
p { clear: both; }
.submit { margin-left: 12em; }
</style>

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
                <td bgcolor="#FEF3EB">&nbsp;</td>
                <td bgcolor="#FEF3EB"><img src="img/pixel.gif" width="5" height="5" /></td>
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
        <td><table width="90%" border="0" align="center" cellpadding="2" cellspacing="2" class="texto_verdana_11px_blanco">
        <form class="ing1Form" action="<?=$PHP_SELF?>" method="post" id="ing1Form">

          <tr>
            <td bgcolor="#122D7A" class="texto_fase"><?=$titulo_fase?></td>
          </tr>


          <tr valign="top">
            <td class="textocontenido">&nbsp;</td>
          </tr>
          <?php
          if ( !empty($instrucciones_fase) ) {
          ?>
          <tr>
            <td bgcolor="#E46E0E" class="texto_verdana_9px_blanco"><strong><?=$instrucciones_fase?></strong></td>
           <?php
           }
           ?>
          <tr valign="top">
            <td class="textocontenido"><table width="100%" border="0" cellpadding="3" cellspacing="3" class="texto_verdana_11px_blanco">
                <tr>
                  <td><strong><?=imprime_respuesta($ROW_SECCION);?></strong></td>
                </tr>
                <tr>
                <p>
                  <td><?=crea_respuesta("n_responsabilidades", "M", 1, "required texto_cajas_naranja", 80, 5)?></td>
				</p>
                </tr>
                <tr>
                  <td background="img/fondobajotitulo.gif" class="TITULO">&nbsp;</td>
                </tr>
                <tr>
                  <td><strong>
                    <?php
                    $ROW_SECCION  = $RES_SECCION ->fetchRow();
                    $clave_seccion = $ROW_SECCION[0];
                    print $ROW_SECCION[2] . " hiii " . $ROW_SECCION[1];
                    ?>
                  </strong></td>
                </tr>
                <tr>
                  <td bgcolor="#E46E0E" class="texto_verdana_9px_blanco"><strong><?=$ROW_SECCION[4]?></strong></td>
                </tr>
                <?php
                $SQL_PREGUNTAS = "SELECT * FROM PREGUNTAS_SECCION ";
                $SQL_PREGUNTAS.= "WHERE clave_test = '". $_SESSION['Sess_clave_test'] . "' AND clave_fase = '$clave_fase' AND clave_seccion = '$clave_seccion' ";
                $SQL_PREGUNTAS.= "ORDER BY clave_pregunta;";
                $RES_PREGUNTAS = dbQuery($SQL_PREGUNTAS);
                $ROW_PREGUNTAS = $RES_PREGUNTAS->fetchRow();
                $clave_pregunta = $ROW_PREGUNTAS[0];
                ?>
                <tr>
                  <td><?=imprime_respuesta($ROW_PREGUNTAS);?></td>
                </tr>
                <tr class="textocontenido2">
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><table width="100%" border="0" cellpadding="3" cellspacing="3" class="texto_verdana_11px_blanco">
                      <tr>
                        <td width="50%" bgcolor="#F3F3F3"><strong>PRONUNCIACI&Oacute;N</strong></td>
                        <td bgcolor="#F3F3F3"><strong>REDACCI&Oacute;N</strong></td>
                      </tr>
                      <tr valign="top">
                        <td><table width="100%" border="0" class="texto_verdana_11px_blanco">
                        <?php
			                $SQL_RESPUESTAS = "SELECT * FROM RESPUESTAS_PREGUNTAS ";
			                $SQL_RESPUESTAS.= "WHERE clave_pregunta = '$clave_pregunta' AND clave_fase = '$clave_fase' ";
			                $SQL_RESPUESTAS.= "ORDER BY clave_respuesta;";
			                $RES_RESPUESTAS = dbQuery($SQL_RESPUESTAS);
			                $ROW_RESPUESTAS = $RES_RESPUESTAS->fetchRow();
	                        while ($ROW_RESPUESTAS[0] < 13) {
	                        $clave_respuesta = $ROW_RESPUESTAS[0];
	                        $respuesta = imprime_respuesta($ROW_RESPUESTAS);                   
                        ?>
                            <tr>
                              <td width="81%"><?=$respuesta?></td>
                              <td width="19%">
                              <?php
                              $SQL_OPCION = "SELECT * FROM OPCIONES_RESPUESTAS WHERE clave_respuesta = '$clave_respuesta' ORDER BY clave_opcion;";
                              $RES_OPCION = dbQuery($SQL_OPCION);
                              ?>                              
                              <select name="<?=$clave_respuesta?>" class="texto_cajas_naranja" id="<?=$clave_respuesta?>">
                              <?php
                              while ($ROW_OPCION = $RES_OPCION->fetchRow()) {
                              ?>
                                  <option value="<?=$ROW_OPCION[1]?>" <?php if ($ROW_OPCION[3] == 'S') print "selected";?>><?=$ROW_OPCION[1]?></option>
                              <?php
                              }                              
                              ?>
                              </select></td>
                            </tr>
                        <?php
                        $ROW_RESPUESTAS = $RES_RESPUESTAS->fetchRow();
                        }
                        ?>
                        </table></td>
                        <td><table width="100%" border="0" class="texto_verdana_11px_blanco">
                        <?php
                        while ($ROW_RESPUESTAS[0] < 16) {
                        $clave_respuesta = $ROW_RESPUESTAS[0];
                        $respuesta = imprime_respuesta($ROW_RESPUESTAS);
                        ?>
                            <tr>
                              <td width="81%"><?=$respuesta?></td>
                              <td width="19%">
                              <?php
                              $SQL_OPCION = "SELECT * FROM OPCIONES_RESPUESTAS WHERE clave_respuesta = '$clave_respuesta' ORDER BY clave_opcion;";
                              $RES_OPCION = dbQuery($SQL_OPCION);
                              ?>                              
                              <select name="<?=$clave_respuesta?>" class="texto_cajas_naranja" id="<?=$clave_respuesta?>">
                              <?php
                              while ($ROW_OPCION = $RES_OPCION->fetchRow()) {
                              ?>
                                  <option value="<?=$ROW_OPCION[1]?>" <?php if ($ROW_OPCION[3] == 'S') print "selected";?>><?=$ROW_OPCION[1]?></option>
                              <?php
                              }                              
                              ?>
                              </select></td>
                            </tr>
                        <?php
                        $ROW_RESPUESTAS = $RES_RESPUESTAS->fetchRow();
                        }
                        ?>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="2" bgcolor="#F3F3F3"><strong>LECTURA</strong></td>
                              </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                        <?php                        
                        while ($ROW_RESPUESTAS[0] < 21) {
                        $clave_respuesta = $ROW_RESPUESTAS[0];
                        $respuesta = imprime_respuesta($ROW_RESPUESTAS);
                        ?>
                            <tr>
                              <td width="81%"><?=$respuesta?></td>
                              <td width="19%">
                              <?php
                              $SQL_OPCION = "SELECT * FROM OPCIONES_RESPUESTAS WHERE clave_respuesta = '$clave_respuesta' ORDER BY clave_opcion;";
                              $RES_OPCION = dbQuery($SQL_OPCION);
                              ?>                              
                              <select name="<?=$clave_respuesta?>" class="texto_cajas_naranja" id="<?=$clave_respuesta?>">
                              <?php
                              while ($ROW_OPCION = $RES_OPCION->fetchRow()) {
                              ?>
                                  <option value="<?=$ROW_OPCION[1]?>" <?php if ($ROW_OPCION[3] == 'S') print "selected";?>><?=$ROW_OPCION[1]?></option>
                              <?php
                              }                              
                              ?>
                              </select></td>
                            </tr>
                        <?php
                        $ROW_RESPUESTAS = $RES_RESPUESTAS->fetchRow();
                        }
                        ?>
                        </table></td>
                      </tr>
                      <tr valign="top">
                        <td colspan="2">
                        <?php
                        $clave_respuesta = $ROW_RESPUESTAS[0];
                        print imprime_respuesta($ROW_RESPUESTAS);
                        print crea_respuesta("n_necesidades_t", "T", 1, "texto_cajas_naranja", 70)
                        ?>
                        </td>
                      </tr>
                  </table></td>
                </tr>
                <?php
                $ROW_PREGUNTAS = $RES_PREGUNTAS->fetchRow();
                $clave_pregunta = $ROW_PREGUNTAS[0];
                ?>
                <tr>
                  <td><?=imprime_respuesta($ROW_PREGUNTAS);?></td>
                </tr>
                <tr>
                  <td><?=crea_respuesta("n_necesidades_lenguaje", "M", 1, "texto_cajas_naranja", 80, 3)?></td>
                </tr>
                <?php
                $ROW_PREGUNTAS = $RES_PREGUNTAS->fetchRow();
                $clave_pregunta = $ROW_PREGUNTAS[0];
                ?>
                <tr>
                  <td><?=imprime_respuesta($ROW_PREGUNTAS);?></td>
                </tr>
                <tr>
                  <td><?=crea_respuesta("n_necesidades_requerimiento", "M", 1, "texto_cajas_naranja", 80, 3)?></td>
                </tr>
            </table></td>
          </tr>
          <tr valign="top">
            <td class="textocontenido"><p align="center">
                <input type="hidden" name="enviar" value="TRUE">
                <input class="submit" name="Submit" type="image" class="textocontenido2" value="Enviar mis datos y respuestas de este cuestionario" src="img/boton_seguir.png">
				<!--<input type="button" name="Guardar" value"Enviar Ingles1" src="img/boton_seguir.png" onclick="saveIng1()">
				<input class="submit" type="submit" value="Submit"/>-->

				<!--<input name="SaveIng1" type="image" class="textocontenido2" value="Enviar ingles 1" src="img/boton_seguir.png" onclick="saveIng1()" >-->
            </p></td>
          </tr></form>
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
</html>
