<?php

  if($_SERVER['REQUEST_METHOD']=='POST'){

    $cod_seguridad = $_POST["cod_seguridad"];

  	require_once 'config.php';

    $conexion = mysqli_connect($host, $user, $password, $BD);

    $consulta = "select * from administrador where password = MD5('$cod_seguridad')";
    
    $response = mysqli_query($conexion, $consulta);

    if(mysqli_num_rows($response)){
			
			$row = mysqli_fetch_assoc($response);
			
			if(md5($cod_seguridad) === $row['password']){
				
				$resultado['success'] = "1";
				$resultado['message'] = "success";
				$resultado['content'] = $row['password'];
				mysqli_close($conexion);
				echo json_encode($resultado);
				
			} else{
				$resultado['success'] = "0";
				$resultado['message'] = "error";
				
				mysqli_close($conexion);
				echo json_encode($resultado);
			}
		}
    }
