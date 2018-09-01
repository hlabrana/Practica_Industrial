<?php
session_start();
//Creacion y reemplazo de TABLAS SQL (FacturadorMinorista y SAP)
$conexion = mysqli_connect('localhost', 'root', 'hector123','Morosidad')
    or die('No se pudo conectar: ' . mysqli_error());
mysqli_set_charset($conexion,'utf8');

$query="

CREATE OR REPLACE TABLE COSTO_DatosSAP(
  Sociedad VARCHAR(255),
  StatusDeDocumento VARCHAR(255),
  NombreDeLaCuenta VARCHAR(255),
  BancoPropio VARCHAR(255),
  ClaseDeDocumento VARCHAR(255),
  Referencia VARCHAR(255),
  Texto VARCHAR(255),
  ViaDePago VARCHAR(255),
  Acreedor BIGINT,
  BloqueoDePago VARCHAR(255),
  ReceptPago VARCHAR(255),
  NDocumento BIGINT,
  FechaDeDocumento DATE,
  FeContabilizacion DATE,
  ImporteMonedaLocal BIGINT,
  MonedaDelDocumento VARCHAR(255),
  FechaDePago DATE,
  DocCompensacion VARCHAR(255),
  CuentaDeMayor BIGINT
)";

mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query="

CREATE OR REPLACE TABLE FECHACOSTO(
  fecha DATE
)";

mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$_SESSION["DATECOSTO"]= $_POST['datecosto'];
$fecha = SET_FECHA($_POST['datecosto']);
$query="INSERT INTO FECHACOSTO VALUES ('$fecha')";

mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

?>


<?php
//Conexion Base de datos
$conexion = mysqli_connect('localhost', 'root', 'hector123','Morosidad')
    or die('No se pudo conectar: ' . mysqli_error());
mysqli_set_charset($conexion,'utf8');
//echo 'Connected successfully'."<br>";
//obtenemos el archivo .csv
$tipo = $_FILES['archivo']['type'];

$tamanio = $_FILES['archivo']['size'];

$archivotmp = $_FILES['archivo']['tmp_name'];

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
       $sociedad = utf8_encode($datos[0]);
       $statusdocumento = utf8_encode($datos[1]);
       $nombrecuenta = utf8_encode($datos[2]);
       $bancopropio = utf8_encode($datos[3]);
       $clasedocumento = utf8_encode($datos[4]);
       $referencia = utf8_encode($datos[5]);
       $texto = utf8_encode($datos[6]);
       $viapago = utf8_encode($datos[7]);
       $acreedor = utf8_encode($datos[8]);
       $bloqueopago = utf8_encode($datos[9]);
       $receptpago = utf8_encode($datos[10]);
       $ndocumento = utf8_encode($datos[11]);
       $fechadocumento = utf8_encode(SET_FECHA($datos[12]));
       $fecontabilizacion = utf8_encode(SET_FECHA($datos[13]));
       $importe = utf8_encode(SET_IMPORTE($datos[14]));
       $moneda = utf8_encode($datos[15]);
       $fechapago = utf8_encode(SET_FECHA($datos[16]));
       $doccompensacion = utf8_encode($datos[17]);
       $cuentamayor = utf8_encode($datos[18]);

       //guardamos en base de datos la línea leida
       mysqli_query($conexion,"INSERT INTO COSTO_DatosSAP VALUES
      ('$sociedad','$statusdocumento','$nombrecuenta','$bancopropio','$clasedocumento','$referencia','$texto','$viapago','$acreedor','$bloqueopago','$receptpago','$ndocumento'
      ,'$fechadocumento','$fecontabilizacion','$importe','$moneda','$fechapago','$doccompensacion','$cuentamayor') ");
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

header("Location: LimpiezaArchivoCosto.php");
?>

<?php
//Definicion de funciones

function SET_FECHA($date){
  $split = explode("-",$date);
  if(count($split) == 3){
  $fechanueva = $split[2]."-".$split[1]."-".$split[0];
  }
  else{
    $fechanueva = NULL;
  }
  return $fechanueva;
}

function SET_IMPORTE($numero){
  $split = explode(".",$numero);
  if(count($split) == 0){
    return 0;
  }
  else{
    $newnumero = $split[0];
    for($i=1;$i<count($split);$i++){
      $newnumero = $newnumero.$split[$i];
    }
    return $newnumero;
  }
  return 0;
}

function SET_PUNTOCOMA($string){
  $split = explode(";",$date);
  if(count($split)>0){
  $NuevoString = $split[0];
  for($i=1;$i<count($split);$i++){
    $NuevoString = $NuevoString.$split[$i];
  }
  return $NuevoString;
  }
  else{
    return $string;
  }
}

?>
