<<?php
/**
  * FUNCIONES PARA EL SISTEMA DE TEST EN LINEA DE lfbypefe.com
		* DESARROLLO: JACINTO CANEK MIRANDA LOPEZ
		* 30/06/2010
  */
 function authTest($test){
	 session_start();
 	if (strcmp($_SESSION['IDsess'], session_id()) || empty($_SESSION['Sess_correo']) || $_SESSION['Sess_clave_test'] != $test) {
	    header("Location: index.html");
	    die();
	 }
}
	
	/*function crea_respuesta ($nombre_campo, $tipo_campo, $forzoso, $clase, $largo = FALSE, $alto = FALSE )
	{
	    switch ($tipo_campo) {
					    case 'M':
									    $salida = "<textarea name=\"$nombre_campo\" cols=\"$largo\" rows=\"$alto\" class=\"$clase\" id=\"$nombre_campo\"></textarea>";
													return $salida;
									    break;
					    case 'C':
									    $salida = "";
													return $salida;
									    break;
					    case 'T':
									    $salida = "<input name=\"$nombre_campo\" type=\"text\" class=\"$clase\" id=\"$nombre_campo\" size=\"$largo\" />";
													return $salida;
									    break;
					}
	}
	
	function imprime_respuesta($ROW_RESPUESTAS)
	{    
					
					$clave_respuesta = $ROW_RESPUESTAS[0];
					if ($ROW_RESPUESTAS[3] == 'S') {
					    $respuesta = "$ROW_RESPUESTAS[2] $ROW_RESPUESTAS[1]";
					} else {
					    $respuesta = "$ROW_RESPUESTAS[1]";
					}
					return $respuesta;
	}*/
?>
