<?php
//Conexion Base de datos
$conexion = mysqli_connect('localhost', 'root', 'hector123','Morosidad')
    or die('No se pudo conectar: ' . mysqli_error());
mysqli_set_charset($conexion,'utf8');

/*5.- BORRAR ULTIMA LINEA DEL TOTAL*/
$query = "DELETE FROM SAP WHERE Cliente='0' AND NumeroDocumento='0' AND CuentaDeMayor='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

/*6.- ELIMINAR ICONOPARTIDAABIERTAS*/
$query = "ALTER TABLE SAP DROP icono";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

/*7.- ELIMINAR BLOQUEODEPAGO*/
$query = "ALTER TABLE SAP DROP BloqueoDePago";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

/*8.- COPIAR REGISTROS AM EN NUEVA TABLA (INICIO INFORME 2) EN CLASEDOCUMENTO FILTRAR POR AM Y ELIMINAR REGISTROS*/
$query = "CREATE OR REPLACE TABLE SAP_AM
            SELECT * FROM SAP WHERE ClaseDocumento='AM'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "DELETE FROM SAP WHERE ClaseDocumento='AM'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "DELETE FROM SAP WHERE ClaseDocumento='S1'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

/*9.- EN COLUMNA REFERENCIA QUITAR CEROS A LA IZQUIERDA A TODOS LOS NUMEROS*/
$query = "ALTER TABLE SAP ADD Referencia_2 BIGINT";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "ALTER TABLE SAP MODIFY COLUMN Referencia_2 BIGINT AFTER Referencia";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "UPDATE SAP SET Referencia_2=Referencia";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "ALTER TABLE SAP MODIFY Referencia_2 VARCHAR(255)";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "UPDATE SAP SET Referencia_2=Referencia WHERE Referencia_2='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "UPDATE SAP SET Referencia=Referencia_2";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "ALTER TABLE SAP DROP Referencia_2";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

/*10.- CAMPOS EN BLANCO EN COLUMNA REFERENCIA COPIAR LABEL EN RESPECTIVO CAMPO ASIGNACION*/
$query = "UPDATE SAP SET Referencia=Asignacion WHERE Referencia=' '";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

/*11.- COMPROBAR CEROS A LA IZQUIERDA DE NUEVOS DATOS EN COLUMNA REFERENCIA*/
$query = "ALTER TABLE SAP ADD Referencia_2 BIGINT";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "ALTER TABLE SAP MODIFY COLUMN Referencia_2 BIGINT AFTER Referencia";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "UPDATE SAP SET Referencia_2=Referencia";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "ALTER TABLE SAP MODIFY Referencia_2 VARCHAR(255)";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "UPDATE SAP SET Referencia_2=Referencia WHERE Referencia_2='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "UPDATE SAP SET Referencia=Referencia_2";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "ALTER TABLE SAP DROP Referencia_2";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

/*12.- PARA LOS REGISTROS EN BLANCO EN COLUMNA REFERENCIA REGISTRAR SEGUN IMPORTE:
        - SI IMPORTE ES NEGATIVO, RELLENAR CON ABONO
        - SI IMPORTE ES POSITIVO, RELLENAR CON SALDO*/
$query = "UPDATE SAP SET Referencia='ABONO_2' WHERE Referencia=' ' AND ImporteEnMonedaLocal<0";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "UPDATE SAP SET Referencia='SALDO_2' WHERE Referencia=' ' AND ImporteEnMonedaLocal>0";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

/*13.- BORRAR COLUMNA ASIGNACION
14.- BORRAR FECHA_PAGO*/
$query = "ALTER TABLE SAP DROP Asignacion, DROP FechaDePago";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

/*15.- ELIMINAR REGISTROS DONDE EL IMPORTE SE ENCUENTRE ENTRE -5 Y 5.*/
$query = "DELETE FROM SAP WHERE ImporteEnMonedaLocal>=-5 AND ImporteEnMonedaLocal<=5";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

/*16.- ELIMINAR FECHA COMPENSACION
17.- ELIMINAR FE.CONTABILIZACION
18.- ELIMINAR N DOCUMENTO
19.- ELIMINAR TEXTO.CAB.DOCUMENTO*/
$query = "ALTER TABLE SAP DROP FechaCompensacion, DROP FeContabilizacion, DROP NumeroDocumento, DROP TextoCabDocumento";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

/*20.- REEMPLAZAR EN SOCIEDAD SEGUN:
        0077-> TCHILE
        0404-> TMOVIL*/
$query = "UPDATE SAP SET Sociedad='TCHILE' WHERE Sociedad='77' OR Sociedad='0077'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "UPDATE SAP SET Sociedad='TMOVIL' WHERE Sociedad='404' OR Sociedad='0404'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

