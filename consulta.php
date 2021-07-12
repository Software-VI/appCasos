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

				}
					
				echo(json_encode($response));
			
			}else{
				
				$user = array(
					'error'=>true,
					'message'=>'Usuario no encontrado',
					
				);
				echo json_encode("Error".$user);
			}
			break; 
	
		case '1':
			$cedula = $_GET['cedula'];			
			$result = $conexion->query( "SELECT * FROM ciudadanos WHERE cedula = '$cedula';" );
			
			 
			if($result->num_rows === 1){
				while($row = $result->fetch_assoc())    {

				$stuff= array();

				/* ADD THE TABLE COLUMNS TO THE JSON OBJECT CONTENTS */
				
				$stuff["cedula"] = $row['cedula'];
				$stuff["nombre"] = $row['nombre'];
				$stuff["apellido"] = $row['apellido'];
				$stuff["direccion"] = $row['direccion'];
				array_push($response["set"], $stuff);

					
				}
			
				echo(json_encode($response));
			
			}else{
				
				$user = array(
					'error'=>true,
					'message'=>'Usuario no encontrado',
					
				);
				echo json_encode("Error".$user);
			}
			break; 
          
			case '2':
				$cod_tipo_reporte = $_GET['cod_tipo_reporte'];			
    		$result = $conexion->query( "SELECT * FROM tipo_reporte WHERE cod_tipo_reporte = '$cod_tipo_reporte';" );
 
				 
				if($result->num_rows === 1){
					while($row = $result->fetch_assoc())    {
	
					$stuff= array();
	
					/* ADD THE TABLE COLUMNS TO THE JSON OBJECT CONTENTS */
					
			
					$stuff["descripcion"] = $row['descripcion'];
					array_push($response["set"], $stuff);
	
						
					}
				
					echo(json_encode($response));
				
				}else{
					
					$user = array(
						'error'=>true,
						'message'=>'Tipo de Reporte no encontrado',
						
					);
					echo json_encode("Error".$user);
				}
				break; 

				case '3':
					$cod_reporte = $_GET['cod_reporte'];			
					$result = $conexion->query( "SELECT * FROM reporte WHERE cod_reporte = '$cod_reporte';" );
					
					 
					if($result->num_rows === 1){
						while($row = $result->fetch_assoc())    {
		
						$stuff= array();
		
						/* ADD THE TABLE COLUMNS TO THE JSON OBJECT CONTENTS */
						
						$stuff["cedula"] = $row['cedula'];
						$stuff["fecha"] = $row['fecha'];
						$stuff["tipo_reporte"] = $row['tipo_reporte'];
						$stuff["observacion"] = $row['observacion'];
						$stuff["activo"] = $row['activo'];

						array_push($response["set"], $stuff);
							
						}
					
						echo(json_encode($response));
					
					}else{
						
						$user = array(
							'error'=>true,
							'message'=>'Reporte no encontrado',
							
						);
						echo json_encode("Error".$user);
					}
					break; 

		default: 
			$response['error'] = true; 
			$response['message'] = 'Invalid Operation Called';
			break;
		
		}
		
	}else{
		$response['error'] = true; 
		$response['message'] = 'Invalid API Call';
	}
?>