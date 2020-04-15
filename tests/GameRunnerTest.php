<?php declare(strict_types=1);

//use Game;
use PHPUnit\Framework\TestCase;

require_once(__DIR__.'/../src/GameRunner.php');

class GameRunnerTest extends TestCase
{
    /** @test */
    public function gamerunner_run()
    {
        $runner = new GameRunner();
        $runner->run();
    }
}
