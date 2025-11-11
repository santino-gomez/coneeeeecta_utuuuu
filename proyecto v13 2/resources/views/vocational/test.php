<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test vocacional - ConectaUTU</title>
    <link rel="stylesheet" href="<?php echo asset('css/profile.css'); ?>">
    <style>
        .test { background: rgba(15, 23, 42, 0.85); padding: 2.5rem; border-radius: 22px; box-shadow: 0 25px 50px rgba(15, 23, 42, 0.5); }
        .test__questions { display: grid; gap: 1.5rem; margin-top: 1.5rem; }
        .test__questions label { display: block; }
        .test__question { background: rgba(15, 23, 42, 0.95); padding: 1.25rem 1.5rem; border-radius: 16px; border: 1px solid rgba(148, 163, 184, 0.25); }
        .test__question header { font-weight: 600; margin-bottom: 0.75rem; }
        .test__question select { width: 100%; padding: 0.65rem 0.75rem; border-radius: 12px; border: 1px solid rgba(148, 163, 184, 0.35); background: rgba(15, 23, 42, 0.85); color: #f8fafc; }
        .test__submit { margin-top: 2rem; padding: 0.9rem 1.5rem; border-radius: 14px; border: none; background: linear-gradient(135deg, #38bdf8, #6366f1); color: #0f172a; font-weight: 700; cursor: pointer; }
    </style>
</head>
<body>
    <main class="profile">
        <header class="profile__header">
            <h1>Test vocacional RIASEC</h1>
            <p>Evalúa tus intereses para recibir recomendaciones personalizadas.</p>
        </header>
        <section class="test">
            <form method="POST" action="/vocacional">
                <div class="test__questions">
                    <?php
                        $questions = [
                            'R1' => 'Disfruto construyendo o reparando objetos manualmente.',
                            'I1' => 'Me interesa investigar cómo funcionan las cosas.',
                            'A1' => 'Prefiero actividades creativas como el diseño o la música.',
                            'S1' => 'Me motiva ayudar a otras personas a aprender.',
                            'E1' => 'Me veo liderando proyectos o emprendimientos.',
                            'C1' => 'Me gusta organizar información y seguir procesos claros.',
                            'R2' => 'Prefiero trabajar con herramientas o maquinaria.',
                            'I2' => 'Me gusta analizar datos para resolver problemas.',
                            'A2' => 'Disfruto expresarme a través de medios visuales o escritos.',
                            'S2' => 'Me siento cómodo trabajando en equipo y colaborando.',
                            'E2' => 'Disfruto convencer a otros con mis ideas.',
                            'C2' => 'Me gusta mantener registros y documentación ordenada.',
                        ];
                        foreach ($questions as $code => $text): ?>
                        <div class="test__question">
                            <header><?php echo htmlspecialchars($text, ENT_QUOTES, 'UTF-8'); ?></header>
                            <label>Tu nivel de afinidad
                                <select name="<?php echo $code; ?>" required>
                                    <option value="5">Muy alta</option>
                                    <option value="4">Alta</option>
                                    <option value="3">Media</option>
                                    <option value="2">Baja</option>
                                    <option value="1">Muy baja</option>
                                </select>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button class="test__submit" type="submit">Obtener recomendaciones</button>
            </form>
        </section>
    </main>
</body>
</html>
