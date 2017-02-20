<?php

namespace Band\Music;

class Guitar
{
    private $music;

    private function __construct()
    {
        $this->music = [
            new Song('Smoke on the Water'),
            new Song('Welcome to the Jungle'),
            new Song('Crazy Nights'),
        ];
    }

    public static function loadSongs() : self
    {
        return new self();
    }

    public function addSong(Song $song) : bool
    {
        $return = false;
        if (!in_array($song, $this->music)) {
            $this->music[] = $song;
            $return = true;
        }

        return $return;
    }

    public function getSongs()
    {
        return $this->music;
    }

    public function showSongs()
    {
        echo "    [" . __CLASS__ . "] Canciones disponibles\n";
        echo $this;
    }

    public function __clone()
    {
        $this->music = [
            new Song('Smoke on the Water'),
            new Song('Welcome to the Jungle'),
            new Song('Crazy Nights'),
        ];
    }

    public static function __set_state(array $array) {
        echo "    [" . __CLASS__ . "] Se ejecuta el método mágico set_state\n";
        return false;
    }

    public function __toString()
    {
        $songs = [];

        foreach ($this->music AS $song) {
            $songs[] = (string) $song;
        }

        return implode(', ', $songs) . "\n";
    }
}