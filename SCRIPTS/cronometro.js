
//CRONOMETR
var CronoID = null
var CronoEjecutandose = false
var decimas, segundos, minutos

function DetenerCrono (){
  if(CronoEjecutandose)
  clearTimeout(CronoID)
  CronoEjecutandose = false
}

function InicializarCrono () {
//inicializa contadores globales
decimas = decimas1
segundos = segundos1
minutos = minutos1

//pone a cero los marcadores
document.getElementById('time_t').value ='00:00:0';
//document.crono.display.value = '00:00:0'
//document.crono.parcial.value = '00:00:0'
}

function MostrarCrono () {
      
  //incrementa el crono
  decimas++
if ( decimas > 9 ) {
decimas = 0
segundos++
if ( segundos > 59 ) {
segundos = 0
minutos++
if ( minutos > 99 ) {
alert('Fin de la cuenta')
DetenerCrono()
return true
}
}
}

//configura la salida
var ValorCrono = ""
ValorCrono = (minutos < 10) ? "0" + minutos : minutos
ValorCrono += (segundos < 10) ? ":0" + segundos : ":" + segundos
ValorCrono += ":" + decimas 

  document.getElementById('time_t').value = ValorCrono

  CronoID = setTimeout("MostrarCrono()", 100)
CronoEjecutandose = true
return true
}

function IniciarCrono () {
DetenerCrono()
InicializarCrono()
MostrarCrono()
}

function ObtenerParcial() {
//obtiene cuenta parcial
//document.crono.parcial.value = document.crono.display.value
}


IniciarCrono ();