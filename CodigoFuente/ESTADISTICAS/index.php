<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Estadísticas</title>
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
	<link rel="stylesheet" type="text/css" href="../css/EstilosTablasEMAIL.css">
</head>
<body background="../imagenes/fondo.png">
	<br>
	<br>
	<nav class="menu">
		<ul>
			<li><a href="http://www.telefonicachile.cl"><img src="../imagenes/logo_telefonica.png" alt=""></a></li>
			<li><a href="../index.php">Informe Cierre de Morosidad</a></li>
			<li><a href="../COSTO/index.php">Informe De Costos</a></li>
			<li><a href="../EMAIL/index.php">Generador Email</a></li>
			<li><a style="color: rgb(12, 189, 35)" href="#">Estadísticas</a></li>
		</ul>
	</nav>

	<center>
			<h2 style="color:#fff;font: 24px/1.4 Times, Serif;font-weight: bold;">Estadísticas Informe Morosidad & Costo</h2>

	<?php
	//Conexion Base de datos
	$conexion = mysqli_connect('localhost', 'root', 'hector123','Morosidad')
	    or die('No se pudo conectar: ' . mysqli_error());
	mysqli_set_charset($conexion,'utf8');
	?>

	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
	<p style="color: #fff">Seleccione Tipo de Gráfica:&nbsp;
	<select name = "tipografica">
		<option value="0">Clientes Morosos</option>
		<option value="5">Mora Acreedor</option>
		<option value="1">Morosidad por Sociedad</option>
		<option value="2">Deudor Con Mora >$100M</option>
		<option value="3">Deudor Con Mora [$10M,$100M]</option>
		<option value="4">Deudor Con Mora <$10M</option>
	</p>
	</select>
	<br> <br>
	<input type="submit" name="enviar" value="Ver Gráfica">
	</form>

	<?php
	if ($_POST){
		$TipoGrafica = $_POST['tipografica'];

		//MOSTRAR FECHAS DE CIERRE EN LAS GRAFICAS
		//Se realiza la consulta SQL
        $query = "SELECT fecha FROM FECHACIERRE";
        $result = mysqli_query($conexion,$query);
        //Comprobar posibles errores
        if(mysqli_error($conexion)){
        echo mysqli_error($conexion)."<br>";
        }
        $query = "SELECT fecha FROM FECHACOSTO";
        $result2 = mysqli_query($conexion,$query);
        //Comprobar posibles errores
        if(mysqli_error($conexion)){
        echo mysqli_error($conexion)."<br>";
        }
        $datacierre = mysqli_fetch_array($result);
        $datacosto = mysqli_fetch_array($result2);

        echo "<table>";
        echo "<th>Tipo de Informe</th>";
        echo "<th>Fecha de Cierre</th>";
        echo "<tr><td><b>Morosidad (Datos Deudor)</b></td><td>".$datacierre['fecha']."</td></tr>";
        echo "<tr><td><b>Costo (Datos Acreedor)</b></td><td>".$datacosto['fecha']."</td></tr>";
        echo "</table>";

		if($TipoGrafica=="0"){
			?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Morosos</title>

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <style type="text/css">
${demo.css}
        </style>
        <script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Clientes Morosos'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: [

            <?php
            //Se realiza la consulta SQL
            $query = "SELECT * FROM (SELECT Grupo,IFNULL(treinta,0)+IFNULL(sesenta,0)+IFNULL(noventa,0)+IFNULL(cienveinte,0)+IFNULL(ciencincuenta,0)+IFNULL(cienochenta,0)+IFNULL(treseiscinco,0)+IFNULL(tresanios,0)+IFNULL(cincoanios,0)+IFNULL(mascinco,0) AS SumaDeuda FROM VISTA_TABLA_DINAMICA WHERE Grupo!='Total General' ORDER BY SumaDeuda DESC) AS morosos WHERE morosos.SumaDeuda>0 ORDER BY morosos.SumaDeuda DESC";
            $result = mysqli_query($conexion,$query);
            //Comprobar posibles errores
            if(mysqli_error($conexion)){
            echo mysqli_error($conexion)."<br>";
            }

            while($row = mysqli_fetch_array($result)){
            ?>        
            ['<?php echo $row['Grupo'];?>',<?php echo $row['SumaDeuda'];?>],

            <?php
            }
            ?>
            ]
        }]
    });
});
        </script>
    </head>
    <body>

