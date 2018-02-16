<?php
/*======================================================================+
 File name   : Install.php
 Begin       : 2013-01-09
 Last Update : 2013-01-13

 Description : step 1 to install software

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


echo("<h2><center>Aggiornamento Database</center></h2>");

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ); 
	if(!$connect) die("cannot connect DB");
	
//Modifica tabella fatture
$sql = "ALTER TABLE `tb_fatture` MODIFY COLUMN descr VARCHAR(200)";

$result = mysqli_query($connect, $sql); 
if (!$result) { 
echo mysqli_error(); 
} else { 
echo "<p><center><img src='./Immagini/dialog_ok_apply.png' height='20px'>Tabella Fatture colonna descrizione<b> aggiornata</b></center></p>"; 
} 

$sql = "ALTER TABLE `tb_fatture` MODIFY COLUMN modpaga VARCHAR(500)";

$result = mysqli_query($connect, $sql); 
if (!$result) { 
echo "Impossibile modificare la tabella<br>"; 
} else { 
echo "<p><center><img src='./Immagini/dialog_ok_apply.png' height='20px'>Tabella Fatture colonna modifica di pagamento<b> aggiornata</b></center></p>"; 
echo "<p><center><h4>AGGIORNAMENTO DATABASE COMPLETATO</h4></center></p>";
} 
  


mysqli_close($connect);

include('./botton.inc');

?>
<center><a href='./index.php'>Torna alla home</a></center>