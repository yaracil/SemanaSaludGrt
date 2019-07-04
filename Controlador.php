<?php

if(isset($_POST['guardar'])){
    //conexion base
    include('includes/ConexionBD.php');
    //recuperar datos
        //Usuario
        $id=(int)$_POST['IdUsuario'];
        
        //Presion
        $sistolica=$_POST['sistolica'];
        $diastolica=$_POST['diastolica'];
        $obspresion=$_POST['obspresion'];
        
        //Glucosa
        $resglucosa=$_POST['resglucosa'];
        $obsglucosa=$_POST['obsglucosa'];
        
        //Evaluación del estado corporal
        $cintura=$_POST['cintura'];
        $peso=$_POST['peso'];
        $imc=$_POST['imc'];
        $edadmetabolica=$_POST['edadmetabolica'];
        $masaosea=$_POST['masaosea'];
        $grasavisceral=$_POST['grasavisceral'];
        $agua=$_POST['agua'];
        $obsestadocorporal=$_POST['obsestadocorporal'];
        
        //Densiometría ósea
        $resdensiometria=$_POST['resdensiometria'];
        $rango=$_POST['rango'];
        $obsdensiometria=$_POST['obsdensiometria'];
        
        //Exámen oftálmico
        $od=$_POST['od'];
        $add=$_POST['add'];
        $ol=$_POST['ol'];
        $adl=$_POST['adl'];
        $obsexamenoftalmico=$_POST['obsexamenoftalmico'];
        
        //Espirometría (Función pulmonar)
        $resespirometria=$_POST['resespirometria'];
        
        //Esquema de Vacunación
        $validar=true;
        while($validar){
            
        }
        
        
    echo $id;
    //insertar en presion
    $count = "INSERT INTO presion (id,sistolica,diastolica,observacion) VALUES($id,'$sistolica','$diastolica','$obspresion');";
    $con->exec($count);
    //insertar glucosa
    $count = "INSERT INTO glucosa (id,sistolica,diastolica,observacion) VALUES($id,'$sistolica','$diastolica','$obspresion');";
    $con->exec($count);
    
}

if(isset($_POST['finalizar'])){
    
    
    
    
    
}

