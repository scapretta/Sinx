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

if ($user == 'admin') {
  $limit=''; $limite='';
} else if ($user == 'limitato') {
  $limit='disabled'; $limite='';
} else if ($user == 'operatore') {
  $limit='disabled'; $limite='';
} else if ($user == 'associato') {
  $limit='disabled'; $limite='disabled';
}

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

//Recupero i totali dal conto economico per la precompilazione
$data = date('Y');
$a=1;
$Query_nome = "SELECT * FROM tb_conto_economico ORDER BY id";
$rs=mysqli_query($connect, $Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");
while ($row=mysqli_fetch_array($rs))
{

$Quota[$a] = $row[valore];
$a++;

}
?>
     <h2><center>Bilancio Economico</center></h2>
<center><small>I campi contrassegnati con l'asterisco sono obbligatori</small><center><br>


<hr style="width: 60%; height: 2px;">
<!-- Sezione per inserire una nuova voce del bilancio economico -->

      <form action='./conf_dati_BilancioEcOdv.php' method='POST'>
        <table align='center' border='0' width='90%'>
	    <colgroup width="35%"></colgroup>
	    <colgroup width="60%"></colgroup>

          <tbody>
            <tr>
              <td><font color="red">Anno: <input name='anno' type='text' value=<?php echo $data ?>><br><small><sub><i>Anno del bilancio</small></i></sub></td>
		<td></td>
		  <td></td>
            </tr>
                         <tr>
              <td>Rimanenze finali al <input name='rimanenze' type='text' size='7%' value=''></td>
		<td></td>
		  <td><input name='Valore100' type='text' size='8%' value=<?echo $Quota[19]?>></td>
	    </tr>
	    <tr>
	      <td><h3>Ricavi<h3></td>
	    </tr>
            <tr>
              <td>1.Quote associative:</td>
		<td></td>
		  <td><input name='QuoteAss' type='text' size='8%' value=<?echo $Quota[1]?>></td>
	    </tr>
        <tr>
        <td>2.Contributi per progetti e/o attivit&agrave:</td>
	<td></td>
	<td><input name='Valore20' type='text' size='8%' value=<?echo $Quota[2]?>></td>
        </tr>
            <tr>
              <td></td>
		<td><small>2.1 da soci <input name='Titolo21' type='text'><br><sub><i>Specificare a quale titolo</i></sub></small></td>
		  <td><input name='Valore21' type='text' size='8%' value='0.00'></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>2.2 da non soci <input name='Titolo22' type='text'><br><sub><i>Specificare a quale titolo</i></small></td>
		  <td><input name='Valore22' type='text' size='8%' value='0.00'></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>2.3 da CSV e Comitato di Getione </small></td>
		  <td><input name='Valore23' type='text' size='8%' value='0.00'></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>2.4 da enti pubblici <input name='Titolo24' type='text'><br><sub><i>Comune, provincia, regione, stato</i></small></td>
		  <td><input name='Valore24' type='text' size='8%' value='0.00'></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>2.5 da Comunit&agrave Europea e da altri organismi internazionali</small></td>
		  <td><input name='Valore25' type='text' size='8%' value='0.00'></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>2.6 da alter Odv <input name='Titolo26' type='text'><br><sub><i>Specificare a quale titolo</i></small></td>
		  <td><input name='Valore26' type='text' size='8%' value='0.00'></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>2.7 dal cinque per mille</small></td>
		  <td><input name='Valore27' type='text' size='8%' value='0.00'></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>2.8 altro <input name='Titolo28' type='text'><br><sub><i>Specificare </i></small></td>
		  <td><input name='Valore28' type='text' size='8%' value='0.00'></td>
	    </tr>
        <tr>
        <td>3.Donazioni deducibili e lasciti testamentari<small> - art 5 L.266/91</small>:</td>
	<td></td>
	<td><input name='Valore30' type='text' size='8%' value=<?echo $Quota[3]?>></td>
        </tr>
           <tr>
              <td></td>
		<td><small>3.1 da soci</small></td>
		  <td><input name='Valore31' type='text' size='8%' value='0.00'></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>3.2 da non soci</small></td>
		  <td><input name='Valore32' type='text' size='8%' value='0.00'></td>
	    </tr>
        <tr>
        <td>4.Rimborsi derivanti da convenzioni con enti pubblici<small> - art 5 L.266/91</small>:</td>
	<td></td>
	<td><input name='Valore40' type='text' size='8%' value=<?echo $Quota[4]?>></td>
        </tr>
        <tr>
        <td>5.Entrate da attivit&agrave commerciali produttive<small> (Raccolta Fondi)</small>:</td>
	<td></td>
	<td><input name='Valore50' type='text' size='8%' value=<?echo $Quota[5]?>></td>
	</tr>
           <tr>
              <td></td>
		<td><small>5.1 da attivit&agrave di vendite occasionali o iniziative occasionali di solidariet&agrave (D.M. 1995 lett.a) es.eventi, cassettina offerte, tombole, spettacoli</small></td>
		  <td><input name='Valore51' type='text' size='8%' value='0.00'></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>5.2 da attivit&agrave di vendita di beni acquisiti da terzi a titolo gratuito a fini di sovvenzione (D.M. 1995 lett.b)</td>
		  <td><input name='Valore52' type='text' size='8%' value='0.00'></small></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>5.3 da attivit&agrave di somministrazione di alimenti e bevande in occasine di manifestazioni e simili a carattere occasionale (D.M. 1995 lett.d)</small></td>
		  <td><input name='Valore53' type='text' size='8%' value='0.00'></td>
	    </tr>
        <tr>
        <td>5.Altre entrate da attivit&agrave commerciali marginali:</td>
	<td></td>
	<td><input name='Valore50b' type='text' size='8%' value=<?echo $Quota[6]?>></td>
	</tr>
           <tr>
              <td></td>
		<td><small>5.4 cessione di beni prodotti dagli assistiti e dai volontari semprech&egrave la vendita dei prodotti sia curata direttamente dall'organizzazione senza alcun intermediario (D.M. 1995 lett.c)</small></td>
		  <td><input name='Valore54' type='text' size='8%' value='0.00'></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>5.5 attivit&agrave di prestazione di servizi rese in conformit&agrave alle finalit&agrave istituzionali, non riconducibili nell'ambito applicativo dell'art.111, comma 3, del TUIR verso pagamento di corrispettivi specifici che non eccedano del 50% i costi di diretta imputazione (D.M. 1995 lett.e)</small></td>
		  <td><input name='Valore55' type='text' size='8%' value='0.00'></td>
	    </tr>
        <tr>
        <td>6.Altre entrate:<small> (comunque ammesse dalla L.266/91)</small></td>
	<td></td>
	<td></td>
	</tr>
           <tr>
              <td></td>
		<td><small>6.1 Rendite patrimoniali (fitti,...)</small></td>
		  <td><input name='Valore61' type='text' size='8%' value='0.00'></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>6.2 Rendite finanziarie (interessi, dividendi)</small></td>
		  <td><input name='Valore62' type='text' size='8%' value='0.00'></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>6.3 altro: <input name='Titolo63' type='text'></small></td>
		  <td><input name='Valore63' type='text' size='8%' value='0.00'></td>
	    </tr>
        <tr>
        <td>7.Anticipazioni di cassa</td>
	<td></td>
	<td><input name='Valore70' type='text' size='8%' value='0.00'></td>
	</tr>
        <tr>
        <td>8.Partite di giro</td>
	<td></td>
	<td><input name='Valore80' type='text' size='8%' value='0.00'></td>
	</tr>

	    <tr>
	      <td><h3>Costi<h3></td>
	    </tr>
        <tr>
        <td>1.Rimborsi spese ai volontari <small>(documentate ed effettivamente sostenute)</small></td>
	<td></td>
	<td><input name='ValoreC10' type='text' size='8%' value=<?echo $Quota[7]?>></td>
	</tr>
        <tr>
        <td>2.Assicurazioni</td>
	<td></td>
	<td><input name='ValoreC20' type='text' size='8%' value=<?echo $Quota[8]?>></td>
	</tr>
           <tr>
              <td></td>
		<td><small>2.1 volontari (malattie, infortuni e resp.civile terzi) - art.4 L.266/91</small></td>
		  <td><input name='ValoreC21' type='text' size='8%' value='0.00'></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>2.2 altre: es. veicoli, immobili...</small></td>
		  <td><input name='ValoreC22' type='text' size='8%' value='0.00'></td>
	    </tr>
        <tr>
        <td>3.Personale occorrente a qualificare e specializzare l'attivit&agrave <small>(art.3 L.266/91 e art.3 L.R.40/1993)</small></td>
	<td></td>
	<td><input name='ValoreC30' type='text' size='8%' value=<?echo $Quota[9]?>></td>
	</tr>
           <tr>
              <td></td>
		<td><small>3.1 dipendenti</small></td>
		  <td><input name='ValoreC31' type='text' size='8%' value='0.00'></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>3.2 atipici e occasinali</small></td>
		  <td><input name='ValoreC32' type='text' size='8%' value='0.00'></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>3.3 consulenti (es. fisioterapista)</small></td>
		  <td><input name='ValoreC33' type='text' size='8%' value='0.00'></td>
	    </tr>
        <tr>
        <td>4.Cquisti di servizi <small>(es. manutenzione, trasporti, service, consulenza fiscale e del lavoro)</small></td>
	<td></td>
	<td><input name='ValoreC40' type='text' size='8%' value=<?echo $Quota[10]?>></td>
	</tr>
        <tr>
        <td>5.Utenze <small>(telefono, luce, riscaldamento...)</small></td>
	<td></td>
	<td><input name='ValoreC50' type='text' size='8%' value=<?echo $Quota[11]?>></td>
	</tr>
        <tr>
        <td>6.Materiali di consumo <small>(cancelleria, postali, materie prime, generi alimentari)</small></td>
	<td></td>
	<td><input name='ValoreC60' type='text' size='8%' value=<?echo $Quota[12]?>></td>
	</tr>
           <tr>
              <td></td>
		<td><small>6.1 per strutura Odv</small></td>
		  <td><input name='ValoreC61' type='text' size='8%' value='0.00'></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>6.2 per attivit&agrave</small></td>
		  <td><input name='ValoreC62' type='text' size='8%' value='0.00'></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>6.3 per soggetti svantaggiati</small></td>
		  <td><input name='ValoreC63' type='text' size='8%' value='0.00'></td>
	    </tr>
        <tr>
        <td>7.Godimento beni di terzi <small>(affitti, noleggio attrezzature, diritti SIAE,...)</small></td>
	<td></td>
	<td><input name='ValoreC70' type='text' size='8%' value=<?echo $Quota[13]?>></td>
	</tr>
        <tr>
        <td>8.Oneri finanziari e patrimoniali <small>(es. interessi passivi sui mutui, prestiti, c/c bancario...)</small></td>
	<td></td>
	<td><input name='ValoreC80' type='text' size='8%' value=<?echo $Quota[14]?>></td>
	</tr>
        <tr>
        <td>9.Ammortamenti</td>
	<td></td>
	<td><input name='ValoreC90' type='text' size='8%' value=<?echo $Quota[15]?>></td>
	</tr>
        <tr>
        <td>10.Imposte e tasse</td>
	<td></td>
	<td><input name='ValoreC100' type='text' size='8%' value=<?echo $Quota[16]?>></td>
	</tr>
        <tr>
        <td>11.Raccolte fondi <small>(vedi allegati Nr, delle singole raccolte fondi di cui ai punti 5.1, 5.2 e 5.3 delle entrate)</small></td>
	<td></td>
	<td><input name='ValoreC110' type='text' size='8%' value=<?echo $Quota[17]?>></td>
	</tr>
        <tr>
        <td>12.Altre uscite/costi</td>
	<td></td>
	<td><input name='ValoreC120' type='text' size='8%' value=<?echo $Quota[18]?>></td>
	</tr>
           <tr>
              <td></td>
		<td><small>12.1 Contributi a soggetti svantaggiati</small></td>
		  <td><input name='ValoreC121' type='text' size='8%' value='0.00'></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>12.2 Quote associative a odv collegate <input name='Titolo122' type='text'><br><sub><i>Specificare</i></small></td>
		  <td><input name='ValoreC122' type='text' size='8%' value='0.00'></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>12.3 versate ad altre odv <input name='Titolo123' type='text'><br><sub><i>Specificare</i></small></td>
		  <td><input name='ValoreC123' type='text' size='8%' value='0.00'></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>12.4 altro <input name='Titolo124' type='text'><br><sub><i>Specificare</i></small></td>
		  <td><input name='ValoreC124' type='text' size='8%' value='0.00'></td>
	    </tr>
        <tr>
        <td>13.Partite di giro</td>
	<td></td>
	<td><input name='ValoreC130' type='text' size='8%' value='0.00'></td>
	</tr>

            <tr>
              <td colspan='2' align='center'>
              <input value='invia' type='submit' <?php echo($limite); ?>></td>
            </tr>


          </tbody>
        </table>
      </form>

<?php
mysqli_close($connect);
include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i>Puoi terminare la compilazione del bilancio e modificare i valori che sinx ha precompilato, al termine sinx predisporr&agrave un file pronto per la stampa compreso il calcolo dei totali.<br>Puoi lanciare la stampa dal browser (file->stampa) e, se vuoi, da li puoi crearti un pdf selezionando 'stampa su file' al posto della stampante.
<hr></i></small><?
include('./botton.inc');

?>
