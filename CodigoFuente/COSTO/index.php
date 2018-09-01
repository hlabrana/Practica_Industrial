<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Informe de Costo Acreedor</title>
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
</head>
<body background="../imagenes/fondo.png">
	<br>
	<nav class="menu">
		<ul>
			<li><a href="http://www.telefonicachile.cl"><img src="../imagenes/logo_telefonica.png" alt=""></a></li>
			<li><a href="../index.php">Informe Cierre de Morosidad</a></li>
			<li><a style="color: rgb(12, 189, 35)" href="#">Informe De Costos</a></li>
			<li><a href="../EMAIL/index.php">Generador Email</a></li>
			<li><a href="../ESTADISTICAS/index.php">Estadísticas</a></li>
		</ul>
	</nav>

<center>
	<h2 style="color:#ffffff">Generador Informe de Costos SAP (CxP)</h2>
	<form action="C_LeerArchivos.php" enctype="multipart/form-data" method="post">
		<table border="1" bgcolor="#ffffff">
		<tr>
		<td>Ingrese Archivo Acreedor SAP (.csv)</td>
   <td><input id="archivo" accept=".csv" name="archivo" type="file" /></td>
 		</tr>
   <input name="MAX_FILE_SIZE" type="hidden" value="20000" />
	 <br>
 		</tr>
		<tr>
			<td>Ingrese Fecha de Cierre (dd-mm-YYYY)</td>
			<td> <input type="text" name="datecosto"> </td>
		</tr>
	</table>
	<br>
	<table>
	<tr>
   <td><input name="enviar" type="submit" value="Generar" /></td>
 	</tr>
 </table>
	</form>
	<br>
	<form action="../UpdateBaseOperadora.php" enctype="multipart/form-data" method="post">
		<table border="1" bgcolor="#ffffff">
		<tr>
		<td>Ingrese Archivo Base Operadora (.csv)</td>
   <td><input id="archivo" accept=".csv" name="archivo" type="file" /></td>
 	</tr>
   <input name="MAX_FILE_SIZE" type="hidden" value="20000" />
 	</table>
	 <br>
	 <table>
	<tr>
   <td><input name="enviar" type="submit" value="Actualizar Base" /></td>
 	</tr>
 	</table>
	</form>
	<br>
	<form action="../VistaBaseOperadora.php">
	 <input type="submit" value="Ver Base Operadora" />
 	</form>
	</center>

	<pre align="left">
		<br>
		<b>Detalle de Archivos: </b>
		<br>

				<b>Archivo Acreedor SAP:</b>

						1) Ingrese a SAP con su usuario y contraseña.
						2) Ingresar a la opcion FBL3N.
						3) Copie los Id Acreedor del siguiente <a href="MostrarIdAcreedor.php">Enlace</a>
						4) En Seleccion Acreedor: Ingrese los Id Acreedor copiados en el punto anterior a consultar Acreedor.
						5) En Seleccion Acreedor: Ingrese Sociedad 0077 (Telefónica Chile) y 0404 (Telefónica Móvil).
						6) En Partidas Abiertas: Seleccionar Histórico Partidas Abiertas.
						7) Seleccionar Layout \_P_MAYORISTA
						8) Exporte los datos en una hoja de calculo (Lista/Exportar/Fichero local).
						9) Convierta el formato del archivo en .csv <a href="https://support.office.com/es-es/article/importar-o-exportar-archivos-de-texto-txt-o-csv-5250ac4c-663c-47ce-937b-339e391393ba">(Ayuda)</a>
						10) Asegurese que la columna 'Texto' no posea el carácter ';' (punto y coma).

				<b>Base Operadora:</b>

						1) Archivo excel que contiene datos de Cartera Mayorista.
						2) Se recomienda revisar la base antes de generar el informe.
						3) Se recomienda eliminar las tildes o en su defecto codificar el archivo CSV en UTF-8 <a href="https://www.ibm.com/support/knowledgecenter/es/SSWU4L/WebLanding/imc_WebLanding/Saving_a_CSV_file_with_UTF-8_encoding.html">(Ayuda)</a>
	</pre>
</body>
</html>
