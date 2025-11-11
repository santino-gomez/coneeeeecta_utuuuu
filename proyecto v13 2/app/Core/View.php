<?php

declare(strict_types=1);

namespace App\Core;

use RuntimeException;

class View
{
    public static function render(string $view, array $data = []): string
    {
        $viewPath = resource_path('views/' . str_replace('.', '/', $view) . '.php');

        if (!file_exists($viewPath)) {
            throw new RuntimeException("La vista {$view} no existe en {$viewPath}");
        }

        extract($data, EXTR_SKIP);

        ob_start();
        include $viewPath;
        return (string) ob_get_clean();
    }
}
