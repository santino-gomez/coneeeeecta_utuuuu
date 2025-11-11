<!DOCTYPE html>
<?php 
$error = htmlspecialchars($_GET['error'] ?? '');
if ($error): 
?>
    <div style="color: red; border: 1px solid red; padding: 10px;">
        Error de Registro: <?= urldecode($error) ?>
    </div>
<?php endif; ?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ConectaUTU - Registrarse</title>
    <link rel="stylesheet" href="../../public/css/registroLogin.css">
    <link rel="icon" href="../../public/images/ConectaUTU.svg">
</head>
<body>
    <br>

    <div class="pagina">
        <?php 
            require 'shared/imagotipo.php';
        ?>  

        <?php
            require 'formRegistro.php';
        ?>
    </div>

    <script src="../../public/js/limite.js"></script>
    <script src="../../public/js/mostrarClave.js"></script> 
    <script src="../../public/js/advertencia.js"></script> 
</body>
</html>