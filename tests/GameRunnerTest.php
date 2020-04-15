<?php declare(strict_types=1);

namespace Trivia\Test;

use PHPUnit\Framework\TestCase;
use Random;

require_once(__DIR__.'/../src/GameRunner.php');
require_once('FakeGame.php');
require_once('Random.php');

class GameRunnerTest extends TestCase
{
    const ACTUAL_FILE = 'tests/goldenmaster/play-actual.txt';
    const GOLDENMASTER_FILE = 'tests/goldenmaster/play-goldenmaster.txt';
    const TIMES = 100;

    /** @test */
    public function golden_master()
    {
        $this->ensureGoldenMasterFileExists();

        $this->play(self::ACTUAL_FILE, self::TIMES);

        $this->assertSameOutput();
    }

    /**
     * @param $outputFilename
     * @param $times
     */
    protected function play($outputFilename, $times)
    {
        //Generate a good amount of golden amsters to be sure we have a good tests set to rely on
        for ($i = 0; $i < $times; $i++) {
            $game = new FakeGame(str_replace('.txt',$i.'.txt', $outputFilename));
            $runner = new \GameRunner($game);

            /* srand() makes test hang, dunno why :( */
            //srand($i);
            //$random = rand(0, 5);

            Random::seed($i);
            $random = \Random::num(0, 5);

            $runner->run($random);
        }
    }

    protected function ensureGoldenMasterFileExists()
    {
        if (!file_exists(self::GOLDENMASTER_FILE)) {
            $this->play(self::GOLDENMASTER_FILE, self::TIMES);
        }
    }

    protected function assertSameOutput()
    {
        for ($i = 0; $i < self::TIMES; $i++) {
            //$actual = file_get_contents(self::ACTUAL_FILE);
            $actual = file_get_contents(str_replace('.txt',$i.'.txt', self::ACTUAL_FILE));
            //$goldenmaster = file_get_contents(self::GOLDENMASTER_FILE);
            $goldenmaster = file_get_contents(str_replace('.txt',$i.'.txt', self::GOLDENMASTER_FILE));
            $this->assertEquals($goldenmaster, $actual);
        }
    }
}
