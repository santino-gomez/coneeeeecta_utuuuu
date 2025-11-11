<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - ConectaUTU</title>
    <link rel="stylesheet" href="<?php echo asset('css/auth.css'); ?>">
</head>
<body class="auth">
    <main class="auth__container">
        <header class="auth__header">
            <img src="<?php echo asset('images/ConectaUTU.svg'); ?>" alt="ConectaUTU">
            <h1>Crea tu cuenta</h1>
            <p>Completa tus datos para acceder a oportunidades y a la comunidad UTU.</p>
        </header>
        <form class="auth__form" method="POST" action="/registro">
            <label for="nombre_usuario">Nombre</label>
            <input type="text" id="nombre_usuario" name="nombre_usuario" required>

            <label for="apellido_usuario">Apellido</label>
            <input type="text" id="apellido_usuario" name="apellido_usuario" required>

            <label for="email_usuario">Correo institucional</label>
            <input type="email" id="email_usuario" name="email_usuario" required>

            <label for="cedula_usuario">Cédula</label>
            <input type="text" id="cedula_usuario" name="cedula_usuario" maxlength="8" required>

            <label for="fecha_nacimiento">Fecha de nacimiento</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>

            <label for="rol_principal">Perfil principal</label>
            <select id="rol_principal" name="rol_principal">
                <option value="estudiante">Estudiante</option>
                <option value="egresado">Egresado</option>
                <option value="empresa">Empresa</option>
            </select>

            <label for="clave_usuario">Contraseña</label>
            <input type="password" id="clave_usuario" name="clave_usuario" required>

            <button type="submit">Crear cuenta</button>
        </form>
        <footer class="auth__footer">
            <p>¿Ya tienes cuenta? <a href="/login">Inicia sesión</a></p>
        </footer>
    </main>
</body>
</html>
