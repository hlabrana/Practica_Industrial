<!DOCTYPE html>
<html>
<head>
	<title>Exportar Informe</title>
	<link rel="StyleSheet" href="css/EstilosTablasGUI.css" type="text/css">
</head>
<body>
	<br>
	<center>
	<h2>Seleccione la forma de salida del Informe:</h2><br>
  <form action="ExportarCSV.php">
   <input type="submit" value="Descargar Repositorio Completo Morosidad" />
  </form>
  <br>
	<form action="SCL/ExportarUnion.php">
   <input type="submit" value="Descargar Repositorio Completo Morosidad + SCL" />
  </form>
	<br>
  <form action="ExportarVista.php">
   <input type="submit" value="Exportar Vista Resumen a Excel" />
  </form>
	<br>
</center>

<?php
//Conexion Base de datos
$conexion = mysqli_connect('localhost', 'root', 'hector123','Morosidad')
		or die('No se pudo conectar: ' . mysqli_error());
mysqli_set_charset($conexion,'utf8');

$result = mysqli_query($conexion,"SELECT * FROM VISTA_TABLA_DINAMICA");
//se despliega el resultado
echo "<table>";
echo "<tr>";
echo "<th>Grupo</th>";
echo "<th>Vigente</th>";
echo "<th>1-30 días</th>";
echo "<th>31-60 días</th>";
echo "<th>61-90 días</th>";
echo "<th>91-120 días</th>";
echo "<th>121-150 días</th>";
echo "<th>151-180 días</th>";
echo "<th>181-365 días</th>";
echo "<th>1-3 años</th>";
echo "<th>3-5 años</th>";
echo "<th>más de 5 años</th>";
echo "<th>Total General</th>";
echo "</tr>";

while ($row = mysqli_fetch_row($result)){
		echo "<tr>";
		echo "<td>".$row[0]."</td>";
		echo "<td>".number_format($row[1],0,',','.')."</td>";
		echo "<td>".number_format($row[2],0,',','.')."</td>";
		echo "<td>".number_format($row[3],0,',','.')."</td>";
		echo "<td>".number_format($row[4],0,',','.')."</td>";
		echo "<td>".number_format($row[5],0,',','.')."</td>";
		echo "<td>".number_format($row[6],0,',','.')."</td>";
		echo "<td>".number_format($row[7],0,',','.')."</td>";
		echo "<td>".number_format($row[8],0,',','.')."</td>";
		echo "<td>".number_format($row[9],0,',','.')."</td>";
		echo "<td>".number_format($row[10],0,',','.')."</td>";
		echo "<td>".number_format($row[11],0,',','.')."</td>";
		$string = 'Total General';
		if(strcmp($row[0],$string) == 0){
			$Sinsigno = $row[12]*-1;
			echo "<td>".number_format($Sinsigno,0,',','.')."</td>";
		}
		else{
			echo "<td>".number_format($row[12],0,',','.')."</td>";
		}
		echo "</tr>";
}

echo "</table>";
echo "<br><br>";
echo "<center><a href='index.php'>Volver al Inicio</a></center>";
echo "<br>";
?>

</body>
</html>
