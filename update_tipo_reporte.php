<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){
	
		require_once 'config.php';

		$conexion = mysqli_connect($host, $user, $password, $BD);
	
		if(isset($_POST["password"])){
			
			$cod_unidad = $_POST["cod_tipo_reporte"];	
			$usuario = $_POST["descripcion"];
		
			
			$string_consulta = "UPDATE tipo_reporte  SET descripcion = '$descripcion' WHERE cod_tipo_reporte = '$cod_tipo_reporte';";

			if(mysqli_query($conexion, $string_consulta)){
				$resultado['res'] = "success";
			} else{
				$resultado['res'] = "error";
			}
			
			mysqli_close($conexion);
			
			echo json_encode($resultado);
		}else{
		
			$cod_tipo_reporte = $_POST["cod_tipo_reporte"];	
			$descripcion = $_POST["descripcion"];
			
			$string_consulta = "UPDATE tipo_reporte SET descripcion = '$descripcion' WHERE cod_tipo_reporte = '$cod_tipo_reporte';";

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