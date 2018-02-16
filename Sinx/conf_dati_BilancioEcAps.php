<?php
/*======================================================================+
 File name   : conf_dati_BilancioEcAps.php
 Begin       : 2013-01-09
 Last Update : 2013-01-19

 Description : elaborate and confirm economic balance for Aps

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
	$nanno = $_POST['anno'];
	$dataverb = $_POST['data'];
	$nrimanenze = $_POST['rimanenze'];
	$nValore100 = $_POST['Valore100'];
	$nValore10 = $_POST['Valore10'];
	$nValore20 = $_POST['Valore20'];
	$nTitolo21 = $_POST['Titolo21'];
	$nValore21 = $_POST['Valore21'];
	$nTitolo22 = $_POST['Titolo22'];
	$nValore22 = $_POST['Valore22'];
	$nTitolo23 = $_POST['Titolo23'];
	$nValore23 = $_POST['Valore23'];
	$nValore24 = $_POST['Valore24'];
	$nValore25 = $_POST['Valore25'];
	$nTitolo26 = $_POST['Titolo26'];
	$nValore26 = $_POST['Valore26'];
	$nValore30 = $_POST['Valore30'];
	$nValore31 = $_POST['Valore31'];
	$nValore32 = $_POST['Valore32'];
	$nValore40 = $_POST['Valore40'];
	$nValore50 = $_POST['Valore50'];
	$nValore51 = $_POST['Valore51'];
	$nValore52 = $_POST['Valore52'];
	$nTitolo53 = $_POST['Titolo53'];
	$nValore53 = $_POST['Valore53'];
	$nValore60 = $_POST['Valore60'];
	$nValore61 = $_POST['Valore61'];
	$nValore62 = $_POST['Valore62'];
	$nTitolo63 = $_POST['Titolo63'];
	$nValore63 = $_POST['Valore63'];

	$nValoreC10 = $_POST['ValoreC10'];
	$nValoreC20 = $_POST['ValoreC20'];
	$nValoreC21 = $_POST['ValoreC21'];
	$nValoreC22 = $_POST['ValoreC22'];
	$nValoreC30 = $_POST['ValoreC30'];
	$nValoreC31 = $_POST['ValoreC31'];
	$nValoreC32 = $_POST['ValoreC32'];
	$nValoreC33 = $_POST['ValoreC33'];
	$nValoreC40 = $_POST['ValoreC40'];
	$nValoreC50 = $_POST['ValoreC50'];
	$nValoreC60 = $_POST['ValoreC60'];
	$nValoreC70 = $_POST['ValoreC70'];
	$nValoreC80 = $_POST['ValoreC80'];
	$nValoreC90 = $_POST['ValoreC90'];
	$nValoreC100 = $_POST['ValoreC100'];
	$nValoreC101 = $_POST['ValoreC101'];
	$nTitolo102 = $_POST['Titolo102'];
	$nValoreC102 = $_POST['ValoreC102'];
	$nTitolo103 = $_POST['Titolo103'];
	$nValoreC103 = $_POST['ValoreC103'];

	$totaleent = ($nValore10+$nValore20+$nValore30+$nValore40+$nValore50+$nValore60+$nValore100);
	
	$totaleusc = ($nValoreC10+$nValoreC20+$nValoreC30+$nValoreC40+$nValoreC50+$nValoreC60+$nValoreC70+$nValoreC80+$nValoreC90+$nValoreC100);

	$nTotEU = ($totaleent-$totaleusc);
	$LiqFin = ($totaleent-$totaleusc);
	$Cassa = $_POST['Cassa'];
	$Banca = $_POST['Banca'];
	$Assemblea = $_POST['Assemblea'];
	$Data = $_POST['Data'];


//$sricavi_oneri = htmlspecialchars($nricavi_oneri, ENT_NOQUOTES, "UTF-8");


//$ricavi_oneri = mysql_escape_string($sricavi_oneri);


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


	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");


include('./Intestazione.php');
echo <<<html

     <h2><center>Bilancio Economico anno $nanno</center></h2>

<hr style="width: 60%; height: 2px;">
        <table align='center' border='0' width='90%'>
          <tbody>

	    <tr bgcolor='pink'>
	      <td colspan='4' align='center'><h3>Entrate<h3></td>
	    </tr>
        <tr>
        <td></td>
	<td></td>
	<td>Importi Parziali</td>
	  <td>Importi Totali</td>
        </tr>
        
        	                <tr>
              <td>Rimanenze/Liquidit&agrave al $nrimanenze</td>
		<td></td>
		  <td></td>
		    <td>$nValore100</td>
	    </tr>
        
            <tr>
              <td>1.Quote associative:</td>
		<td></td>
		  <td></td>
		    <td>$nValore10</td>
	    </tr>
        <tr>
        <td>2.Contributi per progetti e/o attivit&agrave:</td>
	<td></td>
	<td></td>
	  <td>$nValore20</td>
        </tr>
            <tr>
              <td></td>
		<td><small>2.1 da soci $nTitolo21</small></td>
		  <td>$nValore21</td>
	<td></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>2.2 da non soci $nTitolo22</small></td>
		  <td>$nValore22</td>
	<td></td>	    
	    </tr>
           <tr>
              <td></td>
		<td><small>2.3 da enti pubblici $nTitolo23</small></td>
		  <td>$nValore23</td>
	<td></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>2.4 da Comunit&agrave Europea e da altri organismi internazionali</small></td>
		  <td>$nValore24</td>
	<td></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>2.5 dal cinque per mille (di cui separata rendicontazione)</small></td>
		  <td>$nValore25</td>
	<td></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>2.6 altro $nTitolo26</small></td>
		  <td>$nValore26</td>
	<td></td>
	    </tr>
        <tr>
        <td>3.Donazioni deducibili e lasciti testamentari</td>
	<td></td>
	<td></td>
	<td>$nValore30</td>
        </tr>
           <tr>
              <td></td>
		<td><small>3.1 da soci</small></td>
		  <td>$nValore31</td>
	<td></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>3.2 da non soci</small></td>
		  <td>$nValore32</td>
	<td></td>
	    </tr>
        <tr>
        <td>4.Rimborsi derivanti da convenzioni con enti pubblici</td>
	<td></td>
	<td></td>
	<td>$nValore40</td>
        </tr>
        <tr>
        <td>5.Altre entrate ammesse ai sensi delle L.383/2000</td>
	<td></td>
	<td></td>
	<td>$nValore50</td>
	</tr>
           <tr>
              <td></td>
		<td><small>5.1 proventi delle cessioni di beni e servizi agli associati e a terzi, svolte in maniera ausiliaria e sussidiaria e comunque finalizzate al raggiungimento degli obiettivi istituzionali</small></td>
		  <td>$nValore51</td>
	<td></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>5.2 entrate derivanti da iniziative promozionali finalizzate al proprio finanziamento, quali feste e sottoscrizioni anche a premi</td>
		  <td>$nValore52</td>
	<td></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>5.3 altre entrate: $nTitolo53</td>
		  <td>$nValore53</td>
	<td></td>
	    </tr>
        <tr>
        <td>6.Altre entrate:<small> (comunque ammesse ai sensi della L383/2000)</small></td>
	<td></td>
	<td></td>
	<td>$nValore60</td>
	</tr>
           <tr>
              <td></td>
		<td><small>6.1 Rendite patrimoniali (fitti,...)</small></td>
		  <td>$nValore61</td>
	    </tr>
           <tr>
              <td></td>
		<td><small>6.2 Rendite finanziarie (interessi, dividendi)</small></td>
		  <td>$nValore62</td>
	    </tr>
           <tr>
              <td></td>
		<td><small>6.3 altro: $nTitolo63</small></td>
		  <td>$nValore63</td>
	    </tr>
	<tr>
	<td><b>TOTALE ENTRATE</b></td>
	<td></td>
	<td></td>
	<td><b>$totaleent</b></td>


	    <tr bgcolor='pink'>
	      <td colspan='4' align='center'><h3>Uscite<h3></td>
	    </tr>
        <tr>
        <td>1.Rimborsi spese ai volontari <small>(documentate ed effettivamente sostenute)</small></td>
	<td></td>
	<td></td>
	<td>$nValoreC10</td>
	</tr>
        <tr>
        <td>2.Assicurazioni <small>(solo per convenzioni)</small></td>
	<td></td>
	<td></td>
	<td>$nValoreC20</td>
	</tr>
           <tr>
              <td></td>
		<td><small>2.1 volontari (malattie, infortuni e resp.civile terzi) - art.4 L.266/91</small></td>
		  <td>$nValoreC21</td>
	<td></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>2.2 altre: es. veicoli, immobili...</small></td>
		  <td>$nValoreC22</td>
	<td></td>
	    </tr>
        <tr>
        <td>3.Personale (a cui ricorrere solo in caso di particolare necessit&agrave)</td>
	<td></td>
	<td></td>
	<td>$nValoreC30</td>
	</tr>
           <tr>
              <td></td>
		<td><small>3.1 dipendenti e atipici soci</small></td>
		  <td>$nValoreC31</td>
	<td></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>3.2 dipendenti e atipici non soci</small></td>
		  <td>$nValoreC32</td>
	<td></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>3.3 consulenti</small></td>
		  <td>$nValoreC33</td>
	<td></td>
	    </tr>
        <tr>
        <td>4.Cquisti di servizi <small>(es. manutenzione, trasporti, service)</small></td>
	<td></td>
	<td></td>
	<td>$nValoreC40</td>
	</tr>
        <tr>
        <td>5.Utenze <small>(telefono, luce, riscaldamento...)</small></td>
	<td></td>
	<td></td>
	<td>$nValoreC50</td>
	</tr>
        <tr>
        <td>6.Acquisto di beni <small>(cancelleria, postali, materie prime, generi alimentari)</small></td>
	<td></td>
	<td></td>
	<td>$nValoreC60</td>
	</tr>
        <tr>
        <td>7.Godimento beni di terzi <small>(affitti, noleggio attrezzature, diritti SIAE,...)</small></td>
	<td></td>
	<td></td>
	<td>$nValoreC70</td>
	</tr>
        <tr>
        <td>8.Oneri finanziari e patrimoniali <small>(es. interessi passivi sui mutui, prestiti, c/c bancario...)</small></td>
	<td></td>
	<td></td>
	<td>$nValoreC80</td>
	</tr>
        <tr>
        <td>9.Imposte e tasse</td>
	<td></td>
	<td></td>
	<td>$nValoreC90</td>
	</tr>
        <tr>
        <td>10.Altre uscite/costi</td>
	<td></td>
	<td></td>
	<td>$nValoreC100</td>
	</tr>
           <tr>
              <td></td>
		<td><small>10.1 Contributi a soggetti svantaggiati</small></td>
		  <td>$nValoreC101</td>
	    </tr>
           <tr>
              <td></td>
		<td><small>10.2 Quote associative ad organizzazioni collegate: $nTitolo102</small></td>
		  <td>$nValoreC102</td>
	    </tr>
           <tr>
              <td></td>
		<td><small>10.3 altro $nTitolo103</small></td>
		  <td>$nValoreC103</td>
	    </tr>
      <tr>
	<td><b>TOTALE USCITE</b></td>
	<td></td>
	<td></td>
	<td><b>$totaleusc</b></td>
      </tr>
      <tr>
	<td><b><hr>TOTALE <br>ENTRATE-USCITE</b></td>
	<td></td>
	<td></td>
	<td><b>$nTotEU</b></td>
        </tr>  
	</tbody>
        </table>
<hr width='90%'>

<table align='center' border='0' width='90%'>
          <tbody>
  <tr>
    <td>Liquidit&agrave Finale<br><small>(liquidit&agrave iniziale + totale entrate - totale uscite)</td>
      <td></td>
	<td></td>
	  <td>$LiqFin</td>
  </tr>
  <tr>
    <td></td>
      <td>di cui valori in Cassa</td>
	<td>$Cassa</td>
	  <td></td>
   </tr>
  <tr>
    <td></td>
      <td>di cui valori presso depositi</td>
	<td>$Banca</td>
	  <td></td>
   </tr>
</tbody>
</table>
<hr>
Estremi di approvazione bilancio: verbale di assemblea dei soci n. $Assemblea - del $dataverb - <small>(da allegare)</small><br><br>

html;
$data = date("d-m-Y");
echo ("<br>Data:<small> $data</small> -- Firma:___________________________________________");

} else {
header('Location: ./index.php');
}
?>
