<?php
//Conexion Base de datos
$conexion = mysqli_connect('localhost', 'root', 'hector123','Morosidad')
    or die('No se pudo conectar: ' . mysqli_error());
mysqli_set_charset($conexion,'utf8');


//Se crea una columna extra para evitar que las glosas se sobreescriban
$query = "ALTER TABLE OUTPUT ADD REFGLOSA INT DEFAULT '0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

//A CONTINUACION SE PROCEDE A HOMOLOGAR TODAS AQUELLAS GLOSAS QUE CUMPLEN CON EL PATRON DE LA EXPRESION REGULAR
//UTILIZANDO UN UPDATE SOBRE LA TABLA OUTPUT
$query = "UPDATE OUTPUT SET Servicio='CH. A FECHA' , REFGLOSA='1' WHERE cuenta='DZ' AND importe>'0' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='ABONO' , REFGLOSA='1' WHERE Servicio REGEXP 'ABONO.*|abono.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='ADIC. MAESTRO SUSC.' , REFGLOSA='1' WHERE Servicio REGEXP 'ADIC.* MAESTRO.* SUSC.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='ADM. PLAT. PPA LDI' , REFGLOSA='1' WHERE Servicio REGEXP 'ADM.* PLAT.* PPA LDI.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='ADM. Y SOPORTE' , REFGLOSA='1' WHERE Servicio REGEXP 'ADM.* Y SOP.+' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='APOYO EN POSTES' , REFGLOSA='1' WHERE Servicio REGEXP 'APOYO. EN (POSTES|TORRES)' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='ARRIENDO DE DUCTOS' , REFGLOSA='1' WHERE Servicio REGEXP 'ARRIENDO DE DUCTOS.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='ARRIENDO DE EQUIPOS' , REFGLOSA='1' WHERE Servicio REGEXP 'ARRIENDO ?D?E? EQUIPOS.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='ARRIENDO DE ESPACIOS' , REFGLOSA='1' WHERE Servicio REGEXP 'ARRIENDO ?D?E? ESPACIO.*|.*USUFRUCTO.*|Arriendo (esp.*|sitios.*)' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='CARGOS DE ACCESO' , REFGLOSA='1' WHERE Servicio REGEXP '.*C.* Acceso.*|^CA .*|.*CCAA.*|.*CC AA.*|CSMS .*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='CH. PROTESTADO' , REFGLOSA='1' WHERE Servicio REGEXP 'CH.* PROTESTADO.*|^ch.? .*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='CH. A FECHA' , REFGLOSA='1' WHERE Servicio REGEXP '..-..-..?.?. .* ?C?T?A? [0-9]+' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

