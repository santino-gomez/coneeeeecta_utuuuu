<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Services\LocalizationService;

class HomeController extends Controller
{
    private LocalizationService $localization;

    public function __construct()
    {
        $this->localization = new LocalizationService();
    }

    public function landing(Request $request)
    {
        $localization = $this->localization->resolve($request);
        $darkModeCookie = $request->cookie('modoOscuro', 'true');
        $modoOscuro = $darkModeCookie === 'true';

        return $this->view('home.landing', [
            'lang' => $localization['lang'],
            'dictionary' => $localization['dictionary'],
            'modoOscuro' => $modoOscuro,
        ]);
    }
}
