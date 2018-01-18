<?php
/*======================================================================+
 File name   : menu.inc
 Begin       : 2010-08-04
 Last Update : 2013-01-13

 Description : Header and principal
               menu

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
$langmenu = $_SESSION['lingua'];
$paginamenu = "menu.inc";
$linguamenu = ($langmenu.$paginamenu);
include($linguamenu);

if ($user) {

	include ('./dati_db.inc');
	$link=mysqli_connect("$host", "$username", "$password","$db_name")or die(mysqli_connect_error("Non posso connettermi al database"));
	
$Query_nome = "SELECT * FROM tb_anagrafe_associaz";

$rs=mysqli_query($link, $Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");
$row=mysqli_fetch_array($rs,MYSQLI_ASSOC);

?>

<table style="text-align: left; width: 100%;" border="0" cellpadding="0" cellspacing="0">

    <tr>
      <td style="width: 15%;"></td>
      <td style="width: 5px;"></td>
      <td ></td>

<!-- **** LOGOUT **** -->
	<td align='center' width='15%'></td>
    </tr>


    <tr>
      <td style="height: 5px; width: 15%;" bgcolor="#6d931c"></td>
      <td style="height: 5px; width: 5px;" bgcolor="#6d931c"></td>
      <td style="height: 5px;" bgcolor="#6d931c"></td>
      <td style="height: 5px; width: 15%;" bgcolor="#6d931c"></td>
    </tr>
    <tr>
      <td style="height: 5px;" bgcolor="#c7c7c7"></td>
      <td style="height: 5px;" bgcolor="#c7c7c7"></td>
      <td style="height: 5px;" bgcolor="#c7c7c7"></td>
      <td style="height: 5px;" bgcolor="#c7c7c7"></td>
    </tr>


    <tr>
      <td style="vertical-align: top; " bgcolor="#e8e8e8"><span style="font-weight: bold;">Menu<br>
      <br>

	      <hr style="width: 100%; height: 2px;">
      </span>

<div id='cssmenu'>
<ul>
   <li class='has-sub'><a href='#'><span><? echo $Lassociazione; ?></span></a>
      <ul>
        <li><a href='./dati_Associaz.php' title="Per gestire l'Associazione"><span>A--- -<? echo $Ldatiassociazione; ?></span></a></li>
         <li><a  target="_blank" href='<? echo $row[sito] ?>' title="Apre il link in una nuova scheda del browser"><span>Aola -<? echo $Lsito; ?></span></a></li>
         <li><a  target="_blank" href='<? echo $row[webmail] ?>' title="Apre il link in una nuova scheda del browser"><span>Aola - Web Mail</span></a></li>
         <li><a  target="_blank" href='<? echo $row[webPEC] ?>' title="Apre il link in una nuova scheda del browser"><span>Aola - Web PEC</span></a></li>
         <li><a  target="_blank" href='<? echo $row[facebook] ?>' title="Apre il link in una nuova scheda del browser"><span>Aola -<? echo $Lfacebook; ?></span></a></li>
         <li><a  target="_blank" href='<? echo $row[instagram] ?>' title="Apre il link in una nuova scheda del browser"><span>Aola -<? echo $Linstagram; ?></span></a></li>
         <li><a  target="_blank" href='<? echo $row[youtube] ?>' title="Apre il link in una nuova scheda del browser"><span>Aola -<? echo $Lyoutube; ?></span></a></li>
         <li><a  target="_blank" href='<? echo $row[twitter] ?>' title="Apre il link in una nuova scheda del browser"><span>Aola -<? echo $Ltwitter; ?></span></a></li>
         <li><a  target="_blank" href='<? echo $row[HomeBanking] ?>' title="Apre il link in una nuova scheda del browser"><span>Aola -<? echo $LHomeBanking; ?></span></a></li>
         
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span><? echo $Lanagrafica; ?></span></a>
      <ul>
         <li><a href='./InsAnagrStud.php'><span>Axxx -<?echo $Lfondatori; ?></span></a></li>
         <li><a href='./InsAnagrIns.php'><span>Axxx -<? echo $Lassociati; ?></span></a></li>
         <li><a href='./InsAnagrExtra.php'><span>Axxx -<? echo $Laltri; ?></span></a></li>
         <li><a href='./ricerca.php'><span>Aox- -<? echo $Lcerca; ?></span></a></li>
         <li><a href='./Rubrica.php'><span>Aola -<? echo $Lrubrica; ?></span></a></li>
         <li class='last'><a href='./pre_stampa_soci.php'><span>Aola -<? echo $Llibrosoci; ?></span></a></li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span><? echo $Lcontabilita; ?></span></a>
      <ul>
         <li><a href='./InsPrimanota.php'><span>Aoxx -<? echo $Lprimanota; ?></span></a></li>
         <li><a href='./InsRicFisc.php'><span>Aoxx -<? echo $Lquietanza; ?></span></a></li>
         <li><a href='./InsFattura.php'><span>Aoxx -<? echo $Lfattura; ?></span></a></li>
         <li><a href='./InsContoEconomico.php'><span>Aox- -<? echo $Lcontoec; ?></span></a></li>
         <li><a href='./InsStatoPatrimoniale.php'><span>Aox- -<? echo $Lstatopat; ?></span></a></li>
         <li><a href='./Rendiconto.php'><span>Aox- -<? echo $Lrendiconto; ?></span></a></li>
         <li class='last'><a href='./Nuovo_Anno_soc.php'><span>Axxx -<? echo $Lnuovoannosociale; ?></span></a></li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span><? echo $Lgestione; ?></span></a>
      <ul>
<!--         <li><a href='./InsProgetto.php'><span>Progetti</span></a></li> -->
         <li><a href='./CompModuli.php'><span>Aoxa -<? echo $Lmoduli; ?></span></a></li>
         <li><a href='./Calendario2.php'><span>Aox- -<? echo $Lcalendario; ?></span></a></li>
	 <li><a href='./InsNotepad.php'><span>Ao-a - <? echo $Lblocconote; ?></span></a></li>
         <li><a href='./Comp_email.php'><span>Aox- - E-Mail</span></a></li>
         <li><a href='./InsUtente.php'><span>Aola -<? echo $Lutenti; ?></span></a></li>
         <li><a href='./Files.php'><span>Axx- -<? echo $Lfileseimmagini; ?></span></a></li>
	 <li class='last'><a href='./Log.php'><span>Axxx -<? echo $Llog; ?></span></a></li>
	 <li class='last'><a href='./Rip_database.php'><span>Axxx - Backup</span></a></li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span><? echo $Lspecifiche; ?></span></a>
      <ul>
        <li><a href='./Scheda_regioni.php'><span>A-x- -Regioni Province e Comuni</span></a></li>
         <li><a href='./nclasse.php'><span>A-x- -<? echo $Lfunzioniassociati; ?></span></a></li>
         <li class='last'><a href='./nmateria.php'><span>A-x- -<? echo $Ltipoassociati; ?></span></a></li>
	<li><a href='./Licenza.php'><span>Aola -<? echo $Llicenza; ?></span></a></li>
      </ul>
   </li>
   <li><a href='./Manuale.php'><span><? echo $Lmanuale; ?></span></a></li>
   <li class='last'><a href='./logout.php'><span><? echo $Luscita; ?></span></a></li>
</ul>
</div>



<td style="height: 5px;" bgcolor="#c7c7c7"></td>
      <td style="vertical-align: top;">

<?php
} else {
header('Location: ./index.php');
}
?>

