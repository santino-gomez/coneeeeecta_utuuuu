<?php
    require_once '../app/utilities/initCode.php';
?>

<!DOCTYPE html>

<?php
// determine language for html tag (fallback to 'es')
$langAttr = 'es';
if (!empty($lang) && in_array($lang, ['es', 'en'], true)) {
    $langAttr = $lang;
} elseif (!empty($_COOKIE['lang'])) {
    $c = strtolower(substr(trim($_COOKIE['lang']), 0, 2));
    if (in_array($c, ['es', 'en'], true)) {
        $langAttr = $c;
    }
}
?>

<html lang="<?php echo htmlspecialchars($langAttr, ENT_QUOTES, 'UTF-8'); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ConectaUTU - Inicio</title>
    <meta name="author" content="Thinkgear">
    <meta name="description" content="Plataforma para conectar estudiantes de UTU con pasantías y oportunidades laborales.">
    <meta name="keywords" content="
    ConectaUTU, UTU, pasantías, oportunidades laborales, estudiantes, egresados, empresas, ptic, pti, ptec, anep, tecnología
    ">
    <?php // elegir entre modo oscuro o claro
        $modoOscuro = isset($_COOKIE['modoOscuro']) ? $_COOKIE['modoOscuro'] : 'true';
        if ($modoOscuro === 'true') {
            echo '<link rel="stylesheet" href="css/indexDark.css">';
        } else {
            echo '<link rel="stylesheet" href="css/index.css">';
        }
    ?>
    <link rel="icon" type="image/x-icon" href="../images/ConectaUTU.svg">
</head>
<body class="responsivoBro">
    <div class="flexBody">
        <div class="extra">
            <section>
                <h1 class="extraH1">Bienvenido a</h1>
                <span class="imagotipo">
                    <img class="isotipo" src="images/ConectaUTU.svg" draggable="false" alt="Isotipo de ConectaUTU">
                    <h1 class="logotipo">ConectaUTU</h1>
                </span>
                <p>Por: <br> <b>Thinkgear</b></p>
            </section>

            <section class="miniDescsFlex">
                <div class="miniDescs">
                    <div class="miniDescFlex1">
                        <span class="miniDesc">
                            <img src="images/pasantiaIconoAlt.png" alt="Icono de pasantías contorneado" draggable="false">
                            <p>Encuentra pasantías y oportunidades laborales en tu área de estudio.</p>
                        </span>
                        <span class="miniDesc">
                            <img src="images/comunidad.png" alt="Icono de comunidad" draggable="false">
                            <p>Forma una comunidad con gente de tu rubro, sean estudiantes, egresados o empresas.</p>
                        </span>
                    </div>
                    <div class="miniDescFlex2">
                        <span class="miniDesc">
                            <img src="images/empresas.png" alt="Icono de empresas" draggable="false">
                            <p>Encuentra a egresados y envía pasantías y oportunidades de forma fácil y rápida.</p>
                        </span>
                        <span class="miniDesc">
                            <img src="images/curriculumVitae.png" alt="Icono de currículum" draggable="false">
                            <p>Fácil gestión de curriculums, posts y perfiles para agilizar tu experiencia.</p>
                        </span>
                    </div>
                </div>
            </section>

            <footer class="footerPagina"><b>Thinkgear</b> &copy; 2025. <br> Todos los derechos reservados.</footer>
        </div>
    <div class="pagina">
        <div class="fondoPagina">
            <span class="imagotipo">
                <img class="isotipo" src="images/ConectaUTU.svg" draggable="false" alt="Isotipo de ConectaUTU">
                <h1 class="logotipo">ConectaUTU</h1>
            </span>
            <span class="contenido1">
                <p>Para continuar, Inicie sesión o regístrese para continuar:</p>
                <br>
                <p><i>¿Eres una empresa? <a href="../app/view/inicioSesionEmpresas.php">Haz click aquí.</a></i></p>
            </span>
            <span class="botones">
                <button id="redirigirInicioSesion">Iniciar Sesión</button>
                <button id="redirigirRegistro" href="../app/view/registrarse.php">Registrarse</button>
            </span>
        </div>
        
    </div>

    <script src="js/botones.js"></script>
    <script src="js/advertencia.js"></script>
</body>
</html>