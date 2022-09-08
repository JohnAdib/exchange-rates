<?php

ini_set("display_errors", true);

$loader = new \Phalcon\Loader();

$loader->registerNamespaces(
    [
        "models" => $config->application->modelsDir,
        "xchange" => $config->application->libraryDir
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