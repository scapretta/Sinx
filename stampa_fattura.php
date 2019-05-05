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
include('./Intestazione.php');

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

$fattura = $_POST['id'];
//Controllo dati
		if ($fattura == "")
 		{
   		echo "<center><b>Numero fattura non selezionato</b><br>Inserisci un numero di fattura</center>";
   		redirect('./InsFattura.php',2);
		// break;
die ("");
		}

$dataoggi = date('d-m-Y');

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");

$Query_nome = "SELECT nome FROM tb_fatture WHERE id_fatt = $fattura LIMIT 1";

$rs=mysqli_query($connect, $Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($row=mysqli_fetch_array($rs))
{
$nomecl = $row['nome'];
}
?>
<table align='right' border='0' cellpadding='2' cellspacing='2' width='90%'>
 <tr>
  <td><small>Fattura n. <b><?php echo($fattura) ?></b> del: <b><?php echo($dataoggi) ?></b></small></td>
 </tr>
</table>
<?php
$query_cliente = "SELECT nome, indirizzo, cap, citta, provincia, nomerif FROM tb_anagrafe WHERE nome = '$nomecl'";
 $comando=mysqli_query($connect, $query_cliente) or die(mysqli_error);
 while ($array=mysqli_fetch_array($comando))
  {
   echo <<<EOM
<br>
<table align='right' border='0' cellpadding='1' cellspacing='2' width='30%'>
	<tr>
	<td width='100'><small><b>Spett.le </b></small></td>
	</tr>
	<tr>
	<td width='100'><small>$array[nome]</small></td>
	</tr>
	<tr>
	<td width='100'><small>$array[indirizzo]</small></td>
	</tr>
	<tr>	
	<td width='100'><small>$array[cap] $array[citta], $array[provincia]</small></td>
	</tr>
		<tr>	
	<td width='100'><small>$array[nomerif]</small></td>
	</tr>
	<tr><td height='35px'></td></tr>
</table>
EOM;
}



$Query_tab = "SELECT quantita, descr, data, euro, iva, modpaga, totale FROM tb_fatture WHERE id_fatt = '$fattura'";
$ris=mysqli_query($connect, $Query_tab)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

{
echo <<<EOM

<table align='center' border='0' cellpadding='2' cellspacing='2' width='90%'>

	<tr>
	<td width='5%' height='35px' bgcolor="#D1D1D1"><small><b>Q.ta </b></small></td>
	<td width='55%' height='35px' bgcolor="#D1D1D1"><small><b>Descrizione </b></small></td>
	<td align='right' width='18%' height='35px' bgcolor="#D1D1D1"><small><b>Prezzo un. </b></small></td>
	<td align='right' width='8%' height='35px' bgcolor="#D1D1D1"><small><b>IVA </b></small></td>
	<td align='right' width='24%' height='35px' bgcolor="#D1D1D1"><small><b>Totale </b></small></td>
	</tr>
EOM;
}

while ($riga=mysqli_fetch_array($ris))
{
$modpagamento=$riga["modpaga"];
$valiva=$riga["euro"]*($riga['iva']/100);
$imponibile=$riga['euro'];
echo <<<EOM
	<tr>
	<td height='35px'><small>$riga[quantita]</small></td>
	<td height='35px'><small>$riga[descr]</small></td>
	<td align='right' height='35px'><small>$riga[euro] &euro;</small></td>
	<td align='right' height='35px'><small>$riga[iva] %</small></td>

	<td align='right'><small>$riga[totale] &euro;</small></td>
	</tr>
EOM;
}

echo <<<EOT

</table>

EOT;

$query = "SELECT SUM(totale) as totale_numero FROM tb_fatture WHERE id_fatt = $fattura";
$result = mysqli_query($connect,  $query);
  $row = mysqli_fetch_array($result);
$totale = $row['totale_numero'];
{
   echo <<<EOM
</br>
<table align='right' border='0' cellpadding='2' cellspacing='2' width='30%' >
	<tr>
	<td ><small><b>Imponibile:</b></small></td>
	<td ><small>$imponibile &euro;</small></td>
	</tr>
	<tr>
	<td ><small><b>Imposta iva:</b></small></td>
	<td ><small>$valiva &euro;</small></td>
	</tr>
	<tr>
	<td ><small><b>Totale Fattura:</b></small></td>
	<td ><small>$totale &euro;</small></td>
	</tr>
</table>
<br>
<table align='center' border='1' cellpadding='0' cellspacing='0' width='90%' >
	<tr>
	<td width='20%' height='50px' bgcolor="#FFFFFF"><small><b>Modalit&agrave di pagamento: </b></td>
	<td width='55%' bgcolor="#FFFFFF"><small>$modpagamento </small></td>

</table>
EOM;
}


mysqli_close($connect);

} else {
header('Location: ./index.php');
}
?>
