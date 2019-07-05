<?php

// include autoloader
require 'vendor/autoload.php';

if (isset($_GET['usuario']) && !empty($_GET['usuario'])) {
    $usr = $_GET['usuario'];

    include('includes/ConexionBD.php');

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

    <head>
        <title>Grunethal semana de la salud</title>
        <meta charset="utf-8">
    </head>

    <body>
        <!-- Contenedor Central -->

        <div id="container" style="width:900px; height:auto; margin: 50px auto 0 auto; background: #E6E6E6; font-family:Arial; padding: 30px; ">


            <table width="901" border="0">
                <tbody>
                    <tr>
                        <td width="370"><img src="images/salud_logo.png" width="200" alt=""/></td>
                        <td width="236">Fecha: '.date('d/m/Y', time()).'</td>
                        <td style="text-align: right" width="281"><img src="images/logo_grt.png" width="100" alt="" /></td>
                    </tr>
                </tbody>
            </table>

            <h3 align="center" >Estimado ' . $usuario['Nombre'] . ', tu expediente clínico Grünenthal es el siguiente:</h3>

            <table width="900" border="0" style="font-family: Arial;  text-align:center;" >
                <tbody>
                    <tr>
                        <td colspan="3" bgcolor="#7FCE4C" style="font-size:20px;"><strong>Presión Arterial</strong></td>
                    </tr>
                    <tr bgcolor="#ABA7A6">
                        <td width="158" >Sistólica</td>
                        <td width="175" >Diastólica</td>
                        <td width="553" >Observaciones</td>
                    </tr>
                    <tr >
                        <td >' . $presion['sistolica'] . '</td>
                        <td >' . $presion['diastolica'] . '</td>
                        <td >' . $presion['observacion'] . '</td>
                    </tr>
                </tbody>
            </table>

            <table width="900" border="0" style="font-family: Arial; margin-top: 40px; text-align:center; ">
                <tbody>
                    <tr>
                        <td colspan="2" bgcolor="#3D965E" style="font-size:20px;"><strong>Glucosa</strong></td>
                    </tr>
                    <tr bgcolor="#ABA7A6">
                        <td style="text-align:center;" width="158">Resultado</td>

                        <td  style="text-align:center;" width="553">Observaciones</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">' . $glucosa['resultado'] . '</td>
                        <td style="text-align:center;">' . $glucosa['observacion'] . '</td>
                    </tr>
                </tbody>
            </table>


            <table width="900" border="0" style="font-family: Arial; margin-top: 40px; text-align:center;">
                <tbody>
                    <tr >
                        <td colspan="8" bgcolor="#7FCE4C" style="font-size:20px;"><strong>Evaluación del estado corporal</strong></td>
                    </tr>
                    <tr bgcolor="#ABA7A6" style="font-weight:600;">
                        <td >Cintura</td>
                        <td >Peso</td>
                        <td >IMC</td>
                        <td >Edad Metabólica</td>
                        <td >Masa Ósea</td>
                        <td >Grasa Visceral</td>
                        <td >% Agua</td>
                        <td >Observaciones</td>
                    </tr>
                    <tr>

      <td>' . $estadocorporal['cintura'] . '</td>
      <td>' . $estadocorporal['peso'] . '</td>
      <td>' . $estadocorporal['IMC'] . '</td>
      <td>' . $estadocorporal['edad_metabolica'] . '</td>
      <td>' . $estadocorporal['masa_osea'] . '</td>
      <td>' . $estadocorporal['grasa_viceral'] . '</td>
      <td>' . $estadocorporal['agua'] . '</td>
          <td>' . $estadocorporal['observacion'] . '</td>
                    </tr>
                    <tr>
                        <td><strong>Observaciones</strong></td>
                        <td>x</td>


                    </tr>
                </tbody>
            </table>


            <table width="900" border="0" style="font-family: Arial; margin-top: 40px; text-align:center;">
                <tbody>
                    <tr>
                        <td colspan="3" bgcolor="#3D965E" style="font-size:20px;"><strong>Densiometría Óptica</strong></td>
                    </tr>
                    <tr bgcolor="#ABA7A6">
                        <td width="127">Resultado</td>

                        <td width="141">Rango</td>

                        <td width="618">Observaciones</td>
                    </tr>
                    <tr>
                        <td>'.$densiometria['resultado'].'</td>
                        <td>'.$densiometria['rango'].'</td>
                        <td>'.$densiometria['observacion'].'</td>
                    </tr>
                </tbody>
            </table>


            <table width="900" border="0" style="font-family: Arial; margin-top: 40px; text-align:center;">
                <tbody>
                    <tr >
                        <td colspan="5" bgcolor="#7FCE4C" style="font-size:20px;"><strong>Exámen oftálmico</strong></td>
                    </tr>
                    <tr bgcolor="#ABA7A6" style="font-weight:600;">
                        <td >OD</td>
                        <td >AD</td>
                        <td >OL</td>
                        <td >ADL</td>
                        <td >Observaciones</td>
                    </tr>
                    <tr>
                        <td>'.$examenoftalmico['od'].'</td>
                        <td>'.$examenoftalmico['ad'].'</td>
                        <td>'.$examenoftalmico['ol'].'x</td>
                        <td>'.$examenoftalmico['adl'].'</td>
                        <td>'.$examenoftalmico['observacion'].'</td>

                    </tr>
                </tbody>
            </table>

            <table width="900" border="0" style="font-family: Arial; margin-top: 30px; text-align:center;">
                <tbody>
                    <tr>
                        <td colspan="2" bgcolor="#3D965E" style="font-size:20px;"><strong>Espirometría</strong></td>
                    </tr>
                    <tr bgcolor="#ABA7A6">
                        <td width="158"><strong>Volúmen Corriente</strong></td>
                        <td><strong>Resultado</strong><strong></strong></td>
                    </tr>
                    <tr>
                        <td>(VC)</td>
                        <td>x</td>
                    </tr>
                </tbody>
            </table>

            <table width="900" border="0" style="font-family: Arial; margin-top: 30px; ">
                <tbody>
                    <tr >
                        <td colspan="5" bgcolor="#7FCE4C" style="font-size:20px;"><strong>Esquema de Vacunación</strong></td>
                    </tr>
                    <tr bgcolor="#ABA7A6" style="font-weight:600;">
                        <td width="114" >Vacuna</td>
                        <td width="211" >Enfermedad que protege</td>
                        <td width="221" >Fecha de próxima dósis</td>
                        <td width="171" >Frencuencia</td>
                        <td width="161" >Dósis</td>
                    </tr>
                    <tr>
                        <td>x</td>
                        <td>x</td>
                        <td>x</td>
                        <td>x</td>
                        <td>x</td>

                    </tr>
                </tbody>
            </table>

        </div>
    </body>
</html>';
    $mpdf = new \Mpdf\Mpdf();
//    $mpdf->WriteHTML(file_get_contents('pdf.php'));
    $mpdf->WriteHTML($HTML);
    $mpdf->Output();
} else
    header('Location: Controlador.php?mensaje="¡Error! Usuario desconocido"');
?>
    