<?php

namespace Config;

use CodeIgniter\Events\Events;
use CodeIgniter\Exceptions\FrameworkException;
use CodeIgniter\HotReloader\HotReloader;


/*
 * --------------------------------------------------------------------
 * Application Events
 * --------------------------------------------------------------------
 * Events allow you to tap into the execution of the program without
 * modifying or extending core files. This file provides a central
 * location to define your events, though they can always be added
 * at run-time, also, if needed.
 *
 * You create code that can execute by subscribing to events with
 * the 'on()' method. This accepts any form of callable, including
 * Closures, that will be executed when the event is triggered.
 *
 * Example:
 *      Events::on('create', [$myInstance, 'myMethod']);
 */

// Aplica PRAGMA SQLite solo una vez por proceso
Events::on('post_controller_constructor', static function () {
    $db = \Config\Database::connect();
    if ($db->DBDriver === 'SQLite3') {
        static $done = false;
        if ($done) return;
        $done = true;
        $db->simpleQuery('PRAGMA journal_mode=WAL;'); #Lecturas concurrentes sin bloquearse
        $db->simpleQuery('PRAGMA synchronous=NORMAL;'); #Cambia a FULL si priorizas durabilidad
        $db->simpleQuery('PRAGMA foreign_keys=ON;');
        $db->simpleQuery('PRAGMA busy_timeout=5000;'); #evita "database is locked"
        $db->simpleQuery('PRAGMA temp_store=MEMORY;');
        $db->simpleQuery('PRAGMA cache_size=-20000;'); #Limita el tamaño de la caché -- ~20 MB (valor negativo = KB)
    }
});

Events::on('pre_system', static function () {
    if (ENVIRONMENT !== 'testing') {
        if (ini_get('zlib.output_compression')) {
            throw FrameworkException::forEnabledZlibOutputCompression();
        }

        while (ob_get_level() > 0) {
            ob_end_flush();
        }

        ob_start(static fn($buffer) => $buffer);
    }

    /*
     * --------------------------------------------------------------------
     * Debug Toolbar Listeners.
     * --------------------------------------------------------------------
     * If you delete, they will no longer be collected.
     */
    if (CI_DEBUG && ! is_cli()) {
        Events::on('DBQuery', 'CodeIgniter\Debug\Toolbar\Collectors\Database::collect');
        Services::toolbar()->respond();
        // Hot Reload route - for framework use on the hot reloader.
        if (ENVIRONMENT === 'development') {
            Services::routes()->get('__hot-reload', static function () {
                (new HotReloader())->run();
            });
        }
    }
});
