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
$langrendiconto = $_SESSION['lingua'];
$paginarendiconto = "rendiconto.inc";
$linguarendiconto = ($langrendiconto.$paginarendiconto);
include($linguarendiconto);

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
?>


<h2><?php echo $Ltitolorendiconto; ?></h2>
<table align='center'>
<tr>

<td><a class='transp' href='./InsBilancioEconomicoOdv.php'><img src="./ImmTemplate/Pulsanti/Odv.png" title="Modello per le associazioni di volontariato"></img></a></td>
<td><a class='transp' href='./InsBilancioEconomicoAps.php'><img src="./ImmTemplate/Pulsanti/Aps.png" title="Modello per le associazioni di promozione sociale"></img></a></td>
</tr>
</table><br>
<div class='column' style="margin-left: 20px;"><small><i><?php echo $Lrendicontoanno; ?></i><br>
<?php echo $Lnuovoschema; ?><br><br> 
<?php echo $Ldescrrendiconto; ?></li>
<br></small></div><br><br>

<?php
include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i><?php echo $Lhelprendiconto; ?>
<hr></i></small><?
include('./botton.inc');

?>
