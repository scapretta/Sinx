
<html>
<!--======================================================================+
 File name   : index.php
 Begin       : 2010-08-04
 Last Update : 2016-01-16

 Description : The first page of login

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
=========================================================================+-->
<head>
  <meta content="text/html; charset=ISO-8859-1"
 http-equiv="content-type">
  <title>Sinx Is Not Xoops</title>
<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
	<title>Login - Sinx</title>
</head>

<body>

<form action="./Conf_Login.php" method="post">
<table class='bordo' cellpadding="0" cellspacing="0" align="center" width="30%" >
<center><b><br><br>Benvenuto in Sinx, Gestionale per Associazioni No-Profit</b></center><br>
<hr style="width: 50%; height: 2px"><br><br><body bgcolor="#FFFFFF">
<tr style="background-image:url(./ImmTemplate/Sfondo_banner_rid.jpg)">
  <td >
    <center><img src='./ImmTemplate/login.png'></center>
  </td>
  <td >
    <center><img style="border: 0px; width: 130px" alt="" src="./ImmTemplate/Nuovo_Logo_web.png"></center>
  </td>
</tr>
<tr bgcolor="#efefef"><td colspan="2">
 <fieldset>
  <legend><small>Lang:</small></legend>
  <small>Ita </small><input type="radio" name="lang" value="./lang/ita/" checked="checked"/><img src='./ImmTemplate/flag_ita.png'> | 
  <small>Eng </small><input type="radio" name="lang" value="./lang/eng/" /><img src='./ImmTemplate/flag_eng.png'>
</fieldset>
	</td></tr>
<tr>
<td bgcolor="#efefef"></td>
<td align="center" bgcolor="#efefef"><br>
					<label for="usern">Username: </label>
					<input class="usern" name="usern" type="text" value="" /><br /><br>
					<label for="passwd">Password: </label>
					<input class="passwd" name="passwd" type="password" /><br /><br>
					<input class="submit" name="submit" type="submit" value="<- Login ->" />
</td>
</tr>
    <tr bgcolor="#efefef"><td><center><i><small><sub><input name="versione" size='5%' readonly="text" value=" 0.98.8"></sub></small></i></center></td>
    <td><center><i><small><sub>www.sinx.it -- info@sinx.it</sub></small></i></center><br></td></tr>
<!-- SCELTA LINGUAGGIO -->

</table>			
</form>
<br>
<hr style="width: 60%; height: 2px">

<?php
include('./botton.inc');
?>
