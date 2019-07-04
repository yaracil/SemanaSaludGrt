<?php

if (isset($_POST['guardar'])) {
    //conexion base
    include("includes/ConexionBD.php");
    //recuperar id de usuario
    $id = $_GET['usuario'];
    echo $id['id'];
    //insertar en presion
    $count = "INSERT INTO presion (Nombre,Edad) VALUES('" . $Nombre . "'," . $Edad . ");";
    $con->exec($count);
} else if (isset($_POST['finalizar'])) {
    
} else if (isset($_POST['salir_sesion'])) {
    
    echo 'Holaaa';

    header("Location: index.html");
}
?>