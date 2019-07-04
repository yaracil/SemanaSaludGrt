<?php

// include autoloader
require_once 'dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;

//conexion base
include('includes/ConexionBD.php');

if (isset($_GET['usuario']) && !empty($_GET['usuario'])) {
    $usr = $_GET['usuario'];

// instantiate and use the dompdf class
    $dompdf = new Dompdf();
    $options = new Options();
    $options->set('defaultFont', 'Courier');
    $dompdf = new Dompdf($options);
    $dompdf->set_option('isHtml5ParserEnabled', true);

    $q = "SELECT * FROM %s WHERE id='%s'";
    $usuario = mysqli_fetch_array(mysqli_query($link, sprintf($q, 'usuario', $usr)));
    $id = $usuario['id'];

//Obtener parametros del carnet 
    $presion;
    $glucosa;
    $estadocorporal;
    $examenoftalmico;
    $espirometria;
    $densiometria;
    $esquemavacunacion;

    $parametros = array('presion', 'glucosa', 'estadocorporal', 'examenoftalmico', 'espirometria', 'densiometria', 'esquemavacunacion');

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

    <body>

<!-- Sección #menu-navegacion -->


        <section class="container-fluid " >
                <div class="container wrapper p-3 mt-5">

                        <h2 class="mb-4 ml-3">Presión Arterial</h2>

                        <div class="form-group col-2">
                            <label  for="nombre">Sistólica</label>                            
                            <label font="withe" > ' . $presion['sistolica'] . ' </label>
                        </div>

                        <div class="form-group col-2">
                            <label for="Apellido">Diastólica</label>
                            <label  name="diastolica"  class="form-control d-block form-control-lg text-center " aria-describedby="ayuda-nombre" placeholder="00" >' . $presion['diastolica'] . '</label>

                        </div>

                        <div class="form-group col-8 mb-3">
                            <label for="Apellido">Observaciones</label>
                            <label type="text" name="obspresion"  class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="Escriba las observaciones" value = "' . $presion['observacion'] . '">
                            </br>
                        </div>



                        <h2 class="mb-4 mt-4 ml-3">Glucosa</h2>

                        <div class="form-group col-2">
                            <label  for="nombre">Resultado</label>
                            <label  name="resglucosa"  class="form-control d-block form-control-lg text-center " aria-describedby="ayuda-nombre" placeholder="00" value = "' . $glucosa['resultado'] . '">
                        </div>


                        <div class="form-group col-10">
                            <label for="Apellido">Observaciones</label>
                            <label type="text" name="obsglucosa"  class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="Escriba las observaciones" value = "' . $glucosa['observacion'] . '">
                            </br>

                        </div>


                        <h2 class="mb-4 mt-4 ml-3">Evaluación del estado corporal</h2>

                        <div class="form-group col-1">
                            <label  for="nombre">Cintura</label>
                            <label  name="cintura"  class="form-control d-block form-control-lg text-center " aria-describedby="ayuda-nombre" placeholder="00"value = "' . $estadocorporal['cintura'] . '">
                        </div>


                        <div class="form-group col-1">
                            <label for="Apellido">Peso</label>
                            <label  name="peso"  class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="00" value = "' . $estadocorporal['peso'] . '">

                        </div>

                        <div class="form-group col-2">
                            <label for="Apellido">IMC</label>
                            <label  name="imc"  class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="00" value = "' . $estadocorporal['imc'] . '">

                        </div>

                        <div class="form-group col-2">
                            <label for="Apellido">Edad metabólica</label>
                            <label  name="edadmetabolica"  class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="00" value = "' . $estadocorporal['edad_metabolica'] . '">

                        </div>

                        <div class="form-group col-2">
                            <label for="Apellido">Masa ósea</label>
                            <label  name="masaosea"  class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="00" value = "' . $estadocorporal['masa_osea'] . '">

                        </div>

                        <div class="form-group col-2">
                            <label for="Apellido">Grasa Visceral</label>
                            <label  name="grasavisceral"  class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="00" value = "' . $estadocorporal['grasa_visceral'] . '">

                        </div>

                        <div class="form-group col-1">
                            <label for="Apellido">%Agua</label>
                            <label  name="agua"  class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="00" value = "' . $estadocorporal['agua'] . '">

                        </div>


                        <div class="form-group col-12 mb-3">
                            <label for="Apellido">Observaciones</label>
                            <label type="text" name="obsestadocorporal"  class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="Escriba las observaciones" value = "' . $estadocorporal['observacion'] . '">
                            </br>
                        </div>


                        <h2 class="mb-4 mt-4 ml-3">Densiometría ósea</h2>


                        <div class="form-group col-2">
                            <label for="Apellido">Resultado</label>
                            <label  name="resdensiometria"  class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="00" value = "' . $densiometria['resultado'] . '">

                        </div>

                        <div class="form-group col-5">

                            <div class="checkbox text-center">
                                <label><label type="radio" name="rango" value="Normal" ' . $dens_normal .
            '><p>Normal</p></label>
                            </div>

                            <div class="checkbox text-center">
                                <label><label type="radio" name="rango" value="Dentro del rango" ' . $dens_dentro_rango . '
                                              ><p>Dentro del Rango</p></label>
                            </div>

                            <div class="checkbox text-center">
                                <label><label type="radio" name="rango" value="Fuera del rango" ' . $dens_fuera_rango . '
                                              ><p>Fuera del Rango</p></label>
                            </div>



                        </div>


                        <div class="form-group col-5 mb-3">
                            <label for="Apellido">Observaciones</label>
                            <label type="text" name="obsdensiometria"  class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="Escriba las observaciones" value = "' . $densiometria['observacion'] . '">
                            </br>
                        </div>


                        <h2 class="mb-4 mt-4 ml-3">Exámen oftálmico</h2>

                        <div class="form-group col-1">
                            <label  for="nombre">OD</label>
                            <label  name="od"  class="form-control d-block form-control-lg text-center " aria-describedby="ayuda-nombre" placeholder="00" value = "' . $examenoftalmico['od'] . '">
                        </div>


                        <div class="form-group col-1">
                            <label for="Apellido">Ad</label>
                            <label  name="add"  class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="00" value = "' . $examenoftalmico['ad'] . '">

                        </div>

                        <div class="form-group col-1">
                            <label for="Apellido">Ol</label>
                            <label  name="ol"  class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="00" value = "' . $examenoftalmico['ol'] . '">

                        </div>

                        <div class="form-group col-1">
                            <label for="Apellido">Ad</label>
                            <label  name="adl"  class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="00" value = "' . $examenoftalmico['adl'] . '">

                        </div>

                        <div class="form-group col-8">
                            <label for="Apellido">Observaciones</label>
                            <label type="text" name="obsexamenoftalmico"  class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="Escriba las observaciones" value = "' . $examenoftalmico['observacion'] . '">
                            </br>
                        </div>


                        <h2 class="mb-4 mt-4 ml-3">Espirometría (Función pulmonar)</h2>

                        <div class="form-group col-1">
                            <label  for="nombre">Volúmen corriente (vc)</label>


                        </div>


                        <div class="form-group col-11">
                            <label for="Apellido">Resultado</label>
                            <label>' . $espirometria['volumen_corriente'] . '</label>
                            </br>
                        </div>

                        <h2 class="mb-4 mt-4 ml-3">Esquema de Vacunación</h2>
                        
                        <div class="form-group col-2">
                            <label for="Apellido">Vacuna</label>
                            <label type="text" name="vacuna_1"  class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="">
                        </div>
                        <div class="form-group col-3">
                            <label for="Apellido">Enfermedad que protege</label>
                            <label type="text" name="enfermedad_1"  class="form-control d-block form-control-lg" aria-describedby="ayuda-nombre" placeholder="">
                        </div>
                        <div class="form-group col-3">
                            <label for="Apellido">Fecha proxima dosis</label>
                            <label type="text" name="fecha_1"  class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="">
                        </div>
                        <div class="form-group col-2">
                            <label for="Apellido">Frencuencia</label>
                            <label type="text" name="frecuencia_1"  class="form-control d-block form-control-lg " aria-describedby="ayuda-nombre" placeholder="">
                        </div>
                        <div class="form-group col-2">
                            <label for="Apellido">Dosis</label>
                            <label type="text" name="dosis_1"  class="form-control d-block form-control-lg" aria-describedby="ayuda-nombre" placeholder="">
                        </div>
                        <div id="vacunas"></div>
                        <label class="btn btn-light order-md-1 mt-5 ml-3"  type="button" name="agregar" id="add_vacuna" value="Agregar Vacuna" onclick="addVacuna(this)"/>
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
    $dompdf->setPaper('A4', 'landscape');
    //Render the HTML as PDF
    $dompdf->render();
// Output the generated PDF to Browser
    $dompdf->stream();
} else
    echo '¡Error! Usuario desconocido';
?>
    