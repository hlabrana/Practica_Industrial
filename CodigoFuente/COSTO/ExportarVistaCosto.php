<?php
session_start();
/* vars for export */
// database record to be exported
$db_record = 'VISTA_RESUMEN_COSTO';
// optional where query
$where = 'ORDER BY totalgeneral ASC';
// filename for export
$csv_filename = 'Resumen_Grupos_Costo_'.$_SESSION["DATECOSTO"].'.csv';
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
$anio = utf8_decode(" años");
$dia = utf8_decode(" días");
$csv_export.= 'Grupo;Vigente;1-30'.$dia.';31-60'.$dia.';61-90'.$dia.';91-120'.$dia.';121-150'.$dia.';151-180'.$dia.';181-365'.$dia.';1-3'.$anio.';3-5'.$anio.';mas de 5'.$anio.';Total General';
// newline (seems to work both on Linux & Windows servers)
$csv_export.= '
';
// loop through database query and fill export variable
while($row = mysqli_fetch_array($query)) {
    // create line with field values
    for($i = 0; $i < $field; $i++) {
        if($i > 0){//FORMATO DE IMPORTE CON SEPARADOR DE MILES
          if($i == 12){
            $string = 'Total General';
            if(strcmp($row[mysqli_fetch_field_direct($query,0)->name],$string) == 0){
              $Sinsigno = $row[mysqli_fetch_field_direct($query, $i)->name]*-1;
              $csv_export.= '"'.number_format(rtrim($Sinsigno," \n\t\r"),0,',','.').'";';
            }
            else{
              $csv_export.= '"'.number_format(rtrim($row[mysqli_fetch_field_direct($query, $i)->name]," \n\t\r"),0,',','.').'";';
            }
          }
          else{
            if($row[mysqli_fetch_field_direct($query, $i)->name]==0){
              $csv_export.=';';//Para que no se exporten los ceros
            }
            else{
              $csv_export.= '"'.number_format($row[mysqli_fetch_field_direct($query, $i)->name],0,',','.').'";';
            }
          }
        }
        else{//Para columna Grupo - SIN SEPARADOR DE MILES
          $csv_export.= '"'.$row[mysqli_fetch_field_direct($query, $i)->name].'";';
        }
    }
    $csv_export.= '
';
}
// Export the data and prompt a csv file for download
header("Content-type: text/x-csv; charset=utf-8");
header("Content-Disposition: attachment; filename=".$csv_filename."");
echo($csv_export);

?>
