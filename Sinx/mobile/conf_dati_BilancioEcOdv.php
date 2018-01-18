<?php
/*======================================================================+
 File name   : conf_dati_BilancioEcOdv.php
 Begin       : 2013-01-09
 Last Update : 2013-01-19

 Description : elaborate and confirm economic balance for Odv

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
	$nrimanenze = $_POST['rimanenze'];
	$nValore100 = $_POST['Valore100'];
	$nQuoteAss = $_POST['QuoteAss'];

	$nValore20 = $_POST['Valore20'];
	$nTitolo21 = $_POST['Titolo21'];
	$nValore21 = $_POST['Valore21'];
	$nTitolo22 = $_POST['Titolo22'];
	$nValore22 = $_POST['Valore22'];
	$nValore23 = $_POST['Valore23'];
	$nTitolo24 = $_POST['Titolo24'];
	$nValore24 = $_POST['Valore24'];
	$nValore25 = $_POST['Valore25'];
	$nTitolo26 = $_POST['Titolo26'];
	$nValore26 = $_POST['Valore26'];
	$nValore27 = $_POST['Valore27'];
	$nTitolo28 = $_POST['Titolo28'];
	$nValore28 = $_POST['Valore28'];

	$nValore30 = $_POST['Valore30'];
	$nValore31 = $_POST['Valore31'];
	$nValore32 = $_POST['Valore32'];

	$nValore40 = $_POST['Valore40'];

	$nValore50 = $_POST['Valore50'];
	$nValore51 = $_POST['Valore51'];
	$nValore52 = $_POST['Valore52'];
	$nValore53 = $_POST['Valore53'];
	$nValore50b = $_POST['Valore50b'];
	$nValore54 = $_POST['Valore54'];
	$nValore55 = $_POST['Valore55'];

	$nValore60 = ($nValore61+$nValore62+$nValore63);
	$nValore61 = $_POST['Valore61'];
	$nValore62 = $_POST['Valore62'];
	$nTitolo63 = $_POST['Titolo63'];
	$nValore63 = $_POST['Valore63'];

	$nValore70 = $_POST['Valore70'];

	$nValore80 = $_POST['Valore80'];

	$totaleric = ($nQuoteAss+$nValore20+$nValore30+$nValore40+$nValore50+$nValore50b+$nValore60+$nValore70+$nValore80+$nValore100);

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
	$nValoreC61 = $_POST['ValoreC61'];
	$nValoreC62 = $_POST['ValoreC62'];
	$nValoreC63 = $_POST['ValoreC63'];

	$nValoreC70 = $_POST['ValoreC70'];

	$nValoreC80 = $_POST['ValoreC80'];

	$nValoreC90 = $_POST['ValoreC90'];

	$nValoreC100 = $_POST['ValoreC100'];

	$nValoreC110 = $_POST['ValoreC110'];

	$nValoreC120 = $_POST['ValoreC120'];
	$nValoreC121 = $_POST['ValoreC121'];
	$nTitolo122 = $_POST['Titolo122'];
	$nValoreC122 = $_POST['ValoreC122'];
	$nTitolo123 = $_POST['Titolo123'];
	$nValoreC123 = $_POST['ValoreC123'];
	$nTitolo124 = $_POST['Titolo124'];
	$nValoreC124 = $_POST['ValoreC124'];
	$nValoreC130 = $_POST['ValoreC130'];

	$totalecos = ($nValoreC10+$nValoreC20+$nValoreC30+$nValoreC40+$nValoreC50+$nValoreC60+$nValoreC70+$nValoreC80+$nValoreC90+$nValoreC100+$nValoreC110+$nValoreC120+$nValoreC130);


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
            <tr>
              <td width='20%'></td>
		<td size='60%'></td>
		  <td size='10%'>Importi parziali</td>
		    <td size='10%'>Importi totali</td>
            </tr>
	    <tr bgcolor='orange'>
	      <td><h3>Ricavi<h3></td>
		<td></td>
		<td></td>
		<td></td>
	    </tr>
	                <tr>
              <td>Rimanenze al $nrimanenze</td>
		<td></td>
		  <td></td>
		    <td>$nValore100</td>
	    </tr>
	    
            <tr>
              <td>1.Quote associative:</td>
		<td></td>
		  <td></td>
		    <td>$nQuoteAss</td>
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
		<td><small>2.3 da CSV e Comitato di Getione </small></td>
		  <td>$nValore23</td>
	<td></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>2.4 da enti pubblici $nTitolo24</small></td>
		  <td>$nValore24</td>
	<td></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>2.5 da Comunit&agrave Europea e da altri organismi internazionali</small></td>
		  <td>$nValore25</td>
	<td></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>2.6 da alter Odv $nTitolo26</small></td>
		  <td>$nValore26</td>
	<td></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>2.7 dal cinque per mille</small></td>
		  <td>$nValore27</td>
	<td></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>2.8 altro $nTitolo28</small></td>
		  <td>$nValore28</td>
	<td></td>
	    </tr>
        <tr>
        <td>3.Donazioni deducibili e lasciti testamentari<small> - art 5 L.266/91</small>:</td>
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
        <td>4.Rimborsi derivanti da convenzioni con enti pubblici<small> - art 5 L.266/91</small>:</td>
	<td></td>
	<td></td>
	<td>$nValore40</td>
        </tr>
        <tr>
        <td>5.Entrate da attivit&agrave commerciali produttive<small> (Raccolta Fondi)</small>:</td>
	<td></td>
	<td></td>
	<td>$nValore50</td>
	</tr>
           <tr>
              <td></td>
		<td><small>5.1 da attivit&agrave di vendite occasionali o iniziative occasionali di solidariet&agrave (D.M. 1995 lett.a) es.eventi, cassettina offerte, tombole, spettacoli</small></td>
		  <td>$nValore51</td>
	<td></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>5.2 da attivit&agrave di vendita di beni acquisiti da terzi a titolo gratuito a fini di sovvenzione (D.M. 1995 lett.b)</small></td>
		  <td>$nValore52</td>
	<td></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>5.3 da attivit&agrave di somministrazione di alimenti e bevande in occasine di manifestazioni e simili a carattere occasionale (D.M. 1995 lett.d)</small></td>
		  <td>$nValore53</td>
	<td></td>
	    </tr>
        <tr>
        <td>5.Altre entrate da attivit&agrave commerciali marginali:</td>
	<td></td>
	<td></td>
	<td>$nValore50b</td>
	</tr>
           <tr>
              <td></td>
		<td><small>5.4 cessione di beni prodotti dagli assistiti e dai volontari semprech&egrave la vendita dei prodotti sia curata direttamente dall'organizzazione senza alcun intermediario (D.M. 1995 lett.c)</small></td>
		  <td>$nValore54</td>
	<td></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>5.5 attivit&agrave di prestazione di servizi rese in conformit&agrave alle finalit&agrave istituzionali, non riconducibili nell'ambito applicativo dell'art.111, comma 3, del TUIR verso pagamento di corrispettivi specifici che non eccedano del 50% i costi di diretta imputazione (D.M. 1995 lett.e)</small></td>
		  <td>$nValore55</td>
	<td></td>
	    </tr>
        <tr>
        <td>6.Altre entrate:<small> (comunque ammesse dalla L.266/91)</small></td>
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
        <td>7.Anticipazioni di cassa</td>
	<td></td>
	<td></td>
	<td>$nValore70</td>
	</tr>
        <tr>
        <td>8.Partite di giro</td>
	<td></td>
	<td></td>
	<td>$nValore80</td>
	</tr>
	<tr>
	<td><b>TOTALE RICAVI</b></td>
	<td></td>
	<td></td>
	<td><b>$totaleric</b></td>


	    <tr bgcolor='orange'>
	      <td><h3>Costi<h3></td>
	<td></td>
	<td></td>
	<td></td>
	    </tr>
        <tr>
        <td>1.Rimborsi spese ai volontari <small>(documentate ed effettivamente sostenute)</small></td>
	<td></td>
	<td></td>
	<td>$nValoreC10</td>
	</tr>
        <tr>
        <td>2.Assicurazioni</td>
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
        <td>3.Personale occorrente a qualificare e specializzare l'attivit&agrave <small>(art.3 L.266/91 e art.3 L.R.40/1993)</small></td>
	<td></td>
	<td></td>
	<td>$nValoreC30</td>
	</tr>
           <tr>
              <td></td>
		<td><small>3.1 dipendenti</small></td>
		  <td>$nValoreC31</td>
	<td></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>3.2 atipici e occasinali</small></td>
		  <td>$nValoreC32</td>
	<td></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>3.3 consulenti (es. fisioterapista)</small></td>
		  <td>$nValoreC33</td>
	<td></td>
	    </tr>
        <tr>
        <td>4.Cquisti di servizi <small>(es. manutenzione, trasporti, service, consulenza fiscale e del lavoro)</small></td>
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
        <td>6.Materiali di consumo <small>(cancelleria, postali, materie prime, generi alimentari)</small></td>
	<td></td>
	<td></td>
	<td>$nValoreC60</td>
	</tr>
           <tr>
              <td></td>
		<td><small>6.1 per strutura Odv</small></td>
		  <td>$nValoreC61</td>
	<td></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>6.2 per attivit&agrave</small></td>
		  <td>$nValoreC62</td>
	<td></td>
	    </tr>
           <tr>
              <td></td>
		<td><small>6.3 per soggetti svantaggiati</small></td>
		  <td>$nValoreC63</td>
	<td></td>
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
        <td>9.Ammortamenti</td>
	<td></td>
	<td></td>
	<td>$nValoreC90</td>
	</tr>
        <tr>
        <td>10.Imposte e tasse</td>
	<td></td>
	<td></td>
	<td>$nValoreC100</td>
	</tr>
        <tr>
        <td>11.Raccolte fondi <small>(vedi allegati Nr, delle singole raccolte fondi di cui ai punti 5.1, 5.2 e 5.3 delle entrate)</small></td>
	<td></td>
	<td></td>
	<td>$nValoreC110</td>
	</tr>
        <tr>
        <td>12.Altre uscite/costi</td>
	<td></td>
	<td></td>
	<td>$nValoreC120</td>
	</tr>
           <tr>
              <td></td>
		<td><small>12.1 Contributi a soggetti svantaggiati</small></td>
		  <td>$nValoreC121</td>
	    </tr>
           <tr>
              <td></td>
		<td><small>12.2 Quote associative a odv collegate $nTitolo122</small></td>
		  <td>$nValoreC122</td>
	    </tr>
           <tr>
              <td></td>
		<td><small>12.3 versate ad altre odv $nTitolo123</small></td>
		  <td>$nValoreC123</td>
	    </tr>
           <tr>
              <td></td>
		<td><small>12.4 altro $nTitolo124</small></td>
		  <td>$nValoreC124</td>
	    </tr>
        <tr>
        <td>13.Partite di giro</td>
	<td></td>
	<td>$nValoreC130</td>
	</tr>
	<td><b>TOTALE COSTI</b></td>
	<td></td>
	<td></td>
	<td><b>$totalecos</b></td>
          </tbody>
        </table>
<hr width='90%'>

html;
$data = date("d-m-Y");
echo ("<br>Data:<small> $data</small> -- Firma:");

} else {
header('Location: ./index.php');
}
?>
