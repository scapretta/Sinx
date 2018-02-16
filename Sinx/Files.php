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
$langFiles = $_SESSION['lingua'];
$paginaFiles = "Files.inc";
$linguaFiles = ($langFiles.$paginaFiles);
include($linguaFiles);

if ($user == 'admin') {
include('./top.inc');
include('./menu.inc');



function elenco_dir($base)
{
$dir_vuota=1; # Flag per il controllo della directory vuota
if ($handle_dir = opendir($base)) # Apre la directory, e verifica che il percorso sia corretto
{
    echo "<UL class=\"testo\">\n"; 
  while (false!==($dir = readdir($handle_dir))) # Legge una voce finchè non è finita la directory, e la memorizza in $dir

  {
    if ($dir!="." && $dir!="..") #Evita di stampare "." e ".."

    {
      $dir_vuota=0;
          if(is_dir($base. "/" .$dir))

          {
           # Codice nel caso di directory

          echo '<LI style="list-style-image: url(./ImmTemplate/designer.png)"><B>' . $dir . "</B>\n";
          elenco_dir($base. "/" .$dir); 
               echo "</LI>\n";
      }
       else
        {
          #Codice nel caso di file
              if ($dir != "." && $dir != "..")
        {

                   $lista[]=('<LI style="list-style-image: url(./ImmTemplate/doc.png)"><A href="' .$base . '/' . $dir . '">' . str_replace('_', ' ', substr($dir,0, strrpos($dir,"."))) . "</A></LI>\n");
              }
      }
    }

  }

    if ($dir_vuota==1) echo '<LI class="testo" style="list-style-image: url(foto/sbagliato.gif)">Nessun file presente</LI>';    
  echo "</UL><BR>";    
  closedir($handle_dir);
	sort($lista);
	foreach ($lista as $nlista)
	 {
	  echo $nlista. "\n";
	 }
	}
else #Codice nel caso di percorso non trovato
{
  echo "Percorso errato";
}

}    

# Chiamata della funzione come esempio
?><table align='center' border='0' width='90%'>
<tbody>
    
      <tr><td><center><h2><? echo $Ltitologestfiles ?></h2><hr></center></td></tr>
	<tr><td><center>
		<form action="./gest_files.php">
		 <input type="submit" value="Carica, cancella file">
	</form></center></td></tr>
    <tr><td VALIGN="top"> <?php elenco_dir("./Download"); ?></td></tr>
    
   
  </tbody>
</table>
<?

function dir_list($directory)
{
$dirs= array();
$files = array();
if ($handle = opendir("./" . $directory))
{
while ($file = readdir($handle))
{
if (is_dir("./{$directory}/{$file}"))
{
if ($file != "." & $file != "..") $dirs[] = $file; }
else
{
if ($file != "." & $file != "..") $files[] = $file; }
}
}
closedir($handle);
reset($dirs); sort($dirs); reset($dirs);
reset($files); sort($files); reset($files);

//echo "<strong>Cartelle:</strong>\n<ul>";


while(list($key, $valuef) = each($files))
{
//ELENCO FILE
$f++; echo "<li><a href=\"{$directory}{$valuef}\">{$valuef}</a>\n"; }
echo "</ul>\n";
echo "\n<ul>";

while(list($key, $value) = each($dirs))
{
//ELENCO CARTELLE
$d++;
//echo "<li>{$value}\n";

?>
    <tr><td VALIGN="top"> <?php dir_list("./Download/$value/");?></td>
    
<? }
//$d++;echo "<li><a href=\"{$value}\">{$value}/</a>\n"; }
echo "</ul>\n";
echo "\n<ul>";

if (!$d) $d = "0"; if (!$f) $f = "0";
echo "Nella cartella <strong>$directory</strong> ci sono <strong>{$f}</strong> file(s).</strong>\n"; }

//echo "Sono presenti <strong>{$d}</strong> cartelle e <strong>{$f}</strong> file(s).</strong>\n"; }
//if (!$d) $d = "0"; if (!$f) $f = "0"; echo "Sono presenti <strong>{$f}</strong> file(s).</strong>\n"; }

?>
<table align='center' border='0' width='90%'>
<tbody>
     <td><center><h2><? echo $Lcaricaimmagine ?></h2><hr></center></td></tr>
     <td VALIGN="top"> <?php dir_list("./Immagini/Utenti/"); ?></td></tr>
     
<!--      <tr><td><center><h2>Moduli e files caricati</h2><hr></center></td></tr>
    <tr><td VALIGN="top"> <?php dir_list("./Download/"); ?></td></tr>
-->    
   
  </tbody>
</table>

<?php

include('./menusx.inc');
echo $Lhelpgestimmagini;
include('./botton.inc');
} else {
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

echo $Llivello1gestimmagini;
redirect('./index2.php',3);
}
?>

