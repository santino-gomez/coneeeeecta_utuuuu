<?php
/** @var string $lang */
/** @var bool $modoOscuro */
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($lang ?? 'es', ENT_QUOTES, 'UTF-8'); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ConectaUTU - Inicio</title>
    <meta name="author" content="Thinkgear">
    <meta name="description" content="Plataforma para conectar estudiantes de UTU con pasantías y oportunidades laborales.">
    <meta name="keywords" content="ConectaUTU, UTU, pasantías, oportunidades laborales, estudiantes, egresados, empresas">
    <?php if ($modoOscuro): ?>
        <link rel="stylesheet" href="<?php echo asset('css/indexDark.css'); ?>">
    <?php else: ?>
        <link rel="stylesheet" href="<?php echo asset('css/index.css'); ?>">
    <?php endif; ?>
    <link rel="icon" type="image/x-icon" href="<?php echo asset('images/ConectaUTU.svg'); ?>">
</head>
<body class="responsivoBro">
    <div class="flexBody">
        <div class="extra">
            <section>
                <h1 class="extraH1">Bienvenido a</h1>
                <span class="imagotipo">
                    <img class="isotipo" src="<?php echo asset('images/ConectaUTU.svg'); ?>" draggable="false" alt="Isotipo de ConectaUTU">
                    <h1 class="logotipo">ConectaUTU</h1>
                </span>
                <p>Por: <br> <b>Thinkgear</b></p>
            </section>

            <section class="miniDescsFlex">
                <div class="miniDescs">
                    <div class="miniDescFlex1">
                        <span class="miniDesc">
                            <img src="<?php echo asset('images/pasantiaIconoAlt.png'); ?>" alt="Icono de pasantías contorneado" draggable="false">
                            <p>Encuentra pasantías y oportunidades laborales en tu área de estudio.</p>
                        </span>
                        <span class="miniDesc">
                            <img src="<?php echo asset('images/comunidad.png'); ?>" alt="Icono de comunidad" draggable="false">
                            <p>Forma una comunidad con gente de tu rubro, sean estudiantes, egresados o empresas.</p>
                        </span>
                    </div>
                    <div class="miniDescFlex2">
                        <span class="miniDesc">
                            <img src="<?php echo asset('images/empresas.png'); ?>" alt="Icono de empresas" draggable="false">
                            <p>Encuentra a egresados y envía pasantías y oportunidades de forma fácil y rápida.</p>
                        </span>
                        <span class="miniDesc">
                            <img src="<?php echo asset('images/curriculumVitae.png'); ?>" alt="Icono de currículum" draggable="false">
                            <p>Fácil gestión de currículums, posts y perfiles para agilizar tu experiencia.</p>
                        </span>
                    </div>
                </div>
            </section>

            <footer class="footerPagina"><b>Thinkgear</b> &copy; 2025. <br> Todos los derechos reservados.</footer>
        </div>
        <div class="pagina">
            <div class="fondoPagina">
                <span class="imagotipo">
                    <img class="isotipo" src="<?php echo asset('images/ConectaUTU.svg'); ?>" draggable="false" alt="Isotipo de ConectaUTU">
                    <h1 class="logotipo">ConectaUTU</h1>
                </span>
                <span class="contenido1">
                    <p>Para continuar, Inicie sesión o regístrese para continuar:</p>
                    <br>
                    <p><i>¿Eres una empresa? <a href="/empresas/login">Haz click aquí.</a></i></p>
                </span>
                <span class="botones">
                    <a class="boton" href="/login" id="redirigirInicioSesion">Iniciar Sesión</a>
                    <a class="boton" href="/registro" id="redirigirRegistro">Registrarse</a>
                </span>
            </div>
        </div>
    </div>

    <script src="<?php echo asset('js/botones.js'); ?>"></script>
    <script src="<?php echo asset('js/advertencia.js'); ?>"></script>
</body>
</html>
