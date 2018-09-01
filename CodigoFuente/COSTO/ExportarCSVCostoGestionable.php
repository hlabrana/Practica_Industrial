<?php
session_start();
/* vars for export */
// database record to be exported
$db_record = 'COSTO_GESTIONABLE';
// optional where query
$where = 'WHERE 1 ORDER BY 1';
// filename for export
$csv_filename = 'Morosidad_Costos_Gestionable_'.$_SESSION["DATECOSTO"].'.csv';
// database variables
$hostname = "localhost";
$user = "root";
$password = "hector123";
$database = "Morosidad";
$port = 3306;
$conn = mysqli_connect($hostname, $user, $password, $database, $port);
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}
// create empty variable to be filled with export data
$csv_export = '';
// query to get data from database
$query = mysqli_query($conn, "SELECT * FROM ".$db_record." ".$where);
$field = mysqli_field_count($conn);
// create line with field names
for($i = 0; $i < $field; $i++) {
    $csv_export.= mysqli_fetch_field_direct($query, $i)->name.';';
}
// newline (seems to work both on Linux & Windows servers)
$csv_export.= '
';
// loop through database query and fill export variable
while($row = mysqli_fetch_array($query)) {
    // create line with field values
    for($i = 0; $i < $field; $i++) {
        if($i == 15){//FORMATO DE IMPORTE CON SEPARADOR DE MILES
          $csv_export.= '"'.number_format($row[mysqli_fetch_field_direct($query, $i)->name],0,',','.').'";';
        }
        else{
          if($i == 23){
            $csv_export.= '"'.rtrim($row[mysqli_fetch_field_direct($query, $i)->name]," \n\t\r").'";';
          }
          else{
          $csv_export.= '"'.$row[mysqli_fetch_field_direct($query, $i)->name].'";';
          }
        }
    }
    $csv_export.= '
';
}
// Export the data and prompt a csv file for download
header("Content-type: text/x-csv");
header("Content-Disposition: attachment; filename=".$csv_filename."");
echo($csv_export);
?>
