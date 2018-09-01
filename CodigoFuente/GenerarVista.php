<?php
//Conexion Base de datos
$conexion = mysqli_connect('localhost', 'root', 'hector123','Morosidad')
    or die('No se pudo conectar: ' . mysqli_error());
mysqli_set_charset($conexion,'utf8');

$query = "

CREATE OR REPLACE TABLE VISTA_TABLA_DINAMICA

SELECT primero.grupo AS 'Grupo',
Vigente,
treinta,
sesenta,
noventa,
cienveinte,
ciencincuenta,
cienochenta,
treseiscinco,
tresanios,
cincoanios,
mascinco,
totalgeneral
FROM
(SELECT uno.grupo,dos.Vigente FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as Vigente FROM OUTPUT WHERE tramo='Vigente' GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.Vigente DESC
) AS primero
JOIN
(SELECT uno.grupo,dos.treinta FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as treinta FROM OUTPUT WHERE tramo='1-30 dias' GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.treinta DESC
) AS segundo
ON primero.grupo=segundo.grupo
JOIN
(SELECT uno.grupo,dos.sesenta FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as sesenta FROM OUTPUT WHERE tramo='31-60 dias' GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.sesenta DESC
) AS tercero
ON primero.grupo=tercero.grupo
JOIN
(SELECT uno.grupo,dos.noventa FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as noventa FROM OUTPUT WHERE tramo='61-90 dias' GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.noventa DESC
) AS cuarto
ON primero.grupo=cuarto.grupo
JOIN
(SELECT uno.grupo,dos.cienveinte FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as cienveinte FROM OUTPUT WHERE tramo='91-120 dias' GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.cienveinte DESC
) AS quinto
ON primero.grupo=quinto.grupo
JOIN
(SELECT uno.grupo,dos.ciencincuenta FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as ciencincuenta FROM OUTPUT WHERE tramo='121-150 dias' GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.ciencincuenta DESC
) AS sexto
ON primero.grupo=sexto.grupo
JOIN
(SELECT uno.grupo,dos.cienochenta FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as cienochenta FROM OUTPUT WHERE tramo='151-180 dias' GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.cienochenta DESC
) AS septimo
ON primero.grupo=septimo.grupo
JOIN
(SELECT uno.grupo,dos.treseiscinco FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as treseiscinco FROM OUTPUT WHERE tramo='181-365 dias' GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.treseiscinco DESC
) AS octavo
ON primero.grupo=octavo.grupo
JOIN
(SELECT uno.grupo,dos.tresanios FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as tresanios FROM OUTPUT WHERE tramo='1-3 años' GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.tresanios DESC
) AS noveno
ON primero.grupo=noveno.grupo
JOIN
(SELECT uno.grupo,dos.cincoanios FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as cincoanios FROM OUTPUT WHERE tramo='3-5 años' GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.cincoanios DESC
) AS decimo
ON primero.grupo=decimo.grupo
JOIN
(SELECT uno.grupo,dos.mascinco FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as mascinco FROM OUTPUT WHERE tramo='mas de 5 años' GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.mascinco DESC
) AS undecimo
ON primero.grupo=undecimo.grupo
JOIN
(SELECT uno.grupo,dos.totalgeneral FROM ((SELECT grupo FROM OUTPUT GROUP BY grupo) AS uno LEFT JOIN (SELECT grupo,SUM(importe) as totalgeneral FROM OUTPUT GROUP BY grupo ORDER BY SUM(importe) DESC) AS dos ON uno.grupo=dos.grupo) ORDER BY dos.totalgeneral DESC
) AS duodecimo
ON primero.grupo=duodecimo.grupo
GROUP BY totalgeneral DESC
";

mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

//INGRESAR FILA CON LA SUMA DE LOS MONTOS PARCIALES SEGUN TRAMO, ULTIMO REGISTROS

$query = "SELECT SUM(Vigente),SUM(treinta),SUM(sesenta),SUM(noventa),SUM(cienveinte),SUM(ciencincuenta),SUM(cienochenta),SUM(treseiscinco),SUM(tresanios),
SUM(cincoanios),SUM(mascinco),SUM(totalgeneral) FROM VISTA_TABLA_DINAMICA";

$result = mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$row = mysqli_fetch_row($result);

//Se procede a dejar negativo el total general del registro para que quede al último de la lista
$TotalNegativo = $row[11]*-1;

$query_insert = "INSERT INTO VISTA_TABLA_DINAMICA VALUES ('Total General','$row[0]','$row[1]','$row[2]','$row[3]','$row[4]','$row[5]','$row[6]'
,'$row[7]','$row[8]','$row[9]','$row[10]','$TotalNegativo')";

$result = mysqli_query($conexion,$query_insert);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

header("Location: SCL/LimpiezaArchivoSCL.php");
//header("Location: SalidaGUI.php");
?>
