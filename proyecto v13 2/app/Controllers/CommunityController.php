<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Models\CommunityPost;

class CommunityController extends Controller
{
    private CommunityPost $posts;

    public function __construct()
    {
        $this->posts = new CommunityPost();
    }

    public function index()
    {
        $posts = $this->posts->latest();

        return $this->view('community.index', [
            'posts' => $posts,
        ]);
    }

    public function store(Request $request)
    {
        $userId = $this->userId();
        if ($userId === null) {
            return $this->redirect('/login');
        }

        $payload = [
            'id_usuario' => $userId,
            'titulo_post' => $request->input('titulo_post'),
            'contenido' => $request->input('contenido'),
            'estado_post' => 'publicado',
        ];

        $this->posts->create($payload);

        return $this->redirect('/comunidad');
    }

    private function userId(): ?int
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['id_usuario']) ? (int) $_SESSION['id_usuario'] : null;
    }
}
