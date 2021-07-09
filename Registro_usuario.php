<?php

    require_once 'config.php';
    $json = array();

    if (isset($_GET["cod_unidad"])&&isset($_GET["usuario"])&&isset($_GET["nombre"])&&isset($_GET["apellido"])
        &&isset($_GET["contrasena"])&&isset($_GET["email"])&&isset($_GET["telefono"])&&isset($_GET["rango"])){
        $cod_unidad = $_GET['cod_unidad'];
        $usuario = $_GET['usuario'];
        $nombre = $_GET['nombre'];
        $apellido = $_GET['apellido'];
        $contrasena = $_GET['contrasena'];
        $email = $_GET['email'];
        $telefono = $_GET['telefono'];
        $rango = $_GET['rango'];

        $conexion = mysqli_connect($host, $user, $password, $BD);

        $insert = "INSERT INTO usuarios(cod_unidad, usuario, nombre, apellido, password, email, telefono, rango)
                    VALUES('$cod_unidad','$usuario','$nombre','$apellido',MD5('$contrasena'),'$email','$telefono','$rango')";

        $resultado_insert = mysqli_query($conexion, $insert);

        if ($resultado_insert){
            $consulta = "SELECT * FROM usuarios WHERE cod_unidad = '$cod_unidad'";
            $resultado = mysqli_query($conexion, $consulta);

            if ($registro = mysqli_fetch_array($resultado)){
                $json['usuario'][]=$registro;
            }
            mysqli_close($conexion);
            echo json_encode($json);
        }
        else{
            $resulta["cod_unidad"] = 0;
            $resulta["usuario"] = 'no registra';
            $resulta["nombre"] = 'no registra';
            $resulta["apellido"] = 'no registra';
            $resulta["password"] = 'no registra';
            $resulta["email"] = 'no registra';
            $resulta["telefono"] = 'no registra';
            $resulta["rango"] = 'no registra';
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