<script src="API/js/highcharts.js"></script>
<script src="API/js/highcharts-3d.js"></script>
<script src="API/js/modules/exporting.js"></script>

<div id="container" style="height: 400px"></div>
    </body>
</html>

		<?php
	    //Se realiza la consulta SQL
            $query = "SELECT * FROM (SELECT Grupo,IFNULL(treinta,0)+IFNULL(sesenta,0)+IFNULL(noventa,0)+IFNULL(cienveinte,0)+IFNULL(ciencincuenta,0)+IFNULL(cienochenta,0)+IFNULL(treseiscinco,0)+IFNULL(tresanios,0)+IFNULL(cincoanios,0)+IFNULL(mascinco,0) AS SumaDeuda FROM VISTA_TABLA_DINAMICA WHERE Grupo!='Total General' ORDER BY SumaDeuda DESC) AS morosos WHERE morosos.SumaDeuda>0 ORDER BY morosos.SumaDeuda DESC";
	    $result = mysqli_query($conexion,$query);
	    //Comprobar posibles errores
	    if(mysqli_error($conexion)){
	    echo mysqli_error($conexion)."<br>";
	    }

	    echo "<table>";
	    echo "<th>Grupo</th>";
	    echo "<th>Monto Mora</th>";
	    while($row = mysqli_fetch_array($result)){
	    	echo "<tr>";
	    	echo "<td>".$row['Grupo']."</td>";
	    	echo "<td>".number_format($row['SumaDeuda'],0,',','.')."</td>";
	    	echo "</tr>";
	    }
	    echo "</table>";

		}

//TERMINO GRAFICA CERO

		if($TipoGrafica=="1"){
		?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Morosos por Sociedad</title>

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <style type="text/css">
${demo.css}
        </style>
        <script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Morosidad por Sociedad'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: [

            <?php
            //Se realiza la consulta SQL
            $query = "SELECT Sociedad,SUM(importe) as importe FROM OUTPUT WHERE tramo!='Vigente' GROUP BY Sociedad ORDER BY importe DESC";
            $result = mysqli_query($conexion,$query);
            //Comprobar posibles errores
            if(mysqli_error($conexion)){
            echo mysqli_error($conexion)."<br>";
            }

            while($row = mysqli_fetch_array($result)){
            ?>        
            ['<?php echo $row['Sociedad'];?>',<?php echo $row['importe'];?>],

            <?php
            }
            ?>
            ]
        }]
    });
});
        </script>
    </head>
    <body>

<script src="API/js/highcharts.js"></script>
<script src="API/js/highcharts-3d.js"></script>
<script src="API/js/modules/exporting.js"></script>

<div id="container" style="height: 400px"></div>
    </body>
</html>

		<?php
	    //Se realiza la consulta SQL
	    $query = "SELECT Sociedad,SUM(importe) as importe FROM OUTPUT WHERE tramo!='Vigente' GROUP BY Sociedad ORDER BY importe DESC";
	    $result = mysqli_query($conexion,$query);
	    //Comprobar posibles errores
	    if(mysqli_error($conexion)){
	    echo mysqli_error($conexion)."<br>";
	    }

	    echo "<table>";
	    echo "<th>Sociedad</th>";
	    echo "<th>Monto Mora</th>";
	    while($row = mysqli_fetch_array($result)){
	    	echo "<tr>";
	    	echo "<td>".$row['Sociedad']."</td>";
	    	echo "<td>".number_format($row['importe'],0,',','.')."</td>";
	    	echo "</tr>";
	    }
	    echo "</table>";

		}

//TERMINO GRAFICA UNO

		if($TipoGrafica=="2"){
		?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Deudor vs Acreedor</title>

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <style type="text/css">
${demo.css}
        </style>
        <script type="text/javascript">
$(function () {
    $('#container').highcharts({
        data: {
            table: 'datatable'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'Deudor con Mora mayor a $100.000.000'
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Importe [$CLP]'
            }
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.series.name + '</b><br/>' +
                    this.point.y + ' ' + this.point.name.toLowerCase();
            }
        }
    });
});
        </script>
    </head>
    <body>
