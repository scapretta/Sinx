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
      <form action='./conf_immagine_install.php' method='POST' enctype="multipart/form-data">
<center><h2>Caricamento Logo Associazione</h2></center>
<center><small>L'inserimento del logo dell'Associazione serve per predisporre l'intestazione per le stampe</small></center>
<br>
<center><progress value="50" max="100">50%</progress></center>
<table align='center' width='80%'>

	    <tr>
	      <td width='150'>Carica Immagine:<input type="hidden" name="MAX_FILE_SIZE" value="30000"> </td>
	      <td> <input name="immagine" type="file" accept="image/*"><br><small><sub><i>Inserisci il logo dell'Associazione <b>massimo 30 kByte</b></small></i></sub></td>
	      <td><small><sub><i>L'mmagine deve essere di tipo png; le dimensioni ottimali sono di 60px di altezza e non pu&ograve superare i 30Kb;<br><b>Dove verr&agrave nominata: "logo.png" in modo automatico</b><br>L'immagine risiede nella cartella 'Immagini' di Sinx</sub></small></td>
	    </tr>
            <tr>
              <td colspan='2' align='center'>
              <input value='invia' type='submit'></td>
            </tr>
</table>
</form>
