<?php
/*======================================================================+
 File name   : ajax_get_ente_locale.php
 Begin       : 2018-02-16
 Last Update : 2018-02-16

 Description : Get Province and comuni throught ajax

 Author: Marco Pedrazzi

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
//con richiesta ajax, se passo regione mi da le province, se passo provincia mi da i comuni
include ('./dati_db.inc');
$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");

$regione=$_POST['regioni'];
$provincia=$_POST['provincie'];

if (isset($regione)){GetProvince($regione,$connect);}
else if(isset($provincia)){GetComuni($provincia,$connect);}

function GetProvince($regione,$connect)
{
    //se regione non è null, recupera id della regione e seleziona tutte le provincie della regione.
    if(isset($regione))
    {
      $queryIdRegione="SELECT id_reg FROM regioni WHERE nome_regione='$regione'";
      $result=mysqli_query($connect,  $queryIdRegione) or die("<b>Errore:</b> Impossibile eseguire la query id regione");
      while ($row = mysqli_fetch_row($result))
      {
        $idRegione=$row[0];
      }
      $queryGetProvince = "SELECT nome_provincia FROM province WHERE id_reg='$idRegione' ORDER BY nome_provincia"; 
      $result=mysqli_query($connect,  $queryGetProvince) or die("<b>Errore:</b> Impossibile eseguire la query provincie");
      while ($row = mysqli_fetch_row($result))
      {
        echo "<option>" .$row["0"]. "</option>";
      }
      
    }
    else
    {
      echo "E' necessario almeno un parametro valido";
      exit;
    }
}
function GetComuni($provincia,$connect)
{
  //se provincia non è null, recupera id della provincia e seleziona tutte i comuni della regione.
  if(isset($provincia))
  {
    $queryIdProvincia="SELECT id_pro FROM province WHERE nome_provincia='$provincia'";
    $result=mysqli_query($connect,  $queryIdProvincia) or die("<b>Errore:</b> Impossibile eseguire la query id provincia");
    while ($row = mysqli_fetch_row($result))
    {
      $idProvincia=$row[0];
    }
    $queryGetComuni = "SELECT cap,comune FROM comuni WHERE id_pro='$idProvincia' ORDER BY comune"; 
    $result=mysqli_query($connect,  $queryGetComuni) or die("<b>Errore:</b> Impossibile eseguire la query comuni");
    while ($row = mysqli_fetch_row($result))
    {
      echo "<option>" .$row[0]." - ".$row[1]. "</option>";
    }
  }
  else
    {
      echo "E' necessario almeno un parametro valido";
      exit;
    }
}


