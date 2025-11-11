<?php

declare(strict_types=1);

use App\Controllers\AuthController;
use App\Controllers\CommunityController;
use App\Controllers\HomeController;
use App\Controllers\OpportunityController;
use App\Controllers\ProfileController;
use App\Controllers\VocationalController;

$router->get('/', [HomeController::class, 'landing']);

// Autenticación
$router->get('/login', [AuthController::class, 'showLogin']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/registro', [AuthController::class, 'showRegister']);
$router->post('/registro', [AuthController::class, 'register']);
$router->post('/logout', [AuthController::class, 'logout']);

// Perfil
$router->get('/perfil', [ProfileController::class, 'edit']);
$router->get('/perfil/editar', [ProfileController::class, 'edit']);
$router->post('/perfil', [ProfileController::class, 'update']);
$router->post('/perfil/orientacion', [ProfileController::class, 'orientationResults']);

// Comunidad
$router->get('/comunidad', [CommunityController::class, 'index']);
$router->post('/comunidad', [CommunityController::class, 'store']);

// Oportunidades
$router->get('/oportunidades', [OpportunityController::class, 'index']);
$router->post('/oportunidades', [OpportunityController::class, 'store']);

// Vocacional
$router->get('/vocacional', [VocationalController::class, 'show']);
$router->post('/vocacional', [VocationalController::class, 'evaluate']);

// Panel general (redirige al perfil por ahora)
$router->get('/panel', [ProfileController::class, 'edit']);
