<?php

    require_once 'config.php';
    $json = array();

    if (isset($_GET["cedula"])&&isset($_GET["nombre"])&&isset($_GET["apellido"])&&isset($_GET["direccion"])){
        $cedula = $_GET['cedula'];
        $nombre = $_GET['nombre'];
        $apellido = $_GET['apellido'];
        $direccion = $_GET['direccion'];

        $conexion = mysqli_connect($host, $user, $password, $BD);

        $insert = "INSERT INTO ciudadanos(cedula, nombre, apellido, direccion)
                    VALUES('$cedula','$nombre','$apellido','$direccion')";

        $resultado_insert = mysqli_query($conexion, $insert);

        if ($resultado_insert){
            $consulta = "SELECT * FROM ciudadanos WHERE cedula = '$cedula'";
            $resultado = mysqli_query($conexion, $consulta);

            if ($registro = mysqli_fetch_array($resultado)){
                $json['usuario']=$registro;
            }
            mysqli_close($conexion);
            echo json_encode($json);
        }
        else{
            $resulta["cedula"] = 0;
            $resulta["nombre"] = 'no registra';
            $resulta["apellido"] = 'no registra';
			$resulta["direccion"] = 'no registra';
            $json['usuario'][] = $resulta;
            echo json_encode($json);
        }
    }
    else{
        $resulta["cod_unidad"] = 0;
        $resulta["usuario"] = 'Web Service no retorna';
        $resulta["nombre"] = 'Web Service no retorna';
        $resulta["apellido"] = 'Web Service no retorna';
        $resulta["password"] = 'Web Service no retorna';
        $resulta["email"] = 'Web Service no retorna';
        $resulta["telefono"] = 'Web Service no retorna';
        $resulta["rango"] = 'Web Service no retorna';
        $json['usuario'][] = $resulta;
        echo json_encode($json);
    }
?>