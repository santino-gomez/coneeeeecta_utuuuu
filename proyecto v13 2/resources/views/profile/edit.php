<?php
/** @var array|null $user */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar perfil - ConectaUTU</title>
    <link rel="stylesheet" href="<?php echo asset('css/profile.css'); ?>">
</head>
<body>
    <main class="profile">
        <header class="profile__header">
            <h1>Perfil personal</h1>
            <p>Actualiza tus datos, intereses y portafolio para destacarte en la comunidad.</p>
        </header>
        <section class="profile__card">
            <form method="POST" action="/perfil">
                <div class="profile__grid">
                    <label>Nombre
                        <input type="text" name="nombre_usuario" value="<?php echo htmlspecialchars($user['nombre_usuario'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                    </label>
                    <label>Apellido
                        <input type="text" name="apellido_usuario" value="<?php echo htmlspecialchars($user['apellido_usuario'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                    </label>
                </div>

                <label>Biografía
                    <textarea name="biografia" rows="4" placeholder="Comparte tu historia profesional"><?php
                        echo htmlspecialchars($user['biografia'] ?? '', ENT_QUOTES, 'UTF-8');
                    ?></textarea>
                </label>

                <label>Habilidades (separadas por coma)
                    <input type="text" name="habilidades" placeholder="Diseño UX, Automatización, Redes">
                </label>

                <label>Intereses (separados por coma)
                    <input type="text" name="tags" placeholder="Tecnología, Energías renovables, Educación">
                </label>

                <label>Portafolio (URLs separados por coma)
                    <input type="text" name="portafolio" placeholder="https://miportafolio.com">
                </label>

                <div class="profile__actions">
                    <button type="submit">Guardar cambios</button>
                    <a class="profile__link" href="/vocacional">Realizar test vocacional</a>
                </div>
            </form>
        </section>
    </main>
</body>
</html>
