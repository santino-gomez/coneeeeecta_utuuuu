<?php
    $mensajeEliminadoTitulo = "[Contenido no disponible]";
    $mensajeEliminadoDesc = " | <i>Este post ha sido eliminado debido a un incumplimiento de las normas de la página.</i>";
?>

<section class="forosPost">
    <div class="flexPost">
        <div class="usuarioPost">
            <?php
            if (empty($pfpUsuario)) {
                $pfpUsuario = '../../public/images/noPfp.png';
            }
            if (empty($foroPostDesc)) { 
                $foroPostDesc = " | <i>No se ha especificado ninguna información adicional a este post.</i>";
            }
            if (empty($foroPostImagen)) {
                //ocultar la etiqueta img si no hay imagen
                $foroPostImagen = "../../public/images/noImage.png";
            }
            ?>
            
            <img src="<?php echo $pfpUsuario; ?>" alt="Foto de perfil de <?php echo $foroNombreUsuario; ?>">
            
            <span class="alinearUser">
                <h4><?php echo $foroNombreUsuario; ?></h4>
            </span>
        </div>

        <div class="infoPost">
            <h2><?php echo $foroPostTitulo; ?></h2>
            <p><?php echo $foroPostDesc; ?></p>
            <div class="postImagenes">
                <img src="<?php echo $foroPostImagen; ?>" alt="Imagen del post">
            </div>
        </div>

        <?php
            require '../view/components/postBotones.php';
        ?>
    </div>

    <div class="votosPost">
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-up colorAzul" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5"/>
            </svg>
        </div>

        <p id="postPuntaje"> <?php echo $foroPuntajePost; ?> </p>

        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-down colorRojo" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1"/>
            </svg>
        </div>
    </div>
</section>