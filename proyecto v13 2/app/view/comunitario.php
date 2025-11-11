<php
    require_once '../app/utilities/lang/idiomasInitConfig.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        $modoOscuro = isset($_COOKIE['modoOscuro']) ? $_COOKIE['modoOscuro'] : 'false';
        if ($modoOscuro === 'true') {
            echo '<link rel="stylesheet" href="../../public/css/homeDark.css">';
        } else {
            echo '<link rel="stylesheet" href="../../public/css/home.css">';
        }
    ?>
    <link rel="icon" type="image/x-icon" href="../../public/images/ConectaUTU.svg">
    <title>ConectaUTU - Comunitario</title>
</head>
<body>
    <div>

        <?php
            require 'shared/panelHeader.php'; 
        ?>

        <?php
            require 'shared/header.php'; 
        ?>

        <div class="pagina">
            <div class="foros">
                <p style="color: #2d3033; margin-inline: min(85%, 50px);"><i>Aquí encontrarás posts de la comunidad, creados por usuarios de la página, en vez de instituciones y organizaciones.</i></p>

                <br>

                <?php
                    $pfpUsuario = "";
                    $foroNombreUsuario = "Usuario929847";

                    $foroPostTitulo = "Me encuentro en busca de empleo.";
                    $foroPostDesc = "";
                    $foroPostImagen = "";
                    $foroPuntajePost = 0;
                    include 'components/forosPost.php';
                ?>

                <?php
                    $pfpUsuario = "../../public/images/profilePictures/FB_IMG_1600387484979.webp";
                    $foroNombreUsuario = "Gerónimo Benavides";

                    $foroPostTitulo = "Me echaron del trabajo.";
                    $foroPostDesc = "Hola amigos!!! hoy quería decirles que como lo dice el título, me echaron del trabajo... <br>
                                    Sí, muy triste la noticia la verdad... pero vengo acá para ver si encuentro laburo acá. <br>
                                    Vivo en Canelones, tengo 23 años y experiencia en atención al cliente, ventas y repositor. <br>
                                    Si alguien sabe de algo, por favor avísenme. <br>
                                    Muchas gracias a todos y suerte con sus búsquedas también. <br>
                                    No es urgente, todavía me están pagando la indemnización.";
                    $foroPostImagen = "../../public/images/userContent/239959701_858164098158726_4463780559878454497_n.jpg";
                    $foroPuntajePost = 27;
                    include 'components/forosPost.php';
                ?>

                <?php
                    $pfpUsuario = "";
                    $foroNombreUsuario = "Usuario935278";

                    $foroPostTitulo = $mensajeEliminadoTitulo;
                    $foroPostDesc = $mensajeEliminadoDesc;
                    $foroPostImagen = "";
                    $foroPuntajePost = 0;
                    include 'components/forosPost.php';
                ?>
            </div>
        </div>

        <div class="espacioFooter">
            <div class="footer">
                <p>ConectaUTU - 2025</p>
                <br>
            </div>
        </div>
    </div>

    <script src="../../public/js/script.js"></script>
    <script src="../../public/js/advertencia.js"></script>
</body>
</html>