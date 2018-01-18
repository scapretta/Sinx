<?php
/*======================================================================+
 File name   : conferma.php
 Begin       : 2010-08-04
 Last Update : 2012-07-08

 Description : confirm data

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
  $rifer = $_GET['rif'];
 echo <<<EOF
  <html>
<head>
  <title>Conferma registrazione sul database</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="refresh" content="3;URL=./$rifer.php">
</head>
<body>
<div style="text-align: center;"><img src='./Immagini/dialog_ok_apply.png'><span
 style="font-weight: bold;"><br>
Operazione avvenuta con successo !!</span><br
 style="font-weight: bold;">
<span style="font-weight: bold;">Se
la pagina non dovesse ricaricarsi in automatico, <a
 href="./$rifer.php">premi qui</a></span><br>
 
<p> <section>
<h3>Aggiornamento database:</h3> <progress max="100">0%</progress>
</section></p>

</div>
</body>
</html>
EOF;
}
?>
