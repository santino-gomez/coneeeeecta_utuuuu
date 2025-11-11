<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Services\VocationalOrientationService;

class VocationalController extends Controller
{
    private VocationalOrientationService $service;

    public function __construct()
    {
        $this->service = new VocationalOrientationService();
    }

    public function show()
    {
        return $this->view('vocational.test');
    }

    public function evaluate(Request $request)
    {
        $answers = $request->input();
        $results = $this->service->evaluate($answers);

        return $this->view('vocational.results', [
            'results' => $results,
        ]);
    }
}
