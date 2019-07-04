<?php

//conexion base
include('includes/ConexionBD.php');
// include autoloader
require_once 'vendor/autoload.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;

if (isset($_GET['usuario']) && !empty($_GET['usuario'])) {
    $usr = $_GET['usuario'];

// instantiate and use the dompdf class
    $dompdf = new Dompdf();
    $options = new Options();
    $options->set('defaultFont', 'Courier');
    $dompdf = new Dompdf($options);
    $dompdf->set_option('isHtml5ParserEnabled', true);

    $usr = $_GET['usuario'];
    $QueryPresion = 'SELECT * FROM usuario where id="' . $usr . '"';
    $usuario = $con->query($QueryPresion);

    echo '¡Hola ' . $usuario['Nombre'] . '!';

//Obtener parametros del carnet 
    $presion;
    $glucosa;
    $estadocorporal;
    $examenoftalmico;
    $espirometria;
    $densiometria;
    $esquemavacunacion;

    $parametros = array('presion', 'glucosa', 'estadocorporal', 'examenoftalmico', 'espirometria', 'densiometria', 'esquemavacunacion');
    $Query = "SELECT * FROM presion where id='" . $usuario['id'] . "';";

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
    $dens_normal = ($densiometria['rango'] == 'Normal') ? 'checked = "true' : '';
    $dens_dentro_rango = ($densiometria['rango'] == 'Dentro del rango') ? 'checked = "true' : '';
    $dens_fuera_rango = ($densiometria['rango'] == 'Fuera del rango') ? 'checked = "true' : '';


    $HTML = '
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

<!-- Sección #menu-navegacion -->


        <section class="container-fluid " >
            <div class="row">
                <div class="container wrapper p-3 mt-5">

                        <h2 class="mb-4 ml-3">Presión Arterial</h2>

                        <div class="form-group col-2">
                            <label  for="nombre">Sistólica</label>                            
                            <label type="number" name="sistolica" id="nombre" class="form-control d-block form-control-lg text-center " aria-describedby="ayuda-nombre" placeholder="00" value = "' . $presion['sistolica'] . '">
                        </div>

                        <div class="form-group col-2">
                            <label for="Apellido">Diastólica</label>
                            <input type="number" name="diastolica" id="nombre" class="form-control d-block form-control-lg text-center " aria-describedby="ayuda-nombre" placeholder="00" value = "' . $presion['diastolica'] . '">

                        </div>

                        <div class="form-group col-8 mb-3">
                            <label for="Apellido">Observaciones</label>
                            <input type="text" name="obspresion" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="Escriba las observaciones" value = "' . $presion['observacion'] . '">
                            </br>
                        </div>



                        <h2 class="mb-4 mt-4 ml-3">Glucosa</h2>

                        <div class="form-group col-2">
                            <label  for="nombre">Resultado</label>
                            <input type="number" name="resglucosa" id="nombre" class="form-control d-block form-control-lg text-center " aria-describedby="ayuda-nombre" placeholder="00" value = "' . $glucosa['resultado'] . '">
                        </div>


                        <div class="form-group col-10">
                            <label for="Apellido">Observaciones</label>
                            <input type="text" name="obsglucosa" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="Escriba las observaciones" value = "' . $glucosa['observacion'] . '">
                            </br>

                        </div>


                        <h2 class="mb-4 mt-4 ml-3">Evaluación del estado corporal</h2>

                        <div class="form-group col-1">
                            <label  for="nombre">Cintura</label>
                            <input type="number" name="cintura" id="nombre" class="form-control d-block form-control-lg text-center " aria-describedby="ayuda-nombre" placeholder="00"value = "' . $estadocorporal['cintura'] . '">
                        </div>


                        <div class="form-group col-1">
                            <label for="Apellido">Peso</label>
                            <input type="number" name="peso" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="00" value = "' . $estadocorporal['peso'] . '">

                        </div>

                        <div class="form-group col-2">
                            <label for="Apellido">IMC</label>
                            <input type="number" name="imc" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="00" value = "' . $estadocorporal['imc'] . '">

                        </div>

                        <div class="form-group col-2">
                            <label for="Apellido">Edad metabólica</label>
                            <input type="number" name="edadmetabolica" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="00" value = "' . $estadocorporal['edad_metabolica'] . '">

                        </div>

                        <div class="form-group col-2">
                            <label for="Apellido">Masa ósea</label>
                            <input type="number" name="masaosea" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="00" value = "' . $estadocorporal['masa_osea'] . '">

                        </div>

                        <div class="form-group col-2">
                            <label for="Apellido">Grasa Visceral</label>
                            <input type="number" name="grasavisceral" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="00" value = "' . $estadocorporal['grasa_visceral'] . '">

                        </div>

                        <div class="form-group col-1">
                            <label for="Apellido">%Agua</label>
                            <input type="number" name="agua" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="00" value = "' . $estadocorporal['agua'] . '">

                        </div>


                        <div class="form-group col-12 mb-3">
                            <label for="Apellido">Observaciones</label>
                            <input type="text" name="obsestadocorporal" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="Escriba las observaciones" value = "' . $estadocorporal['observacion'] . '">
                            </br>
                        </div>


                        <h2 class="mb-4 mt-4 ml-3">Densiometría ósea</h2>


                        <div class="form-group col-2">
                            <label for="Apellido">Resultado</label>
                            <input type="number" name="resdensiometria" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="00" value = "' . $densiometria['resultado'] . '">

                        </div>

                        <div class="form-group col-5">

                            <div class="checkbox text-center">
                                <label><input type="radio" name="rango" value="Normal" ' . $dens_normal .
            '><p>Normal</p></label>
                            </div>

                            <div class="checkbox text-center">
                                <label><input type="radio" name="rango" value="Dentro del rango" ' . $dens_dentro_rango . '
                                              ><p>Dentro del Rango</p></label>
                            </div>

                            <div class="checkbox text-center">
                                <label><input type="radio" name="rango" value="Fuera del rango" ' . $dens_fuera_rango . '
                                              ><p>Fuera del Rango</p></label>
                            </div>



                        </div>


                        <div class="form-group col-5 mb-3">
                            <label for="Apellido">Observaciones</label>
                            <input type="text" name="obsdensiometria" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="Escriba las observaciones" value = "' . $densiometria['observacion'] . '">
                            </br>
                        </div>


                        <h2 class="mb-4 mt-4 ml-3">Exámen oftálmico</h2>

                        <div class="form-group col-1">
                            <label  for="nombre">OD</label>
                            <input type="number" name="od" id="nombre" class="form-control d-block form-control-lg text-center " aria-describedby="ayuda-nombre" placeholder="00" value = "' . $examenoftalmico['od'] . '">
                        </div>


                        <div class="form-group col-1">
                            <label for="Apellido">Ad</label>
                            <input type="number" name="add" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="00" value = "' . $examenoftalmico['ad'] . '">

                        </div>

                        <div class="form-group col-1">
                            <label for="Apellido">Ol</label>
                            <input type="number" name="ol" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="00" value = "' . $examenoftalmico['ol'] . '">

                        </div>

                        <div class="form-group col-1">
                            <label for="Apellido">Ad</label>
                            <input type="number" name="adl" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="00" value = "' . $examenoftalmico['adl'] . '">

                        </div>

                        <div class="form-group col-8">
                            <label for="Apellido">Observaciones</label>
                            <input type="text" name="obsexamenoftalmico" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="Escriba las observaciones" value = "' . $examenoftalmico['observacion'] . '">
                            </br>
                        </div>


                        <h2 class="mb-4 mt-4 ml-3">Espirometría (Función pulmonar)</h2>

                        <div class="form-group col-1">
                            <label  for="nombre">Volúmen corriente (vc)</label>


                        </div>


                        <div class="form-group col-11">
                            <label for="Apellido">Resultado</label>
                            <input type="number" name="resespirometria" id="nombre" class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="Escriba las observaciones" value = "' . $espirometria['volumen_corriente'] . '">
                            </br>
                        </div>

                        <h2 class="mb-4 mt-4 ml-3">Esquema de Vacunación</h2>
                        
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
                        <input class="btn btn-light order-md-1 mt-5 ml-3"  type="button" name="agregar" id="add_vacuna" value="Agregar Vacuna" onclick="addVacuna(this)"/>
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

</html>';


    $dompdf->loadHtml($HTML);

// (Optional) Setup the paper size and orientation
//    $dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
    $dompdf->render();

// Output the generated PDF to Browser
    $dompdf->stream();
} else
    echo '¡Error! Usuario desconocido';
?>
    