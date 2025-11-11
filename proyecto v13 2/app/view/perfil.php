<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/profile-view.css"/>
    <link rel="icon" href="images/ConectaUTU.svg" type="image/x-icon">
    <title>ConectaUTU - Perfi</title>
</head>
<body>
    <div>
        <?php
            require '../controller/php/header.php'; 
        ?>

        <?php
            require '../controller/php/panelHeader.php'; 
        ?>

        <main class="perfilWrap">
            <div class="perfilBanner" style="background-image: url('images/channels4_banner.jpg');"></div>

            <section class="perfilCard">
                <div class="perfilHead">
                    <img id="viewAvatar" class="perfilAvatar" alt="Avatar del usuario">

                    <div>
                        <h2 id="viewName" class="perfilName">Nombre Apellido</h2>
                        <p id="viewUser" class="perfilUser">@usuario</p>
                        <div id="viewTags" class="chips"> </div>
                    </div>

                    <a href="edperfil.html" class="btnEdit">Editar perfil</a>
                </div>
            </section>
        </main>
    </div>

    <script src="script.js"></script>
    <script src="js/advertencia.js"></script>
</body>
</html>