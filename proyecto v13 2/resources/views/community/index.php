<?php
/** @var array $posts */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comunidad - ConectaUTU</title>
    <link rel="stylesheet" href="<?php echo asset('css/profile.css'); ?>">
    <style>
        .community__form { margin-bottom: 2rem; background: rgba(15, 23, 42, 0.85); padding: 2rem; border-radius: 20px; box-shadow: 0 15px 35px rgba(15, 23, 42, 0.45); }
        .community__form textarea { width: 100%; min-height: 120px; border-radius: 14px; border: 1px solid rgba(148, 163, 184, 0.35); background: rgba(15, 23, 42, 0.9); color: #f8fafc; padding: 1rem; }
        .community__form button { margin-top: 1rem; padding: 0.8rem 1.4rem; border-radius: 12px; border: none; background: linear-gradient(135deg, #38bdf8, #6366f1); color: #0f172a; font-weight: 700; cursor: pointer; }
        .community__post { background: rgba(15, 23, 42, 0.9); padding: 1.75rem; border-radius: 18px; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.4); margin-bottom: 1.5rem; }
        .community__post h2 { margin: 0 0 0.5rem; }
        .community__post footer { margin-top: 1rem; font-size: 0.85rem; color: #cbd5f5; }
    </style>
</head>
<body>
    <main class="profile">
        <header class="profile__header">
            <h1>Espacio comunitario</h1>
            <p>Comparte novedades, recursos y oportunidades con la red UTU.</p>
        </header>
        <section class="community__form">
            <form method="POST" action="/comunidad">
                <label>Título
                    <input type="text" name="titulo_post" required placeholder="Comparte un logro o recurso">
                </label>
                <label>Contenido
                    <textarea name="contenido" required placeholder="Escribe tu mensaje para la comunidad"></textarea>
                </label>
                <button type="submit">Publicar</button>
            </form>
        </section>
        <section>
            <?php foreach ($posts as $post): ?>
                <article class="community__post">
                    <h2><?php echo htmlspecialchars($post['titulo_post'] ?? 'Publicación', ENT_QUOTES, 'UTF-8'); ?></h2>
                    <p><?php echo nl2br(htmlspecialchars($post['contenido'] ?? '', ENT_QUOTES, 'UTF-8')); ?></p>
                    <footer>
                        Publicado por <?php echo htmlspecialchars(($post['nombre_usuario'] ?? '') . ' ' . ($post['apellido_usuario'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>
                        el <?php echo htmlspecialchars(date('d/m/Y', strtotime($post['fecha_publicacion'] ?? 'now')), ENT_QUOTES, 'UTF-8'); ?>
                    </footer>
                </article>
            <?php endforeach; ?>
            <?php if (empty($posts)): ?>
                <p>Aún no hay publicaciones. ¡Sé el primero en compartir!</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
