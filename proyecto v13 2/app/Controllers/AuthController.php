<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Models\User;

class AuthController extends Controller
{
    private User $users;

    public function __construct()
    {
        $this->users = new User();
    }

    public function showLogin(): Response
    {
        return $this->view('auth.login');
    }

    public function showRegister(): Response
    {
        return $this->view('auth.register');
    }

    public function login(Request $request): Response
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $identifier = (string) $request->input('email_usuario', '');
        if ($identifier === '') {
            $identifier = (string) $request->input('cedula_usuario', '');
        }

        $password = (string) $request->input('clave_usuario', '');

        $user = $this->users->findByEmailOrDocument($identifier);
        if (!$user || !password_verify($password, $user['clave_usuario'])) {
            return $this->view('auth.login', ['error' => 'Credenciales inválidas']);
        }

        $_SESSION['id_usuario'] = $user['id_usuario'];
        $_SESSION['rol_principal'] = $user['rol_principal'];

        return $this->redirect('/panel');
    }

    public function register(Request $request): Response
    {
        $payload = [
            'nombre_usuario' => trim((string) $request->input('nombre_usuario')),
            'apellido_usuario' => trim((string) $request->input('apellido_usuario')),
            'email_usuario' => strtolower((string) $request->input('email_usuario')),
            'clave_usuario' => password_hash((string) $request->input('clave_usuario'), PASSWORD_BCRYPT),
            'fecha_nacimiento' => (string) $request->input('fecha_nacimiento'),
            'cedula_usuario' => (string) $request->input('cedula_usuario'),
            'rol_principal' => (string) $request->input('rol_principal', 'estudiante'),
        ];

        $userId = $this->users->create($payload);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['id_usuario'] = $userId;
        $_SESSION['rol_principal'] = $payload['rol_principal'];

        return $this->redirect('/perfil/editar');
    }

    public function logout(): Response
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_destroy();

        return $this->redirect('/');
    }
}
