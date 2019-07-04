<?php

    $servidor = "localhost"; // El servidor que utilizaremos, en este caso será el localhost 
    $usuario = "root"; // El usuario que acabamos de crear en la base de datos 
    $contrasenha = ""; // La contraseña del usuario que utilizaremos 
    $BD = "SemanaSalud"; // El nombre de la base de datos 
    
    
    try {
    $con = new PDO('mysql:host='.$servidor.';dbname='.$BD, $usuario, $contrasenha);
    $link = mysqli_connect($servidor, $usuario, $contrasenha, $BD);
    }
    catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "
    ";
    die();
    }
