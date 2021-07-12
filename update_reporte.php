<?php

if ($_SERVER['REQUEST_METHOD']=='POST'){
	
		require_once 'config.php';

		$conexion = mysqli_connect($host, $user, $password, $BD);
	
		if(isset($_POST["password"])){
			
			$cod_reporte = $_POST["cod_reporte"];	
			$cedula = $_POST["cedula"];
			$fecha = $_POST["fecha"];
			$tipo_reporte = $_POST["tipo_reporte"];
			$observacion = $_POST["observacion"];
			$activo = $_POST["activo"];
			
			$string_consulta = "UPDATE reporte SET cedula = '$cedula', fecha = '$fecha', tipo_reporte = '$tipo_reporte', observacion = '$observacion' , activo = '$activo' WHERE cod_reporte = '$cod_reporte';";

			if(mysqli_query($conexion, $string_consulta)){
				$resultado['res'] = "success";
			} else{
				$resultado['res'] = "error";
			}
			
			mysqli_close($conexion);
			
			echo json_encode($resultado);
		}else{
		
			$cod_reporte = $_POST["cod_reporte"];	
			$cedula = $_POST["cedula"];
			$fecha = $_POST["fecha"];
			$tipo_reporte = $_POST["tipo_reporte"];
			$observacion = $_POST["observacion"];
			$activo = $_POST["activo"];
			
			$string_consulta = "UPDATE reporte SET cedula = '$cedula', fecha = '$fecha', tipo_reporte = '$tipo_reporte', observacion = '$observacion', activo = '$activo' WHERE cod_reporte = '$cod_reporte';";

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