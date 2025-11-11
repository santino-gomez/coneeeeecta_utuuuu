<?php

declare(strict_types=1);

namespace App\Core;

class Application
{
    public function __construct(private readonly Router $router)
    {
    }

    public function handle(Request $request): Response
    {
        return $this->router->dispatch($request);
    }
}
