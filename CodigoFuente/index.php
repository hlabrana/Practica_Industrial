<!DOCTYPE html>
<html>
<head>
	<title>Informe Cierre Morosidad</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>
<body background="imagenes/fondo.png">
	<br>
	<nav class="menu">
		<ul>
			<li><a href="http://www.telefonicachile.cl"><img src="imagenes/logo_telefonica.png" alt=""></a></li>
		  	<li><a style="color: rgb(12, 189, 35)" href="#">Informe Cierre de Morosidad</a></li>
		  	<li><a href="COSTO/index.php">Informe De Costos</a></li>
			<li><a href="EMAIL/index.php">Generador Email</a></li>
			<li><a href="../ESTADISTICAS/index.php">Estadísticas</a></li>
		</ul>
	</nav>

	<center>
	<h2 style="color:#ffffff">Generador Informe Morosidad Mayorista</h2>
	<form action="LeerArchivos.php" enctype="multipart/form-data" method="post">
		<table border="1" bgcolor="#ffffff">
		<tr>
		<td>Ingrese Archivo Repositorio Mayorista (.csv)</td>
   <td><input id="archivo" accept=".csv" name="archivo" type="file" /></td>
 		</tr>
		<tr>
	 <td>Ingrese Archivo SAP (.csv)</td>
	<td><input id="archivo2" accept=".csv" name="archivo2" type="file" /></td>
	 <br>
 		</tr>
		<tr>
		<td>Ingrese Repositorio SCL (.csv)</td>
	 <td><input id="archivo" accept=".csv" name="archivoSCL" type="file" /></td>
		</tr>
		<tr>
	 <td>Ingrese Detalle Glosa informe anterior (.csv)</td>
	<td><input id="archivo3" accept=".csv" name="archivo3" type="file" /></td>
   <input name="MAX_FILE_SIZE" type="hidden" value="20000" />
	 <br>
 		</tr>
		<tr>
			<td>Ingrese Fecha de Cierre (dd-mm-YYYY)</td>
			<td> <input type="text" name="datecierre"> </td>
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
	<form action="UpdateBaseOperadora.php" enctype="multipart/form-data" method="post">
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
	<form action="VistaBaseOperadora.php">
	 <input type="submit" value="Ver Base Operadora" />
 	</form>
	</center>

	<pre align="left">

		<b>Detalle de Archivos: </b>
		<br>
				<b>Repositorio Mayorista:</b>

						1) Archivo Excel ubicado en carpeta compartida con ruta. <a href="file://recupero-01/MAYORISTAS">\\recupero-01\MAYORISTAS</a>
						2) Escoger el archivo Rep_Mayorista con la fecha mas actual posible.
						3) Compruebe el formato del archivo en .csv <a href="https://support.office.com/es-es/article/importar-o-exportar-archivos-de-texto-txt-o-csv-5250ac4c-663c-47ce-937b-339e391393ba">(Ayuda)</a>

				<b>Archivo SAP:</b>

						1) Ingrese a SAP con su usuario y contraseña.
						2) Ingresar a la opcion FBL5N.
						3) Copie los IdSAP del siguiente <a href="MostrarIdSAP.php">Enlace</a>
						4) En Seleccion Deudor: Ingrese los IdSAP copiados en el punto anterior a consultar deudor.
						5) En Seleccion Deudor: Ingrese Sociedad 0077 (Telefónica Chile) y 0404 (Telefónica Móvil).
						6) En Partidas Abiertas: Ingresar fecha o rango de fechas de consulta.
						7) Marcar la opción Operaciones CME
						8) Seleccionar Layout \       PIPE
						9) Exporte los datos en una hoja de calculo (Lista/Exportar/Fichero local)
						10) Convierta el formato del archivo en .csv <a href="https://support.office.com/es-es/article/importar-o-exportar-archivos-de-texto-txt-o-csv-5250ac4c-663c-47ce-937b-339e391393ba">(Ayuda)</a>
						11) Asegurese que la columna 'Texto' no posea el carácter ';' (punto y coma).


				<b>Repositorio SCL:</b>

						1) Archivo Excel ubicado en carpeta compartida en Ruta recupero.
						2) Escoger el archivo SCL con la fecha mas actual posible.
						3) Compruebe el formato del archivo en .csv <a href="https://support.office.com/es-es/article/importar-o-exportar-archivos-de-texto-txt-o-csv-5250ac4c-663c-47ce-937b-339e391393ba">(Ayuda)</a>


				<b>Base Operadora:</b>

						1) Archivo excel que contiene datos de Cartera Mayorista.
						2) Se recomienda revisar la base antes de generar el informe.
						3) Se recomienda eliminar las tildes o en su defecto codificar el archivo CSV en UTF-8 <a href="https://www.ibm.com/support/knowledgecenter/es/SSWU4L/WebLanding/imc_WebLanding/Saving_a_CSV_file_with_UTF-8_encoding.html">(Ayuda)</a>

	</pre>
</body>
</html>
