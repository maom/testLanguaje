<script language="javascript" type="text/javascript">   

  
function MostrarFecha()   
   {   
   var nombres_dias = new Array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado")   
   var nombres_meses = new Array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre")   
  
   var fecha_actual = new Date()   
  
   dia_mes = fecha_actual.getDate()     //dia del mes   
   dia_semana = fecha_actual.getDay()       //dia de la semana   
   mes = fecha_actual.getMonth() + 1   
   anio = fecha_actual.getFullYear()   
  
   //escribe en pagina   
   document.write(nombres_dias[dia_semana] + ", " + dia_mes + " de " + nombres_meses[mes - 1] + " de " + anio)   
   }   
  
  
  
  
</script>  