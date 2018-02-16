<?php
/*======================================================================+
 File name   : CancLog.php
 Begin       : 2013-08-25
 Last Update : 2013-08-25

 Description : delete Sinx log

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

$var=fopen("./log/logSinx.txt","w");
fclose($var);
header('location: ./conferma.php?rif=Log'); //Vado alla pagina di conferma

} else {
header('Location: ./index.php');
}
?>

