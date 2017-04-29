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
$langtipoass = $_SESSION['lingua'];
$paginatipoass = "nmateria.inc";
$linguatipoass = ($langtipoass.$paginatipoass);
include($linguatipoass);

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
?>

      <center><h3><?php echo $Ltitolotipoass ?></h3></center>
      
 <form action='./nmateria_exp.php'>
 <center><button name="stampa" type="submit" <?php echo($limit); echo($limite);?>>
   Cancella | Modifica
 </button></center>
 </form>      
      
<hr width="60%">
	<p align="center"><small><b><?php echo $Lnuovotipoass ?></b></small></p>
<!-- Inserimento Voci db -->
<br>
      <form action='./conf_nmateria.php?Tabella=tb_materia&Colonna=materia&Pagina=nmateria' method='POST'>
        <table align='center' border='0' width='60%'>
          <tbody>
            <tr>
              <td width='150'><?php echo $Lnuovotipoass.$Lsociotipoass ?>:</td>
              <td><input name='nrecord' size='30' type='text'></td>
            </tr>
            <tr>
              <td colspan='2' align='center'>
              <input value='invia' type='submit' <?php echo($limit); echo($limite);?>></td>
            </tr>
          </tbody>
        </table>
      </form>
	<p align="center"><small><b><?php echo $Lelencotipoass ?></b></small></p>
<center><h3><?php echo $Ltitoloelencotipoass ?></h3></center>
<?php
// popolo la tabella visualizzazione elenco
$Query_nome = "SELECT * FROM tb_materia ORDER BY materia";

$rs=mysqli_query($connect, $Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

{
echo <<<EOM
<br>
<table class='bordo' align='center' cellpadding='0' cellspacing='0' width='50%'>
	<tr>
	<td height='25px' width='125' align='center'><small><b>id_$Lsociotipoass</b></small></td>
	<td width='125'><small><b>$Ltipotipoass $Lsociotipoass</b></small></td>
	</tr>
	<tr><td></td></tr>

EOM;
}

while ($row=mysqli_fetch_array($rs))
{
echo <<<EOM
	<tr>
	<td height='25px' width='125' align='center'><small>$row[id_materia]</small></td>
	<td height='25px' width='125'><small>$row[materia]</small></td>
	</tr>

EOM;
}

echo <<<EOT
</table>
EOT;
include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i><?php echo $Lhelptipoass ?><hr></i></small>

<?
include('./botton.inc');

?>
