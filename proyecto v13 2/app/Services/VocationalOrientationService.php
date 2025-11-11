<?php

declare(strict_types=1);

namespace App\Services;

class VocationalOrientationService
{
    private const RIASEC_AREAS = [
        'R' => 'Realista',
        'I' => 'Investigativo',
        'A' => 'Artístico',
        'S' => 'Social',
        'E' => 'Emprendedor',
        'C' => 'Convencional',
    ];

    private const CAREER_SUGGESTIONS = [
        'R' => ['Tecnologías Industriales', 'Mecatrónica', 'Electromecánica'],
        'I' => ['Investigación Aplicada', 'Biotecnología', 'Desarrollo de Software'],
        'A' => ['Diseño Multimedia', 'Producción Audiovisual', 'Artes Visuales'],
        'S' => ['Servicios Sociales', 'Docencia Técnica', 'Orientación Educativa'],
        'E' => ['Gestión de Proyectos', 'Emprendimientos Tecnológicos', 'Marketing Digital'],
        'C' => ['Administración', 'Logística', 'Gestión de Calidad'],
    ];

    public function evaluate(array $answers): array
    {
        $scores = array_fill_keys(array_keys(self::RIASEC_AREAS), 0);

        foreach ($answers as $question => $value) {
            if (!is_numeric($value)) {
                continue;
            }

            $code = strtoupper(substr($question, 0, 1));
            if (!isset($scores[$code])) {
                continue;
            }

            $scores[$code] += (int) $value;
        }

        arsort($scores);
        $top = array_slice($scores, 0, 3, true);

        $suggestions = [];
        foreach (array_keys($top) as $code) {
            $suggestions[$code] = [
                'area' => self::RIASEC_AREAS[$code],
                'careers' => self::CAREER_SUGGESTIONS[$code] ?? [],
            ];
        }

        return [
            'scores' => $scores,
            'top_codes' => array_keys($top),
            'suggestions' => $suggestions,
        ];
    }
}
