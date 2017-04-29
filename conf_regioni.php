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

	$nome = $_POST['nome'];
	$id = $_POST['id'];

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
	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");

//CONTROLLO DEI CAMPI

 
		$sql="UPDATE regioni SET nome_regione='$nome' WHERE id_reg = '$id'"; //inserisco i valori nel database
		$result=mysqli_query($connect, $sql);

	if (!$result) {
        header('location: errore.php?rif=Scheda_regioni'); //Vado alla pagina di errore
	}else{ 
		header('location: ./conferma.php?rif=Scheda_regioni'); //Vado alla pagina di conferma
		}
mysqli_close($connect);
} else {
header('Location: ./index.php');
}
?>
