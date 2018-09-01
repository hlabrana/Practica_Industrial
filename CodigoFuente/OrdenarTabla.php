<?php

//Conexion Base de datos
$conexion = mysqli_connect('localhost', 'root', 'hector123','Morosidad')
    or die('No se pudo conectar: ' . mysqli_error());
mysqli_set_charset($conexion,'utf8');

  $query = "ALTER TABLE FacturadorMinorista MODIFY COLUMN rut_cliente VARCHAR(255) AFTER emp";
  mysqli_query($conexion,$query);
  //Comprobar posibles errores
  if(mysqli_error($conexion)){
  echo mysqli_error($conexion)."<br>";
  }

  $query = "ALTER TABLE FacturadorMinorista MODIFY COLUMN nom_cliente VARCHAR(255) AFTER rut_cliente";
  mysqli_query($conexion,$query);
  //Comprobar posibles errores
  if(mysqli_error($conexion)){
  echo mysqli_error($conexion)."<br>";
  }

  $query = "ALTER TABLE FacturadorMinorista MODIFY COLUMN facturactc INT AFTER nom_cliente";
  mysqli_query($conexion,$query);
  //Comprobar posibles errores
  if(mysqli_error($conexion)){
  echo mysqli_error($conexion)."<br>";
  }

  $query = "ALTER TABLE FacturadorMinorista MODIFY COLUMN cod_area INT AFTER cuenta";
  mysqli_query($conexion,$query);
  //Comprobar posibles errores
  if(mysqli_error($conexion)){
  echo mysqli_error($conexion)."<br>";
  }

  $query = "ALTER TABLE FacturadorMinorista MODIFY COLUMN telefono VARCHAR(255) AFTER cod_area";
  mysqli_query($conexion,$query);
  //Comprobar posibles errores
  if(mysqli_error($conexion)){
  echo mysqli_error($conexion)."<br>";
  }

  $query = "ALTER TABLE FacturadorMinorista MODIFY COLUMN importe INT AFTER telefono";
  mysqli_query($conexion,$query);
  //Comprobar posibles errores
  if(mysqli_error($conexion)){
  echo mysqli_error($conexion)."<br>";
  }

  $query = "ALTER TABLE FacturadorMinorista MODIFY COLUMN grupo VARCHAR(255) AFTER importe";
  mysqli_query($conexion,$query);
  //Comprobar posibles errores
  if(mysqli_error($conexion)){
  echo mysqli_error($conexion)."<br>";
  }

  $query = "ALTER TABLE FacturadorMinorista MODIFY COLUMN analista VARCHAR(255) AFTER grupo";
  mysqli_query($conexion,$query);
  //Comprobar posibles errores
  if(mysqli_error($conexion)){
  echo mysqli_error($conexion)."<br>";
  }

header("Location: LimpiezaSAP.php");
?>
