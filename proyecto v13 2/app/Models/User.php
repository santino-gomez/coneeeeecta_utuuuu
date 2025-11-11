<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

class User
{
    private PDO $connection;

    public function __construct(?PDO $connection = null)
    {
        $this->connection = $connection ?? Database::connection();
    }

    public function findById(int $id): ?array
    {
        $statement = $this->connection->prepare('SELECT * FROM usuario WHERE id_usuario = :id LIMIT 1');
        $statement->execute(['id' => $id]);
        $user = $statement->fetch();

        return $user ?: null;
    }

    public function findByEmailOrDocument(string $identifier): ?array
    {
        $statement = $this->connection->prepare('SELECT * FROM usuario WHERE email_usuario = :identifier OR cedula_usuario = :identifier LIMIT 1');
        $statement->execute(['identifier' => $identifier]);
        $user = $statement->fetch();

        return $user ?: null;
    }

    public function create(array $data): int
    {
        $statement = $this->connection->prepare(
            'INSERT INTO usuario (nombre_usuario, apellido_usuario, email_usuario, clave_usuario, fecha_nacimiento, cedula_usuario, rol_principal, estado_verificacion, es_egresado, fecha_egreso, usuario_activo) VALUES (:nombre, :apellido, :email, :clave, :fecha_nacimiento, :cedula, :rol, :estado, :es_egresado, :fecha_egreso, :activo)'
        );

        $statement->execute([
            'nombre' => $data['nombre_usuario'],
            'apellido' => $data['apellido_usuario'],
            'email' => $data['email_usuario'],
            'clave' => $data['clave_usuario'],
            'fecha_nacimiento' => $data['fecha_nacimiento'],
            'cedula' => $data['cedula_usuario'],
            'rol' => $data['rol_principal'] ?? 'visitante',
            'estado' => $data['estado_verificacion'] ?? 'no_verificado',
            'es_egresado' => $data['es_egresado'] ?? 0,
            'fecha_egreso' => $data['fecha_egreso'] ?? null,
            'activo' => $data['usuario_activo'] ?? 1,
        ]);

        return (int) $this->connection->lastInsertId();
    }

    public function updateProfile(int $id, array $payload): bool
    {
        $fields = [];
        $params = ['id' => $id];

        foreach ($payload as $field => $value) {
            $fields[] = sprintf('%s = :%s', $field, $field);
            $params[$field] = $value;
        }

        if (empty($fields)) {
            return false;
        }

        $sql = 'UPDATE usuario SET ' . implode(', ', $fields) . ' WHERE id_usuario = :id';
        $statement = $this->connection->prepare($sql);

        return $statement->execute($params);
    }

    public function attachInterests(int $userId, array $tags): void
    {
        $this->connection->beginTransaction();

        $delete = $this->connection->prepare('DELETE FROM usuario_tag WHERE id_usuario = :id');
        $delete->execute(['id' => $userId]);

        $tagStatement = $this->connection->prepare('INSERT INTO tag (nombre_tag) VALUES (:name) ON DUPLICATE KEY UPDATE nombre_tag = nombre_tag');
        $linkStatement = $this->connection->prepare('INSERT INTO usuario_tag (id_usuario, id_tag) VALUES (:usuario, (SELECT id_tag FROM tag WHERE nombre_tag = :name))');

        foreach ($tags as $tag) {
            if (!is_string($tag) || trim($tag) === '') {
                continue;
            }

            $normalized = mb_strtolower(trim($tag));
            $tagStatement->execute(['name' => $normalized]);
            $linkStatement->execute(['usuario' => $userId, 'name' => $normalized]);
        }

        $this->connection->commit();
    }

    public function recordVerificationCode(int $userId, string $code, string $expiresAt): bool
    {
        $statement = $this->connection->prepare('UPDATE usuario SET codigo_verificacion = :code, codigo_expira = :expires, codigo_verificado = 0 WHERE id_usuario = :id');

        return $statement->execute([
            'code' => $code,
            'expires' => $expiresAt,
            'id' => $userId,
        ]);
    }
    public function storeOrientationResult(int $userId, array $results): void
    {
        $statement = $this->connection->prepare('INSERT INTO orientacion_resultado (id_usuario, codigo_principal, puntaje_json, sugerencias_json) VALUES (:usuario, :codigo, :puntajes, :sugerencias)');

        $statement->execute([
            'usuario' => $userId,
            'codigo' => $results['top_codes'][0] ?? '',
            'puntajes' => json_encode($results['scores'] ?? [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            'sugerencias' => json_encode($results['suggestions'] ?? [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
        ]);
    }

    public function verifyCode(int $userId, string $code): string
    {
        $statement = $this->connection->prepare('SELECT codigo_verificacion, codigo_expira FROM usuario WHERE id_usuario = :id AND codigo_verificado = 0 LIMIT 1');
        $statement->execute(['id' => $userId]);
        $row = $statement->fetch();

        if (!$row) {
            return 'codigo_incorrecto';
        }

        if (!hash_equals((string) $row['codigo_verificacion'], $code)) {
            return 'codigo_incorrecto';
        }

        if (!empty($row['codigo_expira']) && $row['codigo_expira'] < date('Y-m-d H:i:s')) {
            return 'codigo_expirado';
        }

        $update = $this->connection->prepare('UPDATE usuario SET codigo_verificado = 1, codigo_verificacion = NULL, codigo_expira = NULL WHERE id_usuario = :id');
        $update->execute(['id' => $userId]);

        return 'verificado_con_exito';
    }
}
