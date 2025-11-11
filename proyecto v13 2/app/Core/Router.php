<?php

declare(strict_types=1);

namespace App\Core;

use Closure;
use RuntimeException;

class Router
{
    /** @var array<string, array<string, callable|array>> */
    private array $routes = [];

    public function get(string $uri, callable|array $action): self
    {
        return $this->add('GET', $uri, $action);
    }

    public function post(string $uri, callable|array $action): self
    {
        return $this->add('POST', $uri, $action);
    }

    public function put(string $uri, callable|array $action): self
    {
        return $this->add('PUT', $uri, $action);
    }

    public function patch(string $uri, callable|array $action): self
    {
        return $this->add('PATCH', $uri, $action);
    }

    public function delete(string $uri, callable|array $action): self
    {
        return $this->add('DELETE', $uri, $action);
    }

    public function add(string $method, string $uri, callable|array $action): self
    {
        $method = strtoupper($method);
        $uri = '/' . trim($uri, '/');
        if ($uri === '//') {
            $uri = '/';
        }

        $this->routes[$method][$uri] = $action;
        return $this;
    }

    public function dispatch(Request $request): Response
    {
        $method = $request->method();
        $path = $request->path();

        $action = $this->routes[$method][$path] ?? null;

        if ($action === null) {
            return Response::html(View::render('errors/404', ['path' => $path]), 404);
        }

        if (is_callable($action) && !$action instanceof Closure) {
            return $this->callController($action, $request);
        }

        if ($action instanceof Closure || is_callable($action)) {
            $result = $action($request);
            return $this->normalizeResponse($result);
        }

        throw new RuntimeException('Ruta inválida configurada para ' . $path);
    }

    private function callController(callable|array $action, Request $request): Response
    {
        if (is_array($action)) {
            [$controllerClass, $method] = $action;
            if (!class_exists($controllerClass)) {
                throw new RuntimeException("Controlador {$controllerClass} no encontrado");
            }

            $controller = new $controllerClass();
            $result = $controller->{$method}($request);
        } else {
            $result = $action($request);
        }

        return $this->normalizeResponse($result);
    }

    private function normalizeResponse(mixed $result): Response
    {
        if ($result instanceof Response) {
            return $result;
        }

        if (is_string($result)) {
            return Response::html($result);
        }

        if (is_array($result)) {
            return Response::json($result);
        }

        return Response::html('');
    }
}
