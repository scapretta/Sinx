<?php
/*======================================================================+
 File name   : Cancella.php
 Begin       : 2010-08-04
 Last Update : 2013-03-27

 Description : Deleting data from the 'Prima Nota'

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

$Tabella = $_GET[Tabella];

if ($Tabella == 'tb_primanota') {
$Query_nome = "DELETE FROM $Tabella";
$rs=mysqli_query($connect, $Query_nome)
or die(header('location: ./errore.php?rif=InsPrimanota'));//"<b>Errore:</b> Impossibile eseguire la query della Combo");
header('location: ./conferma.php?rif=InsPrimanota'); //Vado alla pagina di conferma
} else if ($Tabella = 'tb_conto_economico' or 'tb_stato_patrimoniale') {
$Query_nome = "UPDATE $Tabella SET valore='0'";
$rs=mysqli_query($connect, $Query_nome)
or die(header('location: ./errore.php?rif=index2'));//"<b>Errore:</b> Impossibile eseguire la query della Combo");
header('location: ./conferma.php?rif=index2'); //Vado alla pagina di conferma
}

} else {
header('Location: ./index.php');
}
?>
