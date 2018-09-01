<?php
//Conexion Base de datos
$conexion = mysqli_connect('localhost', 'root', 'hector123','Morosidad')
    or die('No se pudo conectar: ' . mysqli_error());
mysqli_set_charset($conexion,'utf8');
//echo 'Connected successfully'."<br>";

/*2.- Filtrar en columna origen:
        - Borrar etiqueta SAP, Refovo, 120.*/
        $query = "DELETE FROM FacturadorMinorista WHERE origen='SAP' or origen='Refovo' or origen='120'";
        mysqli_query($conexion,$query);
        //Comprobar posibles errores
        if(mysqli_error($conexion)){
        echo mysqli_error($conexion)."<br>";
       }
/*3.- cambiarse a columna emp:
      - Borrar EXE, LDD, SICC.*/
      $query = "DELETE FROM FacturadorMinorista WHERE emp='EXE' or emp='LDD' or emp='SICC'";
      mysqli_query($conexion,$query);
      //Comprobar posibles errores
      if(mysqli_error($conexion)){
      echo mysqli_error($conexion)."<br>";
     }
/*4.- borrar columna emp_ldd, emp_deuda, rut_cuenta, cod_tipdocum*/
      $query = "ALTER TABLE FacturadorMinorista DROP emp_ldd, DROP emp_deuda, DROP rut_cuenta, DROP cod_tipdocum";
      mysqli_query($conexion,$query);
      //Comprobar posibles errores
      if(mysqli_error($conexion)){
      echo mysqli_error($conexion)."<br>";
      }
/*5.- en columna des_tipdocum:
      - borrar devolucion, doc.autorizacion pago adelantado.*/
      $query = "DELETE FROM FacturadorMinorista WHERE des_tipdocum='DEVOLUCION' or des_tipdocum='DOC. AUTORIZACION PAGO ADELANTADO'";
      mysqli_query($conexion,$query);
      //Comprobar posibles errores
      if(mysqli_error($conexion)){
      echo mysqli_error($conexion)."<br>";
      }
/*6.- borrar des_tipdocum*/
      $query = "ALTER TABLE FacturadorMinorista DROP des_tipdocum";
      mysqli_query($conexion,$query);
      //Comprobar posibles errores
      if(mysqli_error($conexion)){
      echo mysqli_error($conexion)."<br>";
      }
/*7.- En columna num_folio y facturactc:
      - filtrar facturactc 188,181,SISCLI y pegar respectivo num_folio.*/
      $query = "UPDATE FacturadorMinorista SET facturactc=num_folio WHERE origen='188' or origen='181' or origen='SISCLI'";
      mysqli_query($conexion,$query);
      //Comprobar posibles errores
      if(mysqli_error($conexion)){
      echo mysqli_error($conexion)."<br>";
      }
/*8.- borrar num_docum*/
      $query = "ALTER TABLE FacturadorMinorista DROP n_documento";
      mysqli_query($conexion,$query);
      //Comprobar posibles errores
      if(mysqli_error($conexion)){
      echo mysqli_error($conexion)."<br>";
      }
/*9.- borrar tip_saldo*/
      $query = "ALTER TABLE FacturadorMinorista DROP tip_saldo";
      mysqli_query($conexion,$query);
      //Comprobar posibles errores
      if(mysqli_error($conexion)){
      echo mysqli_error($conexion)."<br>";
      }
/*10.- corregir fec_emision al formato dd-mm-yyyy*/
/*11.- corregir fec_vencimie al formato dd-mm-yyyy*/ //VER FECHAS EN OUTPUT FINAL.


//SE RESPALDA LOS DATOS DE segmento Y cod_ciclo
$query = "CREATE OR REPLACE TABLE BACKUP_CICLO
            SELECT rut_cliente,facturactc,importe,cod_ciclo,segmento
            FROM FacturadorMinorista";
mysqli_query($conexion,$query);
//Comprobar posibles errores
if(mysqli_error($conexion)){
echo mysqli_error($conexion)."<br>";
}

/*12.- borrar cod_ciclo*/
      $query = "ALTER TABLE FacturadorMinorista DROP cod_ciclo";
      mysqli_query($conexion,$query);
      //Comprobar posibles errores
      if(mysqli_error($conexion)){
      echo mysqli_error($conexion)."<br>";
      }
/*13.- borrar columnas ind_vigencia, num_aviso, num_cuota, estado_cuota, segmento.*/
      $query = "ALTER TABLE FacturadorMinorista DROP ind_vigencia, DROP num_aviso, DROP num_cuota, DROP estado_cuota, DROP segmento";
      mysqli_query($conexion,$query);
      //Comprobar posibles errores
      if(mysqli_error($conexion)){
      echo mysqli_error($conexion)."<br>";
      }
