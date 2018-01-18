<!--
======================================================================+
 File name   : Azzera.html
 Begin       : 2010-08-04
 Last Update : 2012-30-12

 Description : A word of warning before you delete all the data
		on 'Prima Nota'

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
-->
<?php
$Modulo = $_GET[Modulo];
$Tabella = $_GET[Tabella];
?>
<html>
<head>
  <title>Cancellazione</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<div style="text-align: center;"><span
 style="font-weight: bold;"><br>ATTENZIONE<br><br>
!!! Confermando si elimineranno tutti i dati !!!</span><br style="font-weight: bold;"><br>
<span style="font-weight: bold;"><a
 href="./cancella.php?Tabella=<?php echo $Tabella; ?>">Azzera <?php echo $Modulo; ?></a></span><br>
<hr style="width: 80%; height: 2px;">
 <span style="font-weight: bold;"><a
 href="./index2.php">Annulla</a></span><br>
</div>
</body>
</html>
