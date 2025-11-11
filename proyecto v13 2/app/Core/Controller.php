<?php

declare(strict_types=1);

namespace App\Core;

abstract class Controller
{
    protected function view(string $view, array $data = []): Response
    {
        return view($view, $data);
    }

    protected function json(array $data, int $status = 200, array $headers = []): Response
    {
        return json($data, $status, $headers);
    }

    protected function redirect(string $url, int $status = 302): Response
    {
        return Response::redirect($url, $status);
    }
}
