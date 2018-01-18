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
include('./dati_posta.inc');

echo("<center><h2>Messaggi ricevuti sulla casella <i>$mailer</i></h2></center>");
echo("<center><small><sub><i>In questa pagina puoi solamente visualizzare gli ultimi 30 messaggi</i></sub></small></center>");

if($inbox=@imap_open("{".$pop3."/pop3:110}INBOX", $username, $password)){ 

	$messaggi_totali=imap_num_msg($inbox);
if($messaggi_totali > 0)
{
	echo "<b>Totale messaggi:</b> $messaggi_totali<br/><br/>";
echo <<<html
	<table align='center' border='0' cellpadding='' cellspacing='2' width='90%'>
	<tr>
	<td width='25%'><small><b>Mittente: </b></small></td>
	<td width='50%'><small><b>Oggetto: </b></small></td>
	<td widyh='25%'><small><b>Data: </b></small></td>
	</tr>
html;

	for($m=30; $m>0; $m--){
		$headers=imap_header($inbox, $m);
		$mittente= $headers->fromaddress; 
		$oggetto=$headers->subject;
		$data=date("j/n/Y G:i:s",strtotime($headers->date));

//Limito il numero di caratteri nel messaggio
$numero_caratteri = 20;
if(strlen(trim($oggetto))>$numero_caratteri)
{
    $testo = substr($oggetto,0,strpos($oggetto,' ',$numero_caratteri)).'...';
}
else
{
    $testo = $oggetto;
}


echo <<<EOM

	<tr>
	<td width='25%'><small>$mittente</small></td>
	<td width='50%'><small>$testo</small></td>
	<td widyh='25%'><small>$data</small></td>
	</tr>

EOM;
	}
echo("</table><br>");
}else{
echo ("<h3><center>Non ci sono messaggi</center></h3>");
}
}else{
	echo "Impossibile connettersi all'account mail selezionato";
}
?>
<table align='center'>
<tr>
<td><a href='./Comp_email.php'><img src="./ImmTemplate/Pulsanti/Email.png" onMouseOver="this.src='./ImmTemplate/Pulsanti/Email2.png'" onMouseOut="this.src='./ImmTemplate/Pulsanti/Email.png'" title="Ritorna alla posta"></img></a></td>
</tr>
</table>
<?php
imap_close($inbox);
mysqli_close($connect);
include('./menusx.inc');
include('./botton.inc');
} else {
header('Location: ./index.php');
}
?>
