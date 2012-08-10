<?php
/**
 * 
 */ 
class Test_Clases_CorreosTests{
	public function enviarCorreoConResultadosDelTest($post){
       	// Varios destinatarios
       	$correo = $post['correo'];
       	$fecha = $post['fecha'];
       	$nombre = $post['nombre'];
       	$respuestas_correctas = $post['respuestas_correctas'];
       	$respuestas_incorrectas = $post['respuestas_incorrectas'];
       	$minutos = $post['minutos'];
		$para  = $correo; // atenci—n a la coma . ', '; 
		// subject
		$titulo = 'Evaluacion de Ingles';
		
		// message
		$mensaje = "
		<html>
		<head>
		  <title>Evaluaci&oacute;n de ingl&eacute;s</title>
		</head>
		<body>
		  <p><strong>Evaluaci&oacute;n de ingl&eacute;s</strong></p>
		  <table border='0' align='center' cellpadding='2' cellspacing='2'>
              <tr>
                <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_user_r.png' alt='Nombre del usuario' width='30' height='33'></td>
                <td>$nombre</td>
              </tr>
              <tr>
                <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_mail.png' alt='Correo electr&oacute;nico registrado' width='30' height='32'></td>
                <td>$correo</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_test_r.png' alt='Test respondido' width='30' height='39'></td>
                <td>Evaluaci&oacute;n de ingl&eacute;s</td>
              </tr>
              <tr>
                <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_date_r.png' alt='Fecha de aplicaci&oacute;n' width=30' height='33'></td>
                <td>$fecha</td>
              </tr>
              <tr>
                <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_aciertos_r1.png' alt='Aciertos' width='30' height='38'></td>
                <td>$respuestas_correctas</td>
              </tr>
              <tr>
                <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_errores.png' alt='Errores' width='30' height='38'></td>
                <td>$respuestas_incorrectas</td>
              </tr>
              <tr>
                <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_time_r.png' alt='Tiempo de resoluci&oacute;n' width='30' height='30'></td>
                <td>$minutos Minutos</td>
              </tr>
            </table>
		</body>
		</html>
		";	
		// Para enviar un correo HTML mail, la cabecera Content-type debe fijarse
		$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		// Cabeceras adicionales
		$cabeceras .= "To: $correo" . "\r\n";
		$cabeceras .= 'From: LFBYPEFE <noresponder@lfbypefe.com.mx>' . "\r\n";
		//$cabeceras .= 'Cc: birthdayarchive@example.com' . "\r\n";
		//$cabeceras .= 'Bcc: birthdaycheck@example.com' . "\r\n";	
		// Mail it
		mail($para, $titulo, $mensaje, $cabeceras);
	} 
	public function  enviarCorreoTestCanalesDePercepcion($post){
		$correo = $post['correo'];
       	$fecha = $post['fecha'];
       	$nombre = $post['nombre'];
       	$resultados_visuales  = $post['resultados_visuales'];
       	$resultados_auditivos = $post['resultados_auditivos'];
       	$resultados_kinestesicos = $post['resultados_kinestesicos']; 
       	$minutos = $post['minutos'];
		$para  = $correo; // atenci—n a la coma . ', '; 
		// subject
		$titulo = 'Evaluacion de canales de percepcion';
		$mensaje = "<html>
		<head>
		  <title>Evaluaci&oacute;n de canales de percepci&oacute;n</title>
		</head>
		<body>
		  <p><strong>Evaluaci&oacute;n de canales de percepci&oacute;n</strong></p>
			<table border='0' align='center' cellpadding='2' cellspacing='2' class='texto_verdana_12px_grisclaro'>
                  <tr>
                    <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_user_r.png' alt='Nombre del usuario' width='30' height='33'></td>
                    <td>$nombre</td>
                  </tr>
                  <tr>
                    <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_mail.png' alt='Correo electr&oacute;nico registrado' width='30' height='32'></td>
                    <td>$correo</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_test_r.png' alt='Test respondido' width='30' height='39'></td>
                    <td>Evaluaci&oacute;n de canales de percepci&oacute;n</td>
                  </tr>
                  <tr>
                    <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_date_r.png' alt='Fecha de aplicaci&oacute;n' width='30' height='33'></td>
                    <td>$fecha</td>
                  </tr>
                  <tr>
                    <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_time_r.png' alt='Tiempo de resoluci&oacute;n' width='30' height='30'></td>
                    <td>$minutos minutos</td>
                  </tr>
                  <tr>
                    <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_visual.png' alt='Resultados visuales' width='30' height='39'></td>
                    <td>$resultados_visuales puntos</td>
                  </tr>
                  <tr>
                    <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_auditivo.png' alt='Resultados auditivos' width='30' height='39'></td>
                    <td>$resultados_auditivos puntos</td>
                  </tr>

                  <tr>
                    <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_kinestesico.png' alt='Resultados kinestesicos' width='30' height='39'></td>
                    <td>$resultados_kinestesicos puntos</td>  
                  </tr>
              </table>
              </body>
		</html>";
			// Para enviar un correo HTML mail, la cabecera Content-type debe fijarse
		$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		// Cabeceras adicionales
		$cabeceras .= "To: $correo" . "\r\n";
		$cabeceras .= 'From: LFBYPEFE <noresponder@lfbypefe.com.mx>' . "\r\n";
		mail($para, $titulo, $mensaje, $cabeceras);
	}
	
