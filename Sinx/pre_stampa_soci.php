<?php
/*======================================================================+
 File name   : pre_stampa_soci.php
 Begin       : 2014-02-02
 Last Update : 2014-02-02

 Description : Pre print to associate's book

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
$langu = $_SESSION['lingua'];
$paginaindex12 = "pre_stampa_soci.inc";
$linguaindex12 = ($langu.$paginaindex12);
include($linguaindex12);

if ($user) {
include('./top.inc');
include('./menu.inc');

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");

?>
<h2><?php echo $Llibrosoci; ?></h2>

 <div style="margin-left: 20px;"><small><center><?php echo $Lfrase; ?></center></div></small><br>
 <hr width='70%'><br>
 
 <form action='./stampa_soci.php' method='POST' target="_blank">
 <table width='60%' align='center'>
  <tr><td><fieldset>
	      <legend><small><i><?php echo $Lordinamento; ?></i></small></legend>
  <small><b><i><small><?php echo $Lsugg; ?></i></b></small></small><br>
  <input type="radio" name="ordine" value="nome" checked="checked"/><small><?php echo $Lnome; ?> </small>
  <input type="radio" name="ordine" value="id_anagrafe"/><small><?php echo $Ltessera; ?></small><br>
	      </fieldset></td></tr>
<tr>
              <td colspan='3' align='center'>
              <input type='submit' target='_BLANK' value= <? echo $Lstampa; ?> ></td>
            </tr>
</table>
      
      

<?php
mysqli_close($connect);
include('./menusx.inc');
echo $Lhelpindex2;
include('./botton.inc');
} else {
header('Location: ./index.php');
}
?>

