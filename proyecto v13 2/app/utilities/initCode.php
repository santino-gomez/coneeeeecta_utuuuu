<?php
// Archivo: app/utilities/initCode.php

    // Si quieres usar cookies para el idioma, déjalo aquí
    setcookie('modoOscuro', 'false');
    // setcookie('lang', 'es'); // Quita esta línea si quieres que idiomasInitConfig maneje la sesión primero
    
    // 1. Incluye el script de configuración que resuelve el idioma (URL/Sesión)
    // La ruta es correcta (estando en utilities/ y el archivo en utilities/lang/)
    require_once __DIR__ . '/lang/idiomasInitConfig.php'; 

    // 2. Eliminar la lógica duplicada y errónea de abajo, ya que idiomasInitConfig.php ya hizo el trabajo
    // (Eliminar $lang, $files, $includePath, y todo el bloque if/else siguiente)
    
?>