<?php
http_response_code(404);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página no encontrada</title>
    <link rel="stylesheet" href="<?php echo asset('css/index.css'); ?>">
    <style>
        body { font-family: 'Montserrat', sans-serif; display: flex; align-items: center; justify-content: center; min-height: 100vh; background-color: #0f172a; color: #fff; margin: 0; }
        .error-card { text-align: center; padding: 2rem 3rem; background: rgba(15, 23, 42, 0.85); border-radius: 16px; box-shadow: 0 10px 40px rgba(15, 23, 42, 0.6); }
        h1 { font-size: 3rem; margin-bottom: 0.5rem; }
        p { margin-bottom: 1.5rem; }
        a { color: #38bdf8; text-decoration: none; font-weight: 600; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="error-card">
        <h1>404</h1>
        <p>No encontramos la ruta <strong><?php echo htmlspecialchars($path ?? '', ENT_QUOTES, 'UTF-8'); ?></strong>.</p>
        <p><a href="/">Volver al inicio</a></p>
    </div>
</body>
</html>
