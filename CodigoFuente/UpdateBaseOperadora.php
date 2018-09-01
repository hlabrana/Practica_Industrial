<?php
//Conexion Base de datos
$conexion = mysqli_connect('localhost', 'root', 'hector123','Morosidad')
    or die('No se pudo conectar: ' . mysqli_error());
mysqli_set_charset($conexion,'utf8');

//obtenemos el archivo .csv
$tipo = $_FILES['archivo']['type'];

$tamanio = $_FILES['archivo']['size'];

$archivotmp = $_FILES['archivo']['tmp_name'];

//Comprobacion de Seguridad
if($tamanio == 0){
  echo "<br>";
  echo "<center><h3>Ingrese un Archivo Válido</h3><br>";
  echo "<br><a href='index.php'>Volver al Inicio</a></center>";
  exit;
}
if($tipo != "text/csv"){
  echo "<br>";
  echo "<center><h3>Error: Formato Inválido,&nbsp; Se requiere CSV.</h3><br>";
  echo "<br><a href='index.php'>Volver al Inicio</a></center>";
  exit;
}

//Se crea o reemplaza la tabla
$query = "

CREATE OR REPLACE TABLE BaseOperadora(
	rut VARCHAR(255),
	rut_1 VARCHAR(255),
	rut_2 VARCHAR(255),
	IdSAP INT,
	Acreedor BIGINT,
	Nombre VARCHAR(255),
	Grupo VARCHAR(255),
	Analista VARCHAR(255),
	NuevoAnalista VARCHAR(255),
	_120 BOOLEAN,
	_188 BOOLEAN,
	CAP BOOLEAN,
	FIJA BOOLEAN,
	MOVIL BOOLEAN,
	SCL BOOLEAN,
	ATIS BOOLEAN,
	SISCLI BOOLEAN,
	rut_3 VARCHAR(255)
)";

mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

//cargamos el archivo
$lineas = file($archivotmp);

//inicializamos variable a 0, esto nos ayudará a indicarle que no lea la primera línea
$i=0;

//Recorremos el bucle para leer línea por línea
foreach ($lineas as $linea_num => $linea)
{
   //abrimos bucle
   /*si es diferente a 0 significa que no se encuentra en la primera línea
   (con los títulos de las columnas) y por lo tanto puede leerla*/
   if($i != 0)
   {
       //abrimos condición, solo entrará en la condición a partir de la segunda pasada del bucle.
       /* La funcion explode nos ayuda a delimitar los campos, por lo tanto irá
       leyendo hasta que encuentre un ; */
       $datos = explode(";",$linea);

       //Almacenamos los datos que vamos leyendo en una variable
       //usamos la función utf8_encode para leer correctamente los caracteres especiales
       $RUT = utf8_encode($datos[0]);
       $rut_1 = utf8_encode($datos[1]);
       $RUT_2 = utf8_encode($datos[2]);
       $IDSAP = utf8_encode($datos[3]);
       $ACREEDOR = utf8_encode($datos[4]);
       $NOMBRE = utf8_encode($datos[5]);
       $grupo = utf8_encode($datos[6]);
       $Analista = utf8_encode($datos[7]);
       $AnalistaNew = utf8_encode($datos[8]);
       $_120 = utf8_encode(SET_X($datos[9]));
       $_188 = utf8_encode(SET_X($datos[10]));
       $CAP = utf8_encode(SET_X($datos[11]));
       $FIJA = utf8_encode(SET_X($datos[12]));
       $MOVIL = utf8_encode(SET_X($datos[13]));
       $SCL = utf8_encode(SET_X($datos[14]));
       $ATIS = utf8_encode(SET_X($datos[15]));
       $SISCLI = utf8_encode(SET_X($datos[16]));
       $RUT3 = utf8_encode($datos[17]);

       //guardamos en base de datos la línea leida
       mysqli_query($conexion,"INSERT INTO BaseOperadora VALUES
      ('$RUT','$rut_1','$RUT_2','$IDSAP','$ACREEDOR','$NOMBRE','$grupo','$Analista','$AnalistaNew'
      ,'$_120','$_188','$CAP','$FIJA','$MOVIL','$SCL','$ATIS','$SISCLI','$RUT3')");
       //cerramos condición
       if(mysqli_error($conexion)){
       echo mysqli_error($conexion)."<br>";
      }
   }

   /*Cuando pase la primera pasada se incrementará nuestro valor y a la siguiente pasada ya
   entraremos en la condición, de esta manera conseguimos que no lea la primera línea.*/
   $i++;
   //cerramos bucle

}
echo "<br><br><center><h2>Base Operadora Actualizada Correctamente</h2>";
echo "<h3><b>".$i." Registros Ingresados</b><h3></center>";
?>

<br>
<p align="right"><a href="index.php">VOLVER</a></p>

<?php
function SET_X($string){
  if($string == 'X' or $string == 'x'){
    return 1;
  }
  else{
    return $string;
  }
}

?>
