<?php
class f_genericas_inc{
/*
 * $funciones de uso genérico 2004/09/09 16:57:45 sep Exp $
 *
 * Jacinto Canek Miranda López <canek.miranda@cinet.com.mx>
 * 
 * See the enclosed file COPYING for license information (LGPL).  If you
 * did not receive this file, see http://www.fsf.org/copyleft/lgpl.html.
 */
 
/*
 * La función get_mes recibe un mes en formato numérico, o alfabético en ingles y lo  
 * regresa en español
 */ 
//VERIFICA QUE LA CADENA SEA UNA CUENTA DE CORREO VÁLIDA
	public static function es_mail($Email)
	{
	  if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $Email)) {
	     return FALSE; 
	  } else {
	      return TRUE;
	  }
	}
	
	//VERIFICA QUE LA CADENA SEA UN NÚMERO ENTERO POSITIVO MAYOR A 0 Y SIN CEROS A LA IZQUIERDA
	public static function es_entero($numero)
	{
	 if (strlen($numero)) {
	     if (ereg("^[0-9]*$", $numero)) {
	         return TRUE;
	     }
	 }
	 return FALSE;   
	}
	
	//VERIFICA QUE LA CADENA SE UN NÚMERO CON 7 U 8 DÍGITOS (FORMATO DE NÚMERO TELEFÓNICO EN MÉXICO)
	public static function es_tel($numero)
	{
	  if (ereg("^[1-9][0-9]{6,7}", $numero)) {
	      return TRUE;
	  } else {
	      return FALSE;
	  }  
	}
	
	//VERIFICA QUE LA CADENA SE UN NÚMERO CON 2 O 3 DÍGITOS (FORMATO DE LADA EN MÉXICO)
	public static function es_lada($numero)
	{
	  if (ereg("^[1-9][0-9]{1,2}", $numero)) {
	      return TRUE;
	  } else {
	      return FALSE;
	  }  
	}
	
	public static function es_flotante($numero)
	{
	  if (es_entero($numero)) {
	      return TRUE;
	  }
	  if (ereg("^[0-9]+\.[0-9]{1,2}$", $numero)) {
	      return TRUE;
	  } else {
	      return FALSE;
	  }  
	}
	
	/*
	 * Función para verificar su una cadena es una fecha válida
	 * $formato = 1 ; En formato de mysql DD/MM/YYYY o DD-MM-YYYY, se usa por default si no se especifica
	 * $formato = 0 ; Formato de fecha MM/DD/YYYY O MM-DD-YYYY
	 */
	public static function fecha_valida($fecha, $formato = 1) 
	{  
	  if (strlen($fecha) >= 8 && strlen($fecha) <= 10) {
	    if ($formato) {
	      list($dia, $mes, $agno) = split("/", $fecha, 3);
	    } elseif (!$formato) {
	      list($mes, $dia, $agno) = split("/", $fecha, 3);      
	    }
	    
	    if (es_entero($dia) && es_entero($mes) && es_entero($agno)) {
	      if (checkdate ($mes, $dia, $agno)) {
	          return TRUE;
	      }
	    }
	  }
	  return FALSE;
	}
	
	/*
	 * Función para convertir entre formatos de fechas de sajón a latino y viceversa
	 * formato = FALSE ; Convierte de sajón a latino
	 * formato = TRUE  ; Convierte de latino a sajón
	 */
	public static function convierte_fecha($fecha, $separador, $formato = FALSE) 
	{  
	  if (!$formato) {
	    list($year, $month, $day) = split("[-/ :]", $fecha, 4);
	  } else {
	    list($day, $month, $year) = split("[-/]", $fecha, 3);
	  }
	
	  if (checkdate ($month, $day, $year)) {
	    if (!$formato) {
	      $nueva_fecha = $day . $separador . $month . $separador . $year;
	    } else {
	      $nueva_fecha = $year . $separador . $month . $separador . $day;
	    }     
	    return $nueva_fecha;
	  } else {
	    return FALSE;
	  }
	  return FALSE;
	}
	
	public static function esPar($x){
	 if($x & 1) {
	     return TRUE;
	 } else {
	     return FALSE;
	 }
	}
	
	public static function addHTMLLinesBackup($instr)
	{
	return str_replace ("\r\n", "\\r\\n", $instr);
	}
	
	public static function addHTMLLines($instr)
	{
	return str_replace ("\r\n", "<br>", $instr);
	}
	
	public static function delHTMLLines($instr)
	{
	return str_replace ("<br>", "\r\n", $instr);
	}
	
	public static function authAdmin()
	{
	 session_start();
	 if (strcmp($_SESSION['IDsess_admin'], session_id()) || empty($_SESSION['usuario_admin'])) {
	    header("Location: index.html");
	    die();
	 }
	}

	public static function auth()
	{
	 session_start();
	 if (strcmp($_SESSION['IDsess'], session_id()) || empty($_SESSION['usuario'])) {
	    header("Location: index.html");
	    die();
	 }
	}
	
	public static function get_mes ($month)
	{
	    $mesesInt = array("Enero" => 1, "Febrero" => 2, "Marzo" => 3, "Abril" => 4, "Mayo" => 5, "Junio" => 6, "Julio" => 7,
	                   "Agosto" => 8, "Septiembre" => 9, "Octubre" => 10, "Noviembre" => 11, "Diciembre" => 12);
	    $mesesTxt = array("Enero" => 'January', "Febrero" => 'February', "Marzo" => 'March', "Abril" => 'April', "Mayo" => 'May', "Junio" => 'June', "Julio" => 'July',
	                   "Agosto" => 'August', "Septiembre" => 'September`', "Octubre" => 'October', "Noviembre" => 'November', "Diciembre" => 'December');
	    $mesesChr = array("Enero" => 'Jan', "Febrero" => 'Feb', "Marzo" => 'Mar', "Abril" => 'apr', "Mayo" => 'May', "Junio" => 'Jun', "Julio" => 'Jul',
	                   "Agosto" => 'Aug', "Septiembre" => 'Sep', "Octubre" => 'Oct', "Noviembre" => 'nov', "Diciembre" => 'Dec');
	    if (is_numeric($month)) {
	        return (array_search($month, $mesesInt));    
			} else if (is_string($month)) {
	        if (strlen($month) > 3) {
							    return (array_search($month, $mesesTxt));
	        }	else if (strlen($month)==3) {
							    return (array_search($month, $mesesChr));
							}						
			} else {
			    return ("El parametro $month es incorrecto");
			}   
	}
	
	public static function get_dia ($day)
	{
	    $dias = array("Lunes" => "Mon", "Martes" => "Tue", "Mi&eacute;rcoles" => "Wed", "Jueves" => "Thu", "Viernes" => "Fri", "S&aacute;bado" => "Sat", "Domingo" => "Sun");
	    return (array_search($day, $dias));
	}
	
	/*
	 * Función para convertir una fecha a formato legible latino
	 * $formato = 1 ; En formato de mysql YYYY-MM-DD HH:MM:SS, se usa por default si no se especifica
	 * $formato = 2 ; Formato de fecha MM/DD/YYYY o MM-DD-YYYY 
	 * $formato = 3 ; Formato de fecha latino DD/MM/YYYY o DD-MM-YYYY
	 */
	public static function format($iso_date, $formato = 1)
	{
	 if ($formato == 1) {
	   list($year,$month,$day,$hour,$minute,$second) = split('[- :]', $iso_date);   
	 } elseif ($formato == 2) {
	   list($month,$day,$year) = split('[/-]', $iso_date);
	 } elseif ($formato == 3) {
	   list($day,$month,$year) = split('[-/]', $iso_date);
	 }
	 $newDate = $day . " de " . get_mes($month) . " de " .$year;
	 return $newDate;
	}
	
	
	// FUNCIONES DE CONVERSION DE NUMEROS A LETRAS.
	
	public static function centimos()
	{
	    global $importe_parcial;
	
	    $importe_parcial = number_format($importe_parcial, 2, ".", "") * 100;
	
	    if ($importe_parcial > 0)
	        $num_letra = " pesos " . decena_centimos($importe_parcial) . " M.N.";
	    else {
	        $num_letra = " pesos 00/100 M.N";
	    }
	    return $num_letra;
	}
	
	
	public static function unidad_centimos($numero)
	{
	switch ($numero)
	{
	case 9:
	{
	$num_letra = "09/100";
	break;
	}
	case 8:
	{
	$num_letra = "08/100";
	break;
	}
	case 7:
	{
	$num_letra = "07/100";
	break;
	}
	case 6:
	{
	$num_letra = "06/100";
	break;
	}
	case 5:
	{
	$num_letra = "05/100";
	break;
	}
	case 4:
	{
	$num_letra = "04/100";
	break;
	}
	case 3:
	{
	$num_letra = "03/100";
	break;
	}
	case 2:
	{
	$num_letra = "02/100";
	break;
	}
	case 1:
	{
	$num_letra = "01/100";
	break;
	}
	}
	return $num_letra;
	}
	
	
	public static function decena_centimos($numero)
	{
	
	if ($numero >= 10) {
	 $centavos = $numero . "/100";
	 return ($centavos);
	/*
	  if ($numero >= 90 && $numero <= 99) {
	    if ($numero == 90)
	      return "90/100";
	    else if ($numero == 91)
	      return "91/100";
	    else
	      return "9" . ($numero - 90) . "/100";
	  }
	  if ($numero >= 80 && $numero <= 89) {
	    if ($numero == 80)
	      return "80/100";
	    else if ($numero == 81)
	      return "81/100";
	    else
	      return "8" . ($numero - 80) . "/100";
	  }
	
	  if ($numero >= 70 && $numero <= 79) {
	    if ($numero == 70)
	      return "70/100";
	    else if ($numero == 71)
	      return "71/100";
	    else
	      return "7" . ($numero - 70) . "/100";
	  }
	  if ($numero >= 60 && $numero <= 69) {
	    if ($numero == 60)
	      return "60/100";
	    else if ($numero == 61)
	      return "61/100";
	    else
	      return "6" . ($numero - 60) . "/100";
	  }
	  if ($numero >= 50 && $numero <= 59) {
	    if ($numero == 50)
	      return "50/100";
	    else if ($numero == 51)
	      return "51/100";
	    else
	      return "5" . ($numero - 50) . "/100";
	  }
	  if ($numero >= 40 && $numero <= 49) {
	    if ($numero == 40)
	      return "40/100";
	    else if ($numero == 41)
	      return "41/100";
	    else
	      return "4" . ($numero - 40) . "/100";
	  }
	  if ($numero >= 30 && $numero <= 39) {
	    if ($numero == 30)
	      return "30/100";
	    else if ($numero == 91)
	      return "31/100";
	    else
	      return "3" . ($numero - 30) . "/100";
	  }
	  if ($numero >= 20 && $numero <= 29) {
	    if ($numero == 20)
	      return "20/100";
	    else if ($numero == 21)
	      return "21/100";
	    else
	      return "2" . ($numero - 20) . "/100";
	  }
	
	  if ($numero >= 10 && $numero <= 19) {
	    if ($numero == 10)
	      return "10/100";
	    else if ($numero == 11)
	      return "11/100";
	    else if ($numero == 12)
	      return "12/100";
	    else if ($numero == 13)
	      return "13/100";
	    else if ($numero == 14)
	      return "14/100";
	    else if ($numero == 15)
	      return "15/100";
	    else if ($numero == 16)
	      return "16/100";
	    else if ($numero == 17)
	      return "17/100";
	    else if ($numero == 18)
	      return "18/100";
	    else if ($numero == 19)
	      return "19/100";
	  }*/
	}
	else
	  return unidad_centimos($numero);
	}
	
	
	public static function unidad($numero)
	{
	switch ($numero)
	{
	case 9:
	{
	$num = "nueve";
	break;
	}
	case 8:
	{
	$num = "ocho";
	break;
	}
	case 7:
	{
	$num = "siete";
	break;
	}
	case 6:
	{
	$num = "seis";
	break;
	}
	case 5:
	{
	$num = "cinco";
	break;
	}
	case 4:
	{
	$num = "cuatro";
	break;
	}
	case 3:
	{
	$num = "tres";
	break;
	}
	case 2:
	{
	$num = "dos";
	break;
	}
	case 1:
	{
	$num = "un";
	break;
	}
	}
	return $num;
	}
	
	
	public static function decena($numero)
	{
	if ($numero >= 90 && $numero <= 99)
	{
	$num_letra = "noventa ";
	
	if ($numero > 90)
	$num_letra = $num_letra."y ".unidad($numero - 90);
	}
	else if ($numero >= 80 && $numero <= 89)
	{
	$num_letra = "ochenta ";
	
	if ($numero > 80)
	$num_letra = $num_letra."y ".unidad($numero - 80);
	}
	else if ($numero >= 70 && $numero <= 79)
	{
	$num_letra = "setenta ";
	
	if ($numero > 70)
	$num_letra = $num_letra."y ".unidad($numero - 70);
	}
	else if ($numero >= 60 && $numero <= 69)
	{
	$num_letra = "sesenta ";
	
	if ($numero > 60)
	$num_letra = $num_letra."y ".unidad($numero - 60);
	}
	else if ($numero >= 50 && $numero <= 59)
	{
	$num_letra = "cincuenta ";
	
	if ($numero > 50)
	$num_letra = $num_letra."y ".unidad($numero - 50);
	}
	else if ($numero >= 40 && $numero <= 49)
	{
	$num_letra = "cuarenta ";
	
	if ($numero > 40)
	$num_letra = $num_letra."y ".unidad($numero - 40);
	}
	else if ($numero >= 30 && $numero <= 39)
	{
	$num_letra = "treinta ";
	
	if ($numero > 30)
	$num_letra = $num_letra."y ".unidad($numero - 30);
	}
	else if ($numero >= 20 && $numero <= 29)
	{
	if ($numero == 20)
	$num_letra = "veinte ";
	else
	$num_letra = "veinti".unidad($numero - 20);
	}
	else if ($numero >= 10 && $numero <= 19)
	{
	switch ($numero)
	{
	case 10:
	{
	$num_letra = "diez ";
	break;
	}
	case 11:
	{
	$num_letra = "once ";
	break;
	}
	case 12:
	{
	$num_letra = "doce ";
	break;
	}
	case 13:
	{
	$num_letra = "trece ";
	break;
	}
	case 14:
	{
	$num_letra = "catorce ";
	break;
	}
	case 15:
	{
	$num_letra = "quince ";
	break;
	}
	case 16:
	{
	$num_letra = "dieciseis ";
	break;
	}
	case 17:
	{
	$num_letra = "diecisiete ";
	break;
	}
	case 18:
	{
	$num_letra = "dieciocho ";
	break;
	}
	case 19:
	{
	$num_letra = "diecinueve ";
	break;
	}
	}
	}
	else
	$num_letra = unidad($numero);
	
	return $num_letra;
	}
	
	
	public static function centena($numero)
	{
	if ($numero >= 100)
	{
	if ($numero >= 900 & $numero <= 999)
	{
	$num_letra = "novecientos ";
	
	if ($numero > 900)
	$num_letra = $num_letra.decena($numero - 900);
	}
	else if ($numero >= 800 && $numero <= 899)
	{
	$num_letra = "ochocientos ";
	
	if ($numero > 800)
	$num_letra = $num_letra.decena($numero - 800);
	}
	else if ($numero >= 700 && $numero <= 799)
	{
	$num_letra = "setecientos ";
	
	if ($numero > 700)
	$num_letra = $num_letra.decena($numero - 700);
	}
	else if ($numero >= 600 && $numero <= 699)
	{
	$num_letra = "seiscientos ";
	
	if ($numero > 600)
	$num_letra = $num_letra.decena($numero - 600);
	}
	else if ($numero >= 500 && $numero <= 599)
	{
	$num_letra = "quinientos ";
	
	if ($numero > 500)
	$num_letra = $num_letra.decena($numero - 500);
	}
	else if ($numero >= 400 && $numero <= 499)
	{
	$num_letra = "cuatrocientos ";
	
	if ($numero > 400)
	$num_letra = $num_letra.decena($numero - 400);
	}
	else if ($numero >= 300 && $numero <= 399)
	{
	$num_letra = "trescientos ";
	
	if ($numero > 300)
	$num_letra = $num_letra.decena($numero - 300);
	}
	else if ($numero >= 200 && $numero <= 299)
	{
	$num_letra = "doscientos ";
	
	if ($numero > 200)
	$num_letra = $num_letra.decena($numero - 200);
	}
	else if ($numero >= 100 && $numero <= 199)
	{
	if ($numero == 100)
	$num_letra = "cien ";
	else
	$num_letra = "ciento ".decena($numero - 100);
	}
	}
	else
	$num_letra = decena($numero);
	
	return $num_letra;
	}
	
	
	public static function cien()
	{
	global $importe_parcial;
	
	$parcial = 0; $car = 0;
	
	while (substr($importe_parcial, 0, 1) == 0)
	$importe_parcial = substr($importe_parcial, 1, strlen($importe_parcial) - 1);
	
	if ($importe_parcial >= 1 && $importe_parcial <= 9.99)
	$car = 1;
	else if ($importe_parcial >= 10 && $importe_parcial <= 99.99)
	$car = 2;
	else if ($importe_parcial >= 100 && $importe_parcial <= 999.99)
	$car = 3;
	
	$parcial = substr($importe_parcial, 0, $car);
	$importe_parcial = substr($importe_parcial, $car);
	
	$num_letra = centena($parcial).centimos();
	
	return $num_letra;
	}
	
	
	public static function cien_mil()
	{
	global $importe_parcial;
	
	$parcial = 0; $car = 0;
	
	while (substr($importe_parcial, 0, 1) == 0)
	$importe_parcial = substr($importe_parcial, 1, strlen($importe_parcial) - 1);
	
	if ($importe_parcial >= 1000 && $importe_parcial <= 9999.99)
	$car = 1;
	else if ($importe_parcial >= 10000 && $importe_parcial <= 99999.99)
	$car = 2;
	else if ($importe_parcial >= 100000 && $importe_parcial <= 999999.99)
	$car = 3;
	
	$parcial = substr($importe_parcial, 0, $car);
	$importe_parcial = substr($importe_parcial, $car);
	
	if ($parcial > 0)
	{
	if ($parcial == 1)
	$num_letra = "mil ";
	else
	$num_letra = centena($parcial)." mil ";
	}
	
	return $num_letra;
	}
	
	
	public static function millon()
	{
	global $importe_parcial;
	
	$parcial = 0; $car = 0;
	
	while (substr($importe_parcial, 0, 1) == 0)
	$importe_parcial = substr($importe_parcial, 1, strlen($importe_parcial) - 1);
	
	if ($importe_parcial >= 1000000 && $importe_parcial <= 9999999.99)
	$car = 1;
	else if ($importe_parcial >= 10000000 && $importe_parcial <= 99999999.99)
	$car = 2;
	else if ($importe_parcial >= 100000000 && $importe_parcial <= 999999999.99)
	$car = 3;
	
	$parcial = substr($importe_parcial, 0, $car);
	$importe_parcial = substr($importe_parcial, $car);
	
	if ($parcial == 1)
	$num_letras = "un millón ";
	else
	$num_letras = centena($parcial)." millones ";
	
	return $num_letras;
	}
	
	
	public static function convertir_a_letras($numero)
	{
	    global $importe_parcial;
	
	    $importe_parcial = $numero;
	    
	    if ($numero == 1) {
	        return "un peso";
	    }
	
	    if ($numero < 1000000000) {
	        if ($numero >= 1000000 && $numero <= 999999999.99) {
	            $num_letras = millon().cien_mil().cien();
	        }
	        else if ($numero >= 1000 && $numero <= 999999.99){
	            $num_letras = cien_mil().cien();
	        }
	        else if ($numero >= 1 && $numero <= 999.99) {
	            $num_letras = cien();
	        }
	        else if ($numero >= 0.01 && $numero <= 0.99) {
	            if ($numero == 0.01) {
	                $num_letras = "01/100";
	            } else {
	                $num_letras = convertir_a_letras(($numero * 100)."/100")." centavos";
	            }
	        }
	    }
	    return $num_letras;
	}
	
	public static function thumb($ruta, $rutatn) {
	  $cadena = strtok($ruta,"/");
	  while ($cadena) {
	    $archivo = $cadena;
	    $cadena  = strtok("/");
	  }
	  $cadena = strtok($archivo,".");
	  while ($cadena) {
	    $ext    = $cadena;
	    $cadena = strtok(".");
	  }
	  $ext = strtolower($ext);
	  if ($ext=="gif") {
	    $fuente = imagecreatefromgif($ruta);
	    Header("Content-type: image/jpg");
	  } elseif ($ext=="jpeg" or $ext=="jpg") {
	    $fuente = imagecreatefromjpeg($ruta);
	    Header("Content-type: image/jpeg");
	  } elseif ($ext=="png") {
	    $fuente = imagecreatefrompng($ruta);
	    Header("Content-type: image/jpg");
	  } else {
	    exit();
	  }
	  $dimension = getimagesize($ruta);
	  $imgAlto   = $dimension[1];
	  $imgAncho  = $dimension[0];
	  if (!$alto) { 
	    $alto = 60;
	  }
	  if (!$ancho) { 
	    $ancho = 60; }
	  if ($imgAlto>$imgAncho) {
	    $cons = $alto/$imgAlto;
	  }
	  if ($imgAlto<$imgAncho) {
	    $cons = $ancho/$imgAncho;
	  }
	  if ($imgAlto==$imgAncho) {
	    $cons = $ancho/$imgAlto;
	  }
	  $alto   = $cons*$imgAlto;
	  $ancho  = $cons*$imgAncho;
	  $imagen = imagecreatetruecolor($ancho,$alto);
	  ImageCopyResized($imagen,$fuente,0,0,0,0,$ancho,$alto,$imgAncho,$imgAlto);
	  imagejpeg($imagen, $ruta_tn, 100);
	  ImageDestroy($imagen);
	}
	
	public static function uploaded_file_error($error) {
	  switch($error){
	   case 0: //no error; possible file attack!
	     return "Ocurri&oacute; un problema al subir el archivo.";
	     break;
	   case 1: //uploaded file exceeds the upload_max_filesize directive in php.ini
	     return "El archivo que se intenta subir es demasiado grande.";
	     break;
	   case 2: //uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the html form
	     return "El archivo que se intenta subir es demasiado grande.";
	     break;
	   case 3: //uploaded file was only partially uploaded
	     return "La transferencia del archivo se interrumpi&oacute;";
	     break;
	   case 4: //no file was uploaded
	     return "Se debe de indicar alg&uacute;n archivo a subir.";
	     break;
	   default: //a default error, just in case!  :)
	     return "Ocurri&oacute; un problema al subir el archivo.";
	     break;
	   }
	}
	
	/*function thumb($im, $maxsize) {
	if ($maxsize == '') {
	$maxsize = 300;
	}
	  
	// The file
	$filename = $im;
	
	// Set a maximum height and width
	$width = $maxsize;
	$height = $maxsize;
	 
	// Content type
	header('Content-type: image/jpeg');
	
	// Get new dimensions
	list($width_orig, $height_orig) = getimagesize($filename);
	  
	if ($width && ($width_orig < $height_orig)) {
	    $width = ($height / $height_orig) * $width_orig;
	} else {
	    $height = ($width / $width_orig) * $height_orig;
	}
	
	// Resample
	$image_p = imagecreatetruecolor($width, $height);
	$image = imagecreatefromjpeg($filename);
	imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
	 
	// Output
	imagejpeg($image_p);
	imagedestroy($image);
	imageDestroy($image_p);
	}*/
	
	public static function estados($id_edo, $clase=FALSE, $fuera=FALSE)
	{
	print '<select name="estado" id="estado" class="' . $clase . '">';
	if ($fuera) {
	     print '<option value="33"'; if ($id_edo == 33) print " selected"; print'>Fuera de México</option>';
	}
	print '<option value="1"'; if ($id_edo == 1) print " selected"; print'>Aguascalientes</option>
	     <option value="2"'; if ($id_edo == 2) print " selected"; print'>Baja California Norte</option>
	     <option value="3"'; if ($id_edo == 3) print " selected"; print'>Baja California Sur</option>
	     <option value="4"'; if ($id_edo == 4) print " selected"; print'>Campeche</option>
	     <option value="5"'; if ($id_edo == 5) print " selected"; print'>Chihuahua</option>
	     <option value="6"'; if ($id_edo == 6) print " selected"; print'>Chiapas</option>
	     <option value="7"'; if ($id_edo == 7) print " selected"; print'>Coahuila</option>
	     <option value="8"'; if ($id_edo == 8) print " selected"; print'>Colima</option>
	     <option value="9"'; if ($id_edo == 9) print " selected"; print'>Distrito Federal</option>
	     <option value="10"'; if ($id_edo == 10) print " selected"; print'>Durango</option>
	     <option value="11"'; if ($id_edo == 11) print " selected"; print'>Guerrero</option>
	     <option value="12"'; if ($id_edo == 12) print " selected"; print'>Guanajuato</option>
	     <option value="13"'; if ($id_edo == 13) print " selected"; print'>Hidalgo</option>
	     <option value="14"'; if ($id_edo == 14) print " selected"; print'>Jalisco</option>
	     <option value="15"'; if ($id_edo == 15) print " selected"; print'>Michoac&aacute;n</option>
	     <option value="16"'; if ($id_edo == 16) print " selected"; print'>M&eacute;xico</option>
	     <option value="17"'; if ($id_edo == 17) print " selected"; print'>Morelos</option>
	     <option value="18"'; if ($id_edo == 18) print " selected"; print'>Nayarit</option>
	     <option value="19"'; if ($id_edo == 19) print " selected"; print'>Nuevo Le&oacute;n</option>
	     <option value="20"'; if ($id_edo == 20) print " selected"; print'>Oaxaca</option>
	     <option value="21"'; if ($id_edo == 21) print " selected"; print'>Puebla</option>
	     <option value="22"'; if ($id_edo == 22) print " selected"; print'>Queretaro</option>
	     <option value="23"'; if ($id_edo == 23) print " selected"; print'>Quintana Roo</option>
	     <option value="24"'; if ($id_edo == 24) print " selected"; print'>Sinaloa</option>
	     <option value="25"'; if ($id_edo == 25) print " selected"; print'>San LuisPotos&iacute;</option>
	     <option value="26"'; if ($id_edo == 26) print " selected"; print'>Sonora</option>
	     <option value="27"'; if ($id_edo == 27) print " selected"; print'>Tabasco</option>
	     <option value="28"'; if ($id_edo == 28) print " selected"; print'>Tamaulipas</option>
	     <option value="29"'; if ($id_edo == 29) print " selected"; print'>Tlaxcala</option>
	     <option value="30"'; if ($id_edo == 30) print " selected"; print'>Veracruz</option>
	     <option value="31"'; if ($id_edo == 31) print " selected"; print'>Yucat&aacute;n</option>
	     <option value="32"'; if ($id_edo == 32) print " selected"; print'>Zacatecas</option>
	    </select>';
	}
	
	/*
	 * FUNCION QUE VALIDA LA LONGITUD DE UNA CADENA, SI LA CADENA ES IGUAL O MAYOR
	 * A LA LONGITUD DEFINIDA EN EL SEGUNDO PARAMETRO, REGRESA TRUE, DE LO CONTRARIO,
	 * REGRESA FALSE
	 */
	public static function longitud_valida($cadena, $longitud)
	{
	 if (strlen($cadena) >= $longitud) {
	   return TRUE;
	 } else
	   return FALSE;
	}
	
	/*
	 * FUNCION PARA DEFINIR COMO CONSTANTE UN ARREGLO 
	 */
	public static function const_array($constant)
	{
	  $array = explode(",",$constant);
	  return $array;
	}
	
	public static function DBconnect($dsn)
	{
	  $db =& DB::connect($dsn);//, $options);
	  if (DB::isError($db)) {
	    die($db->getMessage());
	  }
	  return $db;
	}
	
	public static function DBquery($sql, $db)
	{
	  //global $db;
	  $res =& $db->query($sql);
	  if (DB::isError($res)) {
	    die($res->getMessage());      
	  }
	  return $res;
	}
	
	/*
	 * FUNCION PARA VERIFICAR SI YA EXISTE UN REGISTRO EN UNA TABLA
	 * REGRESA VERDADERO SI ENCONTRÓ EL REGISTRO Y
	 * REGRESA FALSE SI NO ENCONTRÓ EL REGISTRO DE ACUERDO AL SQL ENVIADO
	 */
	public static function existe_registro($sql)
	{
	  global $db;
	  
	  $res = DBquery($sql);
	  if ($res->numRows()) {
	    return TRUE;
	  } else {
	    return FALSE;
	  }
	} 
	
	public static function estado($id_edo)
	{
	 switch($id_edo) {
	     case 1:
	         $estado = "Aguascalientes";
	         break;
	     case 2: 
	         $estado = "Baja California Norte";
	         break;
	     case 3:
	         $estado = "Baja California Sur";
	         break;
	     case 4: 
	         $estado = "Campeche";
	         break;
	     case 5:
	         $estado = "Chihuahua";
	         break;
	     case 6: 
	         $estado = "Chiapas";
	         break;
	     case 7:
	         $estado = "Coahuila";
	         break;
	     case 8: 
	         $estado = "Colima";
	         break;
	     case 9:
	         $estado = "Distrito Federal";
	         break;
	     case 10: 
	         $estado = "Durango";
	         break;
	     case 11:
	         $estado = "Guerrero";
	         break;
	     case 12: 
	         $estado = "Guanajuato";
	         break;
	     case 13:
	         $estado = "Hidalgo";
	         break;
	     case 14: 
	         $estado = "Jalisco";
	         break;
	     case 15:
	         $estado = "Michoac&aacute;n";
	         break;
	     case 16: 
	         $estado = "M&eacute;xico";
	         break;
	     case 17:
	         $estado = "Morelos";
	         break;
	     case 18: 
	         $estado = "Nayarit";
	         break;
	     case 19:
	         $estado = "Nuevo Le&oacute;n";
	         break;
	     case 20: 
	         $estado = "Oaxaca";
	         break;
	     case 21:
	         $estado = "Puebla";
	         break;
	     case 22: 
	         $estado = "Queretaro";
	         break;
	     case 23:
	         $estado = "Quintana Roo";
	         break;
	     case 24: 
	         $estado = "Sinaloa";
	         break;
	     case 25:
	         $estado = "San LuisPotos&iacute;";
	         break;
	     case 26: 
	         $estado = "Sonora";
	         break;
	     case 27:
	         $estado = "Tabasco";
	         break;
	     case 28: 
	         $estado = "Tamaulipas";
	         break;
	     case 29:
	         $estado = "Tlaxcala";
	         break;
	     case 30: 
	         $estado = "Veracruz";
	         break;
	     case 31:
	         $estado = "Yucat&aacute;n";
	         break;
	     case 32: 
	         $estado = "Zacatecas";
	         break;
	     
	     case 33: 
	         $estado = "Fuera de México";
	         break;
	 }
	 return $estado;
	}
	
	/*
	 * Función para convertir una fecha numérica de formato latino a formato MySQL  
	 */
	public static function fecha_mysql($fecha)
	{
	 list($day, $month, $year) = split('[-/]', $fecha);
	 $newDate = $year . "-" . $month . "-" . $day;
	 return $newDate;  
	}
	
	public static function respaldo_matriz($matriz)
	{
	   $respaldo = array();
	   $i        = 0;
	   foreach ($matriz as $renglon) {
	/*     if (is_array($renglon)) {
	       foreach($renglon as $campo) {
	          $respaldo[$i][] = $campo;
	       }
	       $i++;
	     } else {*/
	          $respaldo[] = $renglon;
	//     }
	   }
	   return $respaldo;
	}
	
	/*
	 * Funcion para generar contraseñas aleatorias, si no se recibe la longitud de
	 * la clave a generar, automáticamente se genera de 8 caracteres
	 */ 
	public static function generatePassword ($length=FALSE)
	{
	 $possible = "0123456789bcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRESTUVWXYZ_.-";
	 
	 if ($lenght == "" OR !is_numeric($lengh)){
	  $lenght = 8; 
	 }
	 
	 srand(make_seed());
	
	 $i = 0; 
	 $password = "";    
	 while ($i < $length) { 
	  $char = substr($possible, rand(0, strlen($possible)-1), 1);
	  if (!strstr($password, $char)) { 
	   $password .= $char;
	   $i++;
	   }
	  }
	 return ($password);
	}
	
	public static function make_seed()
	{
	 list($usec, $sec) = explode(' ', microtime());
	 return (float) $sec + ((float) $usec * 100000);
	}
	
	/*
	FUNCION QUE PERMITE EXTRAER UNA PARTE DE UN TEXTO DEJANDO SIEMPRE PALABRAS COMPLETAS
	SI LA VARIABLE LIMITE ES UN ESPACIO (O EL SIGUIENTE CARACTER ES ESPACIO) DENTRO DEL TEXTO ORIGINAL
	AHI CORTA LA CADENA, SI NO, CORTA HASTA LA PALABRA ANTERIOR
	*/
	public static function cortatexto($texto, $limite) {
	    $texto_cortado = substr($texto, 0, $limite+1);
	    if ($texto_cortado[$limite] == " " || $texto_cortado[$limite+1] == " ") {
	        return substr($texto_cortado, 0, $limite);
	    } else {
	        return substr($texto_cortado, 0, strrpos($texto_cortado, " "));
	    }
	}
	/**
	 * Se cambia el formato de numero a texto (02->Febrero) de un determinado Mes
	 */
	public static function formatoMes($num_mes){
		switch($num_mes){
		case 1:
			$mes = Enero;
		break;
		case 2:
			$mes = Febrero;
		break;
		case 3:
			$mes = Marzo;
		break;
		case 4:
			$mes = Abril;
		break;
		case 5:
			$mes = Mayo;
		break;
		case 6:
			$mes = Junio;
		break;
		case 7:
			$mes = Julio;
		break;
		case 8:
			$mes = Agosto;
		break;
		case 9:
			$mes = Septiembre;
		break;
		case 10:
			$mes = Octubre;
		break;
		case 11:
			$mes = Noviembre;
		break;
		case 12:
			$mes = Diciembre;
		break;
		}
		return $mes;
	}
}
?>
