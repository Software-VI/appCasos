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
           
            $json['response']="Success";
            mysqli_close($conexion);
            echo json_encode($json);
        }
        else{
			$json['response'] = "Error";
            echo json_encode($json);
        }
    }
    else{
        $json['response'] = "Error";
        echo json_encode($json);
    }
?>