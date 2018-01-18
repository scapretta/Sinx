<?php
/*======================================================================+
 File name   : InsFattura.php
 Begin       : 2016-08-04
 Last Update : 2016-08-08

 Description : Notepad

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
$langinsnote = $_SESSION['lingua'];
$paginainsnote = "insnote.inc";
$linguainsnote = ($langinsnote.$paginainsnote);
include($linguainsnote);

if ($user == 'admin') {
  $limit='';
} else if ($user == 'limitato') {
  $limit='disabled';
} else if ($user == 'operatore') {
  $limit='';
} else if ($user == 'associato') {
  $limite='disabled';
}

include('./top.inc');
include('./menu.inc');

	include ('./dati_db.inc');
	$link=mysqli_connect("$host", "$username", "$password","$db_name")or die(mysqli_connect_error("Non posso connettermi al database"));

//Note pubbliche

$Query_nome = "SELECT * FROM tb_note";

$rs=mysqli_query($link, $Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");


echo <<<EOT
<center><h3>$Lptitolonote</h3></center>

<!-- Compilazione nuovo progetto -->
     <p align="center"><b>$Lcompnote</b></p>

<br>
       <form action='./conf_note.php' method='POST' enctype="multipart/form-data">

<table align='center' border='0' width='80%'>
<tbody>
	<tr>
	 <td height='100%' width='38%'><small>$Ldescrizione</small></td>
	</tr>
EOT;
$row=mysqli_fetch_array($rs,MYSQLI_ASSOC);

echo <<<EOM

	<tr>
	  <td><input name='nome' size='10%' type='text' value='$row[dest]'></td>
	</tr>
	<tr>
	  <td><textarea name='formcontent' rows="20" cols="100%" >$row[testo]</textarea></td>
	</tr>
EOM;
 ?>
</table>

        <table align='center' border='0' width='30%'>
            <tr>
              <td colspan='2' align='center'>
              <input value='- Registra Nota -' type='submit'<? echo($limit);?>></td>
            </tr>
      </tbody>
	</table>
    </form>


<?php
mysqli_close($link);
include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i><? echo $Lhelpnote; ?>
<hr></i></small><?
include('./botton.inc');

?>
