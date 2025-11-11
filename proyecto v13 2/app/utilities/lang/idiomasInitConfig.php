<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // 2. DETERMINACIÓN DEL IDIOMA

    $default_lang = 'en'; 
    $current_lang = $default_lang;
    $valid_langs = ['es', 'en'];

    // Prioridad 1: Idioma en la URL
    if (isset($_GET['lang']) && in_array($_GET['lang'], $valid_langs)) {
            $current_lang = $_GET['lang'];
            $_SESSION['user_lang'] = $current_lang;
    }
    // Prioridad 2: Idioma guardado en la Sesión
    elseif (isset($_SESSION['user_lang']) && in_array($_SESSION['user_lang'], $valid_langs)) {
            $current_lang = $_SESSION['user_lang'];
    }

    // 3. CARGA DEL DICCIONARIO (Ruta Corregida)

    $root_dir = dirname(__DIR__);
    $lang_path_base = $root_dir . DIRECTORY_SEPARATOR . 'lang' . DIRECTORY_SEPARATOR;

    $lang_file = $lang_path_base . $current_lang . '.php';

    if (file_exists($lang_file)) {
        // Si la ruta es válida, cargamos el array $lang
        include_once $lang_file; 
    } else {
        // Fallback: Cargamos el idioma por defecto con la ruta correcta
        $default_file = $lang_path_base . $default_lang . '.php';
        include_once $default_file;
        $current_lang = $default_lang; // Aseguramos la coherencia de la variable
    }
?>