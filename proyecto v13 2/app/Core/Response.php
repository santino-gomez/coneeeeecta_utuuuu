<?php

declare(strict_types=1);

namespace App\Core;

class Response
{
    public function __construct(
        private string $content,
        private int $status = 200,
        private array $headers = []
    ) {
    }

    public static function html(string $content, int $status = 200, array $headers = []): self
    {
        $headers = array_merge(['Content-Type' => 'text/html; charset=UTF-8'], $headers);
        return new self($content, $status, $headers);
    }

    public static function json(array $data, int $status = 200, array $headers = []): self
    {
        $headers = array_merge(['Content-Type' => 'application/json; charset=UTF-8'], $headers);
        return new self(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), $status, $headers);
    }

    public static function redirect(string $url, int $status = 302): self
    {
        return new self('', $status, ['Location' => $url]);
    }

    public function status(): int
    {
        return $this->status;
    }

    public function headers(): array
    {
        return $this->headers;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function send(): void
    {
        if (!headers_sent()) {
            http_response_code($this->status);
            foreach ($this->headers as $name => $value) {
                header($name . ': ' . $value, true);
            }
        }

        echo $this->content;
    }
}
