<?php
/**
 * @Autor: Miguel Angel Ocampo Mendoza
 */
class Test_Clases_AccionesFormulario{
	protected $clave_fase;
	protected $clave_test;
	protected $clave_test_respondido;
	protected $reporte_test;
	protected $db;
	protected $contador_incorrecto;
	protected $contador_correcto;
	protected $contador_K =0;
	protected $contador_A =0;
	protected $contador_V =0;
	protected $cuadrante_A = 0;
	protected $cuadrante_B = 0;
	protected $cuadrante_C = 0;
	protected $cuadrante_D = 0;
	protected $grupo_A = 0;
	protected $grupo_B = 0;
	protected $grupo_C = 0;
	protected $grupo_D = 0;
	protected $grupo_E = 0;
	protected $grupo_F = 0;
	protected $grupo_G = 0;
	protected $grupo_H = 0;
	protected $grupo_I = 0;
	protected $grupo_J = 0;
	public function __construct($args=null, $fase_clave=null, $test_clave=null, $id_test_respondido=null){
		if($args){
			$this->connect($args);
		}
		$this->clave_fase = $fase_clave;
		$this->clave_test = $test_clave;
		$this->clave_test_respondido = $id_test_respondido;
	}
	public function authTest($test){
	 	session_start();
		if (strcmp($_SESSION['IDsess'], session_id()) || empty($_SESSION['Sess_correo']) || $_SESSION['Sess_clave_test'] != $test) {
		 	header("Location: inicio.html");
			    die();
		}
	}
	
	public function authTestAdmin(){
	 	session_start();
		if (strcmp($_SESSION['IDsess'], session_id()) || empty($_SESSION['Sess_usuario'])) {
		 	header("Location: inicio.html");
			    die();
		}
	}
	
	public function recuperarClave($correo){
			$usuarios = $this->obtenerUsuarioPorCorreo($correo);
			if(is_array($usuarios)){
				$cantidadchar = rand(5, 10);
				$clave =$this->generarPassword($cantidadchar);
				$this->updateClave($clave, $correo);
				$cabecera	= "Tu clave fue regenerada";
				$mensajetot = "Tu clave es: ".$clave;
				$enviado = mail($correo, $cabecera, $mensajetot, "From: LFBYPEFE <noresponder@lfbypefe.com.mx>\nMime-Version: 1.0\nX-Mailer: lfbypefe.com.mx\nIP: " . $_SERVER['REMOTE_ADDR']);
			    if ($enviado) {
			        $mensaje = "Se ha enviado un mensaje a la cuenta de correo " .$correo ;
			  	}
			}else{
				$mensaje = "No es un correo v&aacute;lido ";
			}
			return $mensaje;
	}
	public function generarPassword($cantidad) {
	        $password = "";
	          $caracteres = "0123456789bcdfghjkmnpqrstvwxyz";
	          $i = 0;
	             while ($i < $cantidad) {
	                       $char = substr($caracteres, mt_rand(0, strlen($caracteres)-1), 1);
	
	                       if(!strstr($password, $char)) {
	                                    $password .= $char;
	                       }
	                      $i++;
	             }
	             return $password;
	}
	
