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

//Calcolo delle somme di Cassa
$query = "SELECT SUM(entrata) FROM tb_primanota";
$result = mysqli_query($connect,  $query);
$entrata_tot = mysqli_fetch_row($result);

$query = "SELECT SUM(uscita) FROM tb_primanota";
$result = mysqli_query($connect,  $query);
$uscita_tot = mysqli_fetch_row($result);

$entrata_cassa = ($entrata_tot[0]-$uscita_tot[0]);

//Calcolo delle somme di Banca
$query = "SELECT SUM(entratab) FROM tb_primanota";
$result = mysqli_query($connect,  $query);
$entratab_tot = mysqli_fetch_row($result);

$query = "SELECT SUM(uscitab) FROM tb_primanota";
$result = mysqli_query($connect,  $query);
$uscitab_tot = mysqli_fetch_row($result);

$entrata_banca = ($entratab_tot[0]-$uscitab_tot[0]);


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

<hr style="width: 60%; height: 2px;">
<!-- Sezione per inserire una nuova voce del bilancio economico -->

      <form action='./conf_dati_BilancioEcAps.php' method='POST'>
        <table align='center' border='0' width='90%'>
	    <colgroup width="35%"></colgroup>
	    <colgroup width="60%"></colgroup>
          <tbody>
            <tr>
              <td width='30%'><font color="red">Anno: <input name='anno' type='text' value=<?php echo $data ?>><br><small><sub><i>Anno del bilancio</small></i></sub></td>
		<td size='60%'><small>Verbale assemblea dei soci n.<input name='Assemblea' type='text'></small></td>
		  <td size='10%'><small>del<br><input name='data' type='text' value='<?echo date('d-m-Y'); ?>'  size='7%'></small></td>
            </tr>
            <tr>
	    <tr>
	      <td><h3>Entrate<h3></td>
	    </tr>
	                <tr>
              <td>Rimanenze finali/Liquidit&agrave non assegnate al <input name='rimanenze' type='text' size='7%' value=<?php echo date('d-m-Y') ?>></td>
		<td></td>
		  <td><input name='Valore100' type='text' size='8%'></td>
	    </tr>
            <tr>
              <td>1.Quote associative:</td>
		<td></td>
		  <td><input name='Valore10' type='text' size='8%' value=<?echo $Quota[1]?>></td>
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
		<td><small>2.3 da enti pubblici <input name='Titolo23' type='text'><br><sub><i>Comune, provincia, regione, stato</i></small></td>
		  <td><input name='Valore23' type='text' size='8%' value='0.00'></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>2.4 da Comunit&agrave Europea e da altri organismi internazionali</small></td>
		  <td><input name='Valore24' type='text' size='8%' value='0.00'></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>2.5 dal cinque per mille<br><sub><i>(di cui separata rendicontazione)</i></small></td>
		  <td><input name='Valore25' type='text' size='8%' value='0.00'></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>2.6 altro <input name='Titolo26' type='text'><br><sub><i>Specificare </i></small></td>
		  <td><input name='Valore26' type='text' size='8%' value='0.00'></td>
	    </tr>
        <tr>
        <td>3.Donazioni deducibili e lasciti testamentari:</td>
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
        <td>4.Rimborsi derivanti da convenzioni con enti pubblici:</td>
	<td></td>
	<td><input name='Valore40' type='text' size='8%' value=<?echo $Quota[4]?>></td>
        </tr>
        <tr>
        <td>5.Altre entrate ammesse ai sensi delle L.383/2000:</td>
	<td></td>
	<td><input name='Valore50' type='text' size='8%' value=<?echo $Quota[5]?>></td>
	</tr>
           <tr>
              <td></td>
		<td><small>5.1 proventi dalle cessioni di beni e servizi agli associati e a terzi, svolte in maniera ausiliaria e sussidiaria e comunque finalizzate al raggiungimento degli obiettivi istituzionali.</small></td>
		  <td><input name='Valore51' type='text' size='8%' value='0.00'></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>5.2 entrate derivanti da iniziative promozionali finalizzate al proprio finanziamento, quali feste e sottoscrizioni anche a premi</td>
		  <td><input name='Valore52' type='text' size='8%' value='0.00'></small></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>5.3 altre entrate <input name='Titolo53' type='text'><br><sub><i>Specificare </i></small></td>
		  <td><input name='Valore53' type='text' size='8%' value='0.00'></td>
	    </tr>
        <tr>
        <td>6.Altre entrate <small>(comunque ammesse ai sensi della L. 383/2000):</td>
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
	      <td><h3>Uscite<h3></td>
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
		<td><small>2.1 volontari</small></td>
		  <td><input name='ValoreC21' type='text' size='8%' value='0.00'></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>2.2 altre: es. veicoli, immobili...</small></td>
		  <td><input name='ValoreC22' type='text' size='8%' value='0.00'></td>
	    </tr>
        <tr>
        <td>3.Personale (a cui ricorrere solo in caso di particolare necessit&agrave)</td>
	<td></td>
	<td><input name='ValoreC30' type='text' size='8%' value=<?echo $Quota[9]?>></td>
	</tr>
           <tr>
              <td></td>
		<td><small>3.1 dipendenti e atipici soci</small></td>
		  <td><input name='ValoreC31' type='text' size='8%' value='0.00'></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>3.2 dipendenti e atipici non soci</small></td>
		  <td><input name='ValoreC32' type='text' size='8%' value='0.00'></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>3.3 consulenti</small></td>
		  <td><input name='ValoreC33' type='text' size='8%' value='0.00'></td>
	    </tr>
        <tr>
        <td>4.Cquisti di servizi <small>(es. manutenzione, trasporti, service)</small></td>
	<td></td>
	<td><input name='ValoreC40' type='text' size='8%' value=<?echo $Quota[10]?>></td>
	</tr>
        <tr>
        <td>5.Utenze <small>(telefono, luce, riscaldamento...)</small></td>
	<td></td>
	<td><input name='ValoreC50' type='text' size='8%' value=<?echo $Quota[11]?>></td>
	</tr>
        <tr>
        <td>6.Acquisto di beni <small>(cancelleria, postali, materie prime, generi alimentari)</small></td>
	<td></td>
	<td><input name='ValoreC60' type='text' size='8%' value=<?echo $Quota[12]?>></td>
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
        <td>9.Imposte e tasse</td>
	<td></td>
	<td><input name='ValoreC90' type='text' size='8%' value=<?echo $Quota[15]?>></td>
	</tr>
        <tr>
        <td>10.Altre uscite/costi</td>
	<td></td>
	<td><input name='ValoreC100' type='text' size='8%' value=<?echo $Quota[18]?>></td>
	</tr>
           <tr>
              <td></td>
		<td><small>10.1 Contributi a soggetti svantaggiati</small></td>
		  <td><input name='ValoreC101' type='text' size='8%' value='0.00'></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>10.2 Quote associative a organizzazioni collegate <input name='Titolo102' type='text'><br><sub><i>Specificare</i></small></td>
		  <td><input name='ValoreC102' type='text' size='8%' value='0.00'></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>10.3 altro <input name='Titolo103' type='text'><br><sub><i>Specificare</i></small></td>
		  <td><input name='ValoreC103' type='text' size='8%' value='0.00'></td>
	    </tr>

<?php

?>
           <tr>
              <td></td>
		<td><small>Liquidit&agrave Cassa</td>
		  <td><input name='Cassa' type='text' size='8%' value=<?echo $entrata_cassa;?>></td>
<?php

?>
	    </tr>
           <tr>
              <td></td>
		<td><small>Liquidit&agrave banca</td>
		  <td><input name='Banca' type='text' size='8%' value=<?php echo $entrata_banca; ?>></td>
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
