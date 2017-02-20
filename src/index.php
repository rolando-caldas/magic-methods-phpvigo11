<?php
/**
 * Created by PhpStorm.
 * User: rolando
 * Date: 18/02/17
 * Time: 16:57
 */

/*

__callStatic()

*/

spl_autoload_extensions(".php");
spl_autoload_register();


$options = getopt("m:");

if (!isset($options['m']) || empty($options['m'])) {
    echo "Debes incluir el argumento \"m\" para ejecutar el script\n";
    exit();
}

$magic = new \Magic\Magic();

switch($options['m']) {

    case "constructDestruct":
        $magic->constructDestruct();
        break;

    case "constructDestruct2":
        $magic->constructDestruct(true);
        break;

    case "call":
        $magic->call();
        break;

    case "invoke":
        $magic->invoke();
        break;

    case "sleepWakeUp":
        $magic->sleepWakeUp();
        break;

    case "getSet":
        $magic->getSet();
        break;

    case "issetUnset":
        $magic->issetUnset();
        break;

    case "toString":
        $magic->toString();
        break;

    case "debugInfo":
        $magic->debugInfo();
        break;

    case "runClone":
        $magic->runClone();
        break;

    case "setState":
        $magic->setState();
        break;

    default:
        echo "Valor inválido para el argumento \"m\". Los valores permitidos son:\n";
        echo "- constructDestruct\n";
        echo "- destructDestruct2\n";
        echo "- call\n";
        echo "- sleepWakeUp\n";
        echo "- getSet\n";
        echo "- issetUnset\n";
        echo "- toString\n";
        echo "- debugInfo\n";
        echo "- runClone\n";
        echo "- setState\n";
        break;
}