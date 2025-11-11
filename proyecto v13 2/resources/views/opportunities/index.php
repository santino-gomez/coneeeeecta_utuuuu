<?php
/** @var array $opportunities */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oportunidades - ConectaUTU</title>
    <link rel="stylesheet" href="<?php echo asset('css/profile.css'); ?>">
    <style>
        .filters { display: flex; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem; }
        .opportunities { display: grid; gap: 1.5rem; }
        .opportunity { background: rgba(15, 23, 42, 0.9); padding: 1.75rem; border-radius: 18px; box-shadow: 0 15px 35px rgba(15, 23, 42, 0.45); }
        .opportunity h2 { margin-top: 0; }
        .opportunity footer { margin-top: 1rem; display: flex; justify-content: space-between; align-items: center; }
        .badge { display: inline-flex; align-items: center; padding: 0.35rem 0.75rem; border-radius: 999px; font-size: 0.85rem; background: rgba(56, 189, 248, 0.15); color: #38bdf8; }
        form.filters label { display: flex; flex-direction: column; font-weight: 600; }
        form.filters select, form.filters input { margin-top: 0.35rem; padding: 0.65rem 0.75rem; border-radius: 10px; border: 1px solid rgba(148, 163, 184, 0.35); background: rgba(15, 23, 42, 0.85); color: #f8fafc; }
        form.filters button { padding: 0.75rem 1.15rem; border-radius: 12px; border: none; background: linear-gradient(135deg, #38bdf8, #6366f1); color: #0f172a; font-weight: 700; cursor: pointer; }
    </style>
</head>
<body>
    <main class="profile">
        <header class="profile__header">
            <h1>Oportunidades UTU</h1>
            <p>Filtra pasantías, llamados y ofertas según tus intereses.</p>
        </header>
        <section class="profile__card">
            <form class="filters" method="GET" action="/oportunidades">
                <label>Modalidad
                    <select name="modalidad">
                        <option value="">Todas</option>
                        <option value="presencial">Presencial</option>
                        <option value="virtual">Virtual</option>
                        <option value="hibrido">Híbrido</option>
                    </select>
                </label>
                <label>Perfil objetivo
                    <select name="es_para_egresado">
                        <option value="">Todos</option>
                        <option value="0">Estudiantes</option>
                        <option value="1">Egresados</option>
                    </select>
                </label>
                <label>Tags
                    <input type="text" name="tags" placeholder="Tecnología, Educación">
                </label>
                <button type="submit">Aplicar filtros</button>
            </form>
            <div class="opportunities">
                <?php foreach ($opportunities as $opportunity): ?>
                    <article class="opportunity">
                        <header>
                            <div class="badge"><?php echo htmlspecialchars($opportunity['nombre_empresa'] ?? '', ENT_QUOTES, 'UTF-8'); ?></div>
                            <h2><?php echo htmlspecialchars($opportunity['titulo_oferta'] ?? 'Oferta', ENT_QUOTES, 'UTF-8'); ?></h2>
                        </header>
                        <p><?php echo nl2br(htmlspecialchars($opportunity['descripcion_oferta'] ?? 'Descripción pendiente.', ENT_QUOTES, 'UTF-8')); ?></p>
                        <footer>
                            <span><?php echo htmlspecialchars($opportunity['modalidad'] ?? 'presencial', ENT_QUOTES, 'UTF-8'); ?></span>
                            <a class="profile__link" href="/ofertas/<?php echo (int) ($opportunity['id_oferta'] ?? 0); ?>">Ver detalle</a>
                        </footer>
                    </article>
                <?php endforeach; ?>
                <?php if (empty($opportunities)): ?>
                    <p>No encontramos oportunidades con los filtros seleccionados.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>
</body>
</html>
