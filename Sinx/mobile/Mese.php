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


if ($user) {

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");
	
function Calendar($m,$y, $connect)
{
$user = $_SESSION['utente'];
$langmese = $_SESSION['lingua'];
$paginamese = "mese.inc";
$linguamese = ($langmese.$paginamese);
include($linguamese);

  if ((!isset($_GET['d']))||($_GET['d'] == ""))
  {
    $m = date('n');
    $y = date('Y');
  }else{
    $m = (int)strftime( "%m" ,(int)$_GET['d']);
    $y = (int)strftime( "%Y" ,(int)$_GET['d']);
    $m = $m;
    $y = $y;
  }
  $precedente = mktime(0, 0, 0, $m -1, 1, $y);
  $successivo = mktime(0, 0, 0, $m +1, 1, $y);

  $nomi_mesi = array(
    $Lgennaio,
    $Lfebbraio,
    $Lmarzo,
    $Laprile,
    $Lmaggio,
    $Lgiugno, 
    $Lluglio,
    $Lagosto,
    $Lsettembre,
    $Lottobre,
    $Lnovembre,
    $Ldicembre
  );
  $nomi_giorni = array(
    $Llunedi,
    $Lmartedi,
    $Lmercoledi,
    $Lgiovedi,
    $Lvenerdi,
    $Lsabato,
    $Ldomenica
  );
  $cols = 7;
  $days = date("t",mktime(0, 0, 0, $m, 1, $y)); 
  $lunedi= date("w",mktime(0, 0, 0, $m, 1, $y));
  if($lunedi==0) $lunedi = 7;
  echo "<table width='80%' height='25px' align='center' border='0'>\n"; 
  echo "<tr>\n
  <td align='center', colspan=\"".$cols."\"><small>
  <a href=\"?d=" . $precedente . "\"><-</a>
  " . $nomi_mesi[$m-1] . " " . $y . " 
  <a href=\"?d=" . $successivo . "\">-></a></small></td></tr>";
  foreach($nomi_giorni as $v)
  {
    echo "<td><b>".$v."</b></td>\n";
  }
  echo "</tr>";
  for($j = 1; $j<$days+$lunedi; $j++)
  {
    if($j%$cols+1==0)
    {
      echo "<tr>\n";
    }
    if($j<$lunedi)
    {
      echo "<td> </td>\n";
    }else{
      $day= $j-($lunedi-1);
      $data = date($day."-".$m."-".$y);
      $oggi = date("j-n-Y");

$Query = "SELECT * FROM appuntamenti WHERE str_data = '$data'";

$rs=mysqli_query($connect, $Query) or die('' . mysqli_error());

$evento="";

while ($row=mysqli_fetch_array($rs))
{
$evento=$row[str_data];
}

      if($data == $oggi)
      {
print("\n\t\t<td ><b><span style=\"color:green;\">".$day."</span ></b></td>");
        //echo "<td>".$day."</td>";
      }else if($data == $evento)
{
print("\n\t\t<td><small><b><a href=\"DettCal.php?cod=".$data."&cat=".$day."\"><span style=\"color:orange;\">".$day."</span ></a></b></small></td>");
}else{
print("\n\t\t<td><small><a href=\"Calendario.php?cod=".$data."&cat=".$day."\">".$day."</a></small></td>");
      //  echo "<td><b>".$day."</b></td>";
      }
  

    }
    if($j%$cols==0)
    {
      echo "</tr>";
    }
  }
  echo "<tr></tr>";
  echo "</table>";
}

//Richiamo la funzione
Calendar(date("m"),date("Y"), $connect);
}
?>
