<?php

namespace Trivia\Test;

class FakeGame extends \Game
{
    private $file;
    /**
     * @var
     */
    private $outputFilename;

    /**
     * FakeGame constructor.
     * @param $outputFilename
     */
    public function __construct($outputFilename)
    {
        parent::__construct();

        $this->outputFilename = $outputFilename;

        if(!file_exists(dirname($outputFilename))) {
            mkdir(dirname($outputFilename), 0777, true);
        }

        $this->file = fopen($this->outputFilename, 'w');
        srand(0);
    }

    function echoln($string)
    {
        fwrite($this->file, $string . "\n");
    }

    function __destruct()
    {
        fclose($this->file);
    }

}