/*21.- ELIMINAR CUENTA DE MAYOR
22.- ELIMINAR DOC.COMPENSACION*/
$query = "ALTER TABLE SAP DROP CuentaDeMayor, DROP DocCompensacion";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

/*23.- ELIMINAR COLUMNA NUM_FOLIO EN FACTURADORMINORISTA*/
$query = "ALTER TABLE FacturadorMinorista DROP num_folio";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

/*24.- PEGAR REGISTROS DE SAP A FACTURADORMINORISTA:
        CLIENTE-CLIENTE
        CLASE DE DOCUMENTO-CUENTA
        NOMBRE DE LA CUENTA-NOM_CLIENTE
        REFERENCIA-FACTURACTC
        FECHA DOCUMENTO-FEC_EMISION
        VENCIMIENTO NETO-FEC_VENCIMIENTO
        IMPORTE EN MONEDA LOCAL-IMPORTE*/
$query = "ALTER TABLE SAP CHANGE Cliente cliente INT";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "ALTER TABLE SAP CHANGE ClaseDocumento cuenta VARCHAR(255)";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "ALTER TABLE SAP CHANGE NombreCuenta nom_cliente VARCHAR(255)";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "ALTER TABLE SAP CHANGE Referencia facturactc VARCHAR(255)";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "ALTER TABLE SAP CHANGE FechaDocumento fec_emision DATE";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "ALTER TABLE SAP CHANGE VencimientoNeto fec_vencimie DATE";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "ALTER TABLE SAP CHANGE ImporteEnMonedaLocal importe BIGINT";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "ALTER TABLE SAP CHANGE Texto Servicio VARCHAR(255)";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

//CONVERSION DE TIPOS PARA CALCE CON OVER JOIN
$query = "ALTER TABLE FacturadorMinorista MODIFY importe BIGINT";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "ALTER TABLE FacturadorMinorista MODIFY facturactc VARCHAR(255)";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "ALTER TABLE SAP MODIFY cliente VARCHAR(255)";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

//Agregar columnas SERVICIO Y SOCIEDAD A FacturadorMinorista (PUNTO 25)
$query = "ALTER TABLE FacturadorMinorista ADD Servicio VARCHAR(255), ADD Sociedad VARCHAR(255)";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

//AGREGAR COLUMNAS RESTANTES A SAP PARA HACER CALCE CON OVER JOIN
$query = "ALTER TABLE SAP ADD origen VARCHAR(255), ADD emp VARCHAR(255), ADD rut_cliente VARCHAR(255), ADD cod_area INT,
          ADD telefono VARCHAR(255), ADD grupo VARCHAR(255), ADD analista VARCHAR(255), ADD dias_mora INT, ADD tramo VARCHAR(255)";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

//ORDENAR COLUMNAS EN SAP PARA QUE ESTEN ACORDE A FacturadorMinorista
$query = "ALTER TABLE SAP MODIFY COLUMN origen VARCHAR(255) AFTER cliente";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "ALTER TABLE SAP MODIFY COLUMN cliente VARCHAR(255) AFTER facturactc";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "ALTER TABLE SAP MODIFY COLUMN emp VARCHAR(255) AFTER origen";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "ALTER TABLE SAP MODIFY COLUMN rut_cliente VARCHAR(255) AFTER emp";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "ALTER TABLE SAP MODIFY COLUMN facturactc VARCHAR(255) AFTER nom_cliente";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "ALTER TABLE SAP MODIFY COLUMN cliente VARCHAR(255) AFTER facturactc";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "ALTER TABLE SAP MODIFY COLUMN cod_area INT AFTER cuenta";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "ALTER TABLE SAP MODIFY COLUMN telefono VARCHAR(255) AFTER cod_area";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "ALTER TABLE SAP MODIFY COLUMN importe BIGINT AFTER telefono";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "ALTER TABLE SAP MODIFY COLUMN grupo VARCHAR(255) AFTER importe";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "ALTER TABLE SAP MODIFY COLUMN analista VARCHAR(255) AFTER grupo";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "ALTER TABLE SAP MODIFY COLUMN dias_mora INT AFTER fec_vencimie";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "ALTER TABLE SAP MODIFY COLUMN tramo VARCHAR(255) AFTER dias_mora";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

/*26.- NUEVOS REGISTROS RELLENAR COLUMNAS ORIGEN Y emp CON LABEL 'SAP'*/
$query = "UPDATE SAP SET origen='SAP'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "UPDATE SAP SET emp='SAP'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

