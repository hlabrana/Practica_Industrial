<?php
//Conexion Base de datos
$conexion = mysqli_connect('localhost', 'root', 'hector123','Morosidad')
    or die('No se pudo conectar: ' . mysqli_error());
mysqli_set_charset($conexion,'utf8');

//OUTPUT Y SCL_DATA2 CONTIENEN LOS DATOS FINALES PARA SER UNIFICADOS

//CREAR RESPALDOS DE LAS TABLAS
$query = "CREATE OR REPLACE TABLE UNION_MOROSIDAD
            SELECT * FROM OUTPUT";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "CREATE OR REPLACE TABLE UNION_SCL
            SELECT * FROM SCL_DATA2";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

//SE TRABAJA CON LOS RESPALDOS UNION_MOROSIDAD Y UNION_SCL
//SE TRATA DE CONTRUIR EL LAYOUT FINAL EN AMBAS TABLAS
$query = "ALTER TABLE UNION_MOROSIDAD ADD tipo_moroso VARCHAR(255), ADD ciclo VARCHAR(255), ADD Segmento VARCHAR(255)";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "ALTER TABLE UNION_SCL ADD Sociedad VARCHAR(255) FIRST";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "ALTER TABLE UNION_SCL ADD emp VARCHAR(255) AFTER origen";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "ALTER TABLE UNION_SCL ADD cod_area INT AFTER codigo_tipo_documento";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "ALTER TABLE UNION_SCL ADD telefono VARCHAR(255) AFTER cod_area";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "ALTER TABLE UNION_SCL ADD Servicio VARCHAR(255) AFTER tramo";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

//renombrar atributos en UNION_SCL.
$query = "ALTER TABLE UNION_SCL CHANGE COLUMN Rut_Cliente rut_cliente VARCHAR(255)";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "ALTER TABLE UNION_SCL CHANGE COLUMN Codigo_cliente cliente VARCHAR(255)";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "ALTER TABLE UNION_SCL CHANGE COLUMN Nom_Cliente nom_cliente VARCHAR(255)";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "ALTER TABLE UNION_SCL CHANGE COLUMN codigo_tipo_documento cuenta VARCHAR(255)";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "ALTER TABLE UNION_SCL CHANGE COLUMN N_folio facturactc VARCHAR(255)";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "ALTER TABLE UNION_SCL CHANGE COLUMN Emision fec_emision DATE";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "ALTER TABLE UNION_SCL CHANGE COLUMN Vencimiento fec_vencimie DATE";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

//Ordenar los atributos en UNION_SCL
$query = "ALTER TABLE UNION_SCL MODIFY COLUMN tipo_moroso VARCHAR(255) AFTER Servicio";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "ALTER TABLE UNION_SCL MODIFY COLUMN nom_cliente VARCHAR(255) AFTER rut_cliente";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "ALTER TABLE UNION_SCL MODIFY COLUMN facturactc VARCHAR(255) AFTER nom_cliente";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "ALTER TABLE UNION_SCL MODIFY COLUMN importe BIGINT AFTER telefono";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "ALTER TABLE UNION_SCL MODIFY COLUMN grupo VARCHAR(255) AFTER importe";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "ALTER TABLE UNION_SCL MODIFY COLUMN analista VARCHAR(255) AFTER grupo";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "ALTER TABLE UNION_SCL MODIFY COLUMN dias_mora INT AFTER fec_vencimie";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "ALTER TABLE UNION_SCL MODIFY COLUMN tramo VARCHAR(255) AFTER dias_mora";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "ALTER TABLE UNION_SCL MODIFY COLUMN ciclo VARCHAR(255) AFTER tipo_moroso";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "ALTER TABLE UNION_SCL MODIFY COLUMN Segmento VARCHAR(255) AFTER ciclo";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

//Incorporacion de Detalles
$query = "UPDATE UNION_SCL SET Sociedad='TMOVIL'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE UNION_SCL SET emp='SCL'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE UNION_SCL SET Servicio='TELEFONIA MOVIL'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

//SE AGREGA cod_ciclo y Segmento al final del Informe
$query = "UPDATE UNION_MOROSIDAD INNER JOIN BACKUP_CICLO
ON UNION_MOROSIDAD.rut_cliente = BACKUP_CICLO.rut_cliente AND UNION_MOROSIDAD.facturactc = BACKUP_CICLO.facturactc AND UNION_MOROSIDAD.importe = BACKUP_CICLO.importe
SET UNION_MOROSIDAD.ciclo = BACKUP_CICLO.cod_ciclo";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE UNION_MOROSIDAD set Segmento='MAYORISTAS'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

//SE REALIZA LA UNION DE LAS TABLAS
$query = "CREATE OR REPLACE TABLE UNION_FINAL
(SELECT * FROM UNION_MOROSIDAD) UNION ALL (SELECT * FROM UNION_SCL)";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

header("Location: ../SalidaGUI.php");
 ?>
