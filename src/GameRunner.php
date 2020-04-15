<?php

class GameRunner
{
    /**
     * @var Game
     */
    private $game;

    /**
     * GameRunner constructor.
     * @param Game $game
     */
    public function __construct(Game $game)
    {
        $this->game = $game;
    }

    public function run($random)
    {
        $this->game->add("Chet");
        $this->game->add("Pat");
        $this->game->add("Sue");

        do {
            $this->game->roll($random);

            if (rand(0, 9) == 7) {
                $notAWinner = $this->game->wrongAnswer();
            } else {
                $notAWinner = $this->game->wasCorrectlyAnswered();
            }
        } while ($notAWinner);
    }
}


