<?php
//Conexion Base de datos
$conexion = mysqli_connect('localhost', 'root', 'hector123','Morosidad')
    or die('No se pudo conectar: ' . mysqli_error());
mysqli_set_charset($conexion,'utf8');

//BORRAR LINEAS VACIAS
$query = "DELETE FROM SCL_DATA WHERE importe='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

//BORRAR COLUMNAS QUE NO SEA NECESARIAS
// negocio, Empresa, Cia, cartea, num_cuota, sec_cuota,
// ant_proy, tramo_proy, provision.
$query = "ALTER TABLE SCL_DATA DROP negocio, DROP Empresa, DROP Cia, DROP cartera, DROP num_cuota, DROP sec_cuota,
          DROP ant_proy, DROP tramo_proy, DROP provision";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

//Agregar nuevas COLUMNAS
$query = "ALTER TABLE SCL_DATA ADD grupo VARCHAR(255), ADD analista VARCHAR(255), ADD dias_mora INT, ADD tramo VARCHAR(255)";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

//Buscar analistam Nom_Cliente y grupo en Base Operadora
$query = "CREATE OR REPLACE TABLE SCL_DATA2
            SELECT cl.origen,cl.tipo_moroso,cl.Rut_Cliente,cl.Codigo_cliente,base.Nombre as Nom_Cliente,cl.codigo_tipo_documento,cl.N_folio,
              cl.Emision,cl.Vencimiento,cl.importe,cl.ciclo,cl.Segmento,base.Grupo as grupo,base.NuevoAnalista as analista,cl.dias_mora,cl.tramo
              FROM SCL_DATA AS cl JOIN BaseOperadora AS base WHERE cl.Rut_Cliente=base.rut";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}


//Actualizar Fecha de Vencimiento = Fecha Emision + 30 dias.
$query = "UPDATE SCL_DATA2 SET Vencimiento=DATE_ADD(Emision, INTERVAL 30 DAY)";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}


//Calcular dias mora
$query = "UPDATE SCL_DATA2 SET dias_mora=DATEDIFF((SELECT fecha FROM FECHASCL), Vencimiento)";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

//calcular tramos segun dias_mora
/*dias_mora:
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
$query = "UPDATE SCL_DATA2 SET tramo='Vigente' WHERE dias_mora<'1'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE SCL_DATA2 SET tramo='1-30 dias' WHERE dias_mora<'31' AND dias_mora>='1'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE SCL_DATA2 SET tramo='31-60 dias' WHERE dias_mora<'61' AND dias_mora>='31'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE SCL_DATA2 SET tramo='61-90 dias' WHERE dias_mora<'91' AND dias_mora>='61'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE SCL_DATA2 SET tramo='91-120 dias' WHERE dias_mora<'121' AND dias_mora>='91'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE SCL_DATA2 SET tramo='121-150 dias' WHERE dias_mora<'151' AND dias_mora>='121'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE SCL_DATA2 SET tramo='151-180 dias' WHERE dias_mora<'181' AND dias_mora>='151'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE SCL_DATA2 SET tramo='181-365 dias' WHERE dias_mora<'366' AND dias_mora>='181'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE SCL_DATA2 SET tramo='1-3 años' WHERE dias_mora<'1096' AND dias_mora>='366'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE SCL_DATA2 SET tramo='3-5 años' WHERE dias_mora<'1826' AND dias_mora>='1096'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE SCL_DATA2 SET tramo='mas de 5 años' WHERE dias_mora>='1826'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

header("Location: UnionSCL.php");
 ?>
