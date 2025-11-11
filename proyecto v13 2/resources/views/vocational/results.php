<?php
/** @var array $results */
$suggestions = $results['suggestions'] ?? [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados - Test vocacional</title>
    <link rel="stylesheet" href="<?php echo asset('css/profile.css'); ?>">
    <style>
        .vocational__summary { display: grid; gap: 1.5rem; }
        .vocational__card { background: rgba(15, 23, 42, 0.9); padding: 1.75rem; border-radius: 18px; box-shadow: 0 20px 40px rgba(15, 23, 42, 0.45); }
        .vocational__card h2 { margin-top: 0; }
    </style>
</head>
<body>
    <main class="profile">
        <header class="profile__header">
            <h1>Áreas sugeridas</h1>
            <p>Explora caminos formativos y laborales alineados a tus intereses.</p>
        </header>
        <section class="profile__card">
            <div class="vocational__summary">
                <?php foreach ($suggestions as $code => $data): ?>
                    <article class="vocational__card">
                        <h2><?php echo htmlspecialchars($data['area'] ?? $code, ENT_QUOTES, 'UTF-8'); ?></h2>
                        <p>Posibles caminos de formación y empleo:</p>
                        <ul>
                            <?php foreach (($data['careers'] ?? []) as $career): ?>
                                <li><?php echo htmlspecialchars($career, ENT_QUOTES, 'UTF-8'); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </article>
                <?php endforeach; ?>
            </div>
            <div class="profile__actions">
                <a class="profile__link" href="/perfil/editar">Volver al perfil</a>
                <a class="profile__link" href="/oportunidades">Buscar oportunidades afines</a>
            </div>
        </section>
    </main>
</body>
</html>
