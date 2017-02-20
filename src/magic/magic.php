<?php

/**
 * Created by PhpStorm.
 * User: rolando
 * Date: 19/02/17
 * Time: 16:03
 */

namespace Magic;

use Band\Instruments\Guitar;
use Band\Music\Song;

class Magic
{
    private $guitar;
    private $date = '2017-02-19 20:30:45';

    public function constructDestruct(bool $assign = false)
    {
        echo "\n> Probando constructor:\n";
        echo   "> =====================\n\n";

        if ($assign) {
            $this->guitar = new Guitar(6, true, true, $this->date, true);
        } else {
            new Guitar(6, true, true, $this->date, true);
        }

        echo "\n> Finalizando prueba constructor\n";
    }

    public function call()
    {
        $guitar = new Guitar(6, true, true, $this->date);

        echo "\n> Probando call:\n";
        echo   "> ==============\n";

        echo "> Mostramos las canciones iniciales\n";
        $guitar->showSongs();

        echo "> Añadimos una nueva canción\n";
        $guitar->addSong(new Song('Enter Sandman'));

        echo "> Mostramos las canciones finales\n";
        $guitar->showSongs();

    }

    public function invoke()
    {
        $guitars = [
            new Guitar(6, true, true, $this->date),
            new Guitar(6, true, true, $this->date),
            new Guitar(6, true, true, $this->date),
            new Guitar(6, true, true, $this->date),
        ];

        $song = new Song('Enter Sandman');
        $guitarsWithNewSong = array_map($song, $guitars);

        foreach ($guitarsWithNewSong AS $guitar) {
            $guitar->showSongs();
        }
    }

    public function sleepWakeUp()
    {
        $guitar = new Guitar(6, true, true, $this->date);

        echo "\n> Probando serialize:\n";
        echo   "===================\n";
        $serializedGuitar = serialize($guitar);
        echo "\n> Resultado serialize\n";
        var_dump($serializedGuitar);

        echo "\n> Lanzando unserialize\n";
        $this->var = unserialize($serializedGuitar);
        echo "\n> Resultado unserialize\n";
        var_dump($this->var);

    }

    public function getSet()
    {
        $guitar = new Guitar(6, true, true, $this->date);

        echo "\n> Probando get:\n";
        echo   "=============\n";
        echo $guitar->strings . "\n";

        echo "\n> Cambiamos el valor a 12 en strings\n";
        $guitar->strings = 12;

        echo "\n> El nuevo valor para strings es:\n";
        echo $guitar->strings . "\n";
    }

    public function issetUnset()
    {
        $guitar = new Guitar(6, true, true, $this->date);

        echo "\n> Probando empty:\n";
        echo "> ===============\n";
        var_dump(empty($guitar->strings));

        echo "\n> Probando isset:\n";
        echo "> ===============\n";
        var_dump(isset($guitar->strings));

        echo "\n> Probando unset:\n";
        echo "> ===============\n";
        unset($guitar->strings);

        echo "\n> Probando isset:\n";
        echo "> ===============\n";
        var_dump(isset($guitar->strings));
    }

    public function toString()
    {
        $guitar = new Guitar(6, true, true, $this->date);

        echo "\n> Probando toString\n";
        echo "> " . $guitar . "\n";
    }

    public function debugInfo()
    {
        $guitar = new Guitar(6, true, true, $this->date);

        echo "\n> Probando debugInfo\n";
        echo   "> ==================\n";
        var_dump($guitar);
    }

    public function runClone()
    {
        echo "\n> Probando clonación de objetos:\n";
        echo   "> ==============================\n";
        $guitar = new Guitar(6, true, true, $this->date);
        echo "> Agregamos una canción al objeto guitar\n";
        $guitar->addSong(new Song("Enter Sandman"));

        echo "> Clonamos en objeto guitar en guitarLead\n";
        $guitarLead = clone $guitar;

        echo "> Agregamos una segunda canción al objeto guitar\n";
        $guitar->addSong(new Song("Du Hast"));

        echo "> Mostramos las canciones de guitar\n";
        $guitar->showSongs();

        echo "> Mostramos las canciones de guitarLead\n";
        $guitarLead->showSongs();
    }

    public function setState()
    {
        echo "\n> Probando setState:\n";
        echo   "> ==================\n";
        $guitar = new Guitar(6, true, true, $this->date);
        $guitarLead = false;
        eval ('$guitarLead = ' . var_export($guitar, true) . ';');

        echo "> Resultado de guitarLead\n";
        var_dump($guitarLead);
    }

}