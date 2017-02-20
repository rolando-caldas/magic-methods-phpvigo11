<?php

/**
 * Magic Methods PHP7
 */

spl_autoload_extensions(".php");
spl_autoload_register();

$options = getopt("m:");

if (!isset($options['m']) || empty($options['m'])) {
    echo "Debes incluir el argumento \"m\" para ejecutar el script\n";
    exit();
}

if ((new \Magic\Magic())->run($options['m']) === false) {
    echo "Valor inválido para el argumento \"m\". Los valores permitidos son:\n";
    echo implode(',', get_class_methods('\\Magic\\Magic')) . "\n";
}