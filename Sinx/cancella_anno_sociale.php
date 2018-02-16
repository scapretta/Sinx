<?php
/*======================================================================+
 File name   : cancella_anno_sociale.php
 Begin       : 2012-12-29
 Last Update : 2013-01-13

 Description : delete social year

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

  session_start();

$user = $_SESSION['utente'];
if ($user) {
	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");


$tabelle = array('tb_primanota','tb_ricevute','tb_fatture','tb_tot_fatture');
foreach($tabelle as $tabella)
 mysqli_query($connect, "truncate $tabella") or die(header('location: ./errore.php?rif=index2'));//"<b>Errore:</b> Impossibile eseguire la query della Combo"

$tabelle2 = array('tb_conto_economico','tb_stato_patrimoniale');
foreach($tabelle2 as $tabella)
 mysqli_query($connect, "UPDATE $tabella SET valore='0'") or die(header('location: ./errore.php?rif=index2'));//"<b>Errore:</b> Impossibile eseguire la query della Combo"

header('location: ./conferma.php?rif=index2'); //Vado alla pagina di conferma
} else {
header('Location: ./index.php');
}
?>
