<!doctype html>
<html lang="es">

    <head>
        <title>TARJETAS DE CIRCUITOS INTEGRADOS</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" type="image/png" href="images/icons8-bios-96.png">

        <!-- Carga del CSS de "Bootstrap" -->
        <link rel="stylesheet" href="css/bootstrap.min.css">

        <!-- Carga del CSS de "Font Awesome" -->
        <link rel="stylesheet" href="css/all.css">

        <!-- Carga del CSS personalizado -->
        <link rel="stylesheet" href="css/estilos.css">
    </head>

    <body>

        <!-- Seccion #barra-contacto -->
        <section id="barra-contacto" class="bg-black text-white py-3 py-lg-1 text-center">
            <div class="container">
                <div class="row justify-content-sm-between align-items-sm-center">
                    <div class="col-12 col-sm-auto">
                        <i class="fas fa-map-marker-alt mr-1"></i><span>Consultar el Aviso de Privacidad </span>
                    </div>

                    <div class="col-12 col-sm-auto">
                        <ul class="redes-sociales list-unstyled d-inline-flex mb-0">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sección #detalles-encabezado -->
        <section id="detalles-encabezado" class="d-none d-md-block py-3 bg-white">
            <div class="container">
                <div class="row justify-content-md-between align-items-md-center">
                    <div class="col-auto">
                        <a href="#" class="logo">
                            <img src="images/salud_logo.png" alt="Logo del sitio" width="250" class="img-fluid">
                        </a>
                    </div>
                    <div class="col-auto">
                        <a href="#" class="logo">
                            <img src="images/logo_grt.png" alt="Logo del sitio" width="120" class="img-fluid">
                        </a>
                    </div>

                </div>
            </div>

        </section>

        <!-- Sección #menu-navegacion -->
        <nav id="menu-navegacion" class="navbar navbar-dark bg-success navbar-expand-md">

            <?php
            //conexion base
            include('includes/ConexionBD.php');
            //Verificar autenticacion del usuario
            $autenticado = "NO_AUT";
            $usuario;
            $ValidarUsuario=false;

            if (isset($_GET['usuario']) && !empty($_GET['usuario'])) {
                $autenticado = "USUARIO_DESC";
                $usr = $_GET['usuario'];
                $QueryPresion = "SELECT * FROM usuario";
                $usuarios = $con->query($QueryPresion);
                foreach ($usuarios as $row) {
                    if ($usr == $row['Email']) {
                        $usuario = $row;
                        $autenticado = "USUARIO_CONOC";
                        echo '¡Hola ' . $usuario['Nombre'] . '!';
                        break;
                    }
                    $ValidarUsuario=true;
                }
                if ($autenticado == "USUARIO_DESC")
                    echo '¡Error! Usuario desconocido';
            }
            //Obtener parametros del carnet 
            $presion;
            $glucosa;
            $estadocorporal;
            $examenoftalmico;
            $espirometria;
            $densiometria;
            $esquemavacunacion;
            
                $parametros = array('presion', 'glucosa', 'estadocorporal', 'examenoftalmico', 'espirometria', 'densiometria', 'esquemavacunacion');

                $q = "SELECT * FROM %s WHERE id='%s'";
                $id = $usuario['id'];

                foreach ($parametros as $parametro) {
                    switch ($parametro):
                        case 'presion':
                            $presion = mysqli_fetch_array(mysqli_query($link, sprintf($q, $parametro, $id)));
                            break;
                        case 'glucosa':
                            $glucosa = mysqli_fetch_array(mysqli_query($link, sprintf($q, $parametro, $id)));
                            break;
                        case 'estadocorporal':
                            $estadocorporal = mysqli_fetch_array(mysqli_query($link, sprintf($q, $parametro, $id)));
                            break;
                        case 'examenoftalmico':
                            $examenoftalmico = mysqli_fetch_array(mysqli_query($link, sprintf($q, $parametro, $id)));
                            break;
                        case 'espirometria':
                            $espirometria = mysqli_fetch_array(mysqli_query($link, sprintf($q, $parametro, $id)));
                            break;
                        case 'densiometria':
                            $densiometria = mysqli_fetch_array(mysqli_query($link, sprintf($q, $parametro, $id)));
                            break;
                        case 'esquemavacunacion':
                            $esquemavacunacion = mysqli_fetch_array(mysqli_query($link, sprintf($q, $parametro, $id)));
                            break;
                    endswitch;
    //            
                }
            
            ?>

            <div class="container">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu-principal"
                        aria-expanded="false" aria-label="Botón Menú principal">
                    <span class="boton-menu"></span>
                </button>


                <div class="collapse navbar-collapse" id="menu-principal">
                    <h3 class="mr-5"> Carnet por tu salud </h3>
                    <ul class="navbar-nav mt-3 mt-md-0">
                        <?php
                        if ($autenticado == "USUARIO_CONOC") {
                                echo '
                                        <li class="nav-item mb-1 mb-md-0 mr-md-2"> <input type="submit" value="Salir de la sesión" class="btn btn-danger order-md-1">
                                 </li>
                                        <li class="nav-item mb-1 mb-md-0 mr-md-2"> <input type="submit" value="Guardar" class="btn btn-warning order-md-1">
                                </li>
                                        <li class="nav-item mb-1 mb-md-0 mr-md-2">  <input type="submit" value="Finalizar" class="btn btn-light order-md-1">
                                            </li>';
                        } else
                            echo '<li class = "nav-item mb-1 mb-md-0 mr-md-2"> <a href = "index.html" class = "btn btn-danger order-md-1">Iniciar sesión</a></li>';
                        ?>

                    </ul>

                </div>
            </div>
        </nav>

        <section class="container-fluid " <?php echo ($autenticado == "USUARIO_CONOC") ? 'visible' : 'hidden'; ?>  >
            <div class="row">


                <div class="container wrapper p-3 mt-5">

                    <form action="Controlador.php" class="">

                        <h2 class="mb-4 ml-3">Presión Arterial</h2>

                        <div class="form-group col-2">
                            <label  for="nombre">Sistólica</label>                            
                            <input type="number" name="sistolica" id="nombre" class="form-control d-block form-control-lg text-center " aria-describedby="ayuda-nombre" placeholder="00" <?php echo 'value="' . $presion['sistolica'] . '"'; ?>>
                        </div>

                        <div class="form-group col-2">
                            <label for="Apellido">Diastólica</label>
                            <input type="number" name="diastolica" id="nombre" class="form-control d-block form-control-lg text-center " aria-describedby="ayuda-nombre" placeholder="00" <?php echo 'value="' . $presion['diastolica'] . '"'; ?>>

                        </div>

                        <div class="form-group col-8 mb-3">
                            <label for="Apellido">Observaciones</label>
                            <input type="text" name="obspresion" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="Escriba las observaciones" <?php echo 'value="' . $presion['observacion'] . '"'; ?>>
                            </br>
                        </div>



                        <h2 class="mb-4 mt-4 ml-3">Glucosa</h2>

                        <div class="form-group col-2">
                            <label  for="nombre">Resultado</label>
                            <input type="number" name="resglucosa" id="nombre" class="form-control d-block form-control-lg text-center " aria-describedby="ayuda-nombre" placeholder="00" <?php echo 'value="' . $glucosa['resultado'] . '"'; ?>>
                        </div>


                        <div class="form-group col-10">
                            <label for="Apellido">Observaciones</label>
                            <input type="text" name="obsglucosa" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="Escriba las observaciones" <?php echo 'value="' . $glucosa['observacion'] . '"'; ?>>
                            </br>

                        </div>


                        <h2 class="mb-4 mt-4 ml-3">Evaluación del estado corporal</h2>

                        <div class="form-group col-1">
                            <label  for="nombre">Cintura</label>
                            <input type="number" name="cintura" id="nombre" class="form-control d-block form-control-lg text-center " aria-describedby="ayuda-nombre" placeholder="00"<?php echo 'value="'.$estadocorporal['cintura'].'"'; ?>>
                        </div>


                        <div class="form-group col-1">
                            <label for="Apellido">Peso</label>
                            <input type="number" name="peso" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="00" <?php echo 'value="'.$estadocorporal['peso'].'"'; ?>>

                        </div>

                        <div class="form-group col-2">
                            <label for="Apellido">IMC</label>
                            <input type="number" name="imc" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="00" <?php echo 'value="'.$estadocorporal['imc'].'"'; ?>>

                        </div>

                        <div class="form-group col-2">
                            <label for="Apellido">Edad metabólica</label>
                            <input type="number" name="edadmetabolica" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="00" <?php echo 'value="'.$estadocorporal['edad_metabolica'].'"'; ?>>

                        </div>

                        <div class="form-group col-2">
                            <label for="Apellido">Masa ósea</label>
                            <input type="number" name="masaosea" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="00" <?php echo 'value="'.$estadocorporal['masa_osea'].'"'; ?>>

                        </div>

                        <div class="form-group col-2">
                            <label for="Apellido">Grasa Visceral</label>
                            <input type="number" name="grasavisceral" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="00" <?php echo 'value="'.$estadocorporal['grasa_visceral'].'"'; ?>>

                        </div>

                        <div class="form-group col-1">
                            <label for="Apellido">%Agua</label>
                            <input type="number" name="agua" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="00" <?php echo 'value="'.$estadocorporal['agua'].'"'; ?>>

                        </div>


                        <div class="form-group col-12 mb-3">
                            <label for="Apellido">Observaciones</label>
                            <input type="text" name="obsestadocorporal" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="Escriba las observaciones" <?php echo 'value="'.$estadocorporal['observacion'].'"'; ?>>
                            </br>
                        </div>


                        <h2 class="mb-4 mt-4 ml-3">Densiometría ósea</h2>


                        <div class="form-group col-2">
                            <label for="Apellido">Resultado</label>
                            <input type="number" name="resdensiometria" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="00" <?php echo 'value="'.$densiometria['resultado'].'"'; ?>>

                        </div>

                        <div class="form-group col-5">

                            <div class="checkbox text-center">
                                <label><input type="radio" name="rango" value="Normal" <?php if($densiometria['rango']=='Normal'){echo 'checked="true"';} ?>><p>Normal</p></label>
                            </div>

                            <div class="checkbox text-center">
                                <label><input type="radio" name="rango" value="Dentro del rango" <?php if($densiometria['rango']=='Dentro del rango'){echo 'checked="true"';} ?>><p>Dentro del Rango</p></label>
                            </div>

                            <div class="checkbox text-center">
                                <label><input type="radio" name="rango" value="Fuera del rango" <?php if($densiometria['rango']=='Fuera del rango'){echo 'checked="true"';} ?>><p>Fuera del Rango</p></label>
                            </div>



                        </div>


                        <div class="form-group col-5 mb-3">
                            <label for="Apellido">Observaciones</label>
                            <input type="text" name="obsdensiometria" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="Escriba las observaciones" <?php echo 'value="'.$densiometria['observacion'].'"'; ?>>
                            </br>
                        </div>


                        <h2 class="mb-4 mt-4 ml-3">Exámen oftálmico</h2>

                        <div class="form-group col-1">
                            <label  for="nombre">OD</label>
                            <input type="number" name="od" id="nombre" class="form-control d-block form-control-lg text-center " aria-describedby="ayuda-nombre" placeholder="00" <?php echo 'value="'.$examenoftalmico['od'].'"'; ?>>
                        </div>


                        <div class="form-group col-1">
                            <label for="Apellido">Ad</label>
                            <input type="number" name="add" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="00" <?php echo 'value="'.$examenoftalmico['ad'].'"'; ?>>

                        </div>

                        <div class="form-group col-1">
                            <label for="Apellido">Ol</label>
                            <input type="number" name="ol" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="00" <?php echo 'value="'.$examenoftalmico['ol'].'"'; ?>>

                        </div>

                        <div class="form-group col-1">
                            <label for="Apellido">Ad</label>
                            <input type="number" name="adl" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="00" <?php echo 'value="'.$examenoftalmico['adl'].'"'; ?>>

                        </div>

                        <div class="form-group col-8">
                            <label for="Apellido">Observaciones</label>
                            <input type="text" name="obsexamenoftalmico" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="Escriba las observaciones" <?php echo 'value="'.$examenoftalmico['observacion'].'"'; ?>>
                            </br>
                        </div>


                        <h2 class="mb-4 mt-4 ml-3">Espirometría (Función pulmonar)</h2>

                        <div class="form-group col-1">
                            <label  for="nombre">Volúmen corriente (vc)</label>


                        </div>


                        <div class="form-group col-11">
                            <label for="Apellido">Resultado</label>
                            <input type="number" name="resespirometria" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="Escriba las observaciones" <?php echo 'value="'.$espirometria['volumen_corriente'].'"'; ?>>
                            </br>
                        </div>

                        <h2 class="mb-4 mt-4 ml-3">Esquema de Vacunación</h2>

                        
                        <script type="text/javascript">
                           a=1;
                           function addVacuna(obj){
                               a++;
                               var div = document.createElement('div');
                                div.innerHTML = '<div class="form-group col-2">\n\
                                                    <label for="Apellido">Vacuna</label>\n\
                                                    <input type="text" name="vacuna_'+a+'" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="">\n\
                                                </div>\n\
                                                <div class="form-group col-3">\n\
                                                    <label for="Apellido">Enfermedad que protege</label>\n\
                                                    <input type="text" name="enfermedad_'+a+'" id="nombre" class="form-control d-block form-control-lg" aria-describedby="ayuda-nombre" placeholder="">\n\
                                                </div>\n\
                                                    <div class="form-group col-3">\n\
                                                        <label for="Apellido">Fecha proxima dosis</label>\n\
                                                        <input type="text" name="fecha_'+a+'" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="">\n\
                                                </div>\n\
                                                <div class="form-group col-2">\n\
                                                    <label for="Apellido">Frencuencia</label>\n\
                                                    <input type="text" name="frecuencia_'+a+'" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="">\n\
                                                </div>\n\
                                                <div class="form-group col-2">\n\
                                                    <label for="Apellido">Dosis</label>\n\
                                                    <input type="text" name="dosis_'+a+'" id="nombre" class="form-control d-block form-control-lg" aria-describedby="ayuda-nombre" placeholder="">\n\
                                                </div>';
                                document.getElementById('vacunas').appendChild(div);
                            }
                        </script>
                        <div class="form-group col-2">
                                                    <label for="Apellido">Vacuna</label>
                                                    <input type="text" name="vacuna_1" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="">
                                                </div>
                                                <div class="form-group col-3">
                                                    <label for="Apellido">Enfermedad que protege</label>
                                                    <input type="text" name="enfermedad_1" id="nombre" class="form-control d-block form-control-lg" aria-describedby="ayuda-nombre" placeholder="">
                                                </div>
                                                    <div class="form-group col-3">
                                                        <label for="Apellido">Fecha proxima dosis</label>
                                                        <input type="text" name="fecha_1" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="">
                                                </div>
                                                <div class="form-group col-2">
                                                    <label for="Apellido">Frencuencia</label>
                                                    <input type="text" name="frecuencia_1" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="">
                                                </div>
                                                <div class="form-group col-2">
                                                    <label for="Apellido">Dosis</label>
                                                    <input type="text" name="dosis_1" id="nombre" class="form-control d-block form-control-lg" aria-describedby="ayuda-nombre" placeholder="">
                                                </div>
                        <div id="vacunas"></div>
                        <input class="btn btn-light order-md-1 mt-5 ml-3"  type="button" name="agregar" id="add_vacuna()" value="Agregar Vacuna" onclick="addVacuna(this)"/>


                    </form>
                </div>



            </div>

        </section>


        <!-- Carga de "Jquery" -->
        <script src="js/jquery-3.3.1.min.js"></script>

        <!-- Carga de "Popper" -->
        <script src="js/popper.min.js"></script>

        <!-- Carga de "Bootstrap" -->
        <script src="js/bootstrap.min.js"></script>



    </body>

</html>
