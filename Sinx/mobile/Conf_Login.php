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
$nuser = $_POST['usern'];
$passwd = MD5($_POST['passwd']);
$vers = $_POST['versione'];
$lang = $_POST['lang'];

include ('./dati_db.inc');
$connect = mysqli_connect("$host", "$username", "$password", "$db_name") or die ("cannot connect DB" . mysqli_connect_error());

$user = htmlspecialchars($nuser, ENT_NOQUOTES, "UTF-8");

  
	// verifico la presenza dei campi obbligatori
	if(!$user || !$passwd) {
		echo "Non hai inserito il nome o la password";
//		header("location: $_SERVER[PHP_SELF]?msg=$messaggio");
		exit;
	}


//Recupero il nome
$query = "SELECT nome FROM utenti where utente='$user' and pswd = '$passwd'";
$result = mysqli_query($connect,  $query);
	if (!$result) {
		die("Errore nella query $query: " . mysqli_error());
	}

$record = mysqli_fetch_array($result);

	if(!$record) {
		header("location: ./errore.php");
	} else {

  session_start();

		$_SESSION['utente'] = $record['nome'];
		$_SESSION['vers'] = $vers;
		$_SESSION['nome'] = $user;
		$_SESSION['lingua'] = $lang;
		header("location: ./index2.php");
	}

mysqli_close($connect);
?>
