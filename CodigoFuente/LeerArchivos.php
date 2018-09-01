<?php
session_start();
//Creacion y reemplazo de TABLAS SQL (FacturadorMinorista y SAP)
$conexion = mysqli_connect('localhost', 'root', 'hector123','Morosidad')
    or die('No se pudo conectar: ' . mysqli_error());
mysqli_set_charset($conexion,'utf8');

$query="

CREATE OR REPLACE TABLE FacturadorMinorista (
	origen VARCHAR(255),
	emp VARCHAR(255),
	emp_ldd VARCHAR(255),
	cliente VARCHAR(255),
	cuenta VARCHAR(255), #hay datos NULL
	emp_deuda VARCHAR(255),
	rut_cliente VARCHAR(255), #el formato impide que sea tipo INT
	rut_cuenta VARCHAR(255), #el formato impide que sea tipo INT
	nom_cliente VARCHAR(255),
	cod_tipdocum VARCHAR(255),
	des_tipdocum VARCHAR(255),
	n_documento VARCHAR(255),
	num_folio VARCHAR(255),
	facturactc INT,
	tip_saldo VARCHAR(255),
	fec_emision DATE,
	fec_vencimie DATE,
	importe INT,
	cod_ciclo VARCHAR(255),
	ind_vigencia VARCHAR(255),
	num_aviso VARCHAR(255),
	num_cuota VARCHAR(255),
	estado_cuota VARCHAR(255),
	segmento VARCHAR(255),
	cod_area INT,
	telefono VARCHAR(255),
	ant_proy INT,
	tramo_proy INT,
	prov_proy INT,
	excluido VARCHAR(255),
	relacion VARCHAR(255),
	grupo VARCHAR(255),
	ejecutivo VARCHAR(255),
	fec_carga DATETIME,
	carterizado VARCHAR(255),
	grupo2 VARCHAR(255),
	analista VARCHAR(255)
)";

mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query="

CREATE OR REPLACE TABLE SAP(
	Cliente INT,
	icono VARCHAR(255),
	NombreCuenta VARCHAR(255),
	BloqueoDePago VARCHAR(255),
	ClaseDocumento VARCHAR(255),
	Referencia VARCHAR(255),
	FechaDocumento DATE,
	Asignacion VARCHAR(255),
	FechaDePago DATE,
	VencimientoNeto DATE,
	ImporteEnMonedaLocal BIGINT,
	FechaCompensacion DATE,
	FeContabilizacion DATE,
	NumeroDocumento BIGINT,
	DocCompensacion VARCHAR(255),
	TextoCabDocumento VARCHAR(255),
	Texto VARCHAR(255),
	Sociedad VARCHAR(255),
	CuentaDeMayor BIGINT
)";

mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query="

CREATE OR REPLACE TABLE DetalleGlosa(
	facturactc VARCHAR(255),
	Glosa VARCHAR(255)
)";

mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query="

CREATE OR REPLACE TABLE FECHACIERRE(
	fecha DATE
)";

mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$_SESSION["DATECIERRE"]= $_POST['datecierre'];
$fecha = SET_FECHA($_POST['datecierre']);
$query="INSERT INTO FECHACIERRE VALUES ('$fecha')";

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
       $origen = utf8_encode($datos[0]);
       $emp = utf8_encode($datos[1]);
       $emp_ldd = utf8_encode($datos[2]);
       $cliente = utf8_encode($datos[3]);
       $cuenta = utf8_encode($datos[4]);
       $emp_deuda = utf8_encode($datos[5]);
       $rut_cliente = utf8_encode($datos[6]);
       $rut_cuenta = utf8_encode($datos[7]);
       $nom_cliente = utf8_encode($datos[8]);
       $cod_tipdocum = utf8_encode($datos[9]);
       $des_tipdocum = utf8_encode(strtoupper($datos[10]));
       $n_documento = utf8_encode($datos[11]);
       $num_folio = utf8_encode($datos[12]);
       $facturactc = utf8_encode($datos[13]);
       $tip_saldo = utf8_encode($datos[14]);
       $fec_emision = utf8_encode($datos[15]);
       $fec_vencimie = utf8_encode($datos[16]);
       $importe = utf8_encode($datos[17]);
       $cod_ciclo = utf8_encode($datos[18]);
       $ind_vigencia = utf8_encode($datos[19]);
       $num_aviso = utf8_encode($datos[20]);
       $num_cuota = utf8_encode($datos[21]);
       $estado_cuota = utf8_encode($datos[22]);
       $segmento = utf8_encode($datos[23]);
       $cod_area = utf8_encode($datos[24]);
       $telefono = utf8_encode($datos[25]);
       $ant_proy = utf8_encode($datos[26]);
       $tramo_proy = utf8_encode($datos[27]);
       $prov_proy = utf8_encode($datos[28]);
       $excluido = utf8_encode($datos[29]);
       $relacion = utf8_encode($datos[30]);
       $grupo = utf8_encode($datos[31]);
       $ejecutivo = utf8_encode($datos[32]);
       $fec_carga = utf8_encode($datos[33]);
       $carterizado = utf8_encode($datos[34]);
       $grupo = utf8_encode($datos[35]);
       $analista = utf8_encode($datos[36]);

       //guardamos en base de datos la línea leida
       mysqli_query($conexion,"INSERT INTO FacturadorMinorista VALUES
      ('$origen','$emp','$emp_ldd','$cliente','$cuenta','$emp_deuda','$rut_cliente','$rut_cuenta','$nom_cliente','$cod_tipdocum','$des_tipdocum','$n_documento'
      ,'$num_folio','$facturactc','$tip_saldo','$fec_emision','$fec_vencimie','$importe','$cod_ciclo','$ind_vigencia','$num_aviso','$num_cuota','$estado_cuota','$segmento','$cod_area'
    ,'$telefono','$ant_proy','$tramo_proy','$prov_proy','$excluido','$relacion','$grupo','$ejecutivo','$fec_carga','$carterizado','$grupo','$analista') ");
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
?>

<!-- AHORA CON ARCHIVO SAP -->


<?php
//Conexion Base de datos
$conexion = mysqli_connect('localhost', 'root', 'hector123','Morosidad')
    or die('No se pudo conectar: ' . mysqli_error());
mysqli_set_charset($conexion,'utf8');
//echo 'Connected successfully'."<br>";
//obtenemos el archivo .csv
$tipo = $_FILES['archivo2']['type'];

$tamanio = $_FILES['archivo2']['size'];

$archivotmp = $_FILES['archivo2']['tmp_name'];

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
       $Cliente = utf8_encode($datos[0]);
       $icono = utf8_encode($datos[1]);
       $NombreCuenta = utf8_encode($datos[2]);
       $BloqueoDePago = utf8_encode($datos[3]);
       $ClaseDocumento = utf8_encode($datos[4]);
       $Referencia = utf8_encode($datos[5]);
       $FechaDocumento = utf8_encode(SET_FECHA($datos[6]));
       $Asignacion = utf8_encode($datos[7]);
       $FechaDePago = utf8_encode(SET_FECHA($datos[8]));
       $VencimientoNeto = utf8_encode(SET_FECHA($datos[9]));
       $ImporteEnMonedaLocal = utf8_encode(SET_IMPORTE($datos[10]));
       $FechaCompensacion = utf8_encode(SET_FECHA($datos[11]));
       $FeContabilizacion = utf8_encode(SET_FECHA($datos[12]));
       $NumeroDocumento = utf8_encode($datos[13]);
       $DocCompensacion = utf8_encode($datos[14]);
       $TextoCabDocumento = utf8_encode($datos[15]);
       $Texto = utf8_encode(strtoupper($datos[16]));
       $Sociedad = utf8_encode($datos[17]);
       $CuentaDeMayor = utf8_encode($datos[18]);

       //guardamos en base de datos la línea leida
       mysqli_query($conexion,"INSERT INTO SAP VALUES
      ('$Cliente','$icono','$NombreCuenta','$BloqueoDePago','$ClaseDocumento','$Referencia','$FechaDocumento','$Asignacion'
      ,'$FechaDePago','$VencimientoNeto','$ImporteEnMonedaLocal','$FechaCompensacion','$FeContabilizacion','$NumeroDocumento'
      ,'$DocCompensacion','$TextoCabDocumento','$Texto','$Sociedad','$CuentaDeMayor') ");
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
?>

<?php
//Conexion Base de datos
$conexion = mysqli_connect('localhost', 'root', 'hector123','Morosidad')
    or die('No se pudo conectar: ' . mysqli_error());
mysqli_set_charset($conexion,'utf8');
//echo 'Connected successfully'."<br>";
//obtenemos el archivo .csv
$tipo = $_FILES['archivo3']['type'];

$tamanio = $_FILES['archivo3']['size'];

$archivotmp = $_FILES['archivo3']['tmp_name'];

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
       $facturactc = utf8_encode($datos[5]);//bajo la nueva estructura de la tabla
       $glosa = utf8_encode(strtoupper($datos[17]));

       //guardamos en base de datos la línea leida
       mysqli_query($conexion,"INSERT INTO DetalleGlosa  VALUES
      ('$facturactc','$glosa')");
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
//Se direcciona al php que procesa las consultas
//Al incorporar SCL se direcciona despues de leer datos
//header("Location: LimpiezaBaseMinorista.php");

?>

<!-- Lectura de Archivo SCL-->

<?php
session_start();
//CONEXION BASE DE DATOS
$conexion = mysqli_connect('localhost', 'root', 'hector123','Morosidad')
    or die('No se pudo conectar: ' . mysqli_error());
mysqli_set_charset($conexion,'utf8');

$query="

CREATE OR REPLACE TABLE SCL_DATA(
  negocio VARCHAR(255),
  origen VARCHAR(255),
  Empresa VARCHAR(255),
  Cia VARCHAR(255),
  cartera VARCHAR(255),
  tipo_moroso VARCHAR(255),
  Rut_Cliente VARCHAR(255),
  Codigo_cliente VARCHAR(255),
  Nom_Cliente VARCHAR(255),
  codigo_tipo_documento VARCHAR(255),
  N_folio VARCHAR(255),
  Emision DATE,
  Vencimiento DATE,
  num_cuota VARCHAR(255),
  sec_cuota VARCHAR(255),
  importe BIGINT,
  ant_proy VARCHAR(255),
  tramo_proy VARCHAR(255),
  provision VARCHAR(255),
  ciclo VARCHAR(255),
  Segmento VARCHAR(255)
)";

mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query="

CREATE OR REPLACE TABLE FECHASCL(
  fecha DATE
)";

mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$_SESSION["DATESCL"]= $_POST['datecierre'];
$fecha = SET_FECHA($_POST['datecierre']);
$query="INSERT INTO FECHASCL VALUES ('$fecha')";

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
$tipo = $_FILES['archivoSCL']['type'];

$tamanio = $_FILES['archivoSCL']['size'];

$archivotmp = $_FILES['archivoSCL']['tmp_name'];

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
       $negocio = utf8_encode($datos[0]);
       $origen = utf8_encode($datos[1]);
       $Empresa = utf8_encode($datos[2]);
       $Cia = utf8_encode($datos[3]);
       $cartera = utf8_encode($datos[4]);
       $tipo_moroso = utf8_encode($datos[5]);
       $Rut_Cliente = utf8_encode($datos[6]);
       $Codigo_cliente = utf8_encode($datos[7]);
       $Nom_Cliente = utf8_encode($datos[8]);
       $codigo_tipo_documento = utf8_encode($datos[9]);
       $N_folio = utf8_encode($datos[10]);
       $Emision = utf8_encode(SET_FECHA($datos[11]));
       $Vencimiento = utf8_encode(SET_FECHA($datos[12]));
       $num_cuota = utf8_encode($datos[13]);
       $sec_cuota = utf8_encode($datos[14]);
       $importe = utf8_encode(SET_IMPORTE($datos[15]));
       $ant_proy = utf8_encode($datos[16]);
       $tramo_proy = utf8_encode($datos[17]);
       $provision = utf8_encode($datos[18]);
       $ciclo = utf8_encode($datos[19]);
       $Segmento = utf8_encode($datos[20]);

       //guardamos en base de datos la línea leida
       mysqli_query($conexion,"INSERT INTO SCL_DATA VALUES
      ('$negocio','$origen','$Empresa','$Cia','$cartera','$tipo_moroso','$Rut_Cliente','$Codigo_cliente','$Nom_Cliente','$codigo_tipo_documento',
        '$N_folio','$Emision','$Vencimiento','$num_cuota','$sec_cuota','$importe','$ant_proy','$tramo_proy','$provision','$ciclo','$Segmento') ");
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


//Se procede a entregar el control para procesar informe de Morosidad
header("Location: LimpiezaBaseMinorista.php");
//header("Location: LimpiezaArchivoSCL.php");
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
