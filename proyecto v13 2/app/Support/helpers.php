<?php

declare(strict_types=1);

use App\Core\Response;
use App\Core\View;

if (!function_exists('base_path')) {
    function base_path(string $path = ''): string
    {
        $base = dirname(__DIR__, 1);
        return $path === '' ? $base : $base . DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR);
    }
}

if (!function_exists('config_path')) {
    function config_path(string $path = ''): string
    {
        $configDir = base_path('config');
        return $path === '' ? $configDir : $configDir . DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR);
    }
}

if (!function_exists('resource_path')) {
    function resource_path(string $path = ''): string
    {
        $resourceDir = base_path('resources');
        return $path === '' ? $resourceDir : $resourceDir . DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR);
    }
}

if (!function_exists('storage_path')) {
    function storage_path(string $path = ''): string
    {
        $storageDir = base_path('storage');
        if (!is_dir($storageDir)) {
            mkdir($storageDir, 0775, true);
        }

        return $path === '' ? $storageDir : $storageDir . DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR);
    }
}

if (!function_exists('env')) {
    function env(string $key, mixed $default = null): mixed
    {
        $value = $_ENV[$key] ?? $_SERVER[$key] ?? null;
        if ($value === null) {
            return $default;
        }

        $lower = strtolower($value);
        return match ($lower) {
            'true', '(true)' => true,
            'false', '(false)' => false,
            'empty', '(empty)' => '',
            'null', '(null)' => null,
            default => $value,
        };
    }
}

if (!function_exists('asset')) {
    function asset(string $path): string
    {
        $path = ltrim($path, '/');
        return '/' . $path;
    }
}

if (!function_exists('view')) {
    function view(string $view, array $data = []): Response
    {
        return Response::html(View::render($view, $data));
    }
}

if (!function_exists('json')) {
    function json(array $data, int $status = 200, array $headers = []): Response
    {
        return Response::json($data, $status, $headers);
    }
}
