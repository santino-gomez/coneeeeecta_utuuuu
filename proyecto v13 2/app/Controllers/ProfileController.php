<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Models\User;
use App\Services\VocationalOrientationService;

class ProfileController extends Controller
{
    private User $users;
    private VocationalOrientationService $orientationService;

    public function __construct()
    {
        $this->users = new User();
        $this->orientationService = new VocationalOrientationService();
    }

    public function edit(Request $request)
    {
        $userId = $this->userId();
        if ($userId === null) {
            return $this->redirect('/login');
        }

        $user = $this->users->findById($userId);
        $perfil = [];
        if ($user && !empty($user['perfil_publico_json'])) {
            $decoded = json_decode($user['perfil_publico_json'], true);
            if (is_array($decoded)) {
                $perfil = $decoded;
            }
        }

        return $this->view('profile.edit', [
            'user' => $user,
            'perfil' => $perfil,
        ]);
    }

    public function update(Request $request)
    {
        $userId = $this->userId();
        if ($userId === null) {
            return $this->redirect('/login');
        }

        $habilidades = $this->splitList($request->input('habilidades'));
        $intereses = $this->splitList($request->input('tags'));
        $portafolio = $this->splitList($request->input('portafolio'));

        $payload = [
            'nombre_usuario' => $request->input('nombre_usuario'),
            'apellido_usuario' => $request->input('apellido_usuario'),
            'perfil_publico_json' => json_encode([
                'biografia' => $request->input('biografia'),
                'habilidades' => $habilidades,
                'intereses' => $intereses,
                'portafolio' => $portafolio,
            ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
        ];

        $this->users->updateProfile($userId, $payload);

        if (!empty($intereses)) {
            $this->users->attachInterests($userId, $intereses);
        }

        return $this->redirect('/perfil');
    }

    public function orientationResults(Request $request)
    {
        $userId = $this->userId();
        if ($userId === null) {
            return $this->redirect('/login');
        }

        $answers = $request->input();
        $results = $this->orientationService->evaluate($answers);
        $this->users->storeOrientationResult($userId, $results);

        return $this->view('profile.orientation-results', [
            'results' => $results,
        ]);
    }

    private function splitList(mixed $value): array
    {
        if (is_array($value)) {
            return array_values(array_filter(array_map(fn ($item) => trim((string) $item), $value)));
        }

        if (is_string($value)) {
            $items = array_map(fn ($item) => trim($item), explode(',', $value));
            return array_values(array_filter($items, fn ($item) => $item !== ''));
        }

        return [];
    }

    private function userId(): ?int
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['id_usuario']) ? (int) $_SESSION['id_usuario'] : null;
    }
}
