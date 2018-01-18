<?php
/*Sinx for Association - Gestionale per Associazioni no-profit
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
*/


  session_start();

$user = $_SESSION['utente'];
if ($user == 'admin') {

	include ('dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");

//elimino tutti i dati delle tabelle
$tabelle = array('tb_primanota','tb_ricevute','tb_fatture','tb_tot_fatture','tb_conto_economico','tb_stato_patrimoniale','appuntamenti','comuni','province','regioni','tb_anagrafe_associaz','tb_anagrafe','tb_classe','tb_email','tb_materia','utenti');
foreach($tabelle as $tabella)
 mysqli_query($connect, "truncate $tabella") or die(header('location: ./errore.html'));//"<b>Errore:</b> Impossibile eseguire la query della Combo"


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

//Carico il file nella dir temporanea tmp
$upload_dir = "tmp";
if(@is_uploaded_file($_FILES["backup"]["tmp_name"])) {
$file_name = $_FILES["backup"]["name"];
@move_uploaded_file($_FILES["backup"]["tmp_name"], "$upload_dir/$file_name")
or die("Impossibile spostare il file, controlla l'esistenza o i permessi della directory dove fare l'upload.");

} else {

echo "<center><h2>Problemi nell'upload del file immagine</h2></center>" . $_FILES["immagine"]["name"];
redirect('Location: ./Rip_database.php' ,2);
// break;
die ("");
} 

//Leggo il file
$file = fopen("$upload_dir/$file_name", "r") or exit("Impossibile aprire il file! $upload_dir/$file_name");
//Fino a che ha raggiunto la fine fai un output della riga
while(!feof($file))
  {
  $sql = fgets($file);
  if($sql <> "")
  		$result = mysqli_query($connect, $sql);
  }
fclose($file);

//elimino il file
if(file_exists("$upload_dir/$file_name") && is_file("$upload_dir/$file_name")) {
		unlink("$upload_dir/$file_name");
	}
header('location: ./conferma.php?rif=index2');
mysqli_close($connect);

} else {
header('Location: index.php');
}
?>
