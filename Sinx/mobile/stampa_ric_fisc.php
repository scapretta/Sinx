<html>
<head>
<!--Sinx for Association - Gestionale per Associazioni no-profit
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
-->
<?php


  session_start();

$user = $_SESSION['utente'];
if ($user) {

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");

$Query_nome = "SELECT * FROM tb_anagrafe_associaz";

$rs=mysqli_query($connect, $Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");
$row=mysqli_fetch_array($rs);
?>

  <title><?php echo $row[nome]; ?></title>
 <link rel="stylesheet"
	href="print.css"
	type="text/css"
	media="screen" />
</head>


<?php



$nnumeroric = $_POST['numero'];
$numeroric = htmlspecialchars($nnumeroric, ENT_NOQUOTES, "UTF-8");

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

function numero_lettere($numero)
{
    if (($numero < 0) || ($numero > 999999999))
    {
        return "$numero";
    }

    $milioni = floor($numero / 1000000);  // Milioni  
    $numero -= $milioni * 1000000;
    $migliaia = floor($numero / 1000);    // Migliaia 
    $numero -= $migliaia * 1000;
    $centinaia = floor($numero / 100);     // Centinaia 
    $numero -= $centinaia * 100;
    $decine = floor($numero / 10);       // Decine 
    $unita = $numero % 10;               // Unità 

    $cifra_lettere = "";

    if ($milioni)
    {
            if ($milioni == 1)            
            $cifra_lettere .= numero_lettere($milioni) . "milione ";
            else
            $cifra_lettere .= numero_lettere($milioni) . "milioni ";
    }

    if ($migliaia)
    {
            if ($migliaia == 1)            
            $cifra_lettere .= numero_lettere($migliaia) . "mille ";
            else
            $cifra_lettere .= numero_lettere($migliaia) . "mila ";
        
    }

if ($centinaia)
    {
    $tmp = numero_lettere($centinaia);
    $cifra_lettere .= ($tmp=='uno') ? '' : $tmp; 
        $cifra_lettere .= "cento ";
    }

    $array_primi = array("", "uno", "due", "tre", "quattro", "cinque", "sei",
        "sette", "otto", "nove", "dieci", "undici", "dodici", "tredici",
        "quattordici", "quindici", "sedici", "diciassette", "diciotto",
        "diciannove");
    $array_decine = array("", "", "venti", "trenta", "quaranta", "cinquanta", "sessanta",
        "settanta", "ottanta", "novanta");

    if ($decine || $unita)
    {
        if ($decine < 2)
        {
            $cifra_lettere .= $array_primi[$decine * 10 + $unita];
        }
        else
        {
            $cifra_lettere .= $array_decine[$decine];

            if ($unita)
            {
                $cifra_lettere .= $array_primi[$unita];
            }
        }
    }

    if (empty($cifra_lettere))
    {
        $cifra_lettere = "zero";
    }

    return $cifra_lettere;
}

//Controllo campi compilati
		if ($numeroric == "")
 		{
   		echo "<center><b>Il campo Numero &egrave obbligatorio</b></center>";
   		redirect('./InsRicFisc.php' ,2);
		// break;
die ("");
		}
// popolo la tabella delle ricevute
$Query = "SELECT * FROM tb_ricevute WHERE id_ric = '$numeroric'";

$rs=mysqli_query($connect, $Query)
or die('' . mysqli_error());


while ($row=mysqli_fetch_array($rs))
{
$numero = $row['euro'];
$letterale = numero_lettere($numero);
if ( substr($letterale,-3) == 'uno')
$letterale = str_replace("uno","",$letterale).'uno';


echo <<<EOM
<div id="immagine"><img src="./ImmTemplate/ricevuta.jpg"></div>
<div id="numero">$row[id_ric]</div>
<div id="data">$row[data]</div>
<div id="cliente">$row[nome]</div>
<div id="causale">$row[descr]</div>
<div id="euro">#$row[euro]</div>
<div id="letterale">#$letterale</div>

EOM;
}

$Query_nome = "SELECT * FROM tb_anagrafe_associaz";

$rs=mysqli_query($connect, $Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");
$row=mysqli_fetch_array($rs);

echo <<<EOT
<div id="logo"><img src="./Immagini/logo.png"  height="40px"></div>
<div id="associazione">Associazione <b>$row[nome]</b><br>
Via $row[indirizzo], $row[numero] - $row[cap], $row[citta] ($row[provincia])<br>
<br>
CF e PI $row[cf]</div>

EOT;

mysqli_close($connect);


} else {
header('Location: ./index.php');
}
?>

