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
$langfunzioni = $_SESSION['lingua'];
$paginafunzioni = "nclasse.inc";
$linguafunzioni = ($langfunzioni.$paginafunzioni);
include($linguafunzioni);

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

      <center><h3><?php echo $Ltitolofunzione ?></h3></center>
	
 <form action='./nclasse_exp.php'>
 <center><button name="stampa" type="submit" <?php echo($limit);?> <? echo($limite);?>>
   Cancella | Modifica
 </button></center>
 </form>
	
<hr width="60%">
	<p align="center"><small><b><?php echo $Lnuovofunzione ?></b></small></p>
<!-- Inserimento Voci db -->
      <form action='./conf_nmateria.php?Tabella=tb_classe&Colonna=classe' method='POST'>
        <table align='center' border='0' width='60%'>
          <tbody>
            <tr>
              <td width='150'><?php echo $Lnuovafunzione ?>:</td>
              <td><input name='nrecord' size='30' type='text'></td>
            </tr>
            <tr>
              <td colspan='2' align='center'>
              <input value='invia' type='submit' <?php echo($limit);?> <? echo($limite);?>></td>
            </tr>
          </tbody>
        </table>
      </form>
	<p align="center"><small><b><?php echo $Lelencofunzione ?></b></small></p>
<center><h3><?php echo $Ldescrelencofunzione ?></h3></center>
<?php
// popolo la tabella visualizzazione elenco
$Query_nome = "SELECT * FROM tb_classe ORDER BY classe";

$rs=mysqli_query($connect, $Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

{
echo <<<EOM
<br>
<table class='bordo' align='center' cellpadding='0' cellspacing='0' width='50%'>
	<tr>
	<td height='25px' width='125' align='center'><small><b>id_$Lfunzione</b></small></td>
	<td width='125'><small><b>$Lfunzione</b></small></td>
	</tr>
	<tr><td></td></tr>

EOM;
}

while ($row=mysqli_fetch_array($rs))
{
echo <<<EOM
	<tr>
	<td height='25px' width='125' align='center'><small>$row[id_classe]</small></td>
	<td height='25px' width='125'><small>$row[classe]</small></td>
	</tr>

EOM;
}

echo <<<EOT
</table>
EOT;
include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i><?php echo $Lhelpfunzioni ?><hr></i></small>

<?
include('./botton.inc');

?>
