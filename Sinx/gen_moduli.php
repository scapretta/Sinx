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
	$nome = $_POST['nomeass'];

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");
	
$query = "SELECT indirizzo,provincia,cap,tel,email FROM tb_anagrafe WHERE nome = '$nome'";
 
$rs=mysqli_query($connect,  $query)
or die("<b>Errore: </b> Impossibile eseguire la query della Combo");

$row=mysqli_fetch_row($rs);


	$citta = $row["1"];
	$via = $row["0"];
	$cap = $row["2"];
	$tel = $row["3"];
	$email = $row["4"];
	$data = $_POST['data'];
	$data2 = $_POST['data2'];
	$data3 = $_POST['data3'];
	
$Query_nome = "SELECT * FROM tb_anagrafe_associaz";

$rss=mysqli_query($connect, $Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");
$riga=mysqli_fetch_array($rss);

	$luogo = $riga[citta];
	$modulo = $_POST['modulo'];
	$presenti = $_POST['presenti'];
	$ordine = $_POST['OrdineGiorno'];
	$verbale = $_POST['Verbale'];
	$indsede = $riga[indirizzo];
	$associazione =$riga[nome];
	$numsede = $riga[numero];


if ($modulo == 'ammissione')
{
echo "	Spett.le Associazione
<br><br><br><br>
OGGETTO: <b>Richiesta di Ammissione a Socio</b><br><br>
Il sottoscritto<b> $nome </b>abitante in via:<b> $via </b>, <b> $cap</b>, <b> $citta</b>, Telefono:<b> $tel</b>, e-mail:<b> $email</b><br>chiede di essere ammesso quale socio dell'Associazione.<br><br>
Il/La sottoscritto/a si impegna incondizionatamente a rispettare le norme statutarie vigenti e le deliberazioni degli organi sociali validamente costituiti.<br>A tale scopo dichiara di conoscere ed accettare lo Statuto Sociale.<br><br>
   $luogo, $data .<br><br><br>
 	Firma<br>
 	__________________";
}
if ($modulo == 'consenso')
{
echo " 	Consenso dei dati
<br><br><br><br>
Il sottoscritto<b> $nome </b>abitante in via:<b> $via </b>, <b> $cap</b>, <b> $citta</b>, Telefono:<b> $tel</b>, e-mail:<b> $email</b><br><br>
acquisite le informazioni fornite dal titolare del trattamento ai sensi dell'articolo 13 del D.Lgs. 196/2003:<br>
- presta il suo consenso al trattamento dei dati personali per i fini indicati nella suddetta informativa:<br>
- presta il suo consenso per la comunicazione dei dati personali per le finalit&agrave ed ai soggetti indicati nell'informativa<br>
- presta il suo consenso per la diffusione dei dati personali per le finalit&agrave e nell'ambito indicato nell'informativa<br>
- presta il suo consenso per il trattamento dei dati sensibili necessari per lo svolgimento delle operazioni indicate nell'informativa.<br>
<br><br>
   $luogo, $data <br><br><br> 
 	Firma<br>
 	__________________";
}
if ($modulo == 'consiglio')
{
echo " 	VERBALE ASSEMBLEA ORDINARIA
<br><br><br><br>
In data<b> $data </b>presso<b> $luogo, $insede </b>si &egrave tenuta l'assemblea ordinaria / riunione dell'Associazione <b>$associazione</b><br>
per discutere e deliberare sul seguente:<br><br>
<b>ORDINE DEL GIORNO</B><br><br>
<i>$ordine</i><br><br>
Nel luogo e all'ora indicata risultano presenti:<br><br>
<b>$presenti</b><br><br>
Tutti i presenti si dichiarano informati sugli argomenti posti all'ordine del giorno:<br><br>
<i>$verbale</i><br><br>
<center>L'assemblea, all'unanimit&agrave<br><br> <B>DELIBERA</B><br><br> di aver preso atto, discusso ed accordato l' ordine del giorno al <b>$data</b></center><br><br> 
<b>$luogo, $data</b>";
}
if ($modulo == 'rimborso')
{
echo " RICHIESTA RIMBORSO SPESE
<br><br><br><br>
Il sottoscritto<b> $nome </b>abitante in via:<b> $via </b>, <b> $cap</b>, <b> $citta</b>, Telefono:<b> $tel</b>, e-mail:<b> $email</b><br>
con la presente richiede il rimborso delle spese sostenute in data <b>$data</b> per il seguente motivo:<br><br>
<b>$verbale</b><br><br>
   $luogo, $data <br><br><br> 
 	Firma<br>
 	__________________";
}
if ($modulo == 'ammissioneminore')
{
echo "	RICHIESTA DI AMMISSIONE IN QUALITA' DI ADERENTE<br><br><br><br>
Il sottoscritto<b> $nome </b>abitante in via:<b> $via </b>, <b> $cap</b>, <b> $citta</b>, Telefono:<b> $tel</b>, e-mail:<b> $email</b><br><br>
<li>avendo preso visione dello statuto  che regola  l'Associazione e dei Regolamenti dell'Associazione</li>
<li>condividendo la democraticit&agrave della struttura, l'elettivit&agrave e la gratuit&agrave delle cariche associative</li>
<li>dichiarando di assumersi ogni responsabilit&agrave civile e penale derivante da eventuali danni provocati a persone, animali e cose, sia involontariamente che per infrazione alle norme emanate dagli Statuti e dai Regolamenti sopra citati</li>
<li>consapevole della gratuit&agrave delle prestazioni fornite dagli aderenti</li>
<center>CHIEDE<br>
Di aderire come aderente presso questa Associazione</center><br><br>
PER L'ESERCENTE LA PATRIA POTESTA':<br><br>
Presto il consenso all'ammissione come socio presso questa Associazione, del minore <b>$nome</b><br><br>
   $luogo, $data <br><br><br> 
 	Firma<br>
 	__________________";
}
if ($modulo == 'dimissioni')
{
echo "COMUNICAZIONE DI DIMISSIONE DA SOCIO<br><br><br><br>
Il sottoscritto<b> $nome </b>abitante in via:<b> $via </b>, <b> $cap</b>, <b> $citta</b>, Telefono:<b> $tel</b>, e-mail:<b> $email</b><br><br>
CONSIDERATO CHE: $verbale <br><br>
<center>COMUNICA<br><br>Le proprie irrevocabili dimissioni da socio dell'associazione</center><br><br>
   $luogo, $data <br><br><br> 
 	Firma<br>
 	__________________";
}

if ($modulo == 'convocazione')
{
$Query_nome = "SELECT nome FROM tb_anagrafe WHERE classe = 'Presidente' AND tipologia = 'Stud' ORDER BY nome";

$rs=mysqli_query($connect, $Query_nome)
or die("Errore nella query $query: " . mysqli_error()); //die("<b>Errore:</b> Impossibile eseguire la query della Combo");
while ($row=mysqli_fetch_array($rs))

echo "CONVOCAZIONE DEL CONSIGLIO DIRETTIVO<br><br><br><br>
Egregi signori,<br>
a norma dell'art. 2381, co. 1, cod. civ.,  si avvisa che il Consiglio Direttivo &egrave convocato per il giorno e ora <b>$data2</b>, presso <b>$luogo</b> per deliberare sul seguente<br><br>
ORDINE DEL GIORNO<br><br>
$ordine<br><br>
Ed assumere le deliberazioni conseguenti, tra cui, ove se necessario ed opportuno, quella di convocare l'assemblea dei soci.
In caso di impossibilit&agrave a partecipare in ogni modo alla riunione, invito cortesemente a giustificare l'assenza.<br><br>
   <b>$luogo, $data</b> <br><br><br> 
 	Il Presidente del Consiglio Direttivo<br><br>
 	<b>$row[nome]</b>";
}
if ($modulo == 'rapporto')
{
echo "RAPPORTO ATTIVITA ESEGUITA<br><br><br><br>
I soci o il socio $presenti comunicano che in data $data hanno svolto l'attivit&agrave $ordine <br>con le seguenti note o specifiche: $verbale<br><br>
$luogo, $data<br>";
}

if ($modulo == 'convocazioneassemblea')
{
echo "CONVOCAZIONE ASSEMBLEA ORDINARIA (O STRAORDINARIA)<br><br><br><br>
A tutti i soci,<br>
<br><b>Oggetto: Convocazione Assemblea Ordinaria (o Straordinaria)</b><br>
<p> i soci  dell'Associazione <b> $assocazione </b>  sono  convocati  in  assemblea ordinaria (o straordinaria) in prima convocazione presso <b>$indsede ,$numsede</b> sito in <b>$luogo</b> il giorno e ora <b>$data2</b> ed eventualmente in seconda convocazione il giorno e ora <b>$data3</b> per esaminare e discutere il seguente<br><br>
ORDINE DEL GIORNO<br><br>
$ordine<br><br>
Ed assumere le deliberazioni conseguenti, tra cui, ove se necessario ed opportuno, quella di convocare l'assemblea dei soci.
In caso di impossibilit&agrave a partecipare in ogni modo alla riunione, invito cortesemente a giustificare l'assenza.<br><br>
   $luogo, $data <br><br><br> 
 	Il Presidente del Consiglio Direttivo<br><br>";
 	
$Query_nome = "SELECT nome FROM tb_anagrafe WHERE classe = 'Presidente' AND tipologia = 'Stud' ORDER BY nome";
$rs=mysqli_query($connect, $Query_nome)
or die("Errore nella query $query: " . mysqli_error()); //die("<b>Errore:</b> Impossibile eseguire la query della Combo");
$row=mysqli_fetch_array($rs);

echo "<b>$row[nome]</b>";
}

} else {
header('Location: ./CompModuli.php');
}
mysql_close();
?>
