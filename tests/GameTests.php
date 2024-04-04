<?php

require_once dirname(__DIR__).'/vendor/autoload.php';

use Trivia\Game;
use PHPUnit\Framework\TestCase;

final class GameTests extends TestCase
{
    #[TestDox('Quando aggiungo un giocatore, il metodo add() ritorna true')]
    public function test_add_player(): void
    {
        $game = new Game();

        $playerName = 'Player 1';
        $addition = $game->add($playerName);

        self::assertTrue($addition);
    }

    #[TestDox('Posso aggingere due giocatori')]
    public function test_two_players(): void
    {
        $game = new Game();

        $player1 = 'Player 1';
        $player2 = 'Player 2';
        $addition1 = $game->add($player1);
        $addition2 = $game->add($player2);

        self::assertTrue($addition1);
        self::assertTrue($addition2);

        $this->assertEquals(2, $game->howManyPlayers());
        $this->assertEquals($player1, $game->players[0]);
        $this->assertEquals($player2, $game->players[1]);
    }

    #[TestDox('Posso aggiungere un giocatore anonimo')]
    public function test_add_noname_player(): void
    {
        $game = new Game();

        $player1 = '';
        $addition1 = $game->add($player1);

        self::assertTrue($addition1);
        $this->assertEquals(1, $game->howManyPlayers());
        $this->assertEquals($player1, $game->players[0]);
    }

    #[TestDox('Posso aggiungere giocatori omonimi')]
    public function test_homonim_player(): void
    {
        $game = new Game();

        $player1 = 'Player';
        $player2 = 'Player';
        $addition1 = $game->add($player1);
        $addition2 = $game->add($player2);

        self::assertTrue($addition1);
        self::assertTrue($addition2);
    }

    #[TestDox('Posso giocare da solo!')]
    public function test_posso_giocare_da_solo(): void
    {
        $game = new Game();

        $player = 'Pippo';
        $game->add($player);
        $game->roll(1);

        self::assertTrue(true);
    }

    #[TestDox('Posso tirare dadi a milllllioni di facce!!!')]
    public function test_(): void
    {
        $game = new Game();

        $player = 'Pippo';
        $game->add($player);
        $game->roll(123);

        self::expectOutputString(<<<EOF
Pippo was added
They are player number 1
Pippo is the current player
They have rolled a 123
Pippo's new location is 111
The category is Rock
Rock Question 0

EOF);
    }
}