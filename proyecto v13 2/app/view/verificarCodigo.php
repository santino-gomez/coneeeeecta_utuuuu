<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ConectaUTU - Iniciar Sesión</title>
    <link rel="stylesheet" href="css/registroLoginDark.css">
    <link rel="icon" href="images/ConectaUTU.svg">
</head>
<body>
    <br>

    <div class="pagina">
        <?php 
            require 'shared/imagotipo.php';
        ?>

        <p>Ingrese el código a continuación:</p>
        <form action="../app/view/verificarCodigo.php" method="POST"> <!--  esto no sé que mierda hace, me lo puso la ia -->
            <input type="text" name="codigo" placeholder="Código" required>
            <button type="submit">Verificar</button>
        </form>
    </div>

    <script src="js/advertencia.js"></script>
</body>
</html>

