<?php
/*======================================================================+
 File name   : conf_dati_utente_install.php
 Begin       : 2013-01-09
 Last Update : 2013-01-13

 Description : Confirm step 1 to install software

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
=========================================================================+
*/

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
   		redirect('./index.php' ,2);
		break;
		}
		if ($livello == "")
 		{
   		echo "<center><b>Il campo livello &egrave obbligatorio</b></center>";
   		redirect('./index.php' ,2);
		break;
		}
		if ($passwd == "")
 		{
   		echo "<center><b>Il campo password &egrave obbligatorio</b></center>";
   		redirect('./index.php' ,2);
		break;
		}

	include ('../dati_db.inc');
	$link=mysqli_connect("$host", "$username", "$password","$db_name")or die(mysqli_connect_error("Non posso connettermi al database"));

$tb_utenti = ('utenti(utente, nome, pswd)');
	if ($nome){ 

		$sql="insert into $tb_utenti values('$nome', '$livello', MD5('$passwd'))"; //inserisco i valori nel database
		$result=mysqli_query($link, $sql);
		echo("Registrazione effettuata");
		redirect('./Install2.php' ,2); //Vado alla pagina di conferma
	}else{ 
		header('location: ../errore.html'); //Vado alla pagina di errore
		}
mysqli_close($link);



?>
