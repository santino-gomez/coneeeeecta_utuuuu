<php
    require_once '../app/utilities/lang/idiomasInitConfig.php';
?>

<!DOCTYPE html>
<html lang="<?php echo $current_lang; ?>"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ConectaUTU — Editar perfil</title>
    <link rel="icon" href="images/ConectaUTU.svg">
    <!-- estilos globales que ya tenés -->
    <link rel="stylesheet" href="css/home.css">
    <!-- estilos de esta página -->
    <link rel="stylesheet" href="edperfil.css">
</head>
<body>
    <?php 
        require 'shared/header.php';
    ?>

    <?php
        require 'shared/panelHeader.php'; 
    ?>

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