$query = "UPDATE OUTPUT SET Servicio='ABONO' , REFGLOSA='1' WHERE cuenta='DZ' AND importe<'0' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='CLIMATIZACION' , REFGLOSA='1' WHERE Servicio REGEXP '.*CLIMATIZACI.N.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='COLOCALIZACION' , REFGLOSA='1' WHERE Servicio REGEXP '.*COLOCALIZA.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='COMUNICACIONES VOZ MOVIL' , REFGLOSA='1' WHERE Servicio REGEXP '.*COMUNICACIONES VOZ M.VIL.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='CRA ENTRADA' , REFGLOSA='1' WHERE Servicio REGEXP '.* CRA ENTRA.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='CRA SALIDA' , REFGLOSA='1' WHERE Servicio REGEXP '.* CRA SALI.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='DATOS 2G, 3G Y MMS' , REFGLOSA='1' WHERE Servicio REGEXP '.*DATOS 2G, 3G Y MMS.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='EMPALME ELECTRICO' , REFGLOSA='1' WHERE Servicio REGEXP 'EMPALME EL.CTRICO' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='ENERGIA' , REFGLOSA='1' WHERE Servicio REGEXP '.*ENERG.A.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='ESPACIOS' , REFGLOSA='1' WHERE Servicio REGEXP 'ESPACIO.' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='FACILIDADES' , REFGLOSA='1' WHERE Servicio REGEXP '.*FACILIDADES.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='FACTURA' , REFGLOSA='1' WHERE Servicio REGEXP '^FACTURA .*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='FACTURACION Y COBRANZA' , REFGLOSA='1' WHERE Servicio REGEXP 'FACTURACI.N Y COBRANZA' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='FUNCIONES ADMINISTRATIVAS' , REFGLOSA='1' WHERE Servicio REGEXP 'FUNCIONES ADMINISTRATIVAS.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='INFORME MENSUAL SUSC.' , REFGLOSA='1' WHERE Servicio REGEXP 'INFORME MENSUAL ?D?E? SUSC.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='MANTENCIÓN DE TERM.' , REFGLOSA='1' WHERE Servicio REGEXP 'MANTENCI.N DE TERM.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='MEGAVIA ADSL' , REFGLOSA='1' WHERE Servicio REGEXP 'MEGAV.A ?A?D?S?L?' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='NOTAS  DE CREDITOS EMITIDAS' , REFGLOSA='1' WHERE Servicio REGEXP 'NOTAS? ?D?E? CR.DITOS? EMITIDAS?' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='PAR DE COBRE' , REFGLOSA='1' WHERE Servicio REGEXP 'PAR DE COBRE' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='PREPAGO LDI' , REFGLOSA='1' WHERE Servicio REGEXP 'PREPAGO LDI' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='REFACTURACION' , REFGLOSA='1' WHERE Servicio REGEXP 'REFACTURACI.N.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='REVENTA PLANES' , REFGLOSA='1' WHERE Servicio REGEXP '.*REVENTA PLANES.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='ROAMING' , REFGLOSA='1' WHERE Servicio REGEXP '.*ROAMING .*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='SALDO' , REFGLOSA='1' WHERE Servicio REGEXP 'SALDO.*|SDO .*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='SERV. 1402' , REFGLOSA='1' WHERE Servicio REGEXP '.* 1402 .*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='SERV. 1403' , REFGLOSA='1' WHERE Servicio REGEXP '.* 1403 .*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='SERV. 1406' , REFGLOSA='1' WHERE Servicio REGEXP '.* 1406.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='SERV. 1414' , REFGLOSA='1' WHERE Servicio REGEXP '.* 1414.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='SERV. 800' , REFGLOSA='1' WHERE Servicio REGEXP '.* 800 .*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='SERVICIO LARGA DISTANCIA NAC. E INT.' , REFGLOSA='1' WHERE Servicio REGEXP 'SERVICIO LARGA DISTANCIA NAC. E INT.|SERVICIO DE INTERNET (NAC.*|INTERNACI.*)' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='SERVICIO NAP-ACCESO INTERNET' , REFGLOSA='1' WHERE Servicio REGEXP '.*NAP.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='SERVICIO PIT-ACCESO NACIONAL' , REFGLOSA='1' WHERE Servicio REGEXP '.*PIT.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='SMS ICX' , REFGLOSA='1' WHERE Servicio REGEXP 'SMS (ICX|INTERCOM.*)' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='TARJETAS TRONCALES' , REFGLOSA='1' WHERE Servicio REGEXP '.*TARJETAS TRONCALES.*|.*Tarj. Troncal.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='TRAFICO CONMUTADO LDI' , REFGLOSA='1' WHERE Servicio REGEXP 'TRAFICO CONMUTADO LDI.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='TRAFICO CONMUTADO LDN' , REFGLOSA='1' WHERE Servicio REGEXP 'TRAFICO CONMUTADO LDN.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='TRAFICO DATOS 4G' , REFGLOSA='1' WHERE Servicio REGEXP '.*TRAFICO DATOS 4G.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='USO ENERGIA' , REFGLOSA='1' WHERE Servicio REGEXP 'USO ENERGIA.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='ENLACES' , REFGLOSA='1' WHERE Servicio REGEXP 'ENLACES?.*|.*ENLACES?.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='VOZ ENTRADA OMV' , REFGLOSA='1' WHERE Servicio REGEXP '.*VOZ ENTRADA.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='USSD OMV' , REFGLOSA='1' WHERE Servicio REGEXP '.*OMV_USSD.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='CLDI - SALIDA LDI' , REFGLOSA='1' WHERE Servicio REGEXP '.*CLDI - SALIDA LDI.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='CLDI - ENTRADA LDI' , REFGLOSA='1' WHERE Servicio REGEXP '.*CLDI - ENTRADA LDI.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='FRANQUICIA' , REFGLOSA='1' WHERE Servicio REGEXP '.*OMV_Franquicia.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='DESCUENTO ESPECIAL' , REFGLOSA='1' WHERE Servicio REGEXP '.*Descuento especial.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='SMS ICX' , REFGLOSA='1' WHERE Servicio REGEXP '.*OMV_Mensajes de Texto.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='REVENTA PLANES' , REFGLOSA='1' WHERE Servicio REGEXP '.*OMV_Reventa Plan.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='TRAFICO DATOS' , REFGLOSA='1' WHERE Servicio REGEXP '.*OMV_Trafico Datos.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='TRAFICO DATOS 4G' , REFGLOSA='1' WHERE Servicio REGEXP '.*OMV_Trafico Datos.*3G.*y.*4G.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}
$query = "UPDATE OUTPUT SET Servicio='BACKBONE' , REFGLOSA='1' WHERE Servicio REGEXP '.*Backbon.*' AND REFGLOSA='0'";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

//Se crea una columna extra para evitar que las glosas se sobreescriban
$query = "ALTER TABLE OUTPUT DROP REFGLOSA";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

header("Location: MoraEspecial.php");
 ?>
