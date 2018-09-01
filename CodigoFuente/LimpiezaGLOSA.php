<?php
//Conexion Base de datos
$conexion = mysqli_connect('localhost', 'root', 'hector123','Morosidad')
    or die('No se pudo conectar: ' . mysqli_error());
mysqli_set_charset($conexion,'utf8');

//INICIO DE ETAPA 3 - RELATIVO A LA GLOSA (columna Servicio)
/*1.- En columna origen filtrar por ATIS y agregar en columna servicio 'TELEFONIA BASICA'
        - filtrar por SISCLI y agregar en servicio 'PROY.EMPRESAS'*/
$query = "UPDATE MAYORISTA_SAP_2 SET Servicio='TELEFONIA BASICA' WHERE origen='ATIS'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "UPDATE MAYORISTA_SAP_2 SET Servicio='PROY. EMPRESAS' WHERE origen='SISCLI'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

/*2.- Filtrar los registros con importe entre -5 y 5.*/
$query = "DELETE FROM MAYORISTA_SAP_2 WHERE importe>=-5 AND importe<=5";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

/*3.- En columna facturactc filtrar todos los campos de tipo String y vacios, buscar coincidencias (like) segun:
        - chp,'Protest','ch' -> 'CH PROTESTADO'
        - Si la columna importe es mayor a cero -> 'SALDO'
        - Si la columna importe es menor que cero -> 'ABONO'*/
$query = "UPDATE MAYORISTA_SAP_2 SET Servicio='CH PROTESTADO' WHERE facturactc NOT REGEXP '^[0-9]+$' AND Servicio=' ' AND
          (facturactc LIKE '%ch%' OR facturactc LIKE '%Protest%')";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "UPDATE MAYORISTA_SAP_2 SET Servicio='SALDO' WHERE facturactc NOT REGEXP '^[0-9]+$' AND Servicio=' ' AND
          importe>'0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "UPDATE MAYORISTA_SAP_2 SET Servicio='ABONO' WHERE facturactc NOT REGEXP '^[0-9]+$' AND Servicio=' ' AND
          importe<'0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

//4.- Buscar los registros vacios con facturactc en archivo GLOSA (ultimo reporte mes anterior).
//Crear una nueva tabla con los registros vacios
$query = "CREATE OR REPLACE TABLE VACIOSGLOSA
            SELECT * FROM MAYORISTA_SAP_2 WHERE Servicio=' ' OR Servicio is NULL";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "CREATE OR REPLACE TABLE GLOSA
            SELECT * FROM DetalleGlosa GROUP BY facturactc";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "CREATE OR REPLACE TABLE MAYORISTA_SAP
            SELECT s.origen,s.emp,s.rut_cliente,s.nom_cliente,s.facturactc,s.cliente,s.cuenta,s.cod_area,
            s.telefono,s.importe,s.grupo,s.analista,s.fec_emision,s.fec_vencimie,s.dias_mora,s.tramo,base.Glosa,s.Sociedad
            FROM VACIOSGLOSA as s LEFT JOIN GLOSA as base
            ON s.facturactc=base.facturactc";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "DELETE FROM MAYORISTA_SAP_2 WHERE Servicio=' ' OR Servicio is NULL";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "CREATE OR REPLACE TABLE OUTPUT
              (SELECT * FROM MAYORISTA_SAP_2) UNION ALL (SELECT * FROM MAYORISTA_SAP)";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

/*5.- Agregar en columna dias_mora = FechaActual - fec_vencimie*/

$query = "UPDATE OUTPUT SET dias_mora=DATEDIFF((SELECT fecha FROM FECHACIERRE),fec_vencimie)";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

//Modificar el orden de las TABLAS
$query = "ALTER TABLE OUTPUT MODIFY Sociedad VARCHAR(255) FIRST";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

/*6.- Actualizar la columna tramo bajo la siguiente referencia:
dias_mora:
        < 1 -> "Vigente"
        < 31 -> "1-30 dias"
        < 61 -> "31-60 dias"
        < 91 -> "61-90 dias"
        < 121 -> "91-120 dias"
        < 151 -> "121-150 dias"
        < 181 -> "151-180 dias"
        < 366 -> "181-365 dias"
        < 1096 -> "1-3 años"
        < 1826 -> "3-5 años"
        >= 1826 -> "mas de 5 años"
*/
$query = "UPDATE OUTPUT SET tramo='Vigente' WHERE dias_mora<'1'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET tramo='1-30 dias' WHERE dias_mora<'31' AND dias_mora>='1'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET tramo='31-60 dias' WHERE dias_mora<'61' AND dias_mora>='31'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET tramo='61-90 dias' WHERE dias_mora<'91' AND dias_mora>='61'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET tramo='91-120 dias' WHERE dias_mora<'121' AND dias_mora>='91'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET tramo='121-150 dias' WHERE dias_mora<'151' AND dias_mora>='121'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET tramo='151-180 dias' WHERE dias_mora<'181' AND dias_mora>='151'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET tramo='181-365 dias' WHERE dias_mora<'366' AND dias_mora>='181'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET tramo='1-3 años' WHERE dias_mora<'1096' AND dias_mora>='366'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET tramo='3-5 años' WHERE dias_mora<'1826' AND dias_mora>='1096'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET tramo='mas de 5 años' WHERE dias_mora>='1826'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

header("Location: HomologarGlosa.php");
?>
