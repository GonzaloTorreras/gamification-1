<?php
$DBServer = 'localhost';
$DBUser   = 'root';
$DBPass   = '';
$DBName   = 'gamificacion';

$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
 
//Comrpobamos la conexi�n
if ($conn->connect_error) {
  trigger_error('Error en la conexi�n con la BBDD: '  . $conn->connect_error, E_USER_ERROR);
}

?>