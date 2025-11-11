<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="home.css" />
<link rel="stylesheet" href="profile-view.css" />
<link rel="icon" href="images/ConectaUTU.svg" type="image/x-icon" />
<title>ConectaUTU - Perfil</title>
</head>
<body>
    <div>
        <header class="header">
            <div class="headerIzquierda" style="position: relative;">
                <svg id="headerUsuario" class="headerIcono bi bi-person" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" viewBox="0 0 16 16" role="button" aria-label="Abrir menú de usuario" tabindex="0">
                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                </svg>

                <div id="panelUsuario" class="usuarioContenido" aria-hidden="true">
                <p><a href="profile-editor.html" class="antiAStyle">Editar perfil</a></p>
                <p><a href="#" class="antiAStyle">Modo oscuro</a></p>
                <p><a href="portafolio.html" class="antiAStyle">Portafolio</a></p>
                <p><a href="centro_gestion.html" class="antiAStyle">Centro de gestión</a></p>
                <hr style="border:0;height:1px;background:#0e0e0e40;margin:8px 0;">
                <p><a href="logout.php" class="antiAStyle">Cerrar sesión</a></p>
                <p><a href="registrarse.html" class="antiAStyle">Registrar usuario</a></p>
                <p><a href="index.html" class="antiAStyle">Iniciar sesión</a></p>
                </div>

                <svg id="headerBusqueda" class="headerIcono bi bi-search" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" viewBox="0 0 16 16" role="button" aria-label="Buscar">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                </svg>
            </div>

            <div class="headerCentro">
                <img class="logoHeader" src="images/ConectaUTU.svg" alt="ConectaUTU Logo" />
                <h1>ConectaUTU</h1>
            </div>

            <div class="headerDerecha">
                <div class="crearHeader">
                <p class="siResponsivo">+</p>
                <p class="responsivoSiONo">Crear</p>
                </div>

                <div class="notificaciones">
                <svg onclick="clickFunction && clickFunction()" id="headerCampana" class="headerIcono bi bi-bell" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" viewBox="0 0 16 16" role="button" aria-label="Notificaciones">
                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6"/>
                </svg>
                </div>
            </div>
        </header>

        <nav class="paneles">
            <h4><a class="antiAStyle" href="pasantias.html">PASANTÍAS</a></h4>
            <h4><a class="antiAStyle" href="comunitario.html">COMUNITARIO</a></h4>
            <h4><b>LLAMADOS</b></h4>
        </nav>

        <!-- ======= CONTENIDO PERFIL ======= -->
        <main class="perfilWrap">

        <!-- ===== BANNER del perfl ===== -->
        <div class="perfilBanner" style="background-image: url('images/channels4_banner.jpg');"></div>

        <!-- ===== PERFIL DEL USUARIO ===== -->
        <section class="perfilCard">
            <div class="perfilHead">
                <img id="viewAvatar" class="perfilAvatar" alt="Avatar del usuario" />
            
                <div>
                    <h2 id="viewName" class="perfilName">Nombre Apellido</h2>
                    <p id="viewUser" class="perfilUser">@usuario</p>
                    <div id="viewTags" class="chips"> </div>
                </div>

            <a href="edperfil.html" class="btnEdit">Editar perfil</a>
            
            </div>

            <div class="perfilBody">
                <div class="perfilBlock">
                    <h3>Biografía</h3>
                    <p id="viewBio" class="bio">Sin biografía todavía.</p>
                </div>

                <div class="perfilBlock">
                    <h3>Contacto</h3>
                    <p>Email: <span id="viewEmail">correo@ejemplo.com</span></p>
                </div>
            </div>
        </section>

        <!-- ===== PUBLICACIONES ===== -->
        <section class="perfilPosts">
            <h2>Publicaciones</h2>
            <div id="postsContainer"></div>
        </section>
        </main>
    </div>

    <script src="script.js"></script>
    <script src="js/advertencia.js"></script>
</body>
</html>