<script src="API/js/highcharts.js"></script>
<script src="API/js/modules/data.js"></script>
<script src="API/js/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<table id="datatable" style="display: none;">
    <thead>
        <tr>
            <th>Servicio</th>
            <th>Deudor</th>
            <th>Acreedor</th>
        </tr>
    </thead>
    <tbody>

        <?php
        //Se realiza la consulta SQL
        $query = "SELECT * FROM
	(SELECT uno.Grupo,IFNULL(uno.treinta,0)+IFNULL(uno.sesenta,0)+IFNULL(uno.noventa,0)+IFNULL(uno.cienveinte,0)+IFNULL(uno.ciencincuenta,0)+IFNULL(uno.cienochenta,0)+IFNULL(uno.treseiscinco,0)+IFNULL(uno.tresanios,0)+IFNULL(uno.cincoanios,0)+IFNULL(uno.mascinco,0) AS deudor,IFNULL(dos.treinta,0)+IFNULL(dos.sesenta,0)+IFNULL(dos.noventa,0)+IFNULL(dos.cienveinte,0)+IFNULL(dos.ciencincuenta,0)+IFNULL(dos.cienochenta,0)+IFNULL(dos.treseiscinco,0)+IFNULL(dos.tresanios,0)+IFNULL(dos.cincoanios,0)+IFNULL(dos.mascinco,0) AS acreedor FROM VISTA_TABLA_DINAMICA AS uno JOIN VISTA_RESUMEN_COSTO AS dos ON uno.Grupo=dos.Grupo WHERE uno.Grupo!='Total General') AS a WHERE a.deudor>100000000 ORDER BY a.deudor DESC";
        $result = mysqli_query($conexion,$query);
        //Comprobar posibles errores
        if(mysqli_error($conexion)){
        echo mysqli_error($conexion)."<br>";
        }

        while($row = mysqli_fetch_array($result)){
        	echo "<tr>";
        	echo "<td>".$row['Grupo']."</td>";
        	echo "<td>".$row['deudor']."</td>";
        	echo "<td>".($row['acreedor']*-1)."</td>";
        	echo "</tr>";
        }
        ?>
    </tbody>
</table>
        <?php
        //Se realiza la consulta SQL
        $query = "SELECT * FROM
	(SELECT uno.Grupo,IFNULL(uno.treinta,0)+IFNULL(uno.sesenta,0)+IFNULL(uno.noventa,0)+IFNULL(uno.cienveinte,0)+IFNULL(uno.ciencincuenta,0)+IFNULL(uno.cienochenta,0)+IFNULL(uno.treseiscinco,0)+IFNULL(uno.tresanios,0)+IFNULL(uno.cincoanios,0)+IFNULL(uno.mascinco,0) AS deudor,IFNULL(dos.treinta,0)+IFNULL(dos.sesenta,0)+IFNULL(dos.noventa,0)+IFNULL(dos.cienveinte,0)+IFNULL(dos.ciencincuenta,0)+IFNULL(dos.cienochenta,0)+IFNULL(dos.treseiscinco,0)+IFNULL(dos.tresanios,0)+IFNULL(dos.cincoanios,0)+IFNULL(dos.mascinco,0) AS acreedor FROM VISTA_TABLA_DINAMICA AS uno JOIN VISTA_RESUMEN_COSTO AS dos ON uno.Grupo=dos.Grupo WHERE uno.Grupo!='Total General') AS a WHERE a.deudor>100000000 ORDER BY a.deudor DESC";
        $result = mysqli_query($conexion,$query);
        //Comprobar posibles errores
        if(mysqli_error($conexion)){
        echo mysqli_error($conexion)."<br>";
        }
        echo "<table>
        <thead>
        <tr>
            <th>Servicio</th>
            <th>Deudor</th>
            <th>Acreedor</th>
        </tr>
    	</thead>
    	<tbody>";
        while($row = mysqli_fetch_array($result)){
        	echo "<tr>";
        	echo "<td>".$row['Grupo']."</td>";
        	echo "<td>".number_format($row['deudor'],0,',','.')."</td>";
        	echo "<td>".number_format(($row['acreedor']*-1),0,',','.')."</td>";
        	echo "</tr>";
        }
        echo "</tbody></table>";
        ?>
    </body>
</html>			
		<?php
		}

