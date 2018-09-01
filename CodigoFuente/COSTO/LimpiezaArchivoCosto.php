<?php
//Conexion Base de datos
$conexion = mysqli_connect('localhost', 'root', 'hector123','Morosidad')
    or die('No se pudo conectar: ' . mysqli_error());
mysqli_set_charset($conexion,'utf8');

//3) Eliminar registros en amarillo coloreados.
$query="DELETE FROM COSTO_DatosSAP WHERE Sociedad like '%cuenta%' OR Sociedad like '%Icono%' OR Sociedad='' OR Sociedad is NULL";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

//4) renombrar status de documento a el nombre -> acreedor.
//5) copiar id de acreedor en nueva columna renombrada.
//7) Borrar Acreedor columna I.
$query = "ALTER TABLE COSTO_DatosSAP MODIFY COLUMN Acreedor BIGINT AFTER Sociedad";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

//6) En columna Clase de Documento borrar X1 y RF.
//SE ANULA PASO 6 POR NUEVAS MODIFICACIONES, VER DETALLE EN LAS ULTIMAS LINEAS
/*
$query = "DELETE FROM COSTO_DatosSAP WHERE ClaseDeDocumento='X1' OR ClaseDeDocumento='RF'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}*/

//7) Borrar Acreedor columna I. (Se reemplaza por borrar StatusDeDocumento)
$query = "ALTER TABLE COSTO_DatosSAP DROP StatusDeDocumento";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

//8) Agregar columna extra Grupo, Analista,  Tramo, Dias Mora, Fecha Vencimiento.
$query = "ALTER TABLE COSTO_DatosSAP ADD Grupo VARCHAR(255), ADD Analista VARCHAR(255), ADD Tramo VARCHAR(255), ADD DiasMora BIGINT, ADD FechaVencimiento DATE";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

//9) Insertar fecha vencimiento entre columnas fecha documento y fe.contabilización.
$query = "ALTER TABLE COSTO_DatosSAP MODIFY COLUMN FechaVencimiento DATE AFTER FechaDeDocumento";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

//10) fecha vencimiento = fecha documento + 30 dias.
$query = "UPDATE COSTO_DatosSAP SET FechaVencimiento=DATE_ADD(FechaDeDocumento, INTERVAL 30 DAY)";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

//10.2) CONFIRMADO: PROPONER CAMBIAR SOCIEDAD 0077->TCHILE & 0404->TMOVIL.
$query = "UPDATE COSTO_DatosSAP SET Sociedad='TCHILE' WHERE Sociedad='0077' OR Sociedad='77'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE COSTO_DatosSAP SET Sociedad='TMOVIL' WHERE Sociedad='0404' OR Sociedad='404'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

//11) Realizar un BUSCARV en columnas GRUPO Y ANALISTA segun Rut Acreedor.
$query = "CREATE OR REPLACE TABLE COSTO_DatosSAP2
            SELECT s.Sociedad,s.Acreedor,base.Nombre AS NombreDeLaCuenta,base.rut AS RutCliente,s.BancoPropio,s.ClaseDeDocumento,s.Referencia,s.Texto,s.ViaDePago,
            s.BloqueoDePago,s.ReceptPago,s.NDocumento,s.FechaDeDocumento,s.FechaVencimiento,s.FeContabilizacion,s.ImporteMonedaLocal,
            s.MonedaDelDocumento,s.FechaDePago,s.DocCompensacion,s.CuentaDeMayor,base.Grupo,base.NuevoAnalista AS Analista,s.Tramo,s.DiasMora
            FROM COSTO_DatosSAP AS s JOIN BaseOperadora AS base WHERE s.Acreedor=base.Acreedor";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

//12) Calcular dias mora en base a fecha vencimiento y fecha cierre ingresada usuario.
$query = "UPDATE COSTO_DatosSAP2 SET DiasMora=DATEDIFF((SELECT fecha FROM FECHACOSTO),FechaVencimiento)";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

//13) Calcular Tramo en base a dias mora tomando la referencia del cierre de morosidad.
/*DiasMora:
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
$query = "UPDATE COSTO_DatosSAP2 SET Tramo='Vigente' WHERE DiasMora<'1'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE COSTO_DatosSAP2 SET Tramo='1-30 dias' WHERE DiasMora<'31' AND DiasMora>='1'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE COSTO_DatosSAP2 SET Tramo='31-60 dias' WHERE DiasMora<'61' AND DiasMora>='31'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE COSTO_DatosSAP2 SET Tramo='61-90 dias' WHERE DiasMora<'91' AND DiasMora>='61'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE COSTO_DatosSAP2 SET Tramo='91-120 dias' WHERE DiasMora<'121' AND DiasMora>='91'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE COSTO_DatosSAP2 SET Tramo='121-150 dias' WHERE DiasMora<'151' AND DiasMora>='121'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE COSTO_DatosSAP2 SET Tramo='151-180 dias' WHERE DiasMora<'181' AND DiasMora>='151'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE COSTO_DatosSAP2 SET Tramo='181-365 dias' WHERE DiasMora<'366' AND DiasMora>='181'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE COSTO_DatosSAP2 SET Tramo='1-3 años' WHERE DiasMora<'1096' AND DiasMora>='366'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE COSTO_DatosSAP2 SET Tramo='3-5 años' WHERE DiasMora<'1826' AND DiasMora>='1096'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE COSTO_DatosSAP2 SET Tramo='mas de 5 años' WHERE DiasMora>='1826'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

//MODIFICACIONES:
/*2) Separación de Informe de Costo:
        - Gestionable: BB,BH,IN,PP,KP
        - No Gestionable: ZU,ZD,Y1... el resto de los tipo de cuenta*/
$query = "CREATE OR REPLACE TABLE COSTO_GESTIONABLE
            SELECT * FROM COSTO_DatosSAP2 WHERE ClaseDeDocumento='BB' OR ClaseDeDocumento='BH' OR ClaseDeDocumento='IN'
            OR ClaseDeDocumento='PP' OR ClaseDeDocumento='KP'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "CREATE OR REPLACE TABLE COSTO_NO_GESTIONABLE
            SELECT * FROM COSTO_DatosSAP2 WHERE ClaseDeDocumento!='BB' AND ClaseDeDocumento!='BH' AND ClaseDeDocumento!='IN'
            AND ClaseDeDocumento!='PP' AND ClaseDeDocumento!='KP'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

header("Location: GenerarVistaCosto.php");
 ?>
