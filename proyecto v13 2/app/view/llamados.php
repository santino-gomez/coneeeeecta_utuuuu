<php
    require_once '../utilities/lang/idiomasInitConfig.php';
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
    <title>ConectaUTU - Llamados</title>
</head>
<body>
    <div>
        <?php
            require 'shared/header.php'; 
        ?>

        <nav class="paneles">
            <h4><a class="antiAStyle" href="pasantias.php">PASANTÍAS</a></h4>
            <h4><a class="antiAStyle" href="comunitario.php">COMUNITARIO</a></h4>
            <h4><b>LLAMADOS</b></h4> 
        </nav>

        <div class="pagina">
            <div class="foros">
                <p style="color: #808080;"><i>Aquí encontrarás oportunidades de obtener pasantías por parte de instituciones y organizaciones varias.</i></p>

                <br>

                <?php
                    $nombreLlamado = "Desarrollo Front-End";
                    $descLlamado = "Se necesita desarrollador front-end junior.";
                    $fechaLimiteLlamado = "18/12/2025";
                    $contactoLlamado = "Teléfono: 555-1234";
                    include 'components/llamado.php';
                ?>
            </div>
        </div>

        <div class="espacioFooter">
            <div class="footer">
                <p>ConectaUTU - 2025</p>
            </div>
        </div>
    </div>

    <script src="../../public/js/script.js"></script>
    <script src="../../public/js/advertencia.js"></script>
</body>
</html>