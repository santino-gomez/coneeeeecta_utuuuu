<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Models\Opportunity;

class OpportunityController extends Controller
{
    private Opportunity $opportunities;

    public function __construct()
    {
        $this->opportunities = new Opportunity();
    }

    public function index(Request $request)
    {
        $filters = [
            'modalidad' => $request->query('modalidad'),
            'es_para_egresado' => $request->query('es_para_egresado'),
            'tags' => $request->query('tags'),
        ];

        if (is_string($filters['tags'])) {
            $filters['tags'] = array_filter(array_map('trim', explode(',', $filters['tags'])));
        }

        $opportunities = $this->opportunities->all($filters);

        return $this->view('opportunities.index', [
            'opportunities' => $opportunities,
        ]);
    }

    public function store(Request $request)
    {
        $payload = [
            'id_empresa' => (int) $request->input('id_empresa'),
            'titulo_oferta' => (string) $request->input('titulo_oferta'),
            'descripcion_oferta' => (string) $request->input('descripcion_oferta'),
            'fecha_cierre' => $request->input('fecha_cierre'),
            'es_para_egresado' => (int) $request->input('es_para_egresado', 0),
            'requisitos' => $request->input('requisitos'),
            'ubicacion' => $request->input('ubicacion'),
            'modalidad' => $request->input('modalidad', 'presencial'),
            'tipo_jornada' => $request->input('tipo_jornada', 'tiempo_completo'),
        ];

        $this->opportunities->create($payload);

        return $this->redirect('/oportunidades');
    }
}
