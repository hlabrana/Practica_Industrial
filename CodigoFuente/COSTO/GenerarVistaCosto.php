<?php
//Conexion Base de datos
$conexion = mysqli_connect('localhost', 'root', 'hector123','Morosidad')
    or die('No se pudo conectar: ' . mysqli_error());
mysqli_set_charset($conexion,'utf8');

$query = "

CREATE OR REPLACE TABLE VISTA_RESUMEN_COSTO

SELECT primero.Grupo AS 'Grupo',
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
(SELECT uno.Grupo,dos.Vigente FROM ((SELECT Grupo FROM COSTO_DatosSAP2 GROUP BY Grupo) AS uno LEFT JOIN (SELECT Grupo,SUM(ImporteMonedaLocal) as Vigente FROM COSTO_DatosSAP2 WHERE Tramo='Vigente' GROUP BY Grupo ORDER BY SUM(ImporteMonedaLocal) DESC) AS dos ON uno.Grupo=dos.Grupo) ORDER BY dos.Vigente DESC
) AS primero
JOIN
(SELECT uno.Grupo,dos.treinta FROM ((SELECT Grupo FROM COSTO_DatosSAP2 GROUP BY Grupo) AS uno LEFT JOIN (SELECT Grupo,SUM(ImporteMonedaLocal) as treinta FROM COSTO_DatosSAP2 WHERE Tramo='1-30 dias' GROUP BY Grupo ORDER BY SUM(ImporteMonedaLocal) DESC) AS dos ON uno.Grupo=dos.Grupo) ORDER BY dos.treinta DESC
) AS segundo
ON primero.Grupo=segundo.Grupo
JOIN
(SELECT uno.Grupo,dos.sesenta FROM ((SELECT Grupo FROM COSTO_DatosSAP2 GROUP BY Grupo) AS uno LEFT JOIN (SELECT Grupo,SUM(ImporteMonedaLocal) as sesenta FROM COSTO_DatosSAP2 WHERE Tramo='31-60 dias' GROUP BY Grupo ORDER BY SUM(ImporteMonedaLocal) DESC) AS dos ON uno.Grupo=dos.Grupo) ORDER BY dos.sesenta DESC
) AS tercero
ON primero.Grupo=tercero.Grupo
JOIN
(SELECT uno.Grupo,dos.noventa FROM ((SELECT Grupo FROM COSTO_DatosSAP2 GROUP BY Grupo) AS uno LEFT JOIN (SELECT Grupo,SUM(ImporteMonedaLocal) as noventa FROM COSTO_DatosSAP2 WHERE Tramo='61-90 dias' GROUP BY Grupo ORDER BY SUM(ImporteMonedaLocal) DESC) AS dos ON uno.Grupo=dos.Grupo) ORDER BY dos.noventa DESC
) AS cuarto
ON primero.Grupo=cuarto.Grupo
JOIN
(SELECT uno.Grupo,dos.cienveinte FROM ((SELECT Grupo FROM COSTO_DatosSAP2 GROUP BY Grupo) AS uno LEFT JOIN (SELECT Grupo,SUM(ImporteMonedaLocal) as cienveinte FROM COSTO_DatosSAP2 WHERE Tramo='91-120 dias' GROUP BY Grupo ORDER BY SUM(ImporteMonedaLocal) DESC) AS dos ON uno.Grupo=dos.Grupo) ORDER BY dos.cienveinte DESC
) AS quinto
ON primero.Grupo=quinto.Grupo
JOIN
(SELECT uno.Grupo,dos.ciencincuenta FROM ((SELECT Grupo FROM COSTO_DatosSAP2 GROUP BY Grupo) AS uno LEFT JOIN (SELECT Grupo,SUM(ImporteMonedaLocal) as ciencincuenta FROM COSTO_DatosSAP2 WHERE Tramo='121-150 dias' GROUP BY Grupo ORDER BY SUM(ImporteMonedaLocal) DESC) AS dos ON uno.Grupo=dos.Grupo) ORDER BY dos.ciencincuenta DESC
) AS sexto
ON primero.Grupo=sexto.Grupo
JOIN
(SELECT uno.Grupo,dos.cienochenta FROM ((SELECT Grupo FROM COSTO_DatosSAP2 GROUP BY Grupo) AS uno LEFT JOIN (SELECT Grupo,SUM(ImporteMonedaLocal) as cienochenta FROM COSTO_DatosSAP2 WHERE Tramo='151-180 dias' GROUP BY Grupo ORDER BY SUM(ImporteMonedaLocal) DESC) AS dos ON uno.Grupo=dos.Grupo) ORDER BY dos.cienochenta DESC
) AS septimo
ON primero.Grupo=septimo.Grupo
JOIN
(SELECT uno.Grupo,dos.treseiscinco FROM ((SELECT Grupo FROM COSTO_DatosSAP2 GROUP BY Grupo) AS uno LEFT JOIN (SELECT Grupo,SUM(ImporteMonedaLocal) as treseiscinco FROM COSTO_DatosSAP2 WHERE Tramo='181-365 dias' GROUP BY Grupo ORDER BY SUM(ImporteMonedaLocal) DESC) AS dos ON uno.Grupo=dos.Grupo) ORDER BY dos.treseiscinco DESC
) AS octavo
ON primero.Grupo=octavo.Grupo
JOIN
(SELECT uno.Grupo,dos.tresanios FROM ((SELECT Grupo FROM COSTO_DatosSAP2 GROUP BY Grupo) AS uno LEFT JOIN (SELECT Grupo,SUM(ImporteMonedaLocal) as tresanios FROM COSTO_DatosSAP2 WHERE Tramo='1-3 años' GROUP BY Grupo ORDER BY SUM(ImporteMonedaLocal) DESC) AS dos ON uno.Grupo=dos.Grupo) ORDER BY dos.tresanios DESC
) AS noveno
ON primero.Grupo=noveno.Grupo
JOIN
(SELECT uno.Grupo,dos.cincoanios FROM ((SELECT Grupo FROM COSTO_DatosSAP2 GROUP BY Grupo) AS uno LEFT JOIN (SELECT Grupo,SUM(ImporteMonedaLocal) as cincoanios FROM COSTO_DatosSAP2 WHERE Tramo='3-5 años' GROUP BY Grupo ORDER BY SUM(ImporteMonedaLocal) DESC) AS dos ON uno.Grupo=dos.Grupo) ORDER BY dos.cincoanios DESC
) AS decimo
ON primero.Grupo=decimo.Grupo
JOIN
(SELECT uno.Grupo,dos.mascinco FROM ((SELECT Grupo FROM COSTO_DatosSAP2 GROUP BY Grupo) AS uno LEFT JOIN (SELECT Grupo,SUM(ImporteMonedaLocal) as mascinco FROM COSTO_DatosSAP2 WHERE Tramo='mas de 5 años' GROUP BY Grupo ORDER BY SUM(ImporteMonedaLocal) DESC) AS dos ON uno.Grupo=dos.Grupo) ORDER BY dos.mascinco DESC
) AS undecimo
ON primero.Grupo=undecimo.Grupo
JOIN
(SELECT uno.Grupo,dos.totalgeneral FROM ((SELECT Grupo FROM COSTO_DatosSAP2 GROUP BY Grupo) AS uno LEFT JOIN (SELECT Grupo,SUM(ImporteMonedaLocal) as totalgeneral FROM COSTO_DatosSAP2 GROUP BY Grupo ORDER BY SUM(ImporteMonedaLocal) DESC) AS dos ON uno.Grupo=dos.Grupo) ORDER BY dos.totalgeneral DESC
) AS duodecimo
ON primero.Grupo=duodecimo.Grupo
GROUP BY totalgeneral DESC
";

mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

//INGRESAR FILA CON LA SUMA DE LOS MONTOS PARCIALES SEGUN Tramo, ULTIMO REGISTROS

$query = "SELECT SUM(Vigente),SUM(treinta),SUM(sesenta),SUM(noventa),SUM(cienveinte),SUM(ciencincuenta),SUM(cienochenta),SUM(treseiscinco),SUM(tresanios),
SUM(cincoanios),SUM(mascinco),SUM(totalgeneral) FROM VISTA_RESUMEN_COSTO";

$result = mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$row = mysqli_fetch_row($result);

//Se procede a dejar negativo el total general del registro para que quede al último de la lista
$TotalNegativo = $row[11]*-1;

$query_insert = "INSERT INTO VISTA_RESUMEN_COSTO VALUES ('Total General','$row[0]','$row[1]','$row[2]','$row[3]','$row[4]','$row[5]','$row[6]'
,'$row[7]','$row[8]','$row[9]','$row[10]','$TotalNegativo')";

$result = mysqli_query($conexion,$query_insert);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

header("Location: SalidaGUICosto.php");
?>