//TERMINO GRAFICA DOS

		if($TipoGrafica=="3"){
		?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Deudor vs Acreedor</title>

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <style type="text/css">
${demo.css}
        </style>
        <script type="text/javascript">
$(function () {
    $('#container').highcharts({
        data: {
            table: 'datatable'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'Deudor con Mora entre $10.000.000 & $100.000.000'
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Importe [$CLP]'
            }
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.series.name + '</b><br/>' +
                    this.point.y + ' ' + this.point.name.toLowerCase();
            }
        }
    });
});
        </script>
    </head>
    <body>
<script src="API/js/highcharts.js"></script>
<script src="API/js/modules/data.js"></script>
<script src="API/js/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<table id="datatable" style="display: none;">
    <thead>
        <tr>
            <th>Servicio</th>
            <th>Deudor</th>
            <th>Acreedor</th>
        </tr>
    </thead>
    <tbody>

        <?php
        //Se realiza la consulta SQL
        $query = "SELECT * FROM
	(SELECT uno.Grupo,IFNULL(uno.treinta,0)+IFNULL(uno.sesenta,0)+IFNULL(uno.noventa,0)+IFNULL(uno.cienveinte,0)+IFNULL(uno.ciencincuenta,0)+IFNULL(uno.cienochenta,0)+IFNULL(uno.treseiscinco,0)+IFNULL(uno.tresanios,0)+IFNULL(uno.cincoanios,0)+IFNULL(uno.mascinco,0) AS deudor,IFNULL(dos.treinta,0)+IFNULL(dos.sesenta,0)+IFNULL(dos.noventa,0)+IFNULL(dos.cienveinte,0)+IFNULL(dos.ciencincuenta,0)+IFNULL(dos.cienochenta,0)+IFNULL(dos.treseiscinco,0)+IFNULL(dos.tresanios,0)+IFNULL(dos.cincoanios,0)+IFNULL(dos.mascinco,0) AS acreedor FROM VISTA_TABLA_DINAMICA AS uno JOIN VISTA_RESUMEN_COSTO AS dos ON uno.Grupo=dos.Grupo WHERE uno.Grupo!='Total General') AS a WHERE a.deudor>=10000000 AND a.deudor <=100000000 ORDER BY a.deudor DESC";
        $result = mysqli_query($conexion,$query);
        //Comprobar posibles errores
        if(mysqli_error($conexion)){
        echo mysqli_error($conexion)."<br>";
        }

        while($row = mysqli_fetch_array($result)){
        	echo "<tr>";
        	echo "<td>".$row['Grupo']."</td>";
        	echo "<td>".$row['deudor']."</td>";
        	echo "<td>".($row['acreedor']*-1)."</td>";
        	echo "</tr>";
        }
        ?>
    </tbody>
</table>
        <?php
        //Se realiza la consulta SQL
        $query = "SELECT * FROM
	(SELECT uno.Grupo,IFNULL(uno.treinta,0)+IFNULL(uno.sesenta,0)+IFNULL(uno.noventa,0)+IFNULL(uno.cienveinte,0)+IFNULL(uno.ciencincuenta,0)+IFNULL(uno.cienochenta,0)+IFNULL(uno.treseiscinco,0)+IFNULL(uno.tresanios,0)+IFNULL(uno.cincoanios,0)+IFNULL(uno.mascinco,0) AS deudor,IFNULL(dos.treinta,0)+IFNULL(dos.sesenta,0)+IFNULL(dos.noventa,0)+IFNULL(dos.cienveinte,0)+IFNULL(dos.ciencincuenta,0)+IFNULL(dos.cienochenta,0)+IFNULL(dos.treseiscinco,0)+IFNULL(dos.tresanios,0)+IFNULL(dos.cincoanios,0)+IFNULL(dos.mascinco,0) AS acreedor FROM VISTA_TABLA_DINAMICA AS uno JOIN VISTA_RESUMEN_COSTO AS dos ON uno.Grupo=dos.Grupo WHERE uno.Grupo!='Total General') AS a WHERE a.deudor>=10000000 AND a.deudor <=100000000 ORDER BY a.deudor DESC";
        $result = mysqli_query($conexion,$query);
        //Comprobar posibles errores
        if(mysqli_error($conexion)){
        echo mysqli_error($conexion)."<br>";
        }
        echo "<table>
        <thead>
        <tr>
            <th>Servicio</th>
            <th>Deudor</th>
            <th>Acreedor</th>
        </tr>
    	</thead>
    	<tbody>";
        while($row = mysqli_fetch_array($result)){
        	echo "<tr>";
        	echo "<td>".$row['Grupo']."</td>";
        	echo "<td>".number_format($row['deudor'],0,',','.')."</td>";
        	echo "<td>".number_format(($row['acreedor']*-1),0,',','.')."</td>";
        	echo "</tr>";
        }
        echo "</tbody></table>";
        ?>
    </body>
