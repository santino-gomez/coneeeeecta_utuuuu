<?php
/** @var string|null $error */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión - ConectaUTU</title>
    <link rel="stylesheet" href="<?php echo asset('css/auth.css'); ?>">
</head>
<body class="auth">
    <main class="auth__container">
        <header class="auth__header">
            <img src="<?php echo asset('images/ConectaUTU.svg'); ?>" alt="ConectaUTU">
            <h1>ConectaUTU</h1>
            <p>Inicia sesión con tu correo o cédula UTU para acceder a la comunidad.</p>
        </header>
        <?php if (!empty($error)): ?>
            <div class="auth__alert"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>
        <form class="auth__form" method="POST" action="/login">
            <label for="email_usuario">Correo o cédula</label>
            <input type="text" id="email_usuario" name="email_usuario" placeholder="correo@ejemplo.com" required>

            <label for="clave_usuario">Contraseña</label>
            <input type="password" id="clave_usuario" name="clave_usuario" placeholder="********" required>

            <button type="submit">Ingresar</button>
        </form>
        <footer class="auth__footer">
            <p>¿No tienes cuenta? <a href="/registro">Regístrate aquí</a></p>
        </footer>
    </main>
</body>
</html>
