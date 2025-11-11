<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

class Opportunity
{
    private PDO $connection;

    public function __construct(?PDO $connection = null)
    {
        $this->connection = $connection ?? Database::connection();
    }

    public function create(array $data): int
    {
        $statement = $this->connection->prepare(
            'INSERT INTO oferta (id_empresa, titulo_oferta, descripcion_oferta, fecha_publicacion_oferta, fecha_cierre, es_para_egresado, requisitos, ubicacion, modalidad, tipo_jornada, rango_salarial, cupos) VALUES (:empresa, :titulo, :descripcion, :publicacion, :cierre, :egresado, :requisitos, :ubicacion, :modalidad, :jornada, :rango, :cupos)'
        );

        $statement->execute([
            'empresa' => $data['id_empresa'],
            'titulo' => $data['titulo_oferta'],
            'descripcion' => $data['descripcion_oferta'] ?? null,
            'publicacion' => $data['fecha_publicacion_oferta'] ?? date('Y-m-d H:i:s'),
            'cierre' => $data['fecha_cierre'] ?? null,
            'egresado' => $data['es_para_egresado'] ?? 0,
            'requisitos' => $data['requisitos'] ?? null,
            'ubicacion' => $data['ubicacion'] ?? null,
            'modalidad' => $data['modalidad'] ?? 'presencial',
            'jornada' => $data['tipo_jornada'] ?? 'tiempo_completo',
            'rango' => $data['rango_salarial'] ?? null,
            'cupos' => $data['cupos'] ?? null,
        ]);

        return (int) $this->connection->lastInsertId();
    }

    public function all(array $filters = []): array
    {
        $sql = 'SELECT oferta.*, empresa.nombre_empresa FROM oferta JOIN empresa ON empresa.id_empresa = oferta.id_empresa';
        $conditions = [];
        $params = [];

        if (!empty($filters['modalidad'])) {
            $conditions[] = 'oferta.modalidad = :modalidad';
            $params['modalidad'] = $filters['modalidad'];
        }

        if ($filters['es_para_egresado'] !== null && $filters['es_para_egresado'] !== '') {
            $conditions[] = 'oferta.es_para_egresado = :egresado';
            $params['egresado'] = (int) $filters['es_para_egresado'];
        }

        if (!empty($filters['tags']) && is_array($filters['tags'])) {
            $placeholders = [];
            foreach (array_values($filters['tags']) as $index => $tag) {
                $key = 'tag' . $index;
                $placeholders[] = ':' . $key;
                $params[$key] = mb_strtolower(trim((string) $tag));
            }

            if ($placeholders) {
                $conditions[] = 'EXISTS (SELECT 1 FROM oferta_tag ot JOIN tag t ON ot.id_tag = t.id_tag WHERE ot.id_oferta = oferta.id_oferta AND t.nombre_tag IN (' . implode(',', $placeholders) . '))';
            }
        }

        if ($conditions) {
            $sql .= ' WHERE ' . implode(' AND ', $conditions);
        }

        $sql .= ' ORDER BY oferta.fecha_publicacion_oferta DESC';

        $statement = $this->connection->prepare($sql);
        $statement->execute($params);

        return $statement->fetchAll();
    }
}