</html>			
		<?php
		}

//TERMINO GRAFICA TRES

		if($TipoGrafica=="4"){
		?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Deudor vs Acreedor</title>

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <style type="text/css">
${demo.css}
        </style>
        <script type="text/javascript">
$(function () {
    $('#container').highcharts({
        data: {
            table: 'datatable'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'Deudor con Mora menor a $10.000.000'
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Importe [$CLP]'
            }
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.series.name + '</b><br/>' +
                    this.point.y + ' ' + this.point.name.toLowerCase();
            }
        }
    });
});
        </script>
    </head>
    <body>
<script src="API/js/highcharts.js"></script>
<script src="API/js/modules/data.js"></script>
<script src="API/js/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<table id="datatable" style="display: none;">
    <thead>
        <tr>
            <th>Servicio</th>
            <th>Deudor</th>
            <th>Acreedor</th>
        </tr>
    </thead>
    <tbody>

        <?php
        //Se realiza la consulta SQL
        $query = "SELECT * FROM
	(SELECT uno.Grupo,IFNULL(uno.treinta,0)+IFNULL(uno.sesenta,0)+IFNULL(uno.noventa,0)+IFNULL(uno.cienveinte,0)+IFNULL(uno.ciencincuenta,0)+IFNULL(uno.cienochenta,0)+IFNULL(uno.treseiscinco,0)+IFNULL(uno.tresanios,0)+IFNULL(uno.cincoanios,0)+IFNULL(uno.mascinco,0) AS deudor,IFNULL(dos.treinta,0)+IFNULL(dos.sesenta,0)+IFNULL(dos.noventa,0)+IFNULL(dos.cienveinte,0)+IFNULL(dos.ciencincuenta,0)+IFNULL(dos.cienochenta,0)+IFNULL(dos.treseiscinco,0)+IFNULL(dos.tresanios,0)+IFNULL(dos.cincoanios,0)+IFNULL(dos.mascinco,0) AS acreedor FROM VISTA_TABLA_DINAMICA AS uno JOIN VISTA_RESUMEN_COSTO AS dos ON uno.Grupo=dos.Grupo WHERE uno.Grupo!='Total General') AS a WHERE a.deudor<10000000 ORDER BY a.deudor DESC";
        $result = mysqli_query($conexion,$query);
        //Comprobar posibles errores
        if(mysqli_error($conexion)){
        echo mysqli_error($conexion)."<br>";
        }

        while($row = mysqli_fetch_array($result)){
        	echo "<tr>";
        	echo "<td>".$row['Grupo']."</td>";
        	echo "<td>".$row['deudor']."</td>";
        	echo "<td>".($row['acreedor']*-1)."</td>";
        	echo "</tr>";
        }
        ?>
    </tbody>
