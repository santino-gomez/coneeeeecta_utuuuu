<php
    require_once '../app/utilities/lang/idiomasInitConfig.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        $modoOscuro = isset($_COOKIE['modoOscuro']) ? $_COOKIE['modoOscuro'] : 'true';
        if ($modoOscuro === 'true') {
            echo '<link rel="stylesheet" href="../../public/css/homeDark.css">';
        } else {
            echo '<link rel="stylesheet" href="../../public/css/home.css">';
        }
    ?>
    <link rel="icon" href="images/ConectaUTU.svg" type="image/x-icon">
    <title>ConectaUTU - Pasantías</title>
</head>
<body>
    <div>
        <?php
            require 'shared/header.php'; 
        ?>

        <nav class="paneles">
            <h4><b>PASANTÍAS</b></h4>
            <h4><a class="antiAStyle" href="comunitario.php">COMUNITARIO</a></h4>
            <h4><a class="antiAStyle" href="llamados.php">LLAMADOS</a></h4> 
        </nav>

        <div class="pagina">
            <div class="foros">
                <p style="color: #afafaf;"><i>Aquí encontrarás oportunidades de obtener pasantías por parte de instituciones y organizaciones varias.</i></p>

                <br>

                <?php
                    $empresaPasantia = "Antel";
                    $descPasantia = "¡Hola! Estamos buscando estudiantes de UTU para una pasantía en desarrollo de software. <br>
                    Durante esta pasantía, tendrás la oportunidad de trabajar en proyectos reales, aprender de profesionales";
                    $requisitosPasantia = "Estar estudiando en áreas relacionadas con tecnología en UTU.";
                    $contactoPasantia = "antel100realnofake@gmail.com";
                    $ubicacionPasantia = "Montevideo, Uruguay";
                    include 'components/pasantia.php';
                ?>
            </div>
        </div>

        <div class="espacioFooter">
            <div class="footer">
                <p>ConectaUTU - 2025</p>
            </div>
        </div>
    </div>

    <script src="../../public/js/advertencia.js"></script>
</body>