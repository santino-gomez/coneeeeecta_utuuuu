<php
    require_once '../controller/php/lang/idiomasInitConfig.php';
?>

<!DOCTYPE html>
<html lang="<?php echo $current_lang; ?>"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ConectaUTU — Editar perfil</title>
    <link rel="icon" href="images/ConectaUTU.svg"> 

    <!-- estilos globales que ya tenés -->
    <link rel="stylesheet" href="home.css">
    <!-- estilos de esta página -->
     <link rel="stylesheet" href="edperfil.css">
</head>
<body>
    <?php 
        require '../controller/php/header.php';
    ?>

    <!-- HEADER / NAV (los mismisimios) -->
    <header class="header">
        <div class="headerIzquierda" style="position: relative;">
            <a href="perfil.html" class="antiAStyle" title="Volver a mi perfil" style="display:inline-flex;align-items:center;gap:8px;">
                <svg class="headerIcono" xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                    <path d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/>
                </svg>
                <span><?php echo $lang['go_back']; ?></span>
            </a>
        </div>

        <div class="headerCentro">
          <img class="logoHeader" src="images/ConectaUTU.svg" alt="ConectaUTU Logo">
          <h1>ConectaUTU</h1>
        </div>

        <div class="headerDerecha"></div>
        <?php 
            // Incluimos el archivo que contiene la función para generar el botón de cambio de idioma
            include_once '../controller/php/cambiaIdioma.php'; 

            // Generamos y mostramos el botón de cambio de idioma
            echo $generarBotonCambioIdioma($default_lang, $valid_langs);
        ?>
    </header>

    <nav class="paneles">
        <h4><a class="antiAStyle" href="pasantias.html"><?php echo $lang['nav_interships']; ?></a></h4>
        <h4><a class="antiAStyle" href="comunitario.html"><?php echo $lang['nav_comunnity']; ?></a></h4>
        <h4><a class="antiAStyle" href="llamados.html"><?php echo $lang['nav_calls']; ?></a></h4> 
    </nav>

    <!-- CONTENIDO: Editor de perfil (usa los mismos IDs que js cosa de que los valores se cambien y etc) -->
    <main class="editorWrap">
        <!-- Vista previa de la parte de arriba -->
        <section class="card section">
            <h3 class="title"><?php echo $lang['nav_preview']; ?></h3>
                <div class="preview">
                    <img id="previewAvatar" class="avatar" alt="" />
                    <div>
                        <h1 id="previewName" class="h1">
                            <?php echo $lang['label_fullname']; ?>
                        </h1>
                        <p id="previewUser" class="muted" style="margin:0 0 12px">
                            <?php echo $lang['@contact']; ?>
                        </p> 
                        
                        <div class="divider"></div>
                        
                        <h2 class="h2" style="margin:0 0 8px"><?php echo $lang['label_biography']; ?></h2>
            <p id="previewBio" class="bio muted"><?php echo $lang['label_description']; ?></p>
            <div class="divider"></div>
            <h2 class="h2" style="margin:0 8px 8px 0;display:inline-block">Tags</h2>
            <div id="previewChips" class="chips" aria-live="polite"></div>
            <div class="divider"></div>
            <p class="muted" style="margin:0"><?php echo $lang['contact']; ?> <span id="previewEmail">"<?php echo $lang['placeholder_email']; ?>"</span></p>
          </div>
        </div>
    </section>

    <!-- Formulario de edición -->
    <section class="card section">
        <h3 class="title"><?php echo $lang['label_edit_profile']; ?></h3>

    <!-- inicio de formulario es basicamente todos los campos que se ven -->
            <form id="profileForm" autocomplete="off">
          <div class="form-row"> 
            <div>
              <label for="name"><?php echo $lang['label_fullname2']; ?></label>
              <input id="name" name="name" type="text" placeholder="<?php echo $lang['placeholder_ur_name']; ?>" required />
                    </div>
                    <div>
                        <label for="username"><?php echo $lang['label_user']; ?></label>
                        <input id="username" name="username" type="text" placeholder="<?php echo $lang['placeholder_user']; ?>" />
                    </div>
                </div>

                <div class="form-row">
                    <div>
                        <label for="email"><?php echo $lang['mail']; ?></label> 
                        <input id="email" name="email" type="email" placeholder="<?php echo $lang['placeholder_email']; ?>" />
                    </div>
                <div>
                    <label for="avatar"><?php echo $lang['label_photo_profile']; ?></label>
                    <input id="avatar" name="avatar" type="file" accept="image/*" />

                    <div class="hint"><?php echo $lang['description_photo_profile']; ?></div>

                    </div>
                </div>

                <label for="bio"><?php echo $lang['label_biography']; ?></label>
                <textarea id="bio" name="bio" placeholder="<?php echo $lang['write_bio']; ?>"></textarea> 

                <label><?php echo $lang['tags_interests']; ?></label>

                <div id="tagsBox" class="tags-input">
                    <input id="tagInput" type="text" placeholder="<?php echo $lang['write_tag']; ?>"/> 
                </div>
          
                <div class="hint"><?php echo $lang['agree_and_delete']; ?></div>

                <div class="toolbar">
                    <button type="button" class="btn secondary" id="btnReset"><?php echo $lang['restore_button']; ?></button>
                    <button type="submit" class="btn primary"><?php echo $lang['save_button']; ?></button>
                </div>
            </form>
        </section>
    </main>

  <script>
    // Usamos json_encode para convertir el array $lang de PHP en un objeto JSON que JavaScript pueda leer.
    const LANG = <?php echo json_encode($lang); ?>;
</script>
  <script src="script.js"></script>
  <script src="js/advertencia.js"></script>
</body>
</html>