	public  function enviarCorreoTestLiderazgoFuerzaDebilidades($post){
		$correo = $post['correo'];
       	$fecha = $post['fecha'];
       	$nombre = $post['nombre'];
       	$minutos = $post['minutos'];
		$para  = $correo; // atenci—n a la coma . ', '; 
		// subject
		$titulo = 'Auto evaluacion de liderazgo, fuerzas y debilidades';
		$mensaje = "<html>
		<head>
		  <title></title>
		</head>
		<body>
		  <p><strong>Auto evaluaci&oacute;n de liderazgo, fuerzas y debilidades</strong></p>
			<table border='0' align='center' cellpadding='2' cellspacing='2' class='texto_verdana_12px_grisclaro'>
                  <tr>
                    <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_user_r.png' alt='Nombre del usuario' width='30' height='33'></td>
                    <td>$nombre</td>
                  </tr>
                  <tr>
                    <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_mail.png' alt='Correo electr&oacute;nico registrado' width='30' height='32'></td>
                    <td>$correo</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_test_r.png' alt='Test respondido' width='30' height='39'></td>
                    <td>Auto evaluaci&oacute;n de liderazgo, fuerzas y debilidades</td>
                  </tr>
                  <tr>
                    <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_date_r.png' alt='Fecha de aplicaci&oacute;n' width='30' height='33'></td>
                    <td>$fecha</td>
                  </tr>

                  <tr>
                    <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_time_r.png' alt='Tiempo de resoluci&oacute;n' width='30' height='30'></td>
                    <td>$minutos minutos</td>
                  </tr>
              </table>
              </body> 
		</html>";
		// Para enviar un correo HTML mail, la cabecera Content-type debe fijarse
		$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		// Cabeceras adicionales
		$cabeceras .= "To: $correo" . "\r\n";
		$cabeceras .= 'From: LFBYPEFE <noresponder@lfbypefe.com.mx>' . "\r\n";
		mail($para, $titulo, $mensaje, $cabeceras);
	}
	public  function enviarCorreoTestEstilosDePensamiento($post){
		$correo = $post['correo'];
       	$fecha = $post['fecha'];
       	$nombre = $post['nombre'];
       	$minutos = $post['minutos'];
       	$cuadrante_a = $post['cuadrante_a'];
       	$cuadrante_b = $post['cuadrante_b'];
       	$cuadrante_c = $post['cuadrante_c'];
       	$cuadrante_d = $post['cuadrante_d'];
		$para  = $correo; // atenci—n a la coma . ', '; 
		
		// subject
		$titulo = 'Evaluacion estilos de pensamiento';
		$mensaje = "<html>
		<head>
		  <title></title>
		</head>
		<body> 
		  <p><strong>Evaluaci&oacute;n estilos de pensamiento</strong></p>
			<table border='0' align='center' cellpadding='2' cellspacing='2' class='texto_verdana_12px_grisclaro'>
                <tr>
                  <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_user_r.png' alt='Nombre del usuario' width='30' height='33'></td>
                  <td>$nombre</td>
                  <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_test_r.png' alt='Test respondido' width='30' height='39'></td>
                  <td>Instrumento sobre dominancia cerebral</td>
                </tr>
                <tr>
                  <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_mail.png' alt='Correo electr&oacute;nico registrado' width='30' height='32'></td>
                  <td>$correo</td>
                  <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_date_r.png' alt='Fecha de aplicaci&oacute;n' width='30' height='33'></td>
                  <td>$fecha</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td> 
                  <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_time_r.png' alt='Tiempo de resoluci&oacute;n' width='30' height='30'></td>
                  <td>$minutos minutos</td>
                </tr>
                <tr>
                  <td colspan='4'><table border='0' align='center' cellpadding='4' cellspacing='4' class='texto_verdana_12px_grisclaro'>
                    <tr>
                      <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_brain_a.png' alt='RESULTADOS CUADRANTE A SUPERIOR IZQUIERDO CEREBRAL' width='30' height='29'></td>
                      <td><strong>$cuadrante_a de 50</strong></td>
                      <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_brain_b.png' alt='RESULTADOS CUADRANTE B INFERIOR IZQUIERDO L&Iacute;MBICO' width='30' height='29'></td>
                      <td><strong>$cuadrante_b de 50</strong></td>
                      <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_brain_c.png' alt='RESULTADOS CUADRANTE C DERECHO INFERIOR L&Iacute;MBICO' width='30' height='29'></td>
                      <td><strong>$cuadrante_c de 50</strong></td>
                      <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_brain_d.png' alt='RESULTADOS CUADRANTE D DERECHO SUPERIOR CEREBRAL' width='30' height='29'></td>
                      <td><strong>$cuadrante_d de 50</strong></td>
                    </tr>
                  </table></td>
                  </tr>
              </table>   ";
		// Para enviar un correo HTML mail, la cabecera Content-type debe fijarse
		$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		// Cabeceras adicionales
		$cabeceras .= "To: $correo" . "\r\n";
		$cabeceras .= 'From: LFBYPEFE <noresponder@lfbypefe.com.mx>' . "\r\n";
		mail($para, $titulo, $mensaje, $cabeceras);
	}  
	public function enviarCorreoInteligenciaEmocional($post){
		$correo = $post['correo'];
       	$fecha = $post['fecha'];
       	$nombre = $post['nombre'];
       	$minutos = $post['minutos'];
		$para  = $correo; // atenci—n a la coma . ', '; 
		$grupo_a = $post['grupo_a'];
		$grupo_b = $post['grupo_b'];
		$grupo_c = $post['grupo_c'];
		$grupo_d = $post['grupo_d'];
		$grupo_e = $post['grupo_e'];
		$grupo_f = $post['grupo_f'];
		$grupo_g = $post['grupo_g'];
		$grupo_h = $post['grupo_h'];
		$grupo_i = $post['grupo_i'];
		$grupo_j = $post['grupo_j'];
		// subject
		$titulo = 'Evaluacion inteligecia emocional';
		$mensaje = "<html>
		<head>
		  <title></title>
		</head>
		<body> 
		  <p><strong>Evaluaci&oacute;n inteligecia emocional</strong></p>
			<table width='665' border='0' align='center' cellpadding='2' cellspacing='2' class='texto_verdana_12px_grisclaro'>
                <tr>
                  <td width='67'><img src='http://www.languagefirst.com.mx/TEST/img/icon_user_r.png' alt='Nombre del usuario' width='30' height='33'></td>
                  <td width='319'>$nombre</td>
                  <td width='67'><img src='http://www.languagefirst.com.mx/TEST/img/icon_test_r.png' alt='Test respondido' width='30' height='39'></td>
                  <td width='186'>Inteligencia emocional</td>
                </tr>
                <tr>
                  <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_mail.png' alt='Correo electr&oacute;nico registrado' width='30' height='32'></td>
                  <td>$correo</td>
                  <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_date_r.png' alt='Fecha de aplicaci&oacute;n' width='30' height='33'></td>
                  <td>$fecha</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_time_r.png' alt='Tiempo de resoluci&oacute;n' width='30' height='30'></td>
                  <td>$minutos minutos</td>
                </tr>
                <tr>
                  <td colspan='4' align='center'><img src='http://www.languagefirst.com.mx/TEST/img/separador.gif' width='650' height='9'></td>
                  </tr>
                <tr>
                  <td colspan='4'><table width='637' border='0' align='center' cellpadding='1' cellspacing='1' class='texto_verdana_14px_grisclaro'>
                    <tr>
                      <td width='20'><img src='http://www.languagefirst.com.mx/TEST/img/icon_ok1.png' width='20' height='18'></td>
                      <td width='75'>GRUPO A</td>
                      <td width='193' align='center'>$grupo_a de 10</td>
                      <td width='336'>Autoestima </td>
                    </tr>
                    <tr>
                      <td colspan='4' align='center'><img src='http://www.languagefirst.com.mx/TEST/img/separador.gif' width='600' height='9'></td>
                      </tr>
                    <tr>
                      <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_ok1.png' width='20' height='18'></td>
                      <td>GRUPO B</td>
                      <td align='center'>$grupo_b de 10</td>
                      <td>Auto confianza </td>
                    </tr>
                    <tr>
                      <td colspan='4' align='center'><img src='http://www.languagefirst.com.mx/TEST/img/separador.gif' width='600' height='9'></td>
                    </tr>
                    <tr>
                      <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_ok1.png' width='20' height='18'></td>
                      <td>GRUPO C</td>
                      <td align='center'>$grupo_c de 10</td>
                      <td>Competencia </td>
                    </tr>
                    <tr>
                      <td colspan='4' align='center'><img src='http://www.languagefirst.com.mx/TEST/img/separador.gif' width='600' height='9'></td>
                    </tr>
                    <tr>
                      <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_ok1.png' width='20' height='18'></td>
                      <td>GRUPO D</td>
                      <td align='center' >$grupo_d de 10</td>
                      <td>Fortaleza interna </td>
                    </tr>
                    <tr>
                      <td colspan='4' align='center'><img src='http://www.languagefirst.com.mx/TEST/img/separador.gif' width='600' height='9'></td>
                    </tr>
                    <tr>
                      <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_ok1.png' width='20' height='18'></td>
                      <td>GRUPO E</td>
                      <td align='center'>$grupo_e de 10</td>
                      <td>Sentimiento de ser querido o amado </td>
                    </tr>
                    <tr>
                      <td colspan='4' align='center'><img src='http://www.languagefirst.com.mx/TEST/img/separador.gif' width='600' height='9'></td>
                    </tr>
                    <tr>
                      <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_ok1.png' width='20' height='18'></td>
                      <td>GRUPO F</td>
                      <td align='center'>$grupo_f de 10</td>
                      <td>Autonom&iacute;a </td>
                    </tr>
                    <tr>
                      <td colspan='4' align='center'><img src='img/separador.gif' width='600' height='9'></td>
                    </tr>
                    <tr>
                      <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_ok1.png' width='20' height='18'></td>
                      <td>GRUPO G</td>
                      <td align='center'>$grupo_g de 10</td>
                      <td>Sentimiento con respeto al trato que recibimos </td>
                    </tr>
                    <tr>
                      <td colspan='4' align='center'><img src='http://www.languagefirst.com.mx/TEST/img/separador.gif' width='600' height='9'></td>
                    </tr>
                    <tr>
                      <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_ok1.png' width='20' height='18'></td>
                      <td>GRUPO H</td>
                      <td align='center'>$grupo_h de 10</td>
                      <td>Capacidad de Integraci&oacute;n </td>
                    </tr>
                    <tr>
                      <td colspan='4' align='center'><img src='http://www.languagefirst.com.mx/TEST/img/separador.gif' width='600' height='9'></td>
                    </tr>
                    <tr>
                      <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_ok1.png' width='20' height='18'></td>
                      <td>GRUPO I</td>
                      <td align='center'>$grupo_i de 10</td>
                      <td>Opini&oacute;n que nos merecen de los dem&aacute;s </td>
                    </tr>
                    <tr>
                      <td colspan='4' align='center'><img src='http://www.languagefirst.com.mx/TEST/img/separador.gif' width='600' height='9'></td>
                    </tr>
                    <tr>
                      <td><img src='http://www.languagefirst.com.mx/TEST/img/icon_ok1.png' width='20' height='18'></td>
                      <td>GRUPO J</td>
                      <td align='center'>$grupo_j de 10</td>
                      <td>Principios por los que nos regimos </td>
                    </tr>
                  </table>   ";
		// Para enviar un correo HTML mail, la cabecera Content-type debe fijarse
		$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		// Cabeceras adicionales
		$cabeceras .= "To: $correo" . "\r\n";
		$cabeceras .= 'From: LFBYPEFE <noresponder@lfbypefe.com.mx>' . "\r\n";
		mail($para, $titulo, $mensaje, $cabeceras);
	}
}     
?>
