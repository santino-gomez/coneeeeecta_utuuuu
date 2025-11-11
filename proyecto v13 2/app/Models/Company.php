<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

class Company
{
    private PDO $connection;

    public function __construct(?PDO $connection = null)
    {
        $this->connection = $connection ?? Database::connection();
    }

    public function create(array $data): int
    {
        $statement = $this->connection->prepare(
            'INSERT INTO empresa (nombre_empresa, email_empresa, clave_empresa, descripcion_empresa, sitio_web_empresa, direccion_empresa, logo_empresa_url, telefono_empresa) VALUES (:nombre, :email, :clave, :descripcion, :sitio, :direccion, :logo, :telefono)'
        );

        $statement->execute([
            'nombre' => $data['nombre_empresa'],
            'email' => $data['email_empresa'],
            'clave' => $data['clave_empresa'],
            'descripcion' => $data['descripcion_empresa'] ?? null,
            'sitio' => $data['sitio_web_empresa'] ?? null,
            'direccion' => $data['direccion_empresa'] ?? null,
            'logo' => $data['logo_empresa_url'] ?? null,
            'telefono' => $data['telefono_empresa'],
        ]);

        return (int) $this->connection->lastInsertId();
    }

    public function find(int $id): ?array
    {
        $statement = $this->connection->prepare('SELECT * FROM empresa WHERE id_empresa = :id LIMIT 1');
        $statement->execute(['id' => $id]);
        $company = $statement->fetch();

        return $company ?: null;
    }
}
