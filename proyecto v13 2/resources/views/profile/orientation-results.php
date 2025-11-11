<?php
/** @var array $results */
$scores = $results['scores'] ?? [];
$suggestions = $results['suggestions'] ?? [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados vocacionales - ConectaUTU</title>
    <link rel="stylesheet" href="<?php echo asset('css/profile.css'); ?>">
    <style>
        .results { margin-top: 2rem; display: grid; gap: 1.5rem; }
        .results__card { background: rgba(15, 23, 42, 0.9); padding: 1.5rem; border-radius: 16px; box-shadow: 0 10px 25px rgba(15, 23, 42, 0.5); }
        .results__card h2 { margin-top: 0; }
        .results__list { list-style: none; padding: 0; margin: 0; }
        .results__list li { margin-bottom: 0.5rem; }
    </style>
</head>
<body>
    <main class="profile">
        <header class="profile__header">
            <h1>Resultados del test vocacional</h1>
            <p>Estas recomendaciones se basan en tus respuestas al perfil de intereses RIASEC.</p>
        </header>
        <section class="profile__card">
            <h2>Puntajes por dimensión</h2>
            <ul class="results__list">
                <?php foreach ($scores as $code => $score): ?>
                    <li><strong><?php echo htmlspecialchars($code, ENT_QUOTES, 'UTF-8'); ?>:</strong> <?php echo (int) $score; ?></li>
                <?php endforeach; ?>
            </ul>
            <div class="results">
                <?php foreach ($suggestions as $code => $item): ?>
                    <article class="results__card">
                        <h2><?php echo htmlspecialchars($item['area'] ?? $code, ENT_QUOTES, 'UTF-8'); ?></h2>
                        <p>Explora estas áreas sugeridas:</p>
                        <ul>
                            <?php foreach (($item['careers'] ?? []) as $career): ?>
                                <li><?php echo htmlspecialchars($career, ENT_QUOTES, 'UTF-8'); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </article>
                <?php endforeach; ?>
            </div>
            <div class="profile__actions">
                <a class="profile__link" href="/perfil/editar">Volver al perfil</a>
                <a class="profile__link" href="/oportunidades?modalidad=virtual">Ver oportunidades recomendadas</a>
            </div>
        </section>
    </main>
</body>
</html>