	public function busquedasAvanzadas($post){
		//print_r($post);
		if(($post['usuarioPart1'] != '') && ($post['usuarioPart2'] != '')){
			$usuario = true;
		}else{
			$usuario = false;
		}
		if(($post['fecha_inicial'] !='') && ($post['fecha_final'] !='')){
			$fecha = true;
		}else{
			$fecha = false;
		}
		//echo "Esto tiene usuario ";
		//print_r($usuario);
		
		//echo "Esto tiene fecha: ";
		//print_r($fecha);
		
		if(($fecha == false) && ($post['test'] == 0) && ($usuario == false)){
			//echo"Primer IF ";
			$this->reporte_test = '';
			$reporte['ingles'] = $this->reportesTest(1);
			$this->reporte_test = ''; 
			$reporte['liderasgo'] = $this->reportesTest(2);
			$this->reporte_test = '';
			$reporte['percepcion'] = $this->reportesTest(3);
			$this->reporte_test = '';
			$reporte['pensamiento'] = $this->reportesTest(4);
			$this->reporte_test = '';
			$reporte['emocional'] = $this->reportesTest(5);
			$this->reporte_test = '';
		}   
		if(($fecha == false) && ($post['test'] != 0) && ($usuario == false)){
			//echo"Segundo IF ";
			$this->reporte_test = '';
			$reporte['general'] = $this->reportesTest($post['test']);
			$this->reporte_test = '';
		}
		if(($fecha == false) && ($post['test'] == 0) && ($usuario == true)){
			//echo"Tercero IF ";
			$correo = $post['usuarioPart1'].'@'.$post['usuarioPart2'];
			$this->reporte_test = '';
			$reporte['ingles'] = $this->reportesTest(1, $correo, null);
			$this->reporte_test = ''; 
			$reporte['liderasgo'] = $this->reportesTest(2, $correo, null);
			$this->reporte_test = '';
			$reporte['percepcion'] = $this->reportesTest(3, $correo, null);
			$this->reporte_test = '';
			$reporte['pensamiento'] = $this->reportesTest(4, $correo, null);
			$this->reporte_test = '';
			$reporte['emocional'] = $this->reportesTest(5, $correo, null);
			$this->reporte_test = '';
		}
		if(($fecha == false) && ($post['test'] != 0) && ($usuario == true)){
			//echo"Cuarto IF ";
			$correo = $post['usuarioPart1'].'@'.$post['usuarioPart2'];
			$this->reporte_test = '';
			$reporte['general'] = $this->reportesTest($post['test'], $correo, null);
			$this->reporte_test = '';
		}
		if(($fecha == true) && ($post['test'] == 0) && ($usuario == true)){
			//echo"quinto IF ";
			$this->reporte_test = '';
			$reporte['ingles'] = $this->reportesTest(1, null, $post);
			$this->reporte_test = ''; 
			$reporte['liderasgo'] = $this->reportesTest(2, null, $post);
			$this->reporte_test = '';
			$reporte['percepcion'] = $this->reportesTest(3, null, $post);
			$this->reporte_test = '';
			$reporte['pensamiento'] = $this->reportesTest(4, null, $post);
			$this->reporte_test = '';
			$reporte['emocional'] = $this->reportesTest(5, null, $post);
			$this->reporte_test = '';
		}
		if(($fecha == true) && ($post['test'] == 0) && ($usuario == false)){
			//echo"Sexto ";
			$this->reporte_test = '';
			$reporte['ingles'] = $this->reportesTest(1, null, $post);
			$this->reporte_test = ''; 
			$reporte['liderasgo'] = $this->reportesTest(2, null, $post);
			$this->reporte_test = '';
			$reporte['percepcion'] = $this->reportesTest(3, null, $post);
			$this->reporte_test = '';
			$reporte['pensamiento'] = $this->reportesTest(4, null, $post);
			$this->reporte_test = '';
			$reporte['emocional'] = $this->reportesTest(5, null, $post);
			$this->reporte_test = '';
		}
		if(($fecha == true) && ($post['test'] == 0) && ($usuario == false)){
			//echo"Septimo ";
			/*$this->reporte_test = '';
			$reporte['ingles'] = $this->reportesTest(1, null, $post);
			$this->reporte_test = ''; 
			$reporte['liderasgo'] = $this->reportesTest(2, null, $post);
			$this->reporte_test = '';
			$reporte['percepcion'] = $this->reportesTest(3, null, $post);
			$this->reporte_test = '';
			$reporte['pensamiento'] = $this->reportesTest(4, null, $post);
			$this->reporte_test = '';
			$reporte['emocional'] = $this->reportesTest(5, null, $post);
			$this->reporte_test = '';*/
		}
		//print_r($reporte);
		//echo "Llegaste al final";	
		return $reporte;
	}
	/*public function respuetasUsuarioPorClaveTestRespondido($clave_test){
	
		$respuestas_usuario = $this->obtenerRespuestasUsuariosPorClavetestRespondido();
		return $respuestas_usuario;
	}*/
	/***
	 * 1.- Obtengo todas las respuetas del usuario y las respuestas obtenidas las meto en un ciclo foreach($array_respuestas_usuario as $respuesta_usuario
	 * 2.- Con la clave de la respuesta ($respuesta_usuario['texto_respuesta']), obtengo las opciones de respuesta de sa clave.
	 * 3.- a la funcion $this->contadorRespuestas le paso como parametros las opciones de la respuesta y el texto de la respuets que el usuario eligio
	 * 
	 */
	public function generarReporteTestPorUsuario(){
		$test_respondidos = $this->obtenerTestRespondidosPorClaveTestRespondidos();
		if($this->clave_test == 2){
			$reporte = $this->reporteLiderazdo($test_respondidos);
			return $reporte;
		}
		$array_respuestas_usuario = $this->obtenerRespuestasUsuariosPorClavetestRespondido(); 
		foreach($array_respuestas_usuario as $respuesta_usuario){
			$opciones_respuesta = $this->obtenerOpcionRespuestaPorClaveRespuesta($respuesta_usuario['clave_respuesta']);
			$this->contadorRespuestas($opciones_respuesta, $respuesta_usuario['texto_respuesta']);
		}
			//$test_respondidos = $this->obtenerTestRespondidosPorClaveTestRespondidos();	
			$titulo_totales = $this->obtenerTituloTotales();
			foreach($titulo_totales as $titulo){
				switch($titulo['clave_test']){
					case 1: //TEST ingles
						$this->insertarTotalesTestRespondidosIngles($titulo);
						$reporte = $this->reporteIngles($test_respondidos);
					break;
					case 3: //TEST canales de percepcion
						$this->insertarTotalesTestRespondidosCanalesDePercepcion($titulo);
						$reporte = $this->reporteCanalesDePercepcion($test_respondidos);
					break;
					case 4://TEST estilos de pensamiento
						$this->insertTotalesTestRespondidosEstilosDePensamiento($titulo);
						$reporte = $this->reporteEstilosDePensamiento($test_respondidos);
					break;
					case 5://TEST Inteligencia emocional
						$this->insertTotalesTestRespondidosInteligenciaEmocional($titulo);
						$reporte = $this->reporteInteliengiaEmocional($test_respondidos);
					break;
				}	
			}
		return $reporte; 
	}
	private function reporteCanalesDePercepcion($test_respondidos){
		$reporte = array(
					'resultados_visuales'=>$this->contador_V,
					'resultados_auditivos'=>$this->contador_A,
					'resultados_kinestesicos'=>$this->contador_K,
					'fecha'=>date('d-m-Y'),
					'minutos'=>$test_respondidos['tiempo_real'],
					'correo'=>$test_respondidos['correo']
		);
		return $reporte;
	}
	private function reporteLiderazdo($test_respondidos){
		$reporte = array(
					'fecha'=>date('d-m-Y'),
					'minutos'=>$test_respondidos['tiempo_real'],
					'correo'=>$test_respondidos['correo']
		); 
		return $reporte;
	}
	public function reportesTest($clave_test, $correo = null, $fecha = null){
		switch($clave_test){
			case 1: //Evaluacion ingles
				$temp = $this->reporteTestIngles($clave_test, $correo, $fecha);
				//echo"\nEntraste en ingles\n";
				//$json  = json_encode($temp);
				break;
			case 2: //Liderasgo Fuerza y debeilidades
				//echo"\nEntraste en Liderasgo Fuerza y debeilidade\n";
				$temp = $this->reporteTestLiderazgo($clave_test, $correo, $fecha);
				//$json  = json_encode($temp);
				break;
			case 3: //Canales de percepcion 
				//echo"\nEntraste en Canales de percepcion\n";
				$temp = $this->reporteTestIngles($clave_test, $correo, $fecha);
				//$json  = json_encode($temp);
				break;
			case 4: //Estilos de pensamiento
				//echo"\nEntraste en Estilos de pensamiento\n";
				$temp = $this->reporteTestIngles($clave_test, $correo, $fecha);
				//$json  = json_encode($temp);
				break;
			case 5: //Inteligencia emocional
				//echo"\nEntraste Inteligencia emocional\n";
				$temp = $this->reporteTestIngles($clave_test, $correo, $fecha);
				//$json  = json_encode($temp);
				break;
		} 
		//return $json;
		//print_r($temp);
		return $temp;
	}
	private function reporteTestLiderazgo($clave_test, $correo = null, $fecha = null){
		$tests_respondidos = $this->obtenerTestRespondidoPorClaveTest($clave_test, $correo, $fecha);
		//echo"Estos son los test respondidos: ";
		//print_r($tests_respondidos);
		foreach ($tests_respondidos as $test_respondido){
			$usuario = $this->obtenerUsuarioPorCorreo($test_respondido['correo']);
			$totales_respondidos = $this->obtenerTotalesTestRespondidosPorClaveTestRespondidos($test_respondido['clave_test_respondido']); //Revisar no se si va
			$this->clave_test = $clave_test;
			$titulos_totales = $this->obtenerTituloTotales(); //no se si va;
			$this->parserTest($test_respondido, $usuario, $totales_respondidos, $clave_test, $titulos_totales);
		}
		return $this->reporte_test;
	}
	private function reporteTestIngles($clave_test, $correo = null, $fecha = null){
		$tests_respondidos = $this->obtenerTestRespondidoPorClaveTest($clave_test, $correo, $fecha);
		//print_r($tests_respondidos);
		foreach ($tests_respondidos as $test_respondido){
			$usuario = $this->obtenerUsuarioPorCorreo($test_respondido['correo']);
			$totales_respondidos = $this->obtenerTotalesTestRespondidosPorClaveTestRespondidos($test_respondido['clave_test_respondido']);
			$this->clave_test = $clave_test;
			$titulos_totales = $this->obtenerTituloTotales();
			$this->parserTest($test_respondido, $usuario, $totales_respondidos, $clave_test, $titulos_totales, $test_respondido['revisado']);
		}
		return $this->reporte_test;
	}
	private function parserTest($test_respondido, $usuario, $totales_respondidos = null, $clave_test, $titulos_totales = null, $revisado = null){
		//print_r($test_respondido);
		$fecha = explode('-', $test_respondido['fecha']);
		$reporte_temp= array(
			'clave_test_respondido'=>$test_respondido['clave_test_respondido'],
			'fecha'=>$fecha[2].'-'.$fecha[1].'-'.$fecha[0],
			'fecha_format'=>$fecha[2].' de '. f_genericas_inc::formatoMes($fecha[1]).' de '.$fecha[0],
			'tiempo'=>$test_respondido['tiempo_real'],
			'nombre'=>$usuario['nombre'],
			'empresa'=>$usuario['empresa'],
			'estado'=>$usuario['estado'],
			'ciudad'=>$usuario['ciudad'],
			'revisado'=>$test_respondido['revisado'],
			'tel_personal'=>$usuario['tel_personal'],
			'tel_empresa'=>$usuario['tel_empresa'],
			'puesto'=>$usuario['puesto'],
			'correo'=>$usuario['correo'],
			'revisado'=>$revisado
		);
		/*echo "Esta es el test revisado: ";*/
		$reporte_temp['revisado']=$test_respondido['revisado'];
		if($clave_test == 2){ 
			$reporte_temp['html'] = 'TEST_liderazgo_resultados';
			$reporte_temp['titulo_test']='Evaluaci&oacute;n Liderazgo Fuerza y Debilidades';
		}
		//print_r($test_respondido['revisado']);
		//print_r($reporte_temp);
		/*echo "----Otras vez-----";
		print_r($reporte_temp);
		print_r($totales_respondidos);*/
		foreach($totales_respondidos  as $total_respondido){
			//echo "Entraste en el primer for: ";
			foreach($titulos_totales as $titulo_total){
				//echo "Entraste en el segundo for: ";
				if($total_respondido['clave_total'] == $titulo_total['clave_total']){
					if($clave_test == 1){
						$reporte_temp['html'] = 'TEST_ingles_resultados';
						$reporte_temp['titulo_test']='Evaluaci&oacute;n de ingl&eacute;s';
						if($titulo_total['titulo_total'] == 'Aciertos'){
							$reporte_temp['aciertos'] = $total_respondido['valor_total_test'];
						}elseif($titulo_total['titulo_total'] == 'Errores'){
							$reporte_temp['errores'] = $total_respondido['valor_total_test'];
						}
					}elseif($clave_test == 2){
						
					}elseif($clave_test == 3){
						$reporte_temp['html'] = 'TEST_percepcion_resultados';
						$reporte_temp['titulo_test']='Evaluaci&oacute;n Canales de Percepci&oacute;n';
						if($titulo_total['titulo_total'] == 'Resultados visuales'){
							$reporte_temp['V'] = $total_respondido['valor_total_test'];
						}elseif($titulo_total['titulo_total'] == 'Resultados auditivos'){
							$reporte_temp['A'] = $total_respondido['valor_total_test'];
						}elseif($titulo_total['titulo_total'] == 'Resultados kinestesicos'){
							$reporte_temp['K'] = $total_respondido['valor_total_test'];
						}
					}elseif($clave_test == 4){
						$reporte_temp['html'] = 'TEST_dominancia_resultados';
						$reporte_temp['titulo_test']='Evaluaci&oacute;n Estilos de Pensamiento';
						if($titulo_total['clave_total'] == 8){ //RESULTADOS CUADRANTE A SUPERIOR IZQUIERDO CEREBRAL
							$reporte_temp['CA'] = $total_respondido['valor_total_test'];
						}elseif($titulo_total['clave_total'] == 9){//RESULTADOS CUADRANTE B INFERIOR IZQUIERDO L�MBICO
							$reporte_temp['CB'] = $total_respondido['valor_total_test'];
						}elseif($titulo_total['clave_total'] == 10){//RESULTADOS CUADRANTE C DERECHO INFERIOR L�MBICO
							$reporte_temp['CC'] = $total_respondido['valor_total_test'];
						}elseif($titulo_total['clave_total'] == 11){//RESULTADOS CUADRANTE D DERECHO SUPERIOR CEREBRAL
							$reporte_temp['CD'] = $total_respondido['valor_total_test'];
						}
					
					}elseif($clave_test == 5){
						$reporte_temp['html'] = 'TEST_inteligencia_resultados';
						$reporte_temp['titulo_test']='Evaluaci&oacute;n Inteligencia Emocional';
					if($titulo_total['titulo_total'] == 'GRUPO A'){
							$reporte_temp['A'] = $total_respondido['valor_total_test'];
						}elseif($titulo_total['titulo_total'] == 'GRUPO B'){
							$reporte_temp['B'] = $total_respondido['valor_total_test'];
						}elseif($titulo_total['titulo_total'] == 'GRUPO C'){
							$reporte_temp['C'] = $total_respondido['valor_total_test'];
						}elseif($titulo_total['titulo_total'] == 'GRUPO D'){
							$reporte_temp['D'] = $total_respondido['valor_total_test'];
						}elseif($titulo_total['titulo_total'] == 'GRUPO E'){
							$reporte_temp['E'] = $total_respondido['valor_total_test'];
						}elseif($titulo_total['titulo_total'] == 'GRUPO F'){
							$reporte_temp['F'] = $total_respondido['valor_total_test'];
						}elseif($titulo_total['titulo_total'] == 'GRUPO G'){
							$reporte_temp['G'] = $total_respondido['valor_total_test'];
						}elseif($titulo_total['titulo_total'] == 'GRUPO H'){
							$reporte_temp['H'] = $total_respondido['valor_total_test'];
						}elseif($titulo_total['titulo_total'] == 'GRUPO I'){
							$reporte_temp['I'] = $total_respondido['valor_total_test'];
						}elseif($titulo_total['titulo_total'] == 'GRUPO J'){
							$reporte_temp['J'] = $total_respondido['valor_total_test'];
						}
								
					}elseif($clave_test == 2){ 
						$reporte_temp['html'] = 'TEST_liderazgo_resultados';
						$reporte_temp['titulo_test']='Evaluaci&oacute;n Liderasgo Fuerza y Debilidades';
					}
				}
			}
		}
		$this->reporte_test[] = $reporte_temp;
	}
	private function reporteIngles($test_respondidos){
		$reporte = array(
					'respuestas_correctas'=>$this->contador_correcto,
					'respuestas_incorrectas'=>$this->contador_incorrecto,
					'fecha'=>date('d-m-Y'),
					'minutos'=>$test_respondidos['tiempo_real'],
					'correo'=>$test_respondidos['correo']
		);
		return $reporte;
	}
	private function reporteEstilosDePensamiento($test_respondidos){
		$reporte = array(
					'cuadrante_a'=>$this->cuadrante_A,
					'cuadrante_b'=>$this->cuadrante_B,
					'cuadrante_c'=>$this->cuadrante_C,
					'cuadrante_d'=>$this->cuadrante_D,
					'fecha'=>date('d-m-Y'),
					'minutos'=>$test_respondidos['tiempo_real'],
					'correo'=>$test_respondidos['correo']
		);
		return $reporte;
	}
	private function reporteInteliengiaEmocional($test_respondidos){
		$reporte = array(
					'grupo_a'=>$this->grupo_A,
					'grupo_b'=>$this->grupo_B,
					'grupo_c'=>$this->grupo_C,
					'grupo_d'=>$this->grupo_D,
					'grupo_e'=>$this->grupo_E,
					'grupo_f'=>$this->grupo_F,
					'grupo_g'=>$this->grupo_G,
					'grupo_h'=>$this->grupo_H,
					'grupo_i'=>$this->grupo_I,
					'grupo_j'=>$this->grupo_J,
					'fecha'=>date('d-m-Y'),
					'minutos'=>$test_respondidos['tiempo_real'],
					'correo'=>$test_respondidos['correo']
		);
		return $reporte;
	}
	/**
	 * Funcion insertarTotalesTestRespondidosIngles
	 * Inserta los totales del test de ingles en TOTALES_TEST_RESPONDIDOS
	 */
	private function insertarTotalesTestRespondidosIngles($titulo){
		if($titulo['titulo_total'] == 'Errores'){
			$this->insertarTotalesTestRespondidos($this->contador_incorrecto, $titulo['clave_total']);
		}else if($titulo['titulo_total'] == 'Aciertos'){
			$this->insertarTotalesTestRespondidos($this->contador_correcto, $titulo['clave_total']); 
		}
	}
	/**
	 * Funcion insertarTotalesTestRespondidosCanalesDePercepcion
	 * Insertar totales del tets canales de percepcion en TOTALES_TEST_RESPONDIDOS
	 * 
	 */
	private function insertarTotalesTestRespondidosCanalesDePercepcion($titulo){
		if($titulo['titulo_total'] == 'Resultados visuales'){
			$this->insertarTotalesTestRespondidos($this->contador_V, $titulo['clave_total']);
		}elseif($titulo['titulo_total'] == 'Resultados auditivos'){
			$this->insertarTotalesTestRespondidos($this->contador_A, $titulo['clave_total']);
		}elseif($titulo['titulo_total'] == 'Resultados kinestesicos'){
			$this->insertarTotalesTestRespondidos($this->contador_K, $titulo['clave_total']);
		}
	}
	private function insertTotalesTestRespondidosEstilosDePensamiento($titulo){
		if($titulo['clave_total'] == 8){
			$this->insertarTotalesTestRespondidos($this->cuadrante_A, $titulo['clave_total']);
		}elseif($titulo['clave_total'] == 9){
			$this->insertarTotalesTestRespondidos($this->cuadrante_B, $titulo['clave_total']);
		}elseif($titulo['clave_total'] == 10){
			$this->insertarTotalesTestRespondidos($this->cuadrante_C, $titulo['clave_total']);
		}elseif($titulo['clave_total'] == 11){
			$this->insertarTotalesTestRespondidos($this->cuadrante_D, $titulo['clave_total']);
		}
	}
	private function insertTotalesTestRespondidosInteligenciaEmocional($titulo){
		if($titulo['clave_total'] == 12){
			$this->insertarTotalesTestRespondidos($this->grupo_A, $titulo['clave_total']);
		}elseif($titulo['clave_total'] == 13){
			$this->insertarTotalesTestRespondidos($this->grupo_B, $titulo['clave_total']);
		}elseif($titulo['clave_total'] == 14){
			$this->insertarTotalesTestRespondidos($this->grupo_C, $titulo['clave_total']);
		}elseif($titulo['clave_total'] == 15){
			$this->insertarTotalesTestRespondidos($this->grupo_D, $titulo['clave_total']);
		}elseif($titulo['clave_total'] == 16){
			$this->insertarTotalesTestRespondidos($this->grupo_E, $titulo['clave_total']);
		}elseif($titulo['clave_total'] == 17){
			$this->insertarTotalesTestRespondidos($this->grupo_F, $titulo['clave_total']);
		}elseif($titulo['clave_total'] == 18){
			$this->insertarTotalesTestRespondidos($this->grupo_G, $titulo['clave_total']);
		}elseif($titulo['clave_total'] == 19){
			$this->insertarTotalesTestRespondidos($this->grupo_H, $titulo['clave_total']);
		}elseif($titulo['clave_total'] == 20){
			$this->insertarTotalesTestRespondidos($this->grupo_I, $titulo['clave_total']);
		}elseif($titulo['clave_total'] == 21){
			$this->insertarTotalesTestRespondidos($this->grupo_J, $titulo['clave_total']);
		}
	}
	public function guardarFaseTest($array_post){
		$this->actulizarTiempoRealPorClaveTestRespondido($array_post['time_t']);
		$res['error'] =  $this->verificarPostYRespuestas($array_post);
		if($res['error'] == 'false'){
			$res['mensaje'] = 'Falta campo requerido';
		}
		return $res;
	}
	/**
	 * 1 Test de Ingles
	 * 2 Test Canales de percepcion
	 * 3 Test Canales de percepcion
	 */
	private function contadorRespuestas($opciones_respuesta, $texto_respuesta){
		
		switch($this->clave_test){
			case 1: 
				$this->contadorRespuestasTestIngles($opciones_respuesta, $texto_respuesta);
				return;
			break;
			case 3:
				$this->contadorRespuestasCanalesDePercepcion($opciones_respuesta, $texto_respuesta);
				return;
			break;
			case 4:
				$this->contadorRespuestasEstilosDePensamiento($opciones_respuesta, $texto_respuesta);
				return;
			break;
			case 5:
				$this->contadorRespuestasInteligenciaEmocional($opciones_respuesta, $texto_respuesta);
				return;
			break;
		}
	}
	/**
	 * Funcion contadorRespuestasTestIngles
	 * Funcion que hace el incremento en las respuetas contestadas
	 * correcta e incorrectamente
	 * 
	 */
	private function contadorRespuestasTestIngles($opciones_respuesta, $texto_respuesta){	
		foreach($opciones_respuesta as $opcion_respuesta){
			$opcion_respuesta['valor_opcion']= trim($opcion_respuesta['valor_opcion']);
			$opcion_respuesta['valor_correcto'] = trim($opcion_respuesta['valor_correcto']);
			$texto_respuesta= trim($texto_respuesta);
			//if(addslashes($opcion_respuesta['valor_opcion']) == addslashes($texto_respuesta)){
			if((strcmp($opcion_respuesta['valor_opcion'], $texto_respuesta)) == 0) {
				if($opcion_respuesta['valor_correcto'] == 'S'){
					$this->contador_correcto++;
					return;
				}elseif($opcion_respuesta['valor_correcto'] == 'N'){
					$this->contador_incorrecto++;
					return;
				}	  
			}
		}
	}
	/**
	 * Funcion contadorRespuestasCanalesDePercepcion
	 * Este test cuenta con tres valores posibles A, K, V
	 * Se hace el incremento  en cada variable segun sea el caso de la coincidencia
	 */
	private function contadorRespuestasCanalesDePercepcion($opciones_respuesta, $texto_respuesta){
		foreach($opciones_respuesta as $opcion_respuesta){
			$opcion_respuesta['valor_opcional'] = trim($opcion_respuesta['valor_opcional']);
			$opcion_respuesta['valor_opcion'] = trim($opcion_respuesta['valor_opcion']);
			$texto_respuesta = trim($texto_respuesta);
			if($opcion_respuesta['valor_opcion'] == $texto_respuesta){
				if($opcion_respuesta['valor_opcional'] == 'K'){
					$this->contador_K++;
					return;
				}elseif($opcion_respuesta['valor_opcional'] == 'A'){
					$this->contador_A++;
					return;
				}elseif($opcion_respuesta['valor_opcional'] == 'V'){
					$this->contador_V++;
					return;
				}	
			}
		}
	}
	private function contadorRespuestasEstilosDePensamiento($opciones_respuesta, $texto_respuesta){
		foreach($opciones_respuesta as $opcion_respuesta){
			$opcion_respuesta['valor_opcion'] = trim($opcion_respuesta['valor_opcion']);
			$texto_respuesta = trim($texto_respuesta);
			if(($opcion_respuesta['clave_respuesta'] >=97 ) && ($opcion_respuesta['clave_respuesta'] <= 106)){//Cudrante ASuperior izquierdo cerebral
				if($opcion_respuesta['valor_opcion'] == $texto_respuesta){
					$this->cuadrante_A += $opcion_respuesta['valor_opcional'];	
				}
			}elseif(($opcion_respuesta['clave_respuesta'] >=107 ) && ($opcion_respuesta['clave_respuesta'] <= 116)){//Cudrante B inferior izquierdo
				if($opcion_respuesta['valor_opcion'] == $texto_respuesta){
					$this->cuadrante_B += $opcion_respuesta['valor_opcional'];	
				}
			}elseif(($opcion_respuesta['clave_respuesta'] >=117 ) && ($opcion_respuesta['clave_respuesta'] <= 126)){//Cuadrante C derecho infrerior limbico 
				if($opcion_respuesta['valor_opcion'] == $texto_respuesta){
					$this->cuadrante_C += $opcion_respuesta['valor_opcional'];	
				}
			}elseif(($opcion_respuesta['clave_respuesta'] >=127 ) && ($opcion_respuesta['clave_respuesta'] <= 136)){//Cuadrante D derecho superior cerebral 
				if($opcion_respuesta['valor_opcion'] == $texto_respuesta){
					$this->cuadrante_D += $opcion_respuesta['valor_opcional'];	
				}
			}
		}
	}
	
	
	private function contadorRespuestasInteligenciaEmocional($opciones_respuesta, $texto_respuesta){
		foreach($opciones_respuesta as $opcion_respuesta){
			$opcion_respuesta['valor_opcion'] = trim($opcion_respuesta['valor_opcion']);
			$texto_respuesta = trim($texto_respuesta);
			$opcion_respuesta['valor_correcto'] = trim($opcion_respuesta['valor_correcto']);
			if(($opcion_respuesta['clave_respuesta'] >=137 ) && ($opcion_respuesta['clave_respuesta'] <= 146)){//Grupo A
				if($opcion_respuesta['valor_opcion'] == $texto_respuesta){
					if($opcion_respuesta['valor_correcto'] == 'S'){
							$this->grupo_A ++;
					}
				}
			}elseif(($opcion_respuesta['clave_respuesta'] >=147 ) && ($opcion_respuesta['clave_respuesta'] <= 156)){//Grupo B
				if($opcion_respuesta['valor_opcion'] == $texto_respuesta){
					if($opcion_respuesta['valor_correcto'] == 'S'){
							$this->grupo_B ++;
					}
				}
			}elseif(($opcion_respuesta['clave_respuesta'] >=157 ) && ($opcion_respuesta['clave_respuesta'] <= 166)){//Grupo C 
				if($opcion_respuesta['valor_opcion'] == $texto_respuesta){
					if($opcion_respuesta['valor_correcto'] == 'S'){
							$this->grupo_C ++;
					}
				}
			}elseif(($opcion_respuesta['clave_respuesta'] >=167 ) && ($opcion_respuesta['clave_respuesta'] <= 176)){//Grupo D 
				if($opcion_respuesta['valor_opcion'] == $texto_respuesta){
					if($opcion_respuesta['valor_correcto'] == 'S'){
							$this->grupo_D ++;
					}
				}
			}elseif(($opcion_respuesta['clave_respuesta'] >=177 ) && ($opcion_respuesta['clave_respuesta'] <= 186)){//Grupo E 
				if($opcion_respuesta['valor_opcion'] == $texto_respuesta){
					if($opcion_respuesta['valor_correcto'] == 'S'){
							$this->grupo_E ++;
					}
				}
			}elseif(($opcion_respuesta['clave_respuesta'] >=187 ) && ($opcion_respuesta['clave_respuesta'] <= 196)){//Grupo F 
				if($opcion_respuesta['valor_opcion'] == $texto_respuesta){
					if($opcion_respuesta['valor_correcto'] == 'S'){
							$this->grupo_F ++;
					}	
				}
			}elseif(($opcion_respuesta['clave_respuesta'] >=197 ) && ($opcion_respuesta['clave_respuesta'] <= 206)){//Grupo G 
				if($opcion_respuesta['valor_opcion'] == $texto_respuesta){
					if($opcion_respuesta['valor_correcto'] == 'S'){
							$this->grupo_G ++;
					}	
				}
			}elseif(($opcion_respuesta['clave_respuesta'] >=207 ) && ($opcion_respuesta['clave_respuesta'] <= 216)){//Grupo H 
				if($opcion_respuesta['valor_opcion'] == $texto_respuesta){
					if($opcion_respuesta['valor_correcto'] == 'S'){
							$this->grupo_H ++;
					}
				}
			}elseif(($opcion_respuesta['clave_respuesta'] >=217 ) && ($opcion_respuesta['clave_respuesta'] <= 226)){//Grupo I
				if($opcion_respuesta['valor_opcion'] == $texto_respuesta){
					if($opcion_respuesta['valor_correcto'] == 'S'){
							$this->grupo_I ++;
					}	
				}
			}elseif(($opcion_respuesta['clave_respuesta'] >=227 ) && ($opcion_respuesta['clave_respuesta'] <= 236)){//Grupo J
				if($opcion_respuesta['valor_opcion'] == $texto_respuesta){
					if($opcion_respuesta['valor_correcto'] == 'S'){
							$this->grupo_J ++;
					}
				}
			}
		}

		
	}
	private function connect($dsn){
		$this->db  = f_genericas_inc::DBconnect($dsn);
	}
	private function verificarPostYRespuestas($array_post){
		$array_respuestas = $this->obtenerRespuestasPorClaveFase();
		$requerido = $this->verificarCampoRequerido($array_respuestas, $array_post);
		if($requerido == 'true'){
			foreach($array_post as $key => $post){
				foreach ($array_respuestas as  $respuesta) {
					if($key == $respuesta['clave_respuesta']){
						$this->insertRespuetaUsuarioPorClaveRespuesta($respuesta['clave_respuesta'], $post);
					}
				}
			}
		}
		return $requerido;
	}
	private function verificarCampoRequerido($array_respuestas, $array_post){
		foreach($array_post as $key => $post){
			foreach ($array_respuestas as  $respuesta) {
				if($key == $respuesta['clave_respuesta']){
					if(($respuesta['forzoso'] == 'S') && ($post==''))
						return 'false';
				}
			}
		}
		return 'true';
	}
	
