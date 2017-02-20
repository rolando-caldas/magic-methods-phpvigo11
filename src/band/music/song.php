<?php
/**
 * Created by PhpStorm.
 * User: rolando
 * Date: 19/02/17
 * Time: 20:47
 */

namespace Band\Music;

use Band\Instruments\Guitar;

class Song
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function __toString()
    {
        return $this->name;
    }

    public function __invoke(Guitar $guitar)
    {
        $guitar->addSong($this);
        return $guitar;
    }
}