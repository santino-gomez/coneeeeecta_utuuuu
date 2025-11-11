<?php

declare(strict_types=1);

namespace App\Services;

use App\Core\Request;

class LocalizationService
{
    private array $supported = ['es', 'en'];
    private string $default = 'es';

    public function resolve(Request $request): array
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $lang = $this->default;

        $queryLang = $request->query('lang');
        if (is_string($queryLang) && in_array($queryLang, $this->supported, true)) {
            $lang = $queryLang;
            $_SESSION['user_lang'] = $lang;
        } elseif (isset($_SESSION['user_lang']) && in_array($_SESSION['user_lang'], $this->supported, true)) {
            $lang = $_SESSION['user_lang'];
        }

        $dictionary = $this->loadDictionary($lang);

        return [
            'lang' => $lang,
            'dictionary' => $dictionary,
        ];
    }

    private function loadDictionary(string $lang): array
    {
        $path = base_path('app/utilities/lang/' . $lang . '.php');
        if (!file_exists($path)) {
            $lang = $this->default;
            $path = base_path('app/utilities/lang/' . $lang . '.php');
        }

        $dictionary = [];
        if (file_exists($path)) {
            $langArray = [];
            include $path;
            if (isset($lang)) {
                $dictionary = $lang;
            } elseif (isset($langArray)) {
                $dictionary = $langArray;
            }
        }

        return is_array($dictionary) ? $dictionary : [];
    }
}