	private function parserEstado($id_estado){

		switch($id_estado){
			case 1:
				$estado = 'Aguascalientes';
			break;
			case 2:
				$estado = 'Baja California Norte';
			break;
			case 3:
				$estado = 'Baja California Sur';
			break;
			case 4:
				$estado = 'Campeche';
			break;
			case 5:
				$estado = 'Chihuahua';
			break;
			case 6:
				$estado = 'Chiapas';
			break;
			case 7:
				$estado = 'Coahuila';
			break;
			case 8:
				$estado = 'Colima';
			break;
			case 9:
				$estado = 'Distrito Federal';
			break;
			case 10:
				$estado = 'Durango';
			break;
			case 11:
				$estado = 'Guerrero';
			break;
			case 12:
				$estado = 'Guanajuato';
			break;
			case 13:
				$estado = 'Hidalgo';
			break;
			case 14:
				$estado = 'Jalisco';
			break;
			case 15:
				$estado = 'Michoac&aacute;n';
			break;
			case 16:
				$estado = 'M&eacute;xico';
			break;
			case 17:
				$estado = 'Morelos';
			break;
			case 18:
				$estado = 'Nayarit';
			break;
			case 19:
				$estado = 'Nuevo Le&oacute;n';
			break;
			case 20:
				$estado = 'Oaxaca';
			break;
			case 21:
				$estado = 'Puebla';
			break;
			case 22:
				$estado = 'Queretaro';
			break;
			case 23:
				$estado = 'Quintana Roo';
			break;
			case 24:
				$estado = 'Sinaloa';
			break;
			case 25:
				$estado = 'San LuisPotos&iacute;';
			break;
			case 26:
				$estado = 'Sonora';
			break;
			case 27:
				$estado = 'Tabasco';
			break;
			case 28:
				$estado = 'Tamaulipas';
			break;
			case 29:
				$estado = 'Tlaxcala';
			break;
			case 30:
				$estado = 'Veracruz';
			break;
			case 31:
				$estado = 'Yucat&aacute;n';
			break;
			case 32:
				$estado = 'Zacatecas';
			break;
		
		}
		return $estado;
	}
	/////////////////////////////////////////////////SQL de TEST//////////////////////////////////////////////
	private function insertRespuetaUsuarioPorClaveRespuesta($clave_respuesta, $texto_respuesta){
		$texto_respuesta = addslashes($texto_respuesta);
		$SQL = "INSERT INTO RESPUESTAS_USUARIOS VALUES ('', '$clave_respuesta', '$this->clave_test', '$this->clave_fase', '$texto_respuesta', '$this->clave_test_respondido')";
		$RES = f_genericas_inc::DBquery($SQL, $this->db);
	}
		
