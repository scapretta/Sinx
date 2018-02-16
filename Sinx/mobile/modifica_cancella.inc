<!--======================================================================+
 File name   : conf_mod_stud
 Begin       : 2010-08-04
 Last Update : 2012-10-27

 Description : form modification and deletion associated

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
$associato = $_POST['associato'];
$Query_nome = "SELECT * FROM tb_anagrafe WHERE id_anagrafe = $associato";

$rs=mysqli_query($connect, $Query_nome)
or die("Errore nella query $Query_nome: " . mysqli_error()); //die("<b>Errore:</b> Impossibile eseguire la query della Combo");
while ($row=mysqli_fetch_array($rs))
{
$idprec = $row['id_anagrafe'];
}
?>

<p><center><b>Cancella</b></center></p>
<table align='center' border='0' width='40%'>
<tbody>
	<tr>
		<td><p><small>Inserisci il numero id da cancellare e premi cancella</small></p></td>
	<td><form action='./conf_canc.php?Tabella=tb_anagrafe&Riferimento=id_anagrafe' method='POST'>
		</td>		
		<td width='10'>id:</td>
		<td>
<?php
{
echo "<input name='id_mod' size='10' type='text' value='$idprec' readonly>";
}
?>
</td>
	<td><p colspan='2' align='center'>
		<input value='- Cancella -' type='submit' <? echo($limit); ?>></p>
	</td>
	</tr>
</tbody>
</table>
</form>
<hr style="width: 80%; height: 2px;">
<p><center><b>Modifica</b></center></p>
<p align="center"><small>Inserisci in numero id e campo da modificare<br>Inserisci la modifica su Nuovo record e premi modifica</p></small>

<table align='center' border='0' width='50%'>
          <tbody>
	<td><form action='./conf_mod_stud.php' method='POST'></td>
            <tr>
              <td width='150'>Id*:</td>
              <td>
<?php

echo "<input name='id_mod' size='10' type='text' value='$idprec' readonly>";

?>

</td>
            </tr>
            <tr>

<td width='150'>Campo*:</td>
		<td>
<select name="campo" >
	<option value="" selected="selected"></option>
    <option value="ntessera">Tessera</option>
  <option value="nome">Nome</option>
  <option value="indirizzo">Indirizzo</option>
  <option value="cap">Comune</option>
  <option value="citta">Regione</option>
  <option value="provincia">Provincia</option>
  <option value="tel">Telefono</option>
  <option value="tel2">Telefono 2</option>
  <option value="datan">Data di Nascita</option>
  <option value="materia">Tipo di socio</option>
  <option value="classe">Funzione</option>
  <option value="nomerif">Codice Fiscale</option>
  <option value="mansione">Mansione</option>
  <option value="email">e-mail</option>
  <option value="note">Note</option>
  <option value="immagine">Immagine</option>
  <option value="associato">Socio Attivo (si - no)</option>

</td>


<!--		<td width='150'>Campo*:</td>
		<td><input name='campo' size='20' type='text'></td> -->
	</tr>
	<tr>
		<td width='150'>Nuovo record*:</td>
		<td><input name='record' size='20' type='text' required='required'><br><small><sub><i>Per le immagini, inserire solo nome dell'immagine e l'estensione: "immagine.jpg"</small></i></sub></td>
	<td><p colspan='2' align='center'>
	<input value=' Modifica ' type='submit' <? echo($limit); ?>></p></td>
	</tr>
</tbody>
</table>
</form> 
<hr style="width: 60%; height: 2px;">
