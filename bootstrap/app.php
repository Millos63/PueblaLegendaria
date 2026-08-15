<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Polyfills para funciones deshabilitadas por el hosting (tmpfile, etc.).
// Debe cargarse antes de que Livewire procese subidas de archivos.
require __DIR__.'/../app/php-polyfills.php';

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

// La carpeta pública se llama "public" en local/subdominio, pero "public_html"
// en el dominio principal de Neubox. Apuntamos public_path() a la que exista.
$app->usePublicPath(is_dir(dirname(__DIR__).'/public_html')
    ? dirname(__DIR__).'/public_html'
    : dirname(__DIR__).'/public');

return $app;
