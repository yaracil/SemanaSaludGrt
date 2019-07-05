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
/*<?php
                            $in=0;
                            $query = "SELECT * FROM esquemavacunacion where id=$id";
                            $resultado = $con->query($query);
                            foreach ($resultado as $rows) {
                                $in++;
                                echo '<div id="Esquema_'.$in.'"><div class="form-group col-2">
                                                    <label for="Apellido">Vacuna</label>
                                                    <input type="text" name="vacuna_'.$in.'" value = "'.$rows['vacuna'].'"  id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="">
                                                </div>
                                                <div class="form-group col-3">
                                                    <label for="Apellido">Enfermedad que protege</label>
                                                    <input type="text" name="enfermedad_'.$in.'" value = "'.$rows['enfermedad_proteje'].'" id="nombre" class="form-control d-block form-control-lg" aria-describedby="ayuda-nombre" placeholder="">
                                                </div>
                                                    <div class="form-group col-3">
                                                        <label for="Apellido">Fecha proxima dosis</label>
                                                        <input type="text" name="fecha_'.$in.'" id="nombre" value = "'.$rows['fecha_dosis'].'" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="">
                                                </div>
                                                <div class="form-group col-2">
                                                    <label for="Apellido">Frencuencia</label>
                                                    <input type="text" name="frecuencia_'.$in.'" id="nombre" value = "'.$rows['frecuencia'].'" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="">
                                                </div>
                                                <div class="form-group col-2">
                                                    <label for="Apellido">Dosis</label>
                                                    <input type="text" name="dosis_'.$in.'" id="nombre" value = "'.$rows['dosis'].'" class="form-control d-block form-control-lg" aria-describedby="ayuda-nombre" placeholder="">
                                                </div></div>';
                            }
                            echo "<script type='text/javascript'>document.getElementById('Numero').value=$in;</script>";
                        ?>
                        
                        <script type="text/javascript">
                            
                            function addVacuna(){
                                a = document.getElementById('Numero').value;
                                a++;
                                var div = document.createElement('div');
                                div.setAttribute("id","Esquema_"+a+"");
                                div.innerHTML = '<div class="form-group col-2" >\n\
                                                    <label for="Apellido">Vacuna</label>\n\
                                                    <input type="text" name="vacuna_' + a + '" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="">\n\
                                                </div>\n\
                                                <div class="form-group col-3">\n\
                                                    <label for="Apellido">Enfermedad que protege</label>\n\
                                                    <input type="text" name="enfermedad_' + a + '" id="nombre" class="form-control d-block form-control-lg" aria-describedby="ayuda-nombre" placeholder="">\n\
                                                </div>\n\
                                                    <div class="form-group col-3">\n\
                                                        <label for="Apellido">Fecha proxima dosis</label>\n\
                                                        <input type="text" name="fecha_' + a + '" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="">\n\
                                                </div>\n\
                                                <div class="form-group col-2">\n\
                                                    <label for="Apellido">Frencuencia</label>\n\
                                                    <input type="text" name="frecuencia_' + a + '" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="">\n\
                                                </div>\n\
                                                <div class="form-group col-2">\n\
                                                    <label for="Apellido">Dosis</label>\n\
                                                    <input type="text" name="dosis_' + a + '" id="nombre" class="form-control d-block form-control-lg" aria-describedby="ayuda-nombre" placeholder="">\n\
                                                </div>';
                                document.getElementById('vacunas').appendChild(div);
                                document.getElementById('Numero').value=a;
                            }
                            function removeVacuna(){
                                a = document.getElementById('Numero').value;
                                var dive=document.getElementById('Esquema_'+a+'');
                                document.getElementById('vacunas').removeChild(dive);
                                a--;
                                document.getElementById('Numero').value=a;
                            }
                        </script>
                        
                        <div id="vacunas"></div>
                        <input class="btn btn-light order-md-1 mt-5 ml-3"  type="button" name="agregar" id="add_vacuna" value="Agregar Vacuna" onclick="addVacuna()"/>
                        <input class="btn btn-danger order-md-1 mt-5 ml-3"  type="button" name="borrar" id="remove_vacuna" value="Eliminar Ultima Vacuna" onclick="removeVacuna()"/>
*/
    /*//Esquema de Vacunación
        $validar=true;
        $incremento=$_POST['Numero'];
        $EsquemaVacunas = array();
        $i=0;
        for($i=0;$i<$incremento;$i++){
                $EsquemaVacunas[$i] = array($_POST['vacuna_'.($i+1).''],$_POST['enfermedad_'.($i+1).''],
                    $_POST['fecha_'.($i+1).''],$_POST['frecuencia_'.($i+1).''],$_POST['dosis_'.($i+1).'']);
        }
     * //insertar Esquema de Vacunación
     
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