</table>
        <?php
        //Se realiza la consulta SQL
        $query = "SELECT * FROM
	(SELECT uno.Grupo,IFNULL(uno.treinta,0)+IFNULL(uno.sesenta,0)+IFNULL(uno.noventa,0)+IFNULL(uno.cienveinte,0)+IFNULL(uno.ciencincuenta,0)+IFNULL(uno.cienochenta,0)+IFNULL(uno.treseiscinco,0)+IFNULL(uno.tresanios,0)+IFNULL(uno.cincoanios,0)+IFNULL(uno.mascinco,0) AS deudor,IFNULL(dos.treinta,0)+IFNULL(dos.sesenta,0)+IFNULL(dos.noventa,0)+IFNULL(dos.cienveinte,0)+IFNULL(dos.ciencincuenta,0)+IFNULL(dos.cienochenta,0)+IFNULL(dos.treseiscinco,0)+IFNULL(dos.tresanios,0)+IFNULL(dos.cincoanios,0)+IFNULL(dos.mascinco,0) AS acreedor FROM VISTA_TABLA_DINAMICA AS uno JOIN VISTA_RESUMEN_COSTO AS dos ON uno.Grupo=dos.Grupo WHERE uno.Grupo!='Total General') AS a WHERE a.deudor<10000000 ORDER BY a.deudor DESC";
        $result = mysqli_query($conexion,$query);
        //Comprobar posibles errores
        if(mysqli_error($conexion)){
        echo mysqli_error($conexion)."<br>";
        }
        echo "<table>
        <thead>
        <tr>
            <th>Servicio</th>
            <th>Deudor</th>
            <th>Acreedor</th>
        </tr>
    	</thead>
    	<tbody>";
        while($row = mysqli_fetch_array($result)){
        	echo "<tr>";
        	echo "<td>".$row['Grupo']."</td>";
        	echo "<td>".number_format($row['deudor'],0,',','.')."</td>";
        	echo "<td>".number_format(($row['acreedor']*-1),0,',','.')."</td>";
        	echo "</tr>";
        }
        echo "</tbody></table>";
        ?>
    </body>
</html>			
		<?php
		}

		if($TipoGrafica=="5"){
			?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Mora Acreedor</title>

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <style type="text/css">
${demo.css}
        </style>
        <script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Mora Acreedor - Cuentas por Pagar'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: [

            <?php
            //Se realiza la consulta SQL
            $query = "SELECT * FROM (SELECT Grupo,IFNULL(treinta,0)+IFNULL(sesenta,0)+IFNULL(noventa,0)+IFNULL(cienveinte,0)+IFNULL(ciencincuenta,0)+IFNULL(cienochenta,0)+IFNULL(treseiscinco,0)+IFNULL(tresanios,0)+IFNULL(cincoanios,0)+IFNULL(mascinco,0) AS SumaDeuda FROM VISTA_RESUMEN_COSTO WHERE Grupo!='Total General' ORDER BY SumaDeuda DESC) AS morosos WHERE morosos.SumaDeuda<0 ORDER BY morosos.SumaDeuda ASC";
            $result = mysqli_query($conexion,$query);
            //Comprobar posibles errores
            if(mysqli_error($conexion)){
            echo mysqli_error($conexion)."<br>";
            }

            while($row = mysqli_fetch_array($result)){
            ?>        
            ['<?php echo $row['Grupo'];?>',<?php echo ($row['SumaDeuda']*-1);?>],

            <?php
            }
            ?>
            ]
        }]
    });
});
        </script>
    </head>
    <body>

<script src="API/js/highcharts.js"></script>
<script src="API/js/highcharts-3d.js"></script>
<script src="API/js/modules/exporting.js"></script>

<div id="container" style="height: 400px"></div>
    </body>
</html>

		<?php
	    //Se realiza la consulta SQL
            $query = "SELECT * FROM (SELECT Grupo,IFNULL(treinta,0)+IFNULL(sesenta,0)+IFNULL(noventa,0)+IFNULL(cienveinte,0)+IFNULL(ciencincuenta,0)+IFNULL(cienochenta,0)+IFNULL(treseiscinco,0)+IFNULL(tresanios,0)+IFNULL(cincoanios,0)+IFNULL(mascinco,0) AS SumaDeuda FROM VISTA_RESUMEN_COSTO WHERE Grupo!='Total General' ORDER BY SumaDeuda DESC) AS morosos WHERE morosos.SumaDeuda<0 ORDER BY morosos.SumaDeuda ASC";
	    $result = mysqli_query($conexion,$query);
	    //Comprobar posibles errores
	    if(mysqli_error($conexion)){
	    echo mysqli_error($conexion)."<br>";
	    }

	    echo "<table>";
	    echo "<th>Grupo</th>";
	    echo "<th>Monto Mora</th>";
	    while($row = mysqli_fetch_array($result)){
	    	echo "<tr>";
	    	echo "<td>".$row['Grupo']."</td>";
	    	echo "<td>".number_format(($row['SumaDeuda']*-1),0,',','.')."</td>";
	    	echo "</tr>";
	    }
	    echo "</table>";

		}


	}
?>
</center>
</body>
</html>
