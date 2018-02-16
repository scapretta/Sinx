<!--
/*======================================================================+
 File name   : conferma.php
 Begin       : 2010-08-04
 Last Update : 2017-12-20

 Description : error occured

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
=========================================================================+*/ -->

 <html>
<head>
  <title>!! Errore !!</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="refresh" content="5;URL=<?php echo $_GET['rif'];?>.php">
</head>
<body>
<div style="text-align: center;"><img src='./Immagini/dialog-error.png'><span
 style="font-weight: bold;"><br>
<?php echo $_GET['msg'];?></span><br>
<span style="font-weight: bold;">Se
la pagina non dovesse ricaricarsi in automatico, <a
 href="./<?php echo $_GET['rif'];?>">premi qui</a></span><br>
</div>
</body>
</html>

