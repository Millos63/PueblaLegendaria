<?php

/*
 |--------------------------------------------------------------------------
 | Polyfills para funciones de PHP deshabilitadas por el hosting
 |--------------------------------------------------------------------------
 |
 | Neubox (CloudLinux) bloquea varias funciones nativas de PHP vía
 | `disable_functions`. Una de ellas, tmpfile(), es imprescindible para
 | las subidas de archivos de Livewire/Filament.
 |
 | Como Livewire llama a tmpfile() SIN barra dentro de su propio namespace,
 | PHP resuelve primero una función con ese nombre definida en el MISMO
 | namespace. Aquí definimos ese reemplazo usando tempnam()+fopen()
 | (que sí están permitidas). Si el hosting habilita tmpfile() más adelante,
 | el polyfill delega automáticamente en la función real.
 |
 | Este archivo se carga desde bootstrap/app.php en cada request.
 |
 */

namespace Livewire\Features\SupportFileUploads {
    if (! \function_exists(__NAMESPACE__ . '\\tmpfile')) {
        function tmpfile()
        {
            if (\function_exists('tmpfile')) {
                return \tmpfile();
            }

            $path = \tempnam(\sys_get_temp_dir(), 'lw');

            return $path !== false ? \fopen($path, 'r+b') : false;
        }
    }
}

namespace Symfony\Component\ErrorHandler\ErrorRenderer {
    if (! \function_exists(__NAMESPACE__ . '\\highlight_file')) {
        function highlight_file($filename, $return = false)
        {
            if (\function_exists('highlight_file')) {
                return \highlight_file($filename, $return);
            }

            return $return ? '' : true;
        }
    }
}
