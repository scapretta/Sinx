<?php
session_start();
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
      <td style="height: 5px;" bgcolor="#c7c7c7"></td>
      <td style="height: 5px;" bgcolor="#c7c7c7"></td>
      <td style="height: 5px;" bgcolor="#c7c7c7"></td>
      <td style="height: 5px;" bgcolor="#c7c7c7"></td>
    </tr>


    <tr>
      <td style="vertical-align: top; " bgcolor="#e8e8e8"><span style="font-weight: bold;">Menu<br>
      <br>

	      <hr style="width: 100%;  ">
      </span>

<div id='cssmenu'>
<ul>
   <li class='has-sub'><a href='#'><span><? echo $Lassociazione; ?></span></a>
      <ul>
        <li><a href='./dati_Associaz.php' title="Per gestire l'Associazione"><i class="material-icons">slow_motion_video</i><span><? echo $Ldatiassociazione; ?></span></a></li>
         <li><a  target="_blank" href='<?php echo(isset($row['sito'])) ? $row['sito'] : "dati_Associaz.php"?>' title="Apre il link in una nuova scheda del browser"><i class="material-icons">web_asset</i><span><? echo $Lsito; ?></span></a></li>
         <li><a  target="_blank" href='<? echo(isset($row['webmail']))? $row['webmail'] : "dati_Associaz.php"?>' title="Apre il link in una nuova scheda del browser"><i class="material-icons">mail_outline</i><span><? echo $Lmail; ?></span></a></li>
         <li><a  target="_blank" href='<? echo(isset($row['webPEC']))? $row['webPEC'] : "dati_Associaz.php"?>' title="Apre il link in una nuova scheda del browser"><i class="material-icons">email</i><span><? echo $Lmailpec; ?></span></a></li>
         <li><a  target="_blank" href='<? echo(isset($row['facebook']))? $row['facebook'] : "dati_Associaz.php" ?>' title="Apre il link in una nuova scheda del browser"><i class="material-icons">share</i><span><? echo $Lfacebook; ?></span></a></li>
         <li><a  target="_blank" href='<? echo(isset($row['instagram']))? $row['instagram'] : "dati_Associaz.php" ?>' title="Apre il link in una nuova scheda del browser"><i class="material-icons">share</i><span><? echo $Linstagram; ?></span></a></li>
         <li><a  target="_blank" href='<? echo(isset($row['youtube']))? $row['youtube'] : "dati_Associaz.php" ?>' title="Apre il link in una nuova scheda del browser"><i class="material-icons">videocam</i><span><? echo $Lyoutube; ?></span></a></li>
         <li><a  target="_blank" href='<? echo(isset($row['twitter']))? $row['twitter'] : "dati_Associaz.php" ?>' title="Apre il link in una nuova scheda del browser"><i class="material-icons">share</i><span><? echo $Ltwitter; ?></span></a></li>
         <li><a  target="_blank" href='<? echo(isset($row['HomeBanking']))? $row['HomeBanking'] : "dati_Associaz.php" ?>' title="Apre il link in una nuova scheda del browser"><i class="material-icons">account_balance</i><span><? echo $LHomeBanking; ?></span></a></li>
         
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span><? echo $Lanagrafica; ?></span></a>
      <ul>
         <li><a href='./InsAnagrStud.php'><i class="material-icons">perm_identity</i><span><?echo $Lfondatori; ?></span></a></li>
         <li><a href='./InsAnagrIns.php'><i class="material-icons">supervisor_account</i><span><? echo $Lassociati; ?></span></a></li>
         <li><a href='./InsAnagrExtra.php'><i class="material-icons">portrait</i><span><? echo $Laltri; ?></span></a></li>
         <li><a href='./InsAnagrFile.php'><i class="material-icons">folder_open</i><span><? echo $Limporta; ?></span></a></li>
         <li><a href='./ricerca.php'><i class="material-icons">search</i><span><? echo $Lcerca; ?></span></a></li>
         <li><a href='./Rubrica.php'><i class="material-icons">chrome_reader_mode</i><span><? echo $Lrubrica; ?></span></a></li>
         <li class='last'><a href='./pre_stampa_soci.php'><i class="material-icons">list</i><span><? echo $Llibrosoci; ?></span></a></li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span><? echo $Lcontabilita; ?></span></a>
      <ul>
         <li><a href='./InsPrimanota.php'><i class="material-icons">view_day</i><span><? echo $Lprimanota; ?></span></a></li>
         <li><a href='./InsRicFisc.php'><i class="material-icons">web</i><span><? echo $Lquietanza; ?></span></a></li>
         <li><a href='./InsFattura.php'><i class="material-icons">content_copy</i><span><? echo $Lfattura; ?></span></a></li>
         <li><a href='./InsContoEconomico.php'><i class="material-icons">view_list</i><span><? echo $Lcontoec; ?></span></a></li>
         <li><a href='./InsStatoPatrimoniale.php'><i class="material-icons">work</i><span><? echo $Lstatopat; ?></span></a></li>
         <li><a href='./Rendiconto.php'><i class="material-icons">view_carousel</i><span><? echo $Lrendiconto; ?></span></a></li>
         <li class='last'><a href='./Nuovo_Anno_soc.php'><i class="material-icons">fiber_new</i><span><? echo $Lnuovoannosociale; ?></span></a></li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span><? echo $Lgestione; ?></span></a>
      <ul>
<!--         <li><a href='./InsProgetto.php'><span>Progetti</span></a></li> -->
         <li><a href='./CompModuli.php'><i class="material-icons">assignment</i><span><? echo $Lmoduli; ?></span></a></li>
         <li><a href='./Calendario2.php'><i class="material-icons">date_range</i><span><? echo $Lcalendario; ?></span></a></li>
	 <li><a href='./InsNotepad.php'><i class="material-icons">description</i><span><? echo $Lblocconote; ?></span></a></li>
         <li><a href='./Comp_email.php'><i class="material-icons">contact_mail</i><span>E-Mail</span></a></li>
         <li><a href='./InsUtente.php'><i class="material-icons">account_box</i><span><? echo $Lutenti; ?></span></a></li>
         <li><a href='./Files.php'><i class="material-icons">assignment_turned_in</i><span><? echo $Lfileseimmagini; ?></span></a></li>
	 <li class='last'><a href='./Log.php'><i class="material-icons">assignment</i><span><? echo $Llog; ?></span></a></li>
	 <li class='last'><a href='./Rip_database.php'><i class="material-icons">open_in_browser</i><span>Backup</span></a></li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span><? echo $Lspecifiche; ?></span></a>
      <ul>
        <li><a href='./Scheda_regioni.php'><i class="material-icons">receipt</i><span>Regioni Province e Comuni</span></a></li>
         <li><a href='./nclasse.php'><i class="material-icons">create</i><span><? echo $Lfunzioniassociati; ?></span></a></li>
         <li class='last'><a href='./nmateria.php'><i class="material-icons">low_priority</i><span><? echo $Ltipoassociati; ?></span></a></li>
	<li><a href='./Licenza.php'><i class="material-icons">reorder</i><span><? echo $Llicenza; ?></span></a></li>
      </ul>
   </li>
   <li><a href='./Manuale.php'><i class="material-icons">import_contacts</i><span><? echo $Lmanuale; ?></span></a></li>
   <li class='last'><a href='./logout.php'><i class="material-icons">exit_to_app</i><span><? echo $Luscita; ?></span></a></li>
</ul>
</div>



<td style="height: 5px;" bgcolor="#c7c7c7"></td>
      <td style="vertical-align: top;">

<?php
} else {
header('Location: ./index.php');
}
?>

