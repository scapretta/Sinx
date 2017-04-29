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
include('./top.inc');
include('./menu.inc');

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");

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

$attivita = $_POST['rattivita'];
		if ($attivita == "rattivita")

 		{
   		echo "<center><b>Campo non selezionato</b></center>";
   		redirect('./InsAttivita.php',2);

		// break;
die ("");

		}

$Query_nome = "SELECT * FROM tb_primanota WHERE attivita = '$attivita' ORDER BY data_registr";

$rs=mysqli_query($connect, $Query_nome)
or die("Errore nella query $query: " . mysqli_error()); //die("<b>Errore:</b> Impossibile eseguire la query della Combo");

{
echo <<<EOM
<br><center><b> $attivita</center></b><br>
<hr style="width: 60%; height: 2px;">
<table align='center' border='0' cellpadding='0' cellspacing='2' width='60%'>
	<tr>
	<td height='40px' width='150' align='center'><small><b>id_primanota </b></small></td>
	<td width='150'><small><b>nome </b></small></td>
	<td width='150'><small><b>data_registr </b></small></td>
	<td width='150' align='right'><small><b>entrata </b></small></td>
	</tr>
	<tr><td></td></tr>
EOM;
}

while ($row=mysqli_fetch_array($rs))
{
echo <<<EOM
	<tr>
	<td height='30px' width='150' align='center'><small>$row[id_primanota]</small></td>
	<td width='150'><small>$row[nome]</small></td>
	<td width='150'><small>$row[data_registr]</small></td>
	<td width='150' align='right'><small>$row[entrata]</small></td>
	</tr>

EOM;
}

echo <<<EOT
</table>
EOT;
mysqli_close($connect);
include('./botton.inc');
} else {
header('Location: ./index.php');
}
?>
