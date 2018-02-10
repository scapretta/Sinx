<?php
/*======================================================================+
 File name   : DatiComini.inc
 Begin       : 2010-08-04
 Last Update : 2012-10-27

 Description : Common data entry registries

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
=========================================================================+*/
$langdaticom = $_SESSION['lingua'];
$paginadaticom = "daticomuni.inc";
$linguadaticom = ($langdaticom.$paginadaticom);

include($linguadaticom);

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");

?>

	    <tr>
	      <td width='150'><?php echo $Lpimmagine; ?><input type="hidden" name="MAX_FILE_SIZE" value="30000"> </td>
	      <td> <input name="immagine" type="file" accept="image/*"><br><small><sub><i><?php echo $Listrimmagine; ?></small></i></sub></td>
	    </tr>
            <tr>
              <td width='150'><font color="red"><?php echo $Lnomedaticomuni; ?></td>
              <td><input name='nome' size='30' type='text' required='required'><br><small><sub><i><?php $Listrnome; ?></small></i></sub></td>
            </tr>
            <tr>
              <td width='150'><?php echo $Lcognomedaticomuni; ?></td>
              <td><input name='cognome' size='30' type='text'><br><small><sub><i><?php $Listrcognome; ?></small></i></sub></td>
            </tr>
            <tr>
              <td width='150'><?php echo $Lindirizzo; ?></td>
              <td><input name='indirizzo' size='30' type='text'><br><small><sub><i><?php echo $Listrindirizzo; ?></small></i></sub></td>
            </tr>
<tr>
              <td><?php echo $Lregione; ?></td>

<td><select name="regioni" >
   <option value="" selected="selected"><?php echo $Lscegli; ?></option>
<?php
$query = "SELECT nome_regione FROM regioni ORDER BY nome_regione";
 
$rs=mysqli_query($connect,  $query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo cap");

while ($row = mysqli_fetch_row($rs))
{
echo "<option>" .$row["0"]. "</option>";

}
?>
  </select><br><small><sub><i><?php echo $Lsuggregione; ?></small></i></sub></td>
  
</tr>
<tr>
             <td><?php echo $Lprovincia; ?></td>

<td><select name="provincie" >
   <option value="" selected="selected"><?php $Lscegli; ?></option>
<?php
$query = "SELECT nome_provincia FROM province ORDER BY nome_provincia";
 
$rs=mysqli_query($connect,  $query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo cap");

while ($row=mysqli_fetch_row($rs))
{
echo "<option>" .$row["0"]. "</option>";

}
?>
  </select><br><small><sub><i><?php echo $Lsuggprovincia; ?></small></i></sub></td>
  </tr>
<tr>
             <td><?php echo $Lcomune; ?></td>

<td><select name="comuni" >
   <option value="" selected="selected"><?php echo $Lscegli; ?></option>
<?php
$query = "SELECT cap, comune FROM comuni ORDER BY comune ASC";
 
$rs=mysqli_query($connect,  $query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo cap");

while ($row=mysqli_fetch_row($rs))
{
echo "<option>" .$row["0"], " - ", $row["1"]. "</option>";

}
?>
  </select><br><small><sub><i><?php echo $Lsuggcitta; ?></small></i></sub></td>
  </tr>
            <tr>
              <td width='150'><?php echo $Ltel; ?></td>
              <td><input name='tel' size='30' type='tel' min='0' max='3499999999'><br><small><sub><i><?php echo $Listrtel; ?></small></i></sub></td>
            </tr>
            <tr>
              <td width='150'><?php echo $Lcell; ?></td>
              <td><input name='tel2' size='30' type='tel' min='0' max='3499999999'><br><small><sub><i><?php echo $Listrtel; ?></small></i></sub></td>
            </tr>
            <tr>
              <td width='150'>e-mail:</td>
              <td><input name='email' size='30' type='email' placeholder='email@socio.xxx'></td>
            </tr>
            <tr>
              <td width='150'><?php echo $Ldatanasc; ?></td>
              <td><input name='datangg' size='2' type='number' min='1' max='31'> - 
		  <input name='datanmm' size='2' type='number' min='1' max='12'> -
		  <input name='datanaaaa' size='4' type='number' min='1900' max='2100'><br><small><sub><i><?php echo $Listrdatan; ?></small></i></sub>
	      </td>
            </tr>
            <tr>
              <td width='150'><?php echo $Lcodfiscale; ?></td>
              <td><input name='nomerif' size='30' type='text'></td>
            </tr>
            <tr>
              <td width='150'><?php echo $Lassociato; ?></td>
              <td><input type="checkbox" name="check" checked="checked" value="1"><?php echo $Lassociatoattivo; ?></td>
            </tr>
	    <tr>
	      <td width='150'><?php echo $Lnote; ?></td>
	      <td><textarea name="note" rows="5" cols="40"></textarea></td>
	    </tr>
