<?php
/*======================================================================+
 File name   : conf_importacsv.php
 Begin       : 2014-02-02
 Last Update : 2017-12-08

 Description : confirm import file csv

 Author: Sergio Capretta & Marco Pedrazzi

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
if ($user) 
{


	include ('./dati_db.inc');
        $connect = mysqli_connect("$host", "$username", "$password", "$db_name") or die("cannot connect DB");
        
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
// Recupero il file
$upload_dir = "./tmp";
//se il file esiste
    if(is_uploaded_file($_FILES["filecsv"]["tmp_name"])) 
    {
        $file_name = $_FILES["filecsv"]["name"];
        //sposto il file
        move_uploaded_file($_FILES["filecsv"]["tmp_name"], "$upload_dir/$file_name")
        or die("Impossibile spostare il file, i permessi della directory .$upload_dir. dove viene effettuato l'upload.");

        //mi assicuro che il separatore sia corretto                
        ini_set('auto_detect_line_endings',TRUE);
        //apro il file in lettura
        $file = fopen("./$upload_dir/$file_name",'r');

                    // Se l'apertura del file è avvenuta corretamente
                    if ($file)
                    {              
                        //controllo il numero dei campi
                        if(count($riga_csv = fgetcsv($file))==18)
                        {
                           //per sicurezza imposto la tabella a InnoDb (permette le transazioni)
                           if(! mysqli_query($connect, "ALTER TABLE tb_anagrafe ENGINE=INNODB;"))
                           {   //vai a pagina di errore
                               error("Impossibile cambiare il tipo di engine della tb_anagrafe",'InsAnagrFile');
                           }
                           //avvio transazione sul db
                           mysqli_query($connect, "START TRANSACTION") or error("Impossibile avviare la transazione!");
                           
                           //ciclo ogni riga del file che verrà inserito nell'array $riga_csv
                           $i=2;
                           $linecount = count(file('filename.csv'));
                           while ( ($riga_csv = fgetcsv($file) ) !== FALSE ) 
                           {
                                //x debug
                                //var_dump($riga_csv);
                               
                               
                                //predispongo le variabili per la query
                                $ntessera = $riga_csv[0]; //obbligatorio
                                $nome = $riga_csv[1]; //obbligatorio
                                $cognome = $riga_csv[2];
                                $indirizzo = $riga_csv[3];
                                //cap + comune
                                $cap = $riga_csv[4].' - '.$riga_csv[5];                                 
                                //regione
                                $citta = $riga_csv[6];
                                $provincia = $riga_csv[7];
                                $tel = $riga_csv[8];
                                $tel2 = $riga_csv[9];
                                $datan = $riga_csv[10];
                                $classe = $riga_csv[11];
                                //codice fiscale
                                $nomerif = $riga_csv[12];
                                
                                //tipo socio
                                $materia = $riga_csv[13];
                                //tipo collaboratore/extra
                                $mansione = $riga_csv[14];
                                
                                $email = $riga_csv[15];
                                $note = $riga_csv[16];
                                $immagine = "personal.gif";
                                //associato attivo
                                $associato = $riga_csv[17];
                                
                                //se numero tessera e nome nn sono compilati
                                if(empty($ntessera) || empty($nome))
                                {
                                    mysqli_query($connect, "ROLLBACK") or die("Impossibile eseguire il rollback delle modifiche al database!");
                                    error("Riga ".$i.": numero tessera o nome assenti!",'InsAnagrFile'); 
                                   
                                } 
                                
                                //se classe !=null e materia,mansione sono null allora tipologia è Stud
                                if(!empty($classe))
                                {
                                    if(empty($materia) && empty($mansione))
                                    {
                                        $tipologia="Stud";
                                    }
                                }
                                //se materia !=null e classe,mansione sono null allora tipologia è Ins
                                if(!empty($materia))
                                {
                                    if(empty($classe) && empty($mansione))
                                    {
                                        $tipologia="Ins";
                                    }
                                }
                                //se mansione !=null e classe,materia sono null allora tipologia è Extra
                                if(!empty($mansione))
                                {
                                    if(empty($classe) && empty($materia))
                                    {
                                        $tipologia="Extra";
                                    }
                                }
                                if (!isset($tipologia))
                                {
                                    mysqli_query($connect, "ROLLBACK") or die("Impossibile eseguire il rollback delle modifiche al database!");
                                    error("Riga ".$i.": Solo uno dei seguenti campi deve essere compilaro! materia | classe | mansione.",'InsAnagrFile'); //Vado alla pagina di errore}
                                    
                                }
                                //predispongo la query
                                $query = "INSERT INTO tb_anagrafe(ntessera,nome,cognome,indirizzo,cap,citta,provincia,tel,tel2,datan,                                      classe,nomerif,materia,mansione,email,tipologia,note,associato)"
                                        . "VALUES             ('$ntessera','$nome','$cognome','$indirizzo','$cap','$citta','$provincia','$tel','$tel2','$datan','$classe','$nomerif','$materia','$mansione','$email','$tipologia','$note','$associato')";  
                           
                          
                           
                              $result = mysqli_query($connect, $query);
                               //se query fallisce
                              if($result!=TRUE)
                              {
                                 mysqli_query($connect, "ROLLBACK") or die("Impossibile eseguire il rollback delle modifiche al database!");
                                 error("Riga ".$i."Query fallita!!",'InsAnagrFile');
                              }
                              
                                $i++;
                           }
                           mysqli_query($connect, "COMMIT");
                           //chiudo e cancello il file e reimposto il settaggio di php a default
                           fclose($file) or error("Impossibile chiudere il file!",'InsAnagrFile');
                           unlink("./$upload_dir/$file_name") or error("Impossibile cancellare il file $upload_dir/$file_name",'InsAnagrFile');
                           ini_set('auto_detect_line_endings',FALSE);  
                           mysqli_close($connect);
                           conferma("InsAnagrFile");
                        }
                        else //se num dei campi è diverso
                        { 
                            error("Numero dei campi errato!",'InsAnagrFile'); //Vado alla pagina di errore
                        }        
                    }
                    else
                    { 
                        error("Problemi nell'apertura del file caricato",'InsAnagrFile'); //Vado alla pagina di errore
                    }
    }
    else
    { 
        error("Upload dei file fallito!!",'InsAnagrFile'); //Vado alla pagina di errore
    }
}
else 
{
    header('Location: ./index.php');
}

function error($msg=NULL,$url_redirect=NULL)
{
    if($msg!=null)
    {
        if($url_redirect!=null)
        {
            echo <<<EOF
            <script type="text/javascript">
            window.location.href = "errore.php?msg=$msg&rif=$url_redirect";
            </script>
EOF;
            
            exit();
        }
        else 
        {die ('Function: error Parametro url_redirect assente!');}
    }
    else
    {die ('Function: error Parametro msg assente!');}
    
}
function conferma($url_redirect=NULL)
{
    if($url_redirect!=null)
    {
    echo <<<EOF
            <script type="text/javascript">
            window.location.href = "conferma.php?rif=$url_redirect";
            </script>
EOF;
    }
    
    else
    {die ('Function: error Parametro url assente!');}
}

?>