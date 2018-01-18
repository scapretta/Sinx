<?php
/*======================================================================+
 File name   : conf_logo_associaz.php
 Begin       : 2013-10-10
 Last Update : 2013-10-10

 Description : logo association

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

// *** GESTIONE DELL'IMMAGINE ***
$upload_dir = "./Immagini";
if(@is_uploaded_file($_FILES["immagine"]["tmp_name"])) {
$file_name = $_FILES["immagine"]["name"];
@move_uploaded_file($_FILES["immagine"]["tmp_name"], "$upload_dir/$file_name")
or die("Impossibile spostare il file, controlla l'esistenza o i permessi della directory dove fare l'upload.");

// rinomina del logo dell'Associazione
$ret = rename("$upload_dir/$file_name","$upload_dir/logo.png");
if ($ret = FALSE) { 
  echo "problemi con la rinomina del file";
  redirect('./gest_files.php',2);
  }
  
} else {

echo "Problemi nell'upload del file immagine" . $_FILES["immagine"]["name"];
redirect('./gest_files.php' ,2);
// break;
die ("");
}
echo "Immagine caricata con successo";
redirect('./dati_Associaz.php',2);

?>