	private function obtenerRespuestasPorClaveFase(){
		$SQL = "SELECT * FROM RESPUESTAS_PREGUNTAS WHERE clave_fase = '$this->clave_fase'";
		if($RES = f_genericas_inc::DBquery($SQL, $this->db)){
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
		return $respuestas;
	}
	public function obtenerRespuestasUsuariosPorClavetestRespondido(){
		$SQL = "SELECT * FROM RESPUESTAS_USUARIOS WHERE clave_test_respondido = '$this->clave_test_respondido'";
		if($RES = f_genericas_inc::DBquery($SQL, $this->db)){
			while($ROW = $RES->fetchRow()){
				$respuestas_usuario[] =  array(
					'clave_respuesta_usuario'=>$ROW[0],
					'clave_respuesta'=>$ROW[1],
					'clave_test'=>$ROW[2],
					'clave_fase'=>$ROW[3],
					'texto_respuesta'=>$ROW[4],
					'clave_test_respondido'=>$ROW[5]
				);
			}
		}
		return $respuestas_usuario;
	}
	private function obtenerOpcionRespuestaPorClaveRespuesta($clave_respuesta){
		$opciones_respuestas = null;
		$SQL = "SELECT * FROM OPCIONES_RESPUESTAS WHERE clave_respuesta = '$clave_respuesta'";
		if($RES = f_genericas_inc::DBquery($SQL, $this->db)){
			while($ROW = $RES->fetchRow()){
					$opciones_respuestas[] =  array(
						'clave_opcion'=>$ROW[0],
						'valor_opcion'=>$ROW[1],
						'valor_correcto'=>$ROW[2],
						'selected_opcion'=>$ROW[3],
						'clave_respuesta'=>$ROW[4],
						'valor_opcional'=>$ROW[5]
					);
			}
		}
		return $opciones_respuestas;
		
	}
	public function obtenerUsuarioPorCorreo($correo){
		$SQL = "SELECT * FROM USUARIO WHERE correo = '$correo'";
		if($RES = f_genericas_inc::DBquery($SQL, $this->db)){
			while($ROW = $RES->fetchRow()){
					$usuarios =  array(
						'correo'=>$ROW[0],
						'clave'=>$ROW[1],
						'nombre'=>$ROW[2],
						'apellido'=>$ROW[3],
						'estado'=>$this->parserEstado($ROW[4]),
						'ciudad'=>$ROW[5],
						'empresa'=>$ROW[6],
						'puesto'=>$ROW[7],
						'tel_personal'=>$ROW[8],
						'tel_empresa'=>$ROW[9],
						'confirmado'=>$ROW[10]
					);
			}
		}
		return 	$usuarios;
	}
	
	
	private function obtenerTotalesTestRespondidosPorClaveTestRespondidos($clave_test_respondidos){
		$SQL = "SELECT * FROM TOTALES_TEST_RESPONDIDOS WHERE clave_test_respondido = '$clave_test_respondidos'";
		if($RES = f_genericas_inc::DBquery($SQL, $this->db)){
			while($ROW = $RES->fetchRow()){
					$totales_respondidos[]=  array(
						'clave_total_test'=>$ROW[0],
						'valor_total_test'=>$ROW[1],
						'clave_total'=>$ROW[2],
						'clave_test_respondido'=>$ROW[3]
					);
			}
		}
		return $totales_respondidos;
	}
	private function obtenerTestRespondidoPorClaveTest($clave_test, $correo = null, $fecha = null){
		if(($correo == null) && ($fecha == null)){
			$SQL = "SELECT * FROM TEST_RESPONDIDOS WHERE clave_test = '$clave_test' ORDER BY fecha DESC";
		}elseif($correo){
			$SQL = "SELECT * FROM TEST_RESPONDIDOS WHERE clave_test = '$clave_test' AND correo = '$correo' ORDER BY fecha DESC";
		}elseif($correo == null){
			$SQL = "SELECT * FROM TEST_RESPONDIDOS WHERE clave_test = '$clave_test' AND fecha BETWEEN '$fecha[fecha_inicial]' AND '$fecha[fecha_final]' ORDER BY fecha DESC";
		}
		if($RES = f_genericas_inc::DBquery($SQL, $this->db)){
			while($ROW = $RES->fetchRow()){
					$test_respondidos[]=  array(
						'clave_test_respondido'=>$ROW[0],
						'valores_adicionales'=>$ROW[1],
						'fecha'=>$ROW[2],
						'tiempo_real'=>$ROW[3],
						'revisado'=>$ROW[4],
						'clave_test'=>$ROW[5],
						'correo'=>$ROW[6]
					);
			}
		}
		return $test_respondidos;
	}
	private function obtenerTestRespondidosPorClaveTestRespondidos(){
		$SQL = "SELECT * FROM TEST_RESPONDIDOS WHERE clave_test_respondido = '$this->clave_test_respondido' ORDER BY fecha DESC";
		if($RES = f_genericas_inc::DBquery($SQL, $this->db)){
			while($ROW = $RES->fetchRow()){
					$test_respondidos=  array(
						'clave_test_respondido'=>$ROW[0],
						'valores_adicionales'=>$ROW[1],
						'fecha'=>$ROW[2],
						'tiempo_real'=>$ROW[3],
						'revisado'=>$ROW[4],
						'clave_test'=>$ROW[5],
						'correo'=>$ROW[6]
					);
			}
		}
		return $test_respondidos;
	}
	private function actulizarTiempoRealPorClaveTestRespondido($tiempo_real){
		$SQL = "UPDATE TEST_RESPONDIDOS SET `tiempo_real` = '$tiempo_real' WHERE clave_test_respondido = '$this->clave_test_respondido'";
		$RES = f_genericas_inc::DBquery($SQL, $this->db);
	}
	private function obtenerTituloTotales(){
		$SQL = "SELECT * FROM TOTALES WHERE clave_test = '$this->clave_test'";
		if($RES = f_genericas_inc::DBquery($SQL, $this->db)){
			while($ROW = $RES->fetchRow()){
					$titulo_totales[]=  array(
						'clave_total'=>$ROW[0],
						'titulo_total'=>$ROW[1],
						'clave_test'=>$ROW[2]
					);
			}
		}
		return $titulo_totales;
	}
	private function insertarTotalesTestRespondidos($valor_total, $clave_total){
		$SQL = "INSERT INTO TOTALES_TEST_RESPONDIDOS VALUES ('', '$valor_total', '$clave_total', '$this->clave_test_respondido')";
		$RES = f_genericas_inc::DBquery($SQL, $this->db);
	}
	private function obtenerSeccionesPorClaveTest(){
		$SQL = "SELECT * FROM SECCIONES_FASE WHERE clave_test = '$this->clave_test'";
		if($RES = f_genericas_inc::DBquery($SQL, $this->db)){
			while($ROW = $RES->fetchRow()){
					$secciones[]=  array(
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
		return $secciones;
	}
	public function borrarTestRespondidoPorID($id_tets_respondido){
		$SQL = "DELETE FROM  TEST_RESPONDIDOS WHERE clave_test_respondido = '$id_tets_respondido'";
		$RES = f_genericas_inc::DBquery($SQL, $this->db);
	}
	
	public function UpdateTestRespondidoPorID($id_tets_respondido){
		$SQL = "UPDATE TEST_RESPONDIDOS set revisado = 'S' where clave_test_respondido = $id_tets_respondido"; 
		$RES = f_genericas_inc::DBquery($SQL, $this->db);
	}
	
	public function updateClave($clave, $correo){
		$SQL = "UPDATE USUARIO SET clave = MD5('" . $clave . "') WHERE correo = '$correo' LIMIT 1";

		$RES = f_genericas_inc::DBquery($SQL, $this->db);
	}
	public function verificarClaveTestYClaveFaseEnRespuestasUsuasrios($clave_test, $clave_fase, $clave_test_respondido){
		$flag = 'false';
		$SQL = "SELECT * FROM RESPUESTAS_USUARIOS WHERE clave_test = '$this->clave_test' AND clave_fase = '$this->clave_fase' AND clave_test_respondido = '$this->clave_test_respondido'";
		$RES = f_genericas_inc::DBquery($SQL, $this->db);
			$ROW = $RES->fetchRow();
			if($ROW){
				$flag = 'true';
			}
		return $flag;
	}
}	

?>