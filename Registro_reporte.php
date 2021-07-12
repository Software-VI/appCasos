<?php

    require_once 'config.php';
    $json = array();

    if (isset($_GET["cod_reporte"])&&isset($_GET["cedula"])&&isset($_GET["fecha"])&&isset($_GET["tipo_reporte"])
        &&isset($_GET["observacion"])&&isset($_GET["activo"])){
        $cod_reporte = $_GET['cod_reporte'];
        $cedula = $_GET['cedula'];
        $fecha = $_GET['fecha'];
        $tipo_reporte = $_GET['tipo_reporte'];
        $observacion = $_GET['observacion'];
        $activo = $_GET['activo'];
     

        $conexion = mysqli_connect($host, $user, $password, $BD);

        $insert = "INSERT INTO reporte(cod_reporte, cedula, fecha, tipo_reporte, observacion, activo)
                    VALUES('$cod_reporte','$cedula','$fecha','$tipo_reporte','$observacion','$activo')";

        $resultado_insert = mysqli_query($conexion, $insert);

        if ($resultado_insert){
            $consulta = "SELECT * FROM reporte WHERE cod_reporte= '$cod_reporte'";
            $resultado = mysqli_query($conexion, $consulta);

            if ($registro = mysqli_fetch_array($resultado)){
                $json['cedula'][]=$registro;
            }
            mysqli_close($conexion);
            echo json_encode($json);
        }
        else{
            $resulta["cod_reporte"] = 0;
            $resulta["cedula"] = 'no registra';
            $resulta["fecha"] = 'no registra';
            $resulta["tipo_reporte"] = 'no registra';
            $resulta["observacion"] = 'no registra';
            $resulta["activo"] = 'no registra';
         
            $json['cedula'][] = $resulta;
            echo json_encode($json);
        }
    }
    else{
        $resulta["cod_reporte"] = 0;
        $resulta["cedula"] = 'Web Service no retorna';
        $resulta["fecha"] = 'Web Service no retorna';
        $resulta["tipo_reporte"] = 'Web Service no retorna';
        $resulta["obsercacion"] = 'Web Service no retorna';
        $resulta["activo"] = 'Web Service no retorna';
     
        $json['cedula'][] = $resulta;
        echo json_encode($json);
    }
?>