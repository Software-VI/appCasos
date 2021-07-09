<?php

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $usuario = $_POST["usuario"];

        $contrasena = $_POST["contrasena"];
		
		require_once 'config.php';

        $conexion = mysqli_connect($host, $user, $password, $BD);

        $consulta = "select * from usuarios where usuario = '$usuario' and password = MD5('$contrasena')";

        $response = mysqli_query($conexion, $consulta);
		
		if(mysqli_num_rows($response)===1){
			
			$row = mysqli_fetch_assoc($response);
			
			if(md5($contrasena) === $row['password']){
				
				$resultado['success'] = "1";
				$resultado['message'] = "success";
				
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


?>