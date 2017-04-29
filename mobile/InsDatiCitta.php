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
;
	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");
 $q_str = INSERT INTO tb_citta(citta) VALUES ($citta);
	$result = mysqli_query($connect, $q_str);
	if (!$result) {
	die("Errore nella query $query: " . mysqli_error());
}
$id_inserito = mysqli_insert_id();
mysqli_close($connect);
$messaggio = urlencode("Inserimento effettuato con successo (ID=$id_inserito)");
header('location: '.$_SERVER['PHP_SELF'].'?msg='.$messaggio);
} else {
header('Location: ./index.php');
}
?>
