<?php

/**
 * Created by PhpStorm.
 * User: rolando
 * Date: 18/02/17
 * Time: 16:50
 */

namespace Band\Instruments;

/**
 * Class Guitar
 * @package Band\Instruments
 *
 * @property int strings Número de cuerdas
 * @property bool electric true para eléctrica, false para española
 * @property bool isNew true para indicar que es nueva false para segunda mano
 * @method void showSongs Muestra las canciones disponibles
 * @method bool addSong Agrega una canción a la lista disponible
 *
 */
class Guitar
{
    private $date;
    private $features;
    private $music;
    private $printConstructDestruct;

    public function __construct(string $strings, bool $electric, bool $isNew, string $date, bool $printConstructDestruct = false)
    {

        $this->features = [
            'strings' => $strings,
            'electric' => $electric,
            'isNew' => $isNew,
        ];

        $this->date = new \DateTimeImmutable($date);
        $this->printConstructDestruct = $printConstructDestruct;
        $this->loadMusic();

        if ($this->printConstructDestruct) {
            echo "    [" . __CLASS__ . "] Se ejecuta el método mágico construct\n";
        }
    }

    private function loadMusic()
    {
        if (!isset($this->music) || empty($this->music)) {
            $this->music = \Band\Music\Guitar::loadSongs();
        }
    }

    public function __destruct()
    {
        if ($this->printConstructDestruct) {
            echo "    [" . __CLASS__ . "] Se ejecuta el método mágico destruct\n";
        }
    }

    public function __sleep()
    {
        echo "    [" . __CLASS__ . "] Se ejecuta el método mágico sleep\n";
        $this->date = $this->date->format("Y-m-d H:i:s");

        return ['features', 'date'];
    }

    public function __wakeup()
    {
        echo "    [" . __CLASS__ . "] Se ejecuta el método mágico wakeup\n";
        $this->date = new \DateTimeImmutable($this->date);
        $this->loadMusic();
    }

    public function __call($method, $parameters)
    {
        echo "    [" . __CLASS__ . "] Se ejecuta el método mágico call\n";
        $this->loadMusic();

        if(!method_exists($this->music, $method)) {
            throw new \Exception("Method " . $method . " not available");
        }

        return call_user_func_array(array($this->music, $method), $parameters);
    }

    public function __get($name)
    {
        echo "    [" . __CLASS__ . "] Ejecutando método mágico get\n";

        if (!array_key_exists($name, $this->features)) {
            throw new \Exception("Access to " . $name . " forbidden");
        }

        return $this->features[$name];
    }

    public function __set($name, $value)
    {
        echo "    [" . __CLASS__ . "] Ejecutando método mágico set\n";

        switch ($name) {
            case 'strings':
                if ($value == 6 || $value == 12) {
                    $this->features[$name] = $value;
                } else {
                    throw new \Exception("The method " . $name . " only accept the values 6 or 12");
                }
                break;

            case 'electric':
            case 'isNew':
                if (is_bool($value)) {
                    $this->features[$name] = $value;
                } else {
                    throw new \Exception("The method " . $name . " only accept a boolean");
                }
                break;

            default :
                throw new \Exception("Access to " . $name . " forbidden");
                break;
        }
    }

    public function __isset($name)
    {
        echo "    [" . __CLASS__ . "] Se ejecuta el método mágico isset\n";
        return array_key_exists($name, $this->features);
    }

    public function __unset($name)
    {
        echo "    [" . __CLASS__ . "] Se ejecuta el método mágico unset\n";
        if (array_key_exists($name, $this->features))
        {
            unset($this->features[$name]);
        }
    }

    public function __toString()
    {
        echo "    [" . __CLASS__ . "] Se ejecuta el método mágico toString\n";

        return "A " . ($this->features['isNew'] ? "new" : "used") . " " . ($this->features['electric'] ? 'electric' : 'spanish') . " guitar with "
            . $this->features['strings'] . " strings";
    }

    public function __debugInfo()
    {
        echo "    [" . __CLASS__ . "] Se ejecuta el método mágico debugInfo\n";

        $songs = [];
        foreach ($this->music->getSongs() AS $song) {
            $songs[] = (string) $song;
        }

        return [
            'strings' => $this->features['strings'],
            'electric' => $this->features['electric'],
            'isNew' => $this->features['isNew'],
            'music' => $songs,
        ];
    }

    public function __clone()
    {
        echo "    [" . __CLASS__ . "] Se ejecuta el método mágico clone\n";

        $this->music = clone $this->music;
    }

    public static function __set_state(array $array) {
        echo "    [" . __CLASS__ . "] Se ejecuta el método mágico set_state\n";

        $obj = new self($array['features']['strings'], $array['features']['electric'], $array['features']['isNew'], $array['date']->format('Y-m-d H:i:s'));
        return $obj;
    }
}