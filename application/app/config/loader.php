<?php

use Phalcon\Loader;

ini_set("display_errors", true);

$loader = new Loader();

$loader->registerNamespaces(
    [
        'Phalcon' => BASE_PATH.'/vendor/incubator/Library/Phalcon/',
        "models" => $config->application->modelsDir,
        "library" => $config->application->libraryDir,
        "library/xchange" => $config->application->libraryDir . 'xchange/'
    ]
);

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir,
        $config->application->libraryDir,
    ]
)->register();