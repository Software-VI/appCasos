<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){
	
		require_once 'config.php';

		$conexion = mysqli_connect($host, $user, $password, $BD);
			
		$cedula = $_POST["cedula"];	
		$nombre = $_POST["nombre"];
		$apellido = $_POST["apellido"];
		$direccion = $_POST["direccion"];
		
		$string_consulta = "UPDATE ciudadanos SET nombre = '$nombre', apellido = '$apellido', direccion = '$direccion' WHERE cedula = '$cedula';";

		if(mysqli_query($conexion, $string_consulta)){
			$resultado['res'] = "success";
		} else{
			$resultado['res'] = "error";
		}
		
		mysqli_close($conexion);
		
		echo json_encode($resultado);
	}
?>