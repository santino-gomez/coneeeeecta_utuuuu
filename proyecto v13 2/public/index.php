<?php

declare(strict_types=1);

use App\Core\Request;

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/app/Support/helpers.php';

$app = require dirname(__DIR__) . '/bootstrap/app.php';

$response = $app->handle(Request::capture());
$response->send();
