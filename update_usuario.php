<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){
	
		require_once 'config.php';

		$conexion = mysqli_connect($host, $user, $password, $BD);
	
		if(isset($_POST["password"])){
			
			$cod_unidad = $_POST["cod_unidad"];	
			$usuario = $_POST["usuario"];
			$nombre = $_POST["nombre"];
			$contrasena = $_POST["password"];
			$apellido = $_POST["apellido"];
			$email = $_POST["email"];
			$telefono = $_POST["telefono"];
			$rango = $_POST["rango"];
			
			$string_consulta = "UPDATE usuarios SET usuario = '$usuario', nombre = '$nombre', apellido = '$apellido', password = MD5('$contrasena'), email = '$email', telefono = '$telefono', rango = '$rango' WHERE cod_unidad = '$cod_unidad';";

			if(mysqli_query($conexion, $string_consulta)){
				$resultado['res'] = "success";
			} else{
				$resultado['res'] = "error";
			}
			
			mysqli_close($conexion);
			
			echo json_encode($resultado);
		}else{
		
			$cod_unidad = $_POST["cod_unidad"];	
			$usuario = $_POST["usuario"];
			$nombre = $_POST["nombre"];
			$apellido = $_POST["apellido"];
			$email = $_POST["email"];
			$telefono = $_POST["telefono"];
			$rango = $_POST["rango"];
			
			$string_consulta = "UPDATE usuarios SET usuario = '$usuario', nombre = '$nombre', apellido = '$apellido', email = '$email', telefono = '$telefono', rango = '$rango' WHERE cod_unidad = '$cod_unidad';";

			if(mysqli_query($conexion, $string_consulta)){
				$resultado['res'] = "success";
			} else{
				$resultado['res'] = "error";
			}
			
			mysqli_close($conexion);
			
			echo json_encode($resultado);
		
		}
	
	}
?>