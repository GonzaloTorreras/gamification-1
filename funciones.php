<?php
function addPoints($cantidad, $user){
	$puntos = getPoints($user);
	setPoints($puntos + $cantidad, $user);
}

function subPoints($cantidad, $user){
	$puntos = getPoints($user);
	setPoints($puntos - $cantidad, $user);
}

function getPoints($user){
	include 'mysql.php';
	
	$sql = "SELECT `puntos` FROM `usuario` WHERE user=?";

	$stmt = $conn->prepare($sql);
	if($stmt === false) {
	  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
	}
	
	$stmt->bind_param('s',$user);
	 
	if(!$stmt->execute()){
		$stmt->close();
		return false;
	}
	
	$recordset = $stmt->get_result();
	if($recordset === false) {
		trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
	} else {
		$rows_returned = $recordset->num_rows;
		if ($rows_returned == 0){
			$stmt->close();
			return false;
		}else{
			$recordset->data_seek(0);
			$row = $recordset->fetch_assoc();
			return $row['puntos'];
		}
	}
	return false;
}

function setPoints($puntos, $user){
	include 'mysql.php';
	
	$sql = "UPDATE `usuario` SET `puntos`=? WHERE user=?";

	$stmt = $conn->prepare($sql);
	if($stmt === false) {
	  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
	}
	
	$stmt->bind_param('is',$puntos,$user);
	 
	if(!$stmt->execute()){
		$stmt->close();
		return false;
	}
	
	$stmt->close();
	return true;
	
}

function getName($user){
	include 'mysql.php';
	
	$sql = "SELECT `nombre` FROM `usuario` WHERE user=?";

	$stmt = $conn->prepare($sql);
	if($stmt === false) {
	  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
	}
	
	$stmt->bind_param('s',$user);
	 
	if(!$stmt->execute()){
		$stmt->close();
		return false;
	}
	
	$recordset = $stmt->get_result();
	if($recordset === false) {
		trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
	} else {
		$rows_returned = $recordset->num_rows;
		if ($rows_returned == 0){
			$stmt->close();
			return false;
		}else{
			$recordset->data_seek(0);
			$row = $recordset->fetch_assoc();
			return $row['nombre'];
		}
	}
	return false;
}
?>