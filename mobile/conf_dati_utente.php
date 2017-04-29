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
if ($user) {
	$nnome = $_POST['nomeut'];
	$nlivello = $_POST['livello'];
	$passwd = $_POST['passwd'];

//escape html
$nome = htmlspecialchars($nnome, ENT_NOQUOTES, "UTF-8");
$livello = htmlspecialchars($nlivello, ENT_NOQUOTES, "UTF-8");


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

//Controllo campi compilati
		if ($nome == "")
 		{
   		echo "<center><b>Il campo nome &egrave obbligatorio</b></center>";
   		redirect('./InsUtente.php' ,2);
		// break;
die ("");
		}
		if ($livello == "")
 		{
   		echo "<center><b>Il campo livello &egrave obbligatorio</b></center>";
   		redirect('./InsUtente.php' ,2);
		// break;
die ("");
		}
		if ($passwd == "")
 		{
   		echo "<center><b>Il campo password &egrave obbligatorio</b></center>";
   		redirect('./InsUtente.php' ,2);
		// break;
die ("");
		}
		$valid = preg_match('/[a-zA-Z0-9]{4,20}/', $nome);
		if (!$valid)
		{
		echo "<center><b>Il campo nome non pu&ograve contenere simboli e deve avere da 4 a 20 caratteri</b></center>";
   		redirect('./InsUtente.php' ,3);
		// break;
die ("");
		}

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");

$tb_utenti = ('utenti(utente, nome, pswd)');
	if ($nome){ 

		$sql="insert into $tb_utenti values('$nome', '$livello', MD5('$passwd'))"; //inserisco i valori nel database
		$result=mysqli_query($connect, $sql);
		header('location: ./conferma.php?rif=InsUtente'); //Vado alla pagina di conferma
	}else{ 
		header('location: ./errore.php?rif=InsUtente'); //Vado alla pagina di errore
		}
mysqli_close($connect);
} else {
header('Location: ./index.php');
}
?>
