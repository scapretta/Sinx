<?php
/*======================================================================+
 File name   : gest_files.php
 Begin       : 2012-07-08
 Last Update : 2012-07-08

 Description : Image and files upload

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

include('./top.inc');

?>
<center><h2>Dati dell'Associazione</h2></center>
<center><small>Inserisci tutti i dati dell'Associazione</small></center>
<br>
<center><progress value="75" max="100">75%</progress></center>
      <form action='./conf_Dati.php' method='POST' enctype="multipart/form-data">
<table align='center' width='50%'>
<tbody>
 <tr>
              <td width='70%'><font color="red">Nome Associazione:</td>
              <td><input name='nome' size='30%' type='text'></td>
            </tr>
            <tr>
              <td width='70%'>Via:</td>
              <td><input name='indirizzo' size='30%' type='text'></td>
            </tr>
            <tr>
              <td width='70%'>Numero:</td>
              <td><input name='numero' size='30%' type='text'></td>
            </tr>
            <tr>
              <td width='70%'>CAP:</td>
              <td><input name='cap' size='30%' type='number'></td>
            </tr>
            <tr>
              <td width='70%'>Citt&agrave:</td>
              <td><input name='citta' size='30%' type='text'></td>
            </tr>
            <tr>
              <td width='70%'>Provincia:</td>
              <td><input name='provincia' size='30%' type='text'></td>
            </tr>
            <tr>
              <td width='70%'>Telefono:</td>
              <td><input name='tel' size='30%' type='tel'></td>
            </tr>
            <tr>
              <td width='70%'>Fax:</td>
              <td><input name='fax' size='30%' type='tel'></td>
            </tr>
            <tr>
              <td width='70%'><font color="red">Codice Fiscale ed eventuale Partita Iva:</td>
              <td><input name='cf' size='30%' type='text'></td>
            </tr>
            <tr>
              <td width='70%'>indirizzo e-mail:</td>
              <td><input name='email' size='30%' type='email'></td>
            </tr>
            <tr>
              <td width='70%'>indirizzo webmail:</td>
              <td><input name='webmail' size='30%' type='url'></td>
            </tr>
            <tr>
              <td width='70%'>indirizzo sito internet:</td>
              <td><input name='sito' size='30%' type='url'></td>
            </tr>
            <tr>
              <td colspan='2' align='center'>
              <input value='invia' type='submit'></td>
            </tr>
</form>

<?
include('./botton.inc'); ?>
