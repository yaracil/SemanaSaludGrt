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
        $rango=$_POST['Rango'];
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
        $incremento=1;
        $EsquemaVacunas = array();
        while($validar){
            if($_POST['vacuna_'.$incremento.'']!=""){
                $EsquemaVacunas[] = array(
                    "Vacuna" => $_POST['vacuna_'.$incremento.''],
                    "Enfermedad" => $_POST['enfermedad_'.$incremento.''],
                    "Fecha" => $_POST['fecha_'.$incremento.''],
                    "Frecuencia" => $_POST['frecuencia_'.$incremento.''],
                    "Dosis" => $_POST['dosis_'.$incremento.'']
                );
                $incremento++;
            }else{
                $validar=false;
            }
        }
    
    $validar=false;    
    //insertar en presion
    
        //validar si existe datos
        $query = "SELECT * FROM presion where id=$id";
        $resultado = $con->query($query);
        foreach ($resultado as $rows) {
            $validar=true;
        }
        
        if($validar){
            $count = "Update presion set sistolica='$sistolica', diastolica='$diastolica', observacion='$obspresion' where id=$id;";
            $con->exec($count);
        } else {
            $count = "INSERT INTO presion (id,sistolica,diastolica,observacion) VALUES($id,'$sistolica','$diastolica','$obspresion');";
            $con->exec($count);
        }
    //insertar glucosa
    $validar=false; 
        //validar si existe datos
        $query = "SELECT * FROM glucosa where id=$id";
        $resultado = $con->query($query);
        foreach ($resultado as $rows) {
            $validar=true;
        }
        
        if($validar){
            $count = "Update glucosa set resultado='$resglucosa', observacion='$obsglucosa' where id=$id;";
            $con->exec($count);
        } else {
            $count = "INSERT INTO glucosa (id,resultado,observacion) VALUES($id,'$resglucosa','$obsglucosa');";
            $con->exec($count);
        }
    
    //insertar Evaluación del estado corporal
    $validar=false; 
        //validar si existe datos
        $query = "SELECT * FROM estadocorporal where id=$id";
        $resultado = $con->query($query);
        foreach ($resultado as $rows) {
            $validar=true;
        }
        
        if($validar){
            $count = "UPDATE estadocorporal set cintura='$cintura', peso='$peso',imc='$imc',edad_metabolica='$edadmetabolica',masa_osea='$masaosea',grasa_visceral='$grasavisceral',agua='$agua',observacion='$obsestadocorporal' where id=$id;";
            $con->exec($count);
        } else {
            $count = "INSERT INTO estadocorporal (id,cintura,peso,imc,edad_metabolica,masa_osea,grasa_visceral,agua,observacion) VALUES($id,'$cintura','$peso','$imc','$edadmetabolica','$masaosea','$grasavisceral','$agua','$obsestadocorporal');";
            $con->exec($count);
        }
    
    //insertar Densiometría ósea
    $validar=false;     
        //validar si existe datos
        $query = "SELECT * FROM densiometria where id=$id";
        $resultado = $con->query($query);
        foreach ($resultado as $rows) {
            $validar=true;
        }
        
        if($validar){
            $count = "UPDATE densiometria set resultado='$resdensiometria',rango='$rango',observacion='$obsdensiometria' where id=$id;";
            $con->exec($count);
        } else {
            $count = "INSERT INTO densiometria (id,resultado,rango,observacion) VALUES($id,'$resdensiometria','$rango','$obsdensiometria');";
            $con->exec($count);
        }
    
    //insertar Exámen oftálmico
    $validar=false;     
        //validar si existe datos
        $query = "SELECT * FROM examenoftalmico where id=$id";
        $resultado = $con->query($query);
        foreach ($resultado as $rows) {
            $validar=true;
        }
        
        if($validar){
            $count = "UPDATE examenoftalmico set od='$od',ad='$add',ol='$ol',adl='$adl',observacion='$obsexamenoftalmico' where id=$id;";
            $con->exec($count);
        } else {
            $count = "INSERT INTO examenoftalmico (id,od,ad,ol,adl,observacion) VALUES($id,'$od','$add','$ol','$adl',$obsexamenoftalmico');";
            $con->exec($count);
        }
    //insertar Espirometría (Función pulmonar)
    $validar=false;     
        //validar si existe datos
        $query = "SELECT * FROM espirometria where id=$id";
        $resultado = $con->query($query);
        foreach ($resultado as $rows) {
            $validar=true;
        }
        
        if($validar){
            $count = "UPDATE espirometria set volumen_corriente='$resespirometria' where id=$id;";
            $con->exec($count);
        } else {
            $count = "INSERT INTO espirometria (id,volumen_corriente) VALUES($id,'$resespirometria');";
            $con->exec($count);
        }
    //insertar Esquema de Vacunación
    $validar=false;     
    $vacunas=array();
        //validar si existe datos
        $query = "SELECT * FROM esquemavacunacion where id=$id";
        $resultado = $con->query($query);
        foreach ($resultado as $rows) {
            $validar=true;
            $vacunas= array(
                "id" => $rows['id_vacuna']
            );
        }
        if($validar){
            for($i=0;$i<$incremento;$i++){
                $vacuna=$EsquemaVacunas['Vacuna'];
                $proteje=$EsquemaVacunas['Enfermedad'];
                $fecha=$EsquemaVacunas['Fecha'];
                $frecuencia=$EsquemaVacunas['Frecuencia'];
                $dosis=$EsquemaVacunas['Dosis'];
                $count = "UPDATE esquemavacunacion set vacuna='$vacuna', enfermedad_proteje='$proteje',fecha_dosis='$fecha',frecuencia='$frecuencia',dosis='$dosis', where id=$id;";
                $con->exec($count);
            }
        } else {
            $count = "INSERT INTO esquemavacunacion (id,vacuna,enfermedad_proteje,fecha_dosis,frecuencia,dosis) VALUES();";
            $con->exec($count);
        }    
        
}

if(isset($_POST['finalizar'])){
    
    
    
    
    
}