/*27.- EN COLUMNA rut_cliente realizar una busqueda COMPARAR cliente CON IDSAP EN BASE OPERADORA, TRAER LA COLUMNA RUT3 O RUT (ES LA MISMA) (BUSCARV)*/
/*28.- EN COLUMNA NOM_CLIENTE BUSCAR EL NOMBRE EN BASE OPERADORA SEGUN RUT_CLIENTE O SEGUN CLIENTE*/
$query = "CREATE OR REPLACE TABLE SAP_2
            SELECT s.origen,s.emp,base.rut as rut_cliente,base.Nombre as nom_cliente,s.facturactc,s.cliente,s.cuenta,s.cod_area,
            s.telefono,s.importe,s.grupo,s.analista,s.fec_emision,s.fec_vencimie,s.dias_mora,s.tramo,s.Servicio,s.Sociedad
            FROM SAP as s JOIN BaseOperadora as base
            WHERE s.cliente=base.IdSAP";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

/*28.2.- AGRUPAR LOS REGISTROS CON FACTURACTC IGUAL Y QUE SEAN NUMEROS
$query = "CREATE OR REPLACE TABLE SAP
            SELECT * FROM SAP_2 WHERE facturactc REGEXP '^[0-9]+$'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "CREATE OR REPLACE TABLE SAP_3
            SELECT s.origen,s.emp,s.rut_cliente,s.nom_cliente,s.facturactc,s.cliente,s.cuenta,s.cod_area,
            s.telefono,SUM(s.importe) as importe,s.grupo,s.analista,s.fec_emision,s.fec_vencimie,s.dias_mora,s.tramo,s.Servicio,s.Sociedad
            FROM SAP as s GROUP BY s.facturactc";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "DELETE FROM SAP_2 WHERE facturactc REGEXP '^[0-9]+$'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "CREATE OR REPLACE TABLE SAP
              (SELECT * FROM SAP_2) UNION ALL (SELECT * FROM SAP_3)";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}*/

//SE ELIMINAN LOS REGISTROS CON LABEL FORCOB
$query = "DELETE FROM SAP_2 WHERE facturactc like '%forcob%' OR facturactc like '%FORCOB%'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

//SE REALIZA EL OVER JOIN (UNION DE TABLAS) (TERMINO DEL PASO 24)
$query = "CREATE OR REPLACE TABLE MAYORISTA_SAP
(SELECT * FROM FacturadorMinorista) UNION ALL (SELECT * FROM SAP_2)";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

/*29.- COLUMNA GRUPO HACER BUSQUEDA EN BASE OPERADORA SEGUN RUT_CLIENTE TRAER GRUPO*/
/*30.- COLUMNA ANALISTA HACER BUSQUEDA EN BASE OPERADORA SEGUN RUT_CLIENTE TRAER ANALISTA NEW*/
$query = "CREATE OR REPLACE TABLE MAYORISTA_SAP_2
            SELECT s.origen,s.emp,s.rut_cliente,s.nom_cliente,s.facturactc,s.cliente,s.cuenta,s.cod_area,
            s.telefono,s.importe,base.Grupo as grupo,base.NuevoAnalista as analista,s.fec_emision,s.fec_vencimie,s.dias_mora,
            s.tramo,s.Servicio,s.Sociedad
            FROM MAYORISTA_SAP as s JOIN BaseOperadora as base
            WHERE s.rut_cliente=base.rut";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

/*31.- EN fec_vencimiento = fec_emision + 30 dias.*/
$query = "UPDATE MAYORISTA_SAP_2 SET fec_vencimie=DATE_ADD(fec_emision, INTERVAL 30 DAY) WHERE cuenta!='DZ'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
/*31.2- SE ACTUALIZA CLIENTE NETLINE CON ID SAP='467528' SOLO TMOVIL EN fec_vencimiento = fec_emision + 90 dias.*/
$query = "UPDATE MAYORISTA_SAP_2 SET fec_vencimie=DATE_ADD(fec_emision, INTERVAL 90 DAY) WHERE cliente='467528' AND Sociedad='TMOVIL'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

/*32.- EN SOCIEDAD CAMBIAR:
        - 181,188,ATIS -> TCHILE
        - SISCLI -> _TEMP*/
$query = "UPDATE MAYORISTA_SAP_2 SET Sociedad='TCHILE' WHERE Sociedad='181' OR Sociedad='188' OR Sociedad='ATIS' OR
          origen='181' OR origen='188' OR origen='ATIS'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE MAYORISTA_SAP_2 SET Sociedad='TEMP' WHERE Sociedad='SISCLI' OR origen='SISCLI'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

header("Location: LimpiezaGLOSA.php");
 ?>
