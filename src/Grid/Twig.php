<?php

namespace App\Grid;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class Twig
{
    public static function renderTwig(string $template, array $parameters = []): string
    {
        $loader = new FilesystemLoader(dirname(__DIR__).'/../templates');
        $twig = new Environment($loader, [
            'cache' => dirname(__DIR__).'/../var/cache',
        ]);
        
        return $twig->render($template, $parameters);
    }
}
