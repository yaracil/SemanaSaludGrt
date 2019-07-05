<?php

if (isset($_POST['guardar'])) {
    //conexion base

    include('includes/ConexionBD.php');
    //recuperar datos
    
        //Usuario
        $id = (int) $_POST['IdUsuario'];
        $q = "SELECT * FROM %s WHERE id='%s'";
        $usuario = mysqli_fetch_array(mysqli_query($link, sprintf($q, 'usuario', $id)));
        
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
        $incremento=$_POST['Numero'];
        $EsquemaVacunas = array();
        $i=0;
        for($i=0;$i<$incremento;$i++){
                $EsquemaVacunas[$i] = array($_POST['vacuna_'.($i+1).''],$_POST['enfermedad_'.($i+1).''],
                    $_POST['fecha_'.($i+1).''],$_POST['frecuencia_'.($i+1).''],$_POST['dosis_'.($i+1).'']);
        }
    
    $validar=false;    
    //insertar en presion
        $resultado = mysqli_query($link, sprintf($q, 'presion', $id));

        if (mysqli_num_rows($resultado) != 0) {
            $count = "Update presion set sistolica='$sistolica', diastolica='$diastolica', observacion='$obspresion' where id=$id;";
        } else {
            $count = "INSERT INTO presion (id,sistolica,diastolica,observacion) VALUES($id,'$sistolica','$diastolica','$obspresion');";
        }
        $con->exec($count);
    //insertar glucosa
        $resultado = mysqli_query($link, sprintf($q, 'glucosa', $id));
        if (mysqli_num_rows($resultado) != 0) {
            $count = "Update glucosa set resultado='$resglucosa', observacion='$obsglucosa' where id=$id;";
        } else {
            $count = "INSERT INTO glucosa (id,resultado,observacion) VALUES($id,'$resglucosa','$obsglucosa');";
        }
        $con->exec($count);
    
    //insertar Evaluación del estado corporal
        $resultado = mysqli_query($link, sprintf($q, 'estadocorporal', $id));
        if (mysqli_num_rows($resultado) != 0) {
            $count = "UPDATE estadocorporal set cintura='$cintura', peso='$peso',imc='$imc',edad_metabolica='$edadmetabolica',masa_osea='$masaosea',grasa_visceral='$grasavisceral',agua='$agua',observacion='$obsestadocorporal' where id=$id;";
        } else {
            $count = "INSERT INTO estadocorporal (id,cintura,peso,imc,edad_metabolica,masa_osea,grasa_visceral,agua,observacion) VALUES($id,'$cintura','$peso','$imc','$edadmetabolica','$masaosea','$grasavisceral','$agua','$obsestadocorporal');";
        }
        $con->exec($count);
    
    //insertar Densiometría ósea
        $resultado = mysqli_query($link, sprintf($q, 'densiometria', $id));
        if (mysqli_num_rows($resultado) != 0) {
            $count = "UPDATE densiometria set resultado='$resdensiometria',rango='$rango',observacion='$obsdensiometria' where id=$id;";
        } else {
            $count = "INSERT INTO densiometria (id,resultado,rango,observacion) VALUES($id,'$resdensiometria','$rango','$obsdensiometria');";
        }
        $con->exec($count);
    
    //insertar Exámen oftálmico
        $resultado = mysqli_query($link, sprintf($q, 'examenoftalmico', $id));
        if (mysqli_num_rows($resultado) != 0) {
            $count = "UPDATE examenoftalmico set od='$od',ad='$add',ol='$ol',adl='$adl',observacion='$obsexamenoftalmico' where id=$id;";
        } else {
            $count = "INSERT INTO examenoftalmico (id,od,ad,ol,adl,observacion) VALUES($id,'$od','$add','$ol','$adl',$obsexamenoftalmico');";
        }
    $con->exec($count);
    //insertar Espirometría (Función pulmonar)
        $resultado = mysqli_query($link, sprintf($q, 'espirometria', $id));
        if (mysqli_num_rows($resultado) != 0) {
            $count = "UPDATE espirometria set volumen_corriente='$resespirometria' where id=$id;";
        } else {
            $count = "INSERT INTO espirometria (id,volumen_corriente) VALUES($id,'$resespirometria');";
        }
    $con->exec($count);
    //insertar Esquema de Vacunación
    $validar=false;     
    $vacunas=array();
    $j=0;
    $i=0;
        //validar si existe datos
        $query = "SELECT * FROM esquemavacunacion where id=$id";
        $resultado = $con->query($query);
        foreach ($resultado as $rows) {
            $id_vacunas[$j]=$rows['id_vacuna']; 
            $j++;
        }
        for($i=0;$i<$j;$i++){
            $vacuna=$EsquemaVacunas[$i][0];
            $proteje=$EsquemaVacunas[$i][1];
            $fecha=$EsquemaVacunas[$i][2];
            $frecuencia=$EsquemaVacunas[$i][3];
            $dosis=$EsquemaVacunas[$i][4];
            $id_vac=((int)$id_vacunas[$i]);
            $count = "UPDATE esquemavacunacion set vacuna='$vacuna', enfermedad_proteje='$proteje',fecha_dosis='$fecha',frecuencia='$frecuencia',dosis='$dosis' where id=$id and id_vacuna=$id_vac;";
            $con->exec($count);
        }
        for($i=$j;$i<$incremento;$i++){
            $vacuna=$EsquemaVacunas[$i][0];
            $proteje=$EsquemaVacunas[$i][1];
            $fecha=$EsquemaVacunas[$i][2];
            $frecuencia=$EsquemaVacunas[$i][3];
            $dosis=$EsquemaVacunas[$i][4];
            $count = "INSERT INTO esquemavacunacion (id,vacuna,enfermedad_proteje,fecha_dosis,frecuencia,dosis) VALUES($id,'$vacuna','$proteje','$fecha','$frecuencia','$dosis');";
            $con->exec($count);
        }
        header("Location: index.html");
} else if (isset($_POST['finalizar'])) {
    
    header('Location: toPDF.php?usuario="'.$_POST['IdUsuario'].'"');


} else if (isset($_POST['salir'])) {

    header("Location: index.html");
}
?>
