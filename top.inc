
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<!--======================================================================+
 File name   : top.inc
 Begin       : 2010-08-04
 Last Update : 2012-08-27

 Description : The top of all pages

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
-->
<?php
$versione = $_SESSION['vers'];
$nutente = $_SESSION['nome'];
$user = $_SESSION['utente'];
$langtop = $_SESSION['lingua'];

$paginatop = "top.inc";
$linguatop = ($langtop.$paginatop);
include($linguatop);

//LOG DI SINX
if (isset($_SERVER['HTTP_REFERER'])){
$provenienza = $_SERVER['HTTP_REFERER'];
} else {
$provenienza = "";
};
$data = date("d-m-y"); $ora = date("G:i:s");
$ip = $_SERVER['REMOTE_ADDR'];
$browser = $_SERVER['HTTP_USER_AGENT'];

$testo = "<br>\n\r------\n\r<br>".$data." ".$ora."<br>";
$testo = $testo."\n\rIndirizzo IP: ".$ip."<br>";
$testo = $testo."\n\rProvenienza connessione: ".$provenienza."<br>";
$testo = $testo."\n\rAltre info: ".$browser."<br>";
$testo = $testo."\n\rUtente: ".$nutente."<br>";
$testo = $testo."\n\rLivello Utente: ".$user;

$var=fopen("./log/logSinx.txt","a");
fwrite($var,$testo);
fclose($var);

include ('./dati_db.inc');
$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");
$Query_nome = "SELECT * FROM tb_anagrafe_associaz";

$rs=mysqli_query($connect, $Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");
$row=mysqli_fetch_array($rs);

?>
<head>
  <meta content="text/html; charset=ISO-8859-1"
 http-equiv="content-type">
  <title>Sinx</title>
<link rel="stylesheet" type="text/css" href="style.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type='text/javascript' src='./menu_assets/menu_jquery.js'></script>


</head>
<body>

<!-- HEADER -->
<table class='header bordo' cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td style="width: 15%;"><a href='./index2.php'><img style="border: 0px; width: 130px" src="./ImmTemplate/Nuovo_Logo_web.png"></td></a>
      <td style="width: 5px;"></td>
      <td style="text-align: center"><h2>Sinx</h2><h3><?php echo $Lpresentazione ?></h3><sub><i><b><?php echo $row['nome'] ?></b> - <? echo $row['indirizzo'] ?>, <? echo $row['numero'] ?> - <? echo $row['cap'] ?> <? echo $row['citta'] ?> - <? echo $row['provincia'] ?></b></sub>
      <sub><br><br><small><?echo $Lutente ?><b><?php echo $nutente ?></b> - <?php echo $Llivello ?><b><?php echo $user ?></b> - <?php echo $Lora; echo (date("G:i"));?> - <?php echo $Ldata; echo (date("d-m-y"));?></td>

<!-- **** LOGOUT **** -->
	<td align='center' width='15%'>
<!-- <img align="middle" src="./ImmTemplate/logout.png">&nbsp;<a href='./Backup_database.php'><font color="black"><b>Bakup db</b></a><br> -->
<a class="transp" href='./logout.php'><img src="./ImmTemplate/Pulsanti/Out.png" title="Uscita dal Programma" ></img></a><SMALL>
      <br><center><i><font color="black">www.sinx.it - info@sinx.it</i></center><br><small><?php echo $Lversione; echo $versione; ?></small></td>
    </tr>
</div>
</table>
