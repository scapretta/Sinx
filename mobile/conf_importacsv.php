<?php
/*======================================================================+
 File name   : conf_importacsv.php
 Begin       : 2014-02-02
 Last Update : 2014-02-02

 Description : confirm import file csv

 Author: Sergio Capretta

 (c) Copyright:
               Sergio Capretta
             

               ITALY
               www.sinx.it
               info@sinx.it

Sinx for Association - Gestionale per Associazioni no-profit
    Copyright (C) 2011 by Sergio Capretta

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
=========================================================================+*/

  session_start();

$user = $_SESSION['utente'];
if ($user) {

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");
	
	//Funzione per il redirect
function redirect($url,$tempo = FALSE ){
 if(!headers_sent() && $tempo == FALSE ){
  header('Location:' . $url);
 }elseif(!headers_sent() && $tempo != FALSE ){
  header('Refresh:' . $tempo . ';' . $url);
 }else{
  if($tempo == FALSE ){
    $tempo = 0;
  }
  echo "<meta http-equiv=\"refresh\" content=\"" . $tempo . ";" . $url . "\">";
  }
} 
	
// Recupero il file
$upload_dir = "./tmp";
if(@is_uploaded_file($_FILES["filecsv"]["tmp_name"])) {
$file_name = $_FILES["filecsv"]["name"];
@move_uploaded_file($_FILES["filecsv"]["tmp_name"], "$upload_dir/$file_name")
or die("Impossibile spostare il file, controlla l'esistenza o i permessi della directory dove fare l'upload.");

$file = file("./$upload_dir/$file_name");

		// Creo una query di inserimento e la eseguo
		
		if ($file){ 
	define('CSV_PATH',"$_SERVER['DOCUMENT_ROOT']");
	// path where your CSV file is located
	 
	$csv_file = CSV_PATH . "/tmp/test.csv"; // Name of your CSV file
	$csvfile = fopen($csv_file, 'r');
	$theData = fgets($csvfile);
	$i = 0;
	while (!feof($csvfile)) {
	$csv_data[] = fgets($csvfile, 1024);
	$csv_array = explode(";", $csv_data[$i]);
	$insert_csv = array();
	$insert_csv['id_anagrafe'] = $csv_array[0];
	$insert_csv['nome'] = $csv_array[1];
	$insert_csv['cognome'] = $csv_array[2];
	$insert_csv['indirizzo'] = $csv_array[3];
	$insert_csv['cap'] = $csv_array[4];
	$insert_csv['citta'] = $csv_array[5];
	$insert_csv['provincia'] = $csv_array[6];
	$insert_csv['tel'] = $csv_array[7];
	$insert_csv['tel2'] = $csv_array[8];
	$insert_csv['datan'] = $csv_array[9];
	$insert_csv['classe'] = $csv_array[10];
	$insert_csv['nomerif'] = $csv_array[11];
	$insert_csv['materia'] = $csv_array[12];
	$insert_csv['mansione'] = $csv_array[13];
	$insert_csv['email'] = $csv_array[14];
	$insert_csv['tipologia'] = $csv_array[15];
	$insert_csv['note'] = $csv_array[16];
	$insert_csv['immagine'] = $csv_array[17];
	$insert_csv['associato'] = $csv_array[18];
	$query = "INSERT INTO id_anagrafe(nome,cognome,indirizzo,cap,citta,provincia,tel,tel2,datan,classe,nomerif,materia,mansione,email,tipologia,note,immagine,associato)
	VALUES('".$insert_csv['nome']."','".$insert_csv['cognome']."','".$insert_csv['indirizzo']."','".$insert_csv['cap']."','".$insert_csv['citta']."','".$insert_csv['provincia']."','".$insert_csv['tel']."','".$insert_csv['tel2']."','".$insert_csv['datan']."','".$insert_csv['classe']."','".$insert_csv['nomerif']."','".$insert_csv['materia']."','".$insert_csv['mansione']."','".$insert_csv['email']."','".$insert_csv['tipologia']."','".$insert_csv['note']."','".$insert_csv['immagine']."','".$insert_csv['associato']."')";
	$n=mysqli_query($connect, $query, $connect );
	$i++;
	}
	fclose($csvfile);

	header('location: ./conferma.php?rif=Rubrica'); //Vado alla pagina di conferma
	}else{ 
		header('location: ./errore.php?rif=importacsv'); //Vado alla pagina di errore
		}
	}
mysqli_close($connect);
} else {
header('Location: ./index.php');
}
?>
