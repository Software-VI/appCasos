<?php

    require_once 'config.php';
    $json = array();

    if (isset($_GET["cod_tipo_reporte"])&&isset($_GET["descripcion"])) {

      $cod_tipo_reporte = $_GET['cod_tipo_reporte'];
      $descripcion = $_GET['descripcion'];

      $conexion = mysqli_connect($host, $user, $password, $BD);

      $insert = "INSERT INTO tipo_reporte(cod_tipo_reporte, descripcion)
      VALUES('$cod_tipo_reporte','$descripcion')";

      $resultado_insert = mysqli_query($conexion, $insert);

      if ($resultado_insert){
        $consulta = "SELECT * FROM tipo_reporte WHERE cod_tipo_reporte = '$cod_tipo_reporte'";
        $resultado = mysqli_query($conexion, $consulta);

        if ($registro = mysqli_fetch_array($resultado)){
            $json['usuario'][]=$registro;
        }
        mysqli_close($conexion);
        echo json_encode($json);
    }else{
      $resulta["cod_tipo_reporte"] = 0;
      $resulta["descripcion"] = 'no registra';
      $json['descripcion'][] = $resulta;
      echo json_encode($json);
    }
  }else{
      $resulta["cod_tipo_reporte"] = 0;
      $resulta["descripcion"] = 'Web Service no retorna';
      $json['descripcion'][] = $resulta;
      echo json_encode($json);
  }
?>