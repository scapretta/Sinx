<html>
<head>
<!--Sinx for Association - Gestionale per Associazioni no-profit
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
-->
<?php

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");

$Query_nome = "SELECT * FROM tb_anagrafe_associaz";

$rs=mysqli_query($connect, $Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");
$row=mysqli_fetch_array($rs);
?>

  <title><?php echo $row['nome']; ?></title>
 <link rel="stylesheet"
	href="print.css"
	type="text/css"
	media="screen" />
</head>
<body>
<table border="0">
	<tr>
	<td align="center"><img src="./Immagini/logo.png" height="60px"></td>
	<td align="center"><small>Associazione<br><b><?php echo $row['nome']; ?></b></small></td>
	</tr>
	<tr>
	<td></td>
	<td align="center"><small> Via <?php echo $row['indirizzo']; ?>, <?php echo $row['numero']; ?> - <?php echo $row['cap']; ?> - <?php echo $row['citta']; ?>, <?php echo $row['provincia']; ?> <br>tel: <?php echo $row['tel']; ?> - fax <?php echo $row['fax']; ?><br>CF e PI <?php echo $row['cf']; ?></small></td>
	</tr>
</table>
<hr><br><br>
<?php mysqli_close($connect); ?>
</body>
</html>