/*14.- borrar ant_proy, tramo_proy, prov_proy.*/
      $query = "ALTER TABLE FacturadorMinorista DROP ant_proy, DROP tramo_proy, DROP prov_proy";
      mysqli_query($conexion,$query);
      //Comprobar posibles errores
      if(mysqli_error($conexion)){
      echo mysqli_error($conexion)."<br>";
      }
/*15.- columna excluido filtrar y borrar registros F.*/
      $query = "DELETE FROM FacturadorMinorista WHERE excluido='F'";
      mysqli_query($conexion,$query);
      //Comprobar posibles errores
      if(mysqli_error($conexion)){
      echo mysqli_error($conexion)."<br>";
      }
/*16.- borrar excluido.*/
      $query = "ALTER TABLE FacturadorMinorista DROP excluido";
      mysqli_query($conexion,$query);
      //Comprobar posibles errores
      if(mysqli_error($conexion)){
      echo mysqli_error($conexion)."<br>";
      }
/*17.- borrar columna relacion.*/
/*18.- borrar columnas ejecutivo, fec_carga, carterizado, grupo.*/
      $query = "ALTER TABLE FacturadorMinorista DROP relacion, DROP ejecutivo, DROP fec_carga, DROP carterizado, DROP grupo2";
      mysqli_query($conexion,$query);
      //Comprobar posibles errores
      if(mysqli_error($conexion)){
      echo mysqli_error($conexion)."<br>";
      }
/*19.- agregar columna extra dias_mora y tramo.*/
      $query = "ALTER TABLE FacturadorMinorista ADD dias_mora INT, ADD tramo VARCHAR(255)";
      mysqli_query($conexion,$query);
      //Comprobar posibles errores
      if(mysqli_error($conexion)){
      echo mysqli_error($conexion)."<br>";
      }
/*20.- borrar todos los datos de la columna nom_cliente.*/
      $query = "UPDATE FacturadorMinorista SET nom_cliente=NULL";
      mysqli_query($conexion,$query);
      //Comprobar posibles errores
      if(mysqli_error($conexion)){
      echo mysqli_error($conexion)."<br>";
      }

/*21.- buscar segun columna rut_cliente en excel actual hacia la columna rut en BaseOperadora y traer datos de nom_cliente todos aquellos
registros que no encuentra, se borran.*/

      $query = "CREATE OR REPLACE TABLE FacturadorMinorista_2
                  SELECT f.origen,f.emp,f.cliente,f.cuenta,f.rut_cliente,base.Nombre,f.num_folio,f.facturactc,f.fec_emision,
                  f.fec_vencimie,f.importe,f.cod_area,f.telefono,f.grupo,f.analista,f.dias_mora,f.tramo
                  FROM FacturadorMinorista as f JOIN BaseOperadora as base
                  WHERE f.rut_cliente=base.rut";
      mysqli_query($conexion,$query);
      //Comprobar posibles errores
      if(mysqli_error($conexion)){
      echo mysqli_error($conexion)."<br>";
      }
/*22.- Filtrar en columna origen label ATIS, copiar y pegar en nueva hoja para un posterior trabajo manual.
22.- Filtrar en columna origen label ATIS, copiar y pegar en nueva hoja para un posterior trabajo manual.
23.- Borrar registros ATIS en columna origen.
24.- EN HOJA ATIS:
        - filtrar columna facturactc aquellas facturas repetidas y sumar los montos (fusionar en 1 registro)
        - generar una tabla con las siguientes columnas:
                - factura ctc
                - num_folio
                - rut_cliente
                - origen: siempre label ATIS
                - cliente
                - cuenta
                - nom_cliente
                - fec_emision: las fechas son las mismas para las facturas con numero repetidos.
                - fec_vencimie
                - cod_area
                - telefono
                - total (importe)
        - Copiar columnas en la hoja original en sus respectivos lugares (facturactc-facturactc)
25.- TERMINO DE LIMPIAR BASE MINORISTA.*/
      $query = "CREATE OR REPLACE TABLE FacturadorMinorista
                  SELECT f.origen,f.emp,f.cliente,f.cuenta,f.rut_cliente,f.Nombre as nom_cliente,f.num_folio,f.facturactc,f.fec_emision,
                  f.fec_vencimie,SUM(f.importe) as importe,f.cod_area,f.telefono,f.grupo,f.analista,f.dias_mora,f.tramo
                  FROM FacturadorMinorista_2 as f GROUP BY f.facturactc";

      mysqli_query($conexion,$query);
      //Comprobar posibles errores
      if(mysqli_error($conexion)){
      echo mysqli_error($conexion)."<br>";
      }

header("Location: OrdenarTabla.php");

?>
