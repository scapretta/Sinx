<?php
/*======================================================================+
 File name   : conf_files.php
 Begin       : 2012-07-08
 Last Update : 2012-07-08

 Description : upload files

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

  session_start();

$user = $_SESSION['utente'];
if ($user) {

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
$upload_dir = "./Download";
if(@is_uploaded_file($_FILES["immagine"]["tmp_name"])) {
$file_name = $_FILES["immagine"]["name"];
@move_uploaded_file($_FILES["immagine"]["tmp_name"], "$upload_dir/$file_name")
or die("Impossibile spostare il file, controlla l'esistenza o i permessi della directory dove fare l'upload.");

} else {

echo "Problemi nell'upload del file";
if ($_FILES["immagine"]["error"] == 1) {
  echo(" Il file inviato eccede le dimensioni specificate");
  redirect('./gest_files.php' ,3);
  // break;
die ("");
  }
  else if ($_FILES["immagine"]["error"] == 2) {
  echo(" Il file inviato eccede le dimensioni specificate");
  redirect('./gest_files.php' ,3);
  // break;
die ("");
  }
  else if ($_FILES["immagine"]["error"] == 3) {
  echo(" Upload eseguito parzialmente");
  redirect('./gest_files.php' ,3);
  // break;
die ("");
  }
  else if ($_FILES["immagine"]["error"] == 4) {
  echo(" Nessun file è stato inviato");
  redirect('./gest_files.php' ,3);
  // break;
die ("");
  }
  else if ($_FILES["immagine"]["error"] == 6) {
  echo(" Mancanza della cartella temporanea. Inserito in PHP 4.3.10 e PHP 5.0.3");
  redirect('./gest_files.php' ,3);
  // break;
die ("");
  }
  else {
  echo(" Errore di scrittura su disco");
  redirect('./gest_files.php' ,3);
  // break;
die ("");
  }
}
echo "<center><h2>File caricato con successo</h2></center>";
redirect('./Files.php',3);

} else {
header('Location: ./index.php');
}
?>
