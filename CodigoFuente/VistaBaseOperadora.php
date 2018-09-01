<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="StyleSheet" href="css/EstilosTablasGUI.css" type="text/css">
    <title>Vista Operadora</title>
  </head>
  <body>
    <?php
    //Conexion Base de datos
    $conexion = mysqli_connect('localhost', 'root', 'hector123','Morosidad')
        or die('No se pudo conectar: ' . mysqli_error());
    mysqli_set_charset($conexion,'utf8');

    $result = mysqli_query($conexion,"SELECT * FROM BaseOperadora");
    //se despliega el resultado
    echo "<table>";
    echo "<tr align='center'>";
    echo "<th>Rut</th>";
    echo "<th>Rut_1</th>";
    echo "<th>Rut_2</th>";
    echo "<th>IdSAP</th>";
    echo "<th>Acreedor</th>";
    echo "<th>Nombre</th>";
    echo "<th>Grupo</th>";
    echo "<th>Analista</th>";
    echo "<th>NuevoAnalista</th>";
    echo "<th>120</th>";
    echo "<th>188</th>";
    echo "<th>CAP</th>";
    echo "<th>Fija</th>";
    echo "<th>Móvil</th>";
    echo "<th>SCL</th>";
    echo "<th>ATIS</th>";
    echo "<th>SISCLI</th>";
    echo "<th>Rut_3</th>";
    echo "</tr>";

    while ($row = mysqli_fetch_row($result)){
        echo "<tr align='center'>";
        echo "<td>".$row[0]."</td>";
        echo "<td>".$row[1]."</td>";
        echo "<td>".$row[2]."</td>";
        echo "<td>".$row[3]."</td>";
        echo "<td>".$row[4]."</td>";
        echo "<td>".$row[5]."</td>";
        echo "<td>".$row[6]."</td>";
        echo "<td>".$row[7]."</td>";
        echo "<td>".$row[8]."</td>";
        echo "<td>".$row[9]."</td>";
        echo "<td>".$row[10]."</td>";
        echo "<td>".$row[11]."</td>";
        echo "<td>".$row[12]."</td>";
        echo "<td>".$row[13]."</td>";
        echo "<td>".$row[14]."</td>";
        echo "<td>".$row[15]."</td>";
        echo "<td>".$row[16]."</td>";
        echo "<td>".$row[17]."</td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "<br><br>";
    echo "<center><a href='index.php'>Volver al Inicio</a></center>";
    echo "<br>";
    ?>
  </body>
</html>
