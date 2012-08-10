<?php
/**
 * Clase: Generar Formularios Dinamicamente
 * @Autor: Miguel Angel Ocampo Mendoza
 */
class Test_Clases_GenerarFases{
protected $db;
protected $clave_test;
protected $num_fase;
protected $categoria;
protected $contenedor_respuesta;
protected $contenedor_categoria_respuesta;
protected $init_respuestas_categoria = false; 
protected $contador_respuestas;
protected $contador_temp_respuestas = 0;
protected $bgcolor_instrucciones;
/**
 * Function insert
 * @param object $ob [optional]
 * @param object $dsn [optional]
 * @return
 */
public function __construct($args, $test_clave, $num_fase){
	$this->connect($args);
	$this->clave_test = $test_clave;
	$this->num_fase = $num_fase;
	if($this->clave_test == '1'){
		$this->bgcolor_instrucciones = '#E46E0E';
	}elseif($this->clave_test == '2'){
		$this->bgcolor_instrucciones = '#A8C859';
	}elseif($this->clave_test == '3'){
		$this->bgcolor_instrucciones ='#800B4E';
	}elseif($this->clave_test == '4'){
		$this->bgcolor_instrucciones ='#B6940C';
	}elseif($this->clave_test == '5'){
		$this->bgcolor_instrucciones ='#0779C5';
	}
}
public function connect($dsn){
	$this->db  = f_genericas_inc::DBconnect($dsn);
}
public function disconnect(){
	$this->db->disconnect();
}
/**
 * FASE_TEST
 * Una fase puede tener titulo la fase(titulo_fase)
 * Una fase puded tener instrucciones de fase (intrucciones_fase)
 * 
 * Descripcion:
 * -Se obtienen las fases de un test y se verifica que coresponda con el ID de la
 * fase actual,  se imprime el titulo de la fase
 * y las instruccciones si fase cuenta con ella.
 * -se obtienen las secciones por fase y se llama a la funcion generar seccion
 * 
 */
public function generarFase(){
	$fases_array = $this->obtenerFasesPorClaveTest($this->clave_test);
	$countt = $this->num_fase;
	foreach($fases_array as $fases){
		if($this->num_fase == $fases['clave_fase']){
			$this->imprimirTituloFase($fases['titulo_fase']);
			if($fases['instrucciones_fase']){
				$this->imprimeIntrucciones($fases['instrucciones_fase']);
			}
			$secciones_array = $this->obtenerSeccionesPorClaveFase($fases['clave_fase'], $this->clave_test);
			$this->generarSecciones($secciones_array);
		}
	}
}
/**
 * SECCIONES_FASE
 * Genera las secciones de una Fase
 * -Una seccion puede tener titulo de seccion (titulo_seccion)
 * -Un  seccion puede tener un numero de seccion (numero_seccion) y se verifica en (ver_num_seccion)
 * -Una seccion puede tener intrucciones (intrucciones_seccion)
 * 
 * Se obtienen las preguntas de una seccion y se llama a la funcion generarPreguntas()
 */
private function generarSecciones($secciones_array){
	echo"<tr valign='top'>
	            <td class='textocontenido' width='100%' height='5px'>&nbsp;</td>
		</tr>";
	foreach($secciones_array as $seccion){
		$this->imprimeSeccion($seccion['titulo_seccion'], $seccion['numero_seccion'], $seccion['ver_num_seccion']);
		if($seccion['instrucciones_seccion']){
			$this->imprimeIntrucciones($seccion['instrucciones_seccion']);
		}
		$preguntas_array = $this->obtenerPreguntasPorClaveSeccion($seccion['clave_seccion']);
		$this->generarPreguntas($preguntas_array);
	}
}
/**
 * PREGUNTAS_SECCION
 * Generar preguntas de una seccion
 * -Una pregunta de seccion puede tener titulo de pregunta (titulo_pregunta)
 * -Una pregunta de seccion puede tener numero de pregunta (numero de pregunta) y se verifica en  (ver_num_pregunta)
 * -Una pregunta de seccion puede tener intruccion de preguta (intruccion_pregunta) 
 */
private function generarPreguntas($preguntas_array){
	foreach($preguntas_array as $pregunta){
		if($pregunta['instrucciones_pregunta']){
			$this->imprimirInstruccionesPregunta($pregunta['instrucciones_pregunta']);
		}
		if($pregunta['titulo_pregunta']){ 
			$this->imprimePreguntaDeSeccion($pregunta['titulo_pregunta'], $pregunta['numero_pregunta'], $pregunta['ver_num_pregunta']);
			//$this->espacioEntrePreguntaYRespuesta();
		}
		$respuestas_array = $this->obtenerRespuestasPorClavePregunta($pregunta['clave_pregunta']);
		$this->generarRespuestas($respuestas_array);
	}
}
/**
 * RESPUESTAS_PREGUNTAS
 * Generar Respuestas de una pregunta
 * -Una respuesta de pregunta puede tener titulo de respueta (titulo_respuesta)
 * -Una respueta de pregunta puede tener numero de respuesta (numero_respuesta) y se verifica en (ver_num_respuesta)
 * -Una respuesta de pregunta puede tener intrucciones de respueta(intrucciones_respuesta)
 * -Un respuesta de pregunta tres tipos de de campo (tipo_campo) 
 */
private function generarRespuestas($respuestas_array){
	foreach($respuestas_array as $respuesta){
		if($respuesta['instrucciones_respuesta']){
			$this->imprimeIntruccionesRespuesta($respuesta['instrucciones_respuesta']);
		}
		if($this->clave_test == '2'){
			if($respuesta['titulo_respuesta']){
				$this->imprimeTituloRespuesta($respuesta['titulo_respuesta'], $respuesta['numero_respuesta'], $respuesta['ver_num_respuesta']);
			}
		}
		$this->seleccionaTipoCampo($respuesta);  
		if(($this->clave_test == '2') || ($this->clave_test == '3' ) || ($this->clave_test == '4') || ($this->clave_test == '5')){
			echo "<tr>
                <td ><img src='img/separador.gif' width='100%' height='9'></td>
                </tr>"; 
		}
	}
}
/**
 * Seleccionar el tipo de campo de una respuesta;
 * T .-Caja de texto
 * M .-Caja de texto multilinea
 * C .-Combo box
 *
 */
private function seleccionaTipoCampo($respuesta){
	$nombre_campo = $respuesta['clave_respuesta'];
	$respuesta_titulo= $respuesta['titulo_respuesta'];
	$numero = $respuesta['numero_respuesta'];	
	$largo = $respuesta['largo_campo'];
	$alto = $respuesta['alto_campo'];
	//if($respuesta['forzoso'] == 'S'){
	$clase ='texto_cajas_naranja';
	
	switch ($respuesta['tipo_campo']) {
		case 'M':
			echo"<tr>
                  	<td>
                  		<textarea name='$nombre_campo' cols='$largo' rows='$alto' class='$clase' id='$nombre_campo'></textarea>
                  	</td>
             	</tr>";
			break;
		case 'C':
			if($respuesta['categoria_respuesta']){
				$catego =$respuesta['categoria_respuesta'];	
				if($catego !=$this->categoria){
					$this->imprimirContenedorCatagoriaRespuestas($catego);
				}
				$this->categoria = $catego;
				if($catego == $this->categoria){
					$this->imprimirRespuestaYOpcionesDeCategoria($respuesta);
				}
				if($this->contador_temp_respuestas == $this->contador_respuestas){
					echo"</div></td></tr>";
				}
				break;	
			}
			$opciones_array = $this->obtenerOpcionesPorClaveRespuesta($respuesta['clave_respuesta']); 
			foreach($opciones_array as $opciones){
				$valor =$opciones['valor_opcion'];
				$contenedor_opcion.="<option>$valor</option>";
			}
			echo"<tr>
					<td>
						<select name='$nombre_campo' class='$clase' id='$nombre_campo'>
							$contenedor_opcion
						</select>
					</td>
				</tr>";
			
			break;
		case 'T':
			if($respuesta['ver_num_respuesta'] == 'S')
				$res= $respuesta['ver_num_respuesta'];
			$res.=$respuesta_titulo;
			echo"<tr>
					<td>
						$res<input name='$nombre_campo' type='text' id='$nombre_campo' size='$largo' class='$clase'>
					</td>
				 </tr>";
			//$salida = "<input name=\"$nombre_campo\" type=\"text\" class=\"$clase\" id=\"$nombre_campo\" size=\"$largo\" />";
			//return $salida;
			break;
	}
}
/**
 * Imprime respuestas y opciones de categoria
 */
private function imprimeTituloRespuesta($titulo_respuesta, $numero_respuesta, $ver_num_respueta){
	if($ver_num_respueta == 'S'){
		echo "<tr>
				<td>$titulo_respuesta</td>
			 </tr>";
	}else if($ver_num_respueta == 'N'){
		echo "<tr>
				<td>$titulo_respuesta</td>
			 </tr>";
	}
}
private function imprimirRespuestaYOpcionesDeCategoria($respuesta){
	$clase ='texto_cajas_naranja';
	$nombre_campo = $respuesta['clave_respuesta'];
	$respuesta_titulo= $respuesta['titulo_respuesta'];
	$numero = $respuesta['numero_respuesta'];
	$this->contador_temp_respuestas++; 
	$this->contenedor_respuesta = "<div class='texto_verdana_11px_blanco div_respuesta_categoria'>
		                  		&nbsp; $numero $respuesta_titulo</div>";	
 	$opciones_array = $this->obtenerOpcionesPorClaveRespuesta($respuesta['clave_respuesta']);  
	print $this->contenedor_respuesta; 
	$contenedor_opcion="<div style='float:right'>
		           			<select name='$nombre_campo' class='$clase' id='$nombre_campo'>";
	foreach($opciones_array as $opciones){
		$valor =$opciones['valor_opcion'];
		$contenedor_opcion.="<option>$valor</option>";
	}
	$contenedor_opcion.="</select></div>";
	print $contenedor_opcion;
	echo "<div class='espacio_respuestas'>&nbsp;</div>";
}
/**
 * Imprime el contenedor de la categoria de una respuesta
 */
private function imprimirContenedorCatagoriaRespuestas($categoria){
	if($this->init_respuestas_categoria){
		echo"</div>";
	}else{
		echo"<tr><td>";
		echo"<div style:height:5px;>&nbsp;</div>";
		$this->init_respuestas_categoria = true;
	}
	$this->contenedor_categoria_respuesta =
				"<div class='contenedor_categoria_respuesta'>
		        	<div style='background-color:#F3F3F3'>
		            	<strong>$categoria</strong>
					</div>";
	print $this->contenedor_categoria_respuesta;
}
/**
 * Imprime Espacio entre Pregunta y respuesta
 */
private function espacioEntrePreguntaYRespuesta(){
	echo"<tr height='1px'>
	                  <td>&nbsp;</td>
	     </tr>";
}
/**
 * Imprime Imprimer Pregunta de Seccion
 */
private function imprimePreguntaDeSeccion($pregunta_titulo, $pregunta_num, $ver_num){
	if($ver_num == 'S'){
	echo"<tr class='texto_verdana_11px_blanco'>
		    	<td><strong>$pregunta_num $pregunta_titulo</strong></td>
		 </tr>";
	}else{
	echo"<tr class='texto_verdana_11px_blanco'>
		      <td><strong>$pregunta_titulo</strong></td>
		 </tr>";
	}
}
/**
 * Imprime Intrucciones de pregunta
 */
private function imprimirInstruccionesPregunta($instrucciones){ ///Cambiar el formato de la fila por el indicado para intruccion de pregunta
			echo"<tr>
            	<td bgcolor='#E46E0E' class='texto_verdana_9px_blanco'><strong>$instrucciones</strong></td>
        	</tr>";
}
private function imprimeIntruccionesRespuesta($instrucciones){
	echo"<tr>
            <td bgcolor='#E46E0E' class='texto_verdana_9px_blanco'><strong>$instrucciones </strong></td>
        </tr>";
}


/**
 * Imprime las secciones de una fase
 */
private function imprimeSeccion($seccion_titulo, $seccion_num, $ver_num_seccion){
	if($ver_num_seccion == 'S'){
		if(($this->clave_test == '4') || ($this->clave_test == '5' )){
			echo "<tr class='texto_verdana_14px_grisclaro'>
	           <td align ='center'><strong>$seccion_num$seccion_titulo</strong></td>
	         </tr>";
		}else{
			echo"<tr class='texto_verdana_11px_blanco'>
	           <td><strong>$seccion_num$seccion_titulo</strong></td>
	         </tr>";
		}
	}else{
		if(($this->clave_test == '4') || ($this->clave_test == '5' )){
			echo"<tr>
					<td height='8px'>&nbsp;</td> 
				</tr>";
			echo"<tr class='texto_verdana_14px_grisclaro'>
	           <td align ='center'><strong>$seccion_titulo</strong></td> 
	         </tr>"; 
		}else{
			echo"<tr class='texto_verdana_11px_blanco'>
	           <td><strong>$seccion_titulo</strong></td>
	         </tr>";
		}
	}
}

/**
 * Imprime el titulo de cada fase del TEST
 */
private function imprimirTituloFase($titulo_fase){
		echo"<tr>
	       		<td bgcolor='#122D7A' class='texto_fase'>$titulo_fase</td>
	   		</tr>
	     	<tr valign='top'>
	        	 <td class='textocontenido'>&nbsp;</td>
	     	</tr>";
}
/**
 * Imprime instrucciones de la FASE
 */
private function imprimeIntrucciones($instrucciones){
	echo"<tr>
            	<td bgcolor='$this->bgcolor_instrucciones' class='texto_verdana_9px_blanco'><strong>$instrucciones</strong></td>
        	</tr>";
}
/**
 * SQL para obtener las FASES de un Test  buscando por clave_test
 *
 */
private function obtenerFasesPorClaveTest($clave_test){
	$SQL = "SELECT * FROM FASES_TEST WHERE clave_test = '". $clave_test . "';";
	if($RES = f_genericas_inc::DBquery($SQL, $this->db)){
		while($ROW = $RES->fetchRow()){
			$fase[] = array(
			'clave_fase'=>$ROW[0],
			'titulo_fase'=>$ROW[1],
			'instrucciones_fase'=>$ROW[2]
			);
		}
	return $fase;
	}
}
/**
 * SQL obtiene las SECCIONES de una FASE buscando por clave_fase y clave_test
 */
private function obtenerSeccionesPorClaveFase($clave_fase, $clave_test){
	$SQL = "SELECT * FROM SECCIONES_FASE WHERE clave_fase = '$clave_fase ' AND clave_test = '$clave_test' ORDER BY clave_seccion;";
	if($RES = f_genericas_inc::DBquery($SQL, $this->db)){
		while($ROW = $RES->fetchRow()){
			$seccion[] =  array(
			'clave_seccion'=>$ROW[0],
			'titulo_seccion'=>$ROW[1],
			'numero_seccion'=>$ROW[2],
			'ver_num_seccion'=>$ROW[3],
			'instrucciones_seccion'=>$ROW[4],
			'clave_test'=>$ROW[5],
			'clave_fase'=>$ROW[6]
			);
		}
	}
	return $seccion;
}
/**
 * SQL Obtiene las preguntas de una seccion buscando por clave_seccion
 */
private function obtenerPreguntasPorClaveSeccion($clave_seccion){
	$SQL_PREGUNTAS = "SELECT * FROM PREGUNTAS_SECCION ";
	$SQL_PREGUNTAS.= "WHERE clave_test = '". $this->clave_test . "' AND clave_fase = '$this->num_fase' AND clave_seccion = '$clave_seccion' ";
	$SQL_PREGUNTAS.= "ORDER BY clave_pregunta;";
	if($RES = f_genericas_inc::DBquery($SQL_PREGUNTAS, $this->db)){
		while($ROW = $RES->fetchRow()){
			$preguntas[] =  array(
			'clave_pregunta'=>$ROW[0],
			'titulo_pregunta'=>$ROW[1],
			'numero_pregunta'=>$ROW[2],
			'ver_num_pregunta'=>$ROW[3],
			'instrucciones_pregunta'=>$ROW[4],
			'clave_test'=>$ROW[5],
			'clave_fase'=>$ROW[6],
			'clave_seccion'=>$ROW[7]
			);
		}
	}
	return $preguntas;
}
/**
 * SQL Obtiene las Respuestas de una Pregunta
 */
private function obtenerRespuestasPorClavePregunta($clave_pregunta){
	$SQL_RESPUESTAS = "SELECT * FROM RESPUESTAS_PREGUNTAS ";
	$SQL_RESPUESTAS.= "WHERE clave_pregunta = '$clave_pregunta' AND clave_fase = '$this->num_fase' ";
	$SQL_RESPUESTAS.= "ORDER BY clave_respuesta;";
	//print_r($SQL_RESPUESTAS);
	if($RES = f_genericas_inc::DBquery($SQL_RESPUESTAS, $this->db)){
		while($ROW = $RES->fetchRow()){
		$respuestas[] =  array(
			'clave_respuesta'=>$ROW[0],
			'titulo_respuesta'=>$ROW[1],
			'numero_respuesta'=>$ROW[2],
			'ver_num_respuesta'=>$ROW[3],
			'instrucciones_respuesta'=>$ROW[4],
			'tipo_campo'=>$ROW[5],
			'largo_campo'=>$ROW[6],
			'alto_campo'=>$ROW[7],
			'forzoso'=>$ROW[8],
			'clave_pregunta'=>$ROW[9],
			'clave_fase'=>$ROW[10],
			'categoria_respuesta'=>$ROW[11]
		);
		}
	}
	$this->contador_respuestas = count($respuestas);
	return $respuestas;
}
/**
 * SQL obtiene las Opciones de una Respuesta
 */
private function obtenerOpcionesPorClaveRespuesta($clave_respuesta){
	$SQL_OPCION = "SELECT * FROM OPCIONES_RESPUESTAS WHERE clave_respuesta = '$clave_respuesta' ORDER BY clave_opcion;";
	if($RES = f_genericas_inc::DBquery($SQL_OPCION, $this->db)){
		while($ROW = $RES->fetchRow()){
		$opciones[] =  array(
			'clave_opcion'=>$ROW[0],
			'valor_opcion'=>$ROW[1],
			'valor_correcto'=>$ROW[2],
			'selected_opcion'=>$ROW[3],
			'clave_respuesta'=>$ROW[4]
		);
		}
	}
	return $opciones;
}

}///Fin de la clase
?>