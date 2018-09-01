<?php
//Creacion y reemplazo de TABLAS SQL (FacturadorMinorista y SAP)
$conexion = mysqli_connect('localhost', 'root', 'hector123','Morosidad')
    or die('No se pudo conectar: ' . mysqli_error());
mysqli_set_charset($conexion,'utf8');


//TANTO PARA LOS CHEQUE A FECHA COMO EL CLIENTE NETLINE CON IDSAP 467528 ESTAN ACTUALIZADOS EN LimpiezaSAP.PHP

//Servicios con GLOSA COLOCALIZACION SE DEBE DAR 60 DIAS DE GRACIA.
$query = "UPDATE OUTPUT SET fec_vencimie=DATE_ADD(fec_emision, INTERVAL 60 DAY) WHERE Servicio='COLOCALIZACION' OR Servicio='BACKBONE'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

//SETEAR DIAS MORA
$query = "UPDATE OUTPUT SET dias_mora=DATEDIFF((SELECT fecha FROM FECHACIERRE),fec_vencimie) WHERE Servicio='COLOCALIZACION' OR Servicio='BACKBONE'";
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
$query = "UPDATE OUTPUT SET tramo='Vigente' WHERE dias_mora<'1' AND (Servicio='COLOCALIZACION' OR Servicio='BACKBONE')";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET tramo='1-30 dias' WHERE dias_mora<'31' AND dias_mora>='1' AND (Servicio='COLOCALIZACION' OR Servicio='BACKBONE')";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET tramo='31-60 dias' WHERE dias_mora<'61' AND dias_mora>='31' AND (Servicio='COLOCALIZACION' OR Servicio='BACKBONE')";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET tramo='61-90 dias' WHERE dias_mora<'91' AND dias_mora>='61' AND (Servicio='COLOCALIZACION' OR Servicio='BACKBONE')";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET tramo='91-120 dias' WHERE dias_mora<'121' AND dias_mora>='91' AND (Servicio='COLOCALIZACION' OR Servicio='BACKBONE')";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET tramo='121-150 dias' WHERE dias_mora<'151' AND dias_mora>='121' AND (Servicio='COLOCALIZACION' OR Servicio='BACKBONE')";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET tramo='151-180 dias' WHERE dias_mora<'181' AND dias_mora>='151' AND (Servicio='COLOCALIZACION' OR Servicio='BACKBONE')";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET tramo='181-365 dias' WHERE dias_mora<'366' AND dias_mora>='181' AND (Servicio='COLOCALIZACION' OR Servicio='BACKBONE')";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET tramo='1-3 años' WHERE dias_mora<'1096' AND dias_mora>='366' AND (Servicio='COLOCALIZACION' OR Servicio='BACKBONE')";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET tramo='3-5 años' WHERE dias_mora<'1826' AND dias_mora>='1096' AND (Servicio='COLOCALIZACION' OR Servicio='BACKBONE')";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET tramo='mas de 5 años' WHERE dias_mora>='1826' AND (Servicio='COLOCALIZACION' OR Servicio='BACKBONE')";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

//SE AGREGAN LAS COLUMNAS CICLO Y SEGMENTO
$query = "ALTER TABLE OUTPUT ADD ciclo VARCHAR(255), ADD Segmento VARCHAR(255)";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Segmento='MAYORISTAS'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT INNER JOIN BACKUP_CICLO
ON OUTPUT.rut_cliente = BACKUP_CICLO.rut_cliente AND OUTPUT.facturactc = BACKUP_CICLO.facturactc AND OUTPUT.importe = BACKUP_CICLO.importe
SET OUTPUT.ciclo = BACKUP_CICLO.cod_ciclo";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

header("Location: GenerarVista.php");
 ?>
