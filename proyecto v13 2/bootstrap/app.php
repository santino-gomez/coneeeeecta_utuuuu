<?php

declare(strict_types=1);

use App\Core\Application;
use App\Core\Router;
use App\Support\EnvLoader;

EnvLoader::load(dirname(__DIR__));

$router = new Router();

require dirname(__DIR__) . '/routes/web.php';

return new Application($router);
