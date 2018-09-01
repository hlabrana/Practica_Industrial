<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ID Acreedor</title>
  </head>
  <body>
    <?php
    //Conexion Base de datos
    $conexion = mysqli_connect('localhost', 'root', 'hector123','Morosidad')
        or die('No se pudo conectar: ' . mysqli_error());
    mysqli_set_charset($conexion,'utf8');
    echo "<center>";
    $result = mysqli_query($conexion,"SELECT Acreedor FROM BaseOperadora WHERE Acreedor!=' ' OR Acreedor!='0'");
    //se despliega el resultado
    echo "<table border='0' style='font-size:12px'>";
    echo "<tr align='center'>";
    echo "<th>Id Acreedor</th>";
    echo "</tr>";

    while ($row = mysqli_fetch_row($result)){
        echo "<tr align='center'>";
        echo "<td>".$row[0]."</td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "<br><br>";
    echo "<a href='index.php'>Volver al Inicio</a></center>";
    echo "<br>";

    ?>
  </body>
</html>
