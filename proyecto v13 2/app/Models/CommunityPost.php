<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

class CommunityPost
{
    private PDO $connection;

    public function __construct(?PDO $connection = null)
    {
        $this->connection = $connection ?? Database::connection();
    }

    public function create(array $data): int
    {
        $statement = $this->connection->prepare('INSERT INTO post (id_usuario, titulo_post, contenido, estado_post) VALUES (:usuario, :titulo, :contenido, :estado)');
        $statement->execute([
            'usuario' => $data['id_usuario'],
            'titulo' => $data['titulo_post'],
            'contenido' => $data['contenido'],
            'estado' => $data['estado_post'] ?? 'publicado',
        ]);

        return (int) $this->connection->lastInsertId();
    }

    public function latest(int $limit = 20): array
    {
        $statement = $this->connection->prepare('SELECT p.*, u.nombre_usuario, u.apellido_usuario FROM post p JOIN usuario u ON u.id_usuario = p.id_usuario ORDER BY fecha_publicacion DESC LIMIT :limit');
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}
