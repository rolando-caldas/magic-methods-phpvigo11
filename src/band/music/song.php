<?php

namespace Band\Music;

use Band\Instruments\Guitar;

class Song
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function __invoke(Guitar $guitar)
    {
        $guitar->addSong($this);
        return $guitar;
    }


    public function __toString()
    {
        return $this->name;
    }
    public static function __set_state(array $array) {
        return new self($array['name']);
    }
}