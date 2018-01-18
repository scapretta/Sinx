<?php
/*======================================================================+
 File name   : index2.php
 Begin       : 2010-08-04
 Last Update : 2012-08-27

 Description : The sinx's first page

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
$nutente = $_SESSION['nome'];
$langu = $_SESSION['lingua'];
$paginaindex2 = "index2.inc";
$linguaindex2 = ($langu.$paginaindex2);
include($linguaindex2);

if ($user) {
include('./top.inc');
include('./menu.inc');

	include ('./dati_db.inc');
	$link=mysqli_connect("$host", "$username", "$password","$db_name")or die(mysqli_connect_error("Non posso connettermi al database"));


?>
<h2><? echo $Lbenvenuto.chr(32).$nutente; ?></h2>

      <div style="margin-left: 20px;"><small><? echo $Lfrase; ?></center></div></small>
<?php

//Funzione compleanno
$compleanno = date('j-m');
$compleanno2 = date('d-n');
$oggi = date("j-n-Y");

$query = "SELECT nome
	FROM tb_anagrafe
	WHERE datan REGEXP '^$compleanno2' OR datan REGEXP '^$compleanno'
	ORDER BY id_anagrafe";

$rs=@mysqli_query($link, $query) or die("<b>Errore:</b> Impossibile eseguire la query della Combo");
while($row=mysqli_fetch_array($rs,MYSQLI_ASSOC))
{
  if($row)
  {
    echo "<br><h3>Oggi <i>".$row['nome']."</i> compie gli anni</h3>";
    }
}

//Funzione appuntamenti
$Query = "SELECT * FROM appuntamenti WHERE str_data='$oggi'";
$rss=@mysqli_query($link, $Query) or die('errore' . mysql_error());

while ($roww=mysqli_fetch_array($rss,MYSQLI_ASSOC))
{

if($roww)
    {
    echo "<h3>Appuntamenti di oggi: ".$roww['titolo']."</h3>";
    }
}
// Blocco Note
$Query_nome = "SELECT * FROM tb_note";

$rs=@mysqli_query($link, $Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");
$row=mysqli_fetch_array($rs,MYSQLI_ASSOC);

?>
<center><h3><? echo $Lptitolonote; ?></h3></center>

<!-- Visualizza -->
     <p align="center"><b><? echo $Lcompnote; ?></b></p>
<table align='center' border='0' width='70%'>
<tbody>
	<tr>
	 <td height='100%' width='38%'>
	  <small>
	   <center>
		<? echo $Ldescrizionenote;?>
	   </center>
	   <br><b>
		<? echo $row[dest];?>
	   </b>
	  </small>
	 </td>
	</tr>
	<tr>
	  <td><textarea name='formcontent' rows="5" cols="100%" readonly><? echo $row[testo] ?></textarea></td>
	</tr>
</table>
<?php
@mysqli_close($link);
include('./menusx.inc');
echo $Lhelpindex2;
include('./botton.inc');
} else {
header('Location: ./index.php');
}

?>

