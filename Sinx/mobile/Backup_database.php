<?php
/*======================================================================+
 File name   : Backup_database.php
 Begin       : 2013-01-09
 Last Update : 2013-08-21

 Description : sistem remote backup and restore

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
if ($user == 'admin') {

	include ('dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");

// *** Creo la lista delle tabelle ***
 
$sql = "SHOW TABLES FROM $db_name";
$result_tabelle = mysqli_query($connect, $sql);
 
if (!$result_tabelle) {
   echo "DB Error, could not list tables\n";
   echo 'MySQL Error: ' . mysqli_error();
   exit;
}


// **** AVVIO DEL BACKUP ****
# Creo la funzione datadump
function datadump ($table) {
  # Creo la variabile $result
  if(!isset($result)) $result = "";
  
  $result .= "# Dump of $table \n";
  $result .= "# Dump DATE : " . date("d-M-Y") ."\n\n";

  # Conto i campi presenti nella tabella
  include ('dati_db.inc');
  if(!isset($connect)) $connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");
  $query = mysqli_query($connect, "select * from $table");
// angelo  $num_fields = @mysqli_field_count($query);
  $num_fields = @mysqli_field_count($connect);

  # Conto il numero di righe presenti nella tabella
  $numrow = mysqli_num_rows($query);

  # Passo con un ciclo for tutte le righe della tabella
  for ($i =0; $i<$numrow; $i++)
  {
    $row = mysqli_fetch_row($query);

    # Ricreo la tipica sintassi di un comune Dump
    $result .= "INSERT INTO ".$table." VALUES(";

    # Con un secondo ciclo for stampo i valori di tutti i campi
    # trovati in ogni riga
    for($j=0; $j<$num_fields; $j++) {
      $row[$j] = addslashes($row[$j]);
      $row[$j] = preg_replace("/\n/","\\n",$row[$j]); // angelo from ereg_replace to preg_replace
      if (isset($row[$j])) $result .= "\"$row[$j]\"" ; else $result .= "\"\"";
      if ($j<($num_fields-1)) $result .= ",";
    }

    # Chiudo l'istruzione INSERT
    $result .= ");\n";
  }

  return $result . "\n\n\n";
}
# Diamo un nome al file di Dump che verrà creato
$file_name = "Sinx_Backup_".date('d-m-Y').".txt";

# Definiamo le intestazioni
Header("Content-type: application/octet-stream"); 
Header("Content-Disposition: attachment; filename = $file_name");

echo "# Backup Database Gestionale\n";
echo "\n";
echo "# Ceazione Tabelle\n";
echo "\n";
echo "CREATE TABLE IF NOT EXISTS `appuntamenti` (`id` int(11) NOT NULL,`titolo` varchar(255) NOT NULL DEFAULT '',`testo` text NOT NULL,`str_data` varchar(10) NOT NULL DEFAULT '0') ENGINE=MyISAM DEFAULT CHARSET=latin1;\n";
echo "CREATE TABLE IF NOT EXISTS `comuni` (`id_com` int(6) UNSIGNED NOT NULL,`id_pro` int(4) UNSIGNED NOT NULL,`cap` int(8) UNSIGNED NOT NULL,`comune` varchar(200) CHARACTER SET latin1 NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8;\n";
echo "CREATE TABLE IF NOT EXISTS `province` (`id_pro` int(4) UNSIGNED NOT NULL,`id_reg` int(3) UNSIGNED NOT NULL,`nome_provincia` varchar(200) CHARACTER SET latin1 NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8;\n";
echo "CREATE TABLE IF NOT EXISTS `regioni` (`id_reg` int(3) UNSIGNED NOT NULL,`nome_regione` varchar(200) CHARACTER SET latin1 NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8;\n";
echo "CREATE TABLE IF NOT EXISTS `tb_anagrafe` (  `id_anagrafe` int(9) NOT NULL,  `nome` varchar(25) DEFAULT NULL,  `cognome` varchar(25) DEFAULT NULL,  `indirizzo` varchar(40) DEFAULT NULL,  `cap` varchar(55) DEFAULT NULL,  `citta` varchar(25) DEFAULT NULL,  `provincia` varchar(25) DEFAULT NULL,  `tel` varchar(10) DEFAULT NULL,  `tel2` varchar(10) DEFAULT NULL,  `datan` varchar(10) DEFAULT NULL,  `classe` varchar(25) DEFAULT NULL,  `nomerif` varchar(25) DEFAULT NULL,  `materia` varchar(25) DEFAULT NULL,  `mansione` varchar(25) DEFAULT NULL,  `email` varchar(30) DEFAULT NULL,  `tipologia` varchar(5) DEFAULT NULL,  `note` varchar(150) DEFAULT NULL,  `immagine` varchar(100) DEFAULT NULL,  `associato` varchar(2) DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;\n";
echo "CREATE TABLE IF NOT EXISTS `tb_anagrafe_associaz` (  `id_anagrafe` int(9) NOT NULL,  `nome` varchar(70) DEFAULT NULL,  `indirizzo` varchar(100) DEFAULT NULL,  `numero` varchar(10) DEFAULT NULL,  `cap` varchar(6) DEFAULT NULL,  `citta` varchar(50) DEFAULT NULL,  `provincia` varchar(2) DEFAULT NULL,  `tel` varchar(15) DEFAULT NULL,  `fax` varchar(15) DEFAULT NULL,  `cf` varchar(50) DEFAULT NULL,  `email` varchar(100) DEFAULT NULL,  `webmail` varchar(100) DEFAULT NULL,  `sito` varchar(100) DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;\n";
echo "CREATE TABLE IF NOT EXISTS `tb_classe` (  `id_classe` int(9) NOT NULL,  `classe` varchar(25) DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;\n";
echo "CREATE TABLE IF NOT EXISTS `tb_conto_economico` (  `id` int(11) NOT NULL,  `descrizione` varchar(125) NOT NULL,  `valore` decimal(8,2) NOT NULL,  `costoricavo` varchar(25) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;\n";
echo "CREATE TABLE IF NOT EXISTS `tb_email` (  `id_mail` int(11) NOT NULL,  `data` varchar(10) NOT NULL, `dest` varchar(25) NOT NULL, `testo` text) ENGINE=InnoDB DEFAULT CHARSET=utf8;\n";
echo "CREATE TABLE IF NOT EXISTS `tb_fatture` (  `id_fatt` int(11) NOT NULL,  `id_riga_art` int(11) NOT NULL,  `nome` varchar(25) NOT NULL,  `data` varchar(10) NOT NULL,  `euro` decimal(8,2) DEFAULT NULL,  `quantita` decimal(8,3) NOT NULL,  `iva` int(2) NOT NULL,  `descr` varchar(200) NOT NULL,  `modpaga` varchar(500) NOT NULL,  `totale` decimal(8,2) DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;\n";
echo "CREATE TABLE IF NOT EXISTS `tb_materia` (  `id_materia` int(9) NOT NULL,  `materia` varchar(25) DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;\n";
echo "CREATE TABLE IF NOT EXISTS `tb_primanota` (  `id_primanota` int(9) NOT NULL,  `id_ricevuta` int(9) DEFAULT NULL,  `id_fattura` int(9) DEFAULT NULL,  `nome` varchar(25) DEFAULT NULL,  `descrizione` varchar(50) DEFAULT NULL,  `entrata` decimal(8,2) DEFAULT NULL,  `uscita` decimal(8,2) DEFAULT NULL,  `entratab` decimal(8,2) DEFAULT NULL,  `uscitab` decimal(8,2) DEFAULT NULL,  `data_registr` varchar(10) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;\n";
echo "CREATE TABLE IF NOT EXISTS `tb_progetto` (  `id_progetto` int(11) NOT NULL,  `id_riga_art` int(11) NOT NULL,  `nome` varchar(25) NOT NULL,  `data` varchar(10) NOT NULL,  `euro` decimal(8,2) DEFAULT NULL,  `quantita` decimal(8,3) NOT NULL,  `iva` int(2) NOT NULL,  `descr` varchar(25) NOT NULL,  `totale` decimal(8,2) DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;\n";
echo "CREATE TABLE IF NOT EXISTS `tb_ricevute` (  `id_ric` int(11) NOT NULL,  `nome` varchar(25) NOT NULL,  `data` varchar(10) NOT NULL,  `euro` decimal(8,2) DEFAULT NULL,  `descr` varchar(100) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;\n";
echo "CREATE TABLE IF NOT EXISTS `tb_stato_patrimoniale` (  `id` int(11) NOT NULL,  `descrizione` varchar(125) NOT NULL,  `valore` decimal(8,2) DEFAULT NULL,  `costoricavo` varchar(25) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;\n";
echo "CREATE TABLE IF NOT EXISTS `tb_tot_fatture` (  `id` int(11) NOT NULL,  `id_tot_fatture` int(11) NOT NULL,  `nome` varchar(25) NOT NULL,  `data` varchar(10) NOT NULL,  `tot_fattura` decimal(8,2) DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;\n";
echo "CREATE TABLE IF NOT EXISTS `tb_tot_progetto` (  `id` int(11) NOT NULL,  `nome` varchar(25) NOT NULL,  `data` varchar(10) NOT NULL,  `descrizione` text,  `tot_progetto` decimal(8,2) DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;\n";
echo "CREATE TABLE IF NOT EXISTS `utenti` (  `id` int(11) NOT NULL,  `nome` varchar(25) NOT NULL,  `pswd` text NOT NULL,  `utente` varchar(25) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;\n";
echo "\n";
echo "# Ceazione Indici\n";
echo "\n";
echo "ALTER TABLE `appuntamenti` ADD PRIMARY KEY (`id`);\n";
echo "ALTER TABLE `comuni`  ADD PRIMARY KEY (`id_com`);\n";
echo "ALTER TABLE `province`  ADD PRIMARY KEY (`id_pro`);\n";
echo "ALTER TABLE `regioni`  ADD PRIMARY KEY (`id_reg`);\n";
echo "ALTER TABLE `tb_anagrafe`  ADD PRIMARY KEY (`id_anagrafe`);\n";
echo "ALTER TABLE `tb_anagrafe_associaz`  ADD PRIMARY KEY (`id_anagrafe`);\n";
echo "ALTER TABLE `tb_classe`  ADD PRIMARY KEY (`id_classe`);\n";
echo "ALTER TABLE `tb_conto_economico`  ADD PRIMARY KEY (`id`);\n";
echo "ALTER TABLE `tb_email`  ADD PRIMARY KEY (`id_mail`);\n";
echo "ALTER TABLE `tb_fatture`  ADD PRIMARY KEY (`id_riga_art`);\n";
echo "ALTER TABLE `tb_materia`  ADD PRIMARY KEY (`id_materia`);\n";
echo "ALTER TABLE `tb_primanota`  ADD PRIMARY KEY (`id_primanota`);\n";
echo "ALTER TABLE `tb_progetto`  ADD PRIMARY KEY (`id_riga_art`);\n";
echo "ALTER TABLE `tb_ricevute`  ADD PRIMARY KEY (`id_ric`);\n";
echo "ALTER TABLE `tb_stato_patrimoniale`  ADD PRIMARY KEY (`id`);\n";
echo "ALTER TABLE `tb_tot_fatture`  ADD PRIMARY KEY (`id`);\n";
echo "ALTER TABLE `tb_tot_progetto`  ADD PRIMARY KEY (`id`);\n";
echo "ALTER TABLE `utenti`  ADD PRIMARY KEY (`id`);\n";



# Poniamo di voler fare il Dump di 2 tabelle chiamate rispettivamente
# "amici" e "clienti"... Ovviamente potete modificare
# a piacimento!
while ($lista = mysqli_fetch_row($result_tabelle)) {
  $table = datadump("{$lista[0]}");
	# Stampiamo il contenuto
  echo $table; 
}
# Chiudiamo
exit;



mysqli_close($connect);


/*
function __backup_mysql_database($params)
{
    $mtables = array(); $contents = "-- Database: `".$params['db_to_backup']."` --\n";
   
    $mysqli = new mysqli($params['db_host'], $params['db_uname'], $params['db_password'], $params['db_to_backup']);
    if ($mysqli->connect_error) {
        die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
    }
   
    $results = $mysqli->query("SHOW TABLES");
   
    while($row = $results->fetch_array()){
            $mtables[] = $row[0];
    }

    foreach($mtables as $table){
        $contents .= "-- Table `".$table."` --\n";
       
        $results = $mysqli->query("SHOW CREATE TABLE ".$table);
        while($row = $results->fetch_array()){
            $contents .= $row[1].";\n\n";
        }

        $results = $mysqli->query("SELECT * FROM ".$table);
        $row_count = $results->num_rows;
        $fields = $results->fetch_fields();
        $fields_count = count($fields);
       
        $insert_head = "INSERT INTO `".$table."` (";
        for($i=0; $i < $fields_count; $i++){
            $insert_head  .= "`".$fields[$i]->name."`";
                if($i < $fields_count-1){
                        $insert_head  .= ', ';
                    }
        }
        $insert_head .=  ")";
        $insert_head .= " VALUES\n";       
               
        if($row_count>0){
            $r = 0;
            while($row = $results->fetch_array()){
                if(($r % 400)  == 0){
                    $contents .= $insert_head;
                }
                $contents .= "(";
                for($i=0; $i < $fields_count; $i++){
                    $row_content =  str_replace("\n","\\n",$mysqli->real_escape_string($row[$i]));
                   
                    switch($fields[$i]->type){
                        case 8: case 3:
                            $contents .=  $row_content;
                            break;
                        default:
                            $contents .= "'". $row_content ."'";
                    }
                    if($i < $fields_count-1){
                            $contents  .= ', ';
                        }
                }
                if(($r+1) == $row_count || ($r % 400) == 399){
                    $contents .= ");\n\n";
                }else{
                    $contents .= "),\n";
                }
                $r++;
            }
        }
    }
      
    $backup_file_name = "Sinx_Backup_".date( "d-m-Y--h-i-s").".sql";

	# Definiamo le intestazioni
	Header("Content-type: application/octet-stream"); 
	Header("Content-Disposition: attachment; filename = $backup_file_name");
    
    # Scrive il backup completo   
    echo $contents;
}

// -------------- new start

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$user = $_SESSION['utente'];
if ($user == 'admin') {

	include ('dati_db.inc');

$para = array(
    'db_host'=> $host,  //mysql host
    'db_uname' => $username,  //user
    'db_password' => $password, //pass
    'db_to_backup' => $db_name //database name
);
__backup_mysql_database($para);
*/

// header('Location: conferma.html');
} else {
	header('Location: Rip_database.php');
}
?>
