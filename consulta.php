<?php

require_once 'config.php';
$response["set"] = array();

$conexion = mysqli_connect($host, $user, $password, $BD);

if(isset($_GET['type'])){
		switch($_GET['type']){

			case '0':
				
			$cod_unidad = $_GET['cod_unidad'];			
			$result = $conexion->query( "SELECT * FROM usuarios WHERE cod_unidad = '$cod_unidad';" );
			
			$user=array(); 
			if($result->num_rows === 1){
				while($row = $result->fetch_assoc())    {

				$stuff= array();

				/* ADD THE TABLE COLUMNS TO THE JSON OBJECT CONTENTS */
				
				$stuff["usuario"] = $row['usuario'];
				$stuff["nombre"] = $row['nombre'];
				$stuff["apellido"] = $row['apellido'];
				$stuff["password"] = $row['password'];
				$stuff["email"] = $row['email'];
				$stuff["telefono"] = $row['telefono'];
				$stuff["rango"] = $row['rango'];
				array_push($response["set"], $stuff);

					// $response[] = $row;
				}
					// success
				//$response["success"] = 1;
				echo(json_encode($response));
			
			}else{
				
				$user = array(
					'error'=>true,
					'message'=>'Usuario no encontrado',
					
				);
				echo json_encode("Error".$user);
			}
			break; 
	
		case 'register':
		$username = $_POST['username'];
		$password = $_POST['password']; 			
		
		//$username = $_GET['username'];
		//$password = $_GET['password']; 			
			$stmt = $con->prepare("SELECT id, username, email, phone FROM users WHERE username = ? AND password = ?");
			$stmt->bind_param("ss",$username, $password);			
			$stmt->execute();
			$stmt->store_result();
			
			if($stmt->num_rows <=0){
				//$stmt->bind_result( $username);
				//$stmt2 = $con->prepare("insert into users (username, password) values ( ? , ?");
				$q= "insert into users (username, password) values ( '$username' , '$password')";
				//echo $q;
				$stmt2 = $con->prepare($q);
				//$stmt2->bind_param("ss",$username, $password);			
				$stmt2->execute();
				$stmt2->store_result();
					
				
				$stmt2->fetch();
				$user = array(
					'error'=>false,
					'message'=>'Registro de Usuario Correcto',
					 'username'=>$username
					
				);
				//array_push($data, $user);
				echo json_encode($user);
				//$response['error'] = false; 
				//$response['message'] = 'Login successful'; 
				//$response['user'] = $user; 
				//print_r ($user);
			}else{
				//$response['error'] = false; 
				//$response['message'] = 'Invalid username or password';
				$user = array(
					'error'=>true,
					'message'=>'Registro Incorrecto.. Usuario Existe',
					'id'=>'', 
					'username'=>'', 
					'email'=>'',
					'phone'=>''
				);
				echo json_encode($user);
			}
		break; 
            
		break;
		default: 
			$response['error'] = true; 
			$response['message'] = 'Invalid Operation Called';
		}
	}
	else{
		$response['error'] = true; 
		$response['message'] = 'Invalid API Call';
	}






?>