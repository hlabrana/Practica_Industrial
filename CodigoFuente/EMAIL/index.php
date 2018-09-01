<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Generador Email Morosidad</title>
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
	<link rel="StyleSheet" href="../css/EstilosTablasEMAIL.css" type="text/css">
</head>
<body background="../imagenes/fondo.png">
	<br>
	<br>
	<nav class="menu">
		<ul>
			<li><a href="http://www.telefonicachile.cl"><img src="../imagenes/logo_telefonica.png" alt=""></a></li>
			<li><a href="../index.php">Informe Cierre de Morosidad</a></li>
			<li><a href="../COSTO/index.php">Informe De Costos</a></li>
			<li><a style="color: rgb(12, 189, 35)" href="#">Generador Email</a></li>
			<li><a href="../ESTADISTICAS/index.php">Estadísticas</a></li>
		</ul>
	</nav>

	<center>
			<h2 style="color:#fff;font: 24px/1.4 Times, Serif;font-weight: bold;">Generador Email Clientes Mayoristas Morosos</h2>

	<?php
	//Conexion Base de datos
	$conexion = mysqli_connect('localhost', 'root', 'hector123','Morosidad')
	    or die('No se pudo conectar: ' . mysqli_error());
	mysqli_set_charset($conexion,'utf8');

	$query = "SELECT nom_cliente FROM OUTPUT GROUP BY rut_cliente ORDER BY nom_cliente ASC";
	$resultado = mysqli_query($conexion,$query);
	//Comprobar posibles errores
	if(mysqli_error($conexion)){
	echo mysqli_error($conexion)."<br>";
 	}
	?>

	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
	<p style="color: #fff">Seleccione Nombre Mayorista:&nbsp;
	<select name = "NombreMayorista">
		<?php
			while($row = mysqli_fetch_array($resultado)){
				echo "<option value='".$row['nom_cliente']."'>";
				echo $row['nom_cliente'];
				echo "</option>";
			}
		?>
		</p>
	</select>
	<br> <br>
	<input type="submit" name="enviar" value="Consultar Deuda">
	</form>

	<?php
	if ($_POST){
		$NombreCLiente = $_POST['NombreMayorista'];

		$query = "CREATE OR REPLACE TABLE EMAIL(
			Sociedad VARCHAR(255),
			nom_cliente VARCHAR(255),
			importe BIGINT,
			analista VARCHAR(255),
			tramo VARCHAR(255),
			Servicio VARCHAR(255)
		)";
		$resultado = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}

		//Insertar registros en EMAIL por tramo y agrupados por Servicio
		$query = "INSERT INTO EMAIL (SELECT Sociedad,nom_cliente,SUM(importe) AS importe,analista,tramo,Servicio FROM OUTPUT WHERE tramo='Vigente' AND nom_cliente='$NombreCLiente' GROUP BY Servicio)";
		$resultado = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
		}
		$query = "INSERT INTO EMAIL (SELECT Sociedad,nom_cliente,SUM(importe) AS importe,analista,tramo,Servicio FROM OUTPUT WHERE tramo='1-30 dias' AND nom_cliente='$NombreCLiente' GROUP BY Servicio)";
		$resultado = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}
		$query = "INSERT INTO EMAIL (SELECT Sociedad,nom_cliente,SUM(importe) AS importe,analista,tramo,Servicio FROM OUTPUT WHERE tramo='31-60 dias' AND nom_cliente='$NombreCLiente' GROUP BY Servicio)";
		$resultado = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}
		$query = "INSERT INTO EMAIL (SELECT Sociedad,nom_cliente,SUM(importe) AS importe,analista,tramo,Servicio FROM OUTPUT WHERE tramo='61-90 dias' AND nom_cliente='$NombreCLiente' GROUP BY Servicio)";
		$resultado = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}
		$query = "INSERT INTO EMAIL (SELECT Sociedad,nom_cliente,SUM(importe) AS importe,analista,tramo,Servicio FROM OUTPUT WHERE tramo='91-120 dias' AND nom_cliente='$NombreCLiente' GROUP BY Servicio)";
		$resultado = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}
		$query = "INSERT INTO EMAIL (SELECT Sociedad,nom_cliente,SUM(importe) AS importe,analista,tramo,Servicio FROM OUTPUT WHERE tramo='121-150 dias' AND nom_cliente='$NombreCLiente' GROUP BY Servicio)";
		$resultado = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}
		$query = "INSERT INTO EMAIL (SELECT Sociedad,nom_cliente,SUM(importe) AS importe,analista,tramo,Servicio FROM OUTPUT WHERE tramo='151-180 dias' AND nom_cliente='$NombreCLiente' GROUP BY Servicio)";
		$resultado = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}
		$query = "INSERT INTO EMAIL (SELECT Sociedad,nom_cliente,SUM(importe) AS importe,analista,tramo,Servicio FROM OUTPUT WHERE tramo='181-365 dias' AND nom_cliente='$NombreCLiente' GROUP BY Servicio)";
		$resultado = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}
		$query = "INSERT INTO EMAIL (SELECT Sociedad,nom_cliente,SUM(importe) AS importe,analista,tramo,Servicio FROM OUTPUT WHERE tramo='1-3 años' AND nom_cliente='$NombreCLiente' GROUP BY Servicio)";
		$resultado = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}
		$query = "INSERT INTO EMAIL (SELECT Sociedad,nom_cliente,SUM(importe) AS importe,analista,tramo,Servicio FROM OUTPUT WHERE tramo='3-5 años' AND nom_cliente='$NombreCLiente' GROUP BY Servicio)";
		$resultado = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}
		$query = "INSERT INTO EMAIL (SELECT Sociedad,nom_cliente,SUM(importe) AS importe,analista,tramo,Servicio FROM OUTPUT WHERE tramo='mas de 5 años' AND nom_cliente='$NombreCLiente' GROUP BY Servicio)";
		$resultado = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}

		//Crear Formato tabla de salida
		$query = "CREATE OR REPLACE TABLE EMAIL_OUT(
							Servicio VARCHAR(255)
		)";
		$resultado = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}

		//INSERTAR Servicio agrupados
		$query="INSERT INTO EMAIL_OUT (SELECT Servicio FROM EMAIL GROUP BY Servicio)";
		$resultado = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}

		//Agregar las nuevas columnas a EMAIL_OUT
		$query="ALTER TABLE EMAIL_OUT ADD vigente BIGINT DEFAULT '0',ADD treinta BIGINT DEFAULT '0',ADD sesenta BIGINT DEFAULT '0',ADD noventa BIGINT DEFAULT '0',ADD cienveinte BIGINT DEFAULT '0',ADD ciencincuenta BIGINT DEFAULT '0',ADD cienochenta BIGINT DEFAULT '0',
								ADD treseiscinco BIGINT DEFAULT '0',ADD tresanios BIGINT DEFAULT '0',ADD cincoanios BIGINT DEFAULT '0',ADD mascinco BIGINT DEFAULT '0'";
		$resultado = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}

		//INSERTAR REGISTROS EN RESPECTIVO ORDEN
		$query = "UPDATE EMAIL_OUT INNER JOIN EMAIL ON EMAIL_OUT.Servicio=EMAIL.Servicio SET EMAIL_OUT.vigente=EMAIL.importe WHERE EMAIL.tramo='Vigente'";
		$result = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
		}
		$query = "UPDATE EMAIL_OUT INNER JOIN EMAIL ON EMAIL_OUT.Servicio=EMAIL.Servicio SET EMAIL_OUT.treinta=EMAIL.importe WHERE EMAIL.tramo='1-30 dias'";
		$result = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}
		$query = "UPDATE EMAIL_OUT INNER JOIN EMAIL ON EMAIL_OUT.Servicio=EMAIL.Servicio SET EMAIL_OUT.sesenta=EMAIL.importe WHERE EMAIL.tramo='31-60 dias'";
		$result = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}
		$query = "UPDATE EMAIL_OUT INNER JOIN EMAIL ON EMAIL_OUT.Servicio=EMAIL.Servicio SET EMAIL_OUT.noventa=EMAIL.importe WHERE EMAIL.tramo='61-90 dias'";
		$result = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}
		$query = "UPDATE EMAIL_OUT INNER JOIN EMAIL ON EMAIL_OUT.Servicio=EMAIL.Servicio SET EMAIL_OUT.cienveinte=EMAIL.importe WHERE EMAIL.tramo='91-120 dias'";
		$result = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}
		$query = "UPDATE EMAIL_OUT INNER JOIN EMAIL ON EMAIL_OUT.Servicio=EMAIL.Servicio SET EMAIL_OUT.ciencincuenta=EMAIL.importe WHERE EMAIL.tramo='121-150 dias'";
		$result = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}
		$query = "UPDATE EMAIL_OUT INNER JOIN EMAIL ON EMAIL_OUT.Servicio=EMAIL.Servicio SET EMAIL_OUT.cienochenta=EMAIL.importe WHERE EMAIL.tramo='151-180 dias'";
		$result = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}
		$query = "UPDATE EMAIL_OUT INNER JOIN EMAIL ON EMAIL_OUT.Servicio=EMAIL.Servicio SET EMAIL_OUT.treseiscinco=EMAIL.importe WHERE EMAIL.tramo='181-365 dias'";
		$result = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}
		$query = "UPDATE EMAIL_OUT INNER JOIN EMAIL ON EMAIL_OUT.Servicio=EMAIL.Servicio SET EMAIL_OUT.tresanios=EMAIL.importe WHERE EMAIL.tramo='1-3 años'";
		$result = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}
		$query = "UPDATE EMAIL_OUT INNER JOIN EMAIL ON EMAIL_OUT.Servicio=EMAIL.Servicio SET EMAIL_OUT.cincoanios=EMAIL.importe WHERE EMAIL.tramo='3-5 años'";
		$result = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}
		$query = "UPDATE EMAIL_OUT INNER JOIN EMAIL ON EMAIL_OUT.Servicio=EMAIL.Servicio SET EMAIL_OUT.mascinco=EMAIL.importe WHERE EMAIL.tramo='mas de 5 años'";
		$result = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}

		//AGREGAR FILAS Y COLUMNAS TOTALES
		$query = "INSERT INTO EMAIL_OUT (Servicio) VALUES ('Total General')";
		$result = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}
		$query = "UPDATE EMAIL_OUT SET vigente=(SELECT SUM(vigente) FROM (SELECT * FROM EMAIL_OUT) AS UNO) WHERE Servicio='Total General'";
		$result = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
		}
		$query = "UPDATE EMAIL_OUT SET treinta=(SELECT SUM(treinta) FROM (SELECT * FROM EMAIL_OUT) AS UNO) WHERE Servicio='Total General'";
		$result = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}
		$query = "UPDATE EMAIL_OUT SET sesenta=(SELECT SUM(sesenta) FROM (SELECT * FROM EMAIL_OUT) AS UNO) WHERE Servicio='Total General'";
		$result = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}
		$query = "UPDATE EMAIL_OUT SET noventa=(SELECT SUM(noventa) FROM (SELECT * FROM EMAIL_OUT) AS UNO) WHERE Servicio='Total General'";
		$result = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}
		$query = "UPDATE EMAIL_OUT SET cienveinte=(SELECT SUM(cienveinte) FROM (SELECT * FROM EMAIL_OUT) AS UNO) WHERE Servicio='Total General'";
		$result = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}
		$query = "UPDATE EMAIL_OUT SET ciencincuenta=(SELECT SUM(ciencincuenta) FROM (SELECT * FROM EMAIL_OUT) AS UNO) WHERE Servicio='Total General'";
		$result = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}
		$query = "UPDATE EMAIL_OUT SET cienochenta=(SELECT SUM(cienochenta) FROM (SELECT * FROM EMAIL_OUT) AS UNO) WHERE Servicio='Total General'";
		$result = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}
		$query = "UPDATE EMAIL_OUT SET treseiscinco=(SELECT SUM(treseiscinco) FROM (SELECT * FROM EMAIL_OUT) AS UNO) WHERE Servicio='Total General'";
		$result = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}
		$query = "UPDATE EMAIL_OUT SET tresanios=(SELECT SUM(tresanios) FROM (SELECT * FROM EMAIL_OUT) AS UNO) WHERE Servicio='Total General'";
		$result = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}
		$query = "UPDATE EMAIL_OUT SET cincoanios=(SELECT SUM(cincoanios) FROM (SELECT * FROM EMAIL_OUT) AS UNO) WHERE Servicio='Total General'";
		$result = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}
		$query = "UPDATE EMAIL_OUT SET mascinco=(SELECT SUM(mascinco) FROM (SELECT * FROM EMAIL_OUT) AS UNO) WHERE Servicio='Total General'";
		$result = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}

		//TOTAL GENERAL POR SERVICIOS
		$query = "ALTER TABLE EMAIL_OUT ADD TOTAL BIGINT";
		$result = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}

		$query = "UPDATE EMAIL_OUT SET TOTAL=vigente+treinta+sesenta+noventa+cienveinte+ciencincuenta+cienochenta+treseiscinco+tresanios+cincoanios+mascinco";
		$result = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}


		//OBTENER DATOS NECESARIOS PARA LA CONSTRUCCION DEL EMAIL
		$query = "SELECT * FROM BaseOperadora WHERE Nombre='$NombreCLiente'";
		$result = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}
		$row = mysqli_fetch_array($result);
		$analista = $row['NuevoAnalista'];

		$query = "SELECT fecha FROM FECHACIERRE";
		$result = mysqli_query($conexion,$query);
		//Comprobar posibles errores
		if(mysqli_error($conexion)){
		echo mysqli_error($conexion)."<br>";
	 	}
		$row = mysqli_fetch_array($result);
		$fec_cierre = $row['fecha'];

		$sociedad = SET_SOCIEDAD($conexion);
		//TABLA DATOS GENERALES
		echo "<table>";
		echo "<tr>";
		echo "<td><b>Nombre Cliente</b></td>";
		echo "<td>".$NombreCLiente."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td><b>Analista</b></td>";
		echo "<td>".$analista."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td><b>Sociedad</b></td>";
		echo "<td>".$sociedad."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td><b>Fecha Cierre</b></td>";
		echo "<td>".$fec_cierre."</td>";
		echo "</tr>";
		echo "</table>";

		echo "<br><br>";


		//TABLA EMAIL_OUT
		$result = mysqli_query($conexion,"SELECT * FROM EMAIL_OUT");
    if(mysqli_error($conexion)){
    echo mysqli_error($conexion)."<br>";
    }
    //se despliega el resultado
    echo "<table>";
    echo "<tr>";
    echo "<th>Servicio</th>";
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
    echo "<th>Total</th>";
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
        echo "<td>".number_format($row[12],0,',','.')."</td>";
        echo "</tr>";
    }
    echo "</table>";

	}
?>
</center>
<?php
function SET_SOCIEDAD($conexion){
	$society='';
	$query = "SELECT Sociedad FROM EMAIL WHERE Sociedad='TMOVIL'";
	$result = mysqli_query($conexion,$query);
	//Comprobar posibles errores
	if(mysqli_error($conexion)){
	echo mysqli_error($conexion)."<br>";
	}

	if(mysqli_num_rows($result)>0){
		$society.= "TMOVIL ";
	}

	$query = "SELECT Sociedad FROM EMAIL WHERE Sociedad='TCHILE'";
	$result = mysqli_query($conexion,$query);
	//Comprobar posibles errores
	if(mysqli_error($conexion)){
	echo mysqli_error($conexion)."<br>";
	}

	if(mysqli_num_rows($result)>0){
		$society.= "TCHILE ";
	}

	$query = "SELECT Sociedad FROM EMAIL WHERE Sociedad='TEMP'";
	$result = mysqli_query($conexion,$query);
	//Comprobar posibles errores
	if(mysqli_error($conexion)){
	echo mysqli_error($conexion)."<br>";
	}

	if(mysqli_num_rows($result)>0){
		$society.= "TEMP ";
	}

	return $society;
}
 ?>
</body>
</html>
