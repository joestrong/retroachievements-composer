<?php

namespace spec\JoeStrong\RetroAchievements;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use JoeStrong\RetroAchievements\RetroAchievements;
use JoeStrong\RetroAchievements\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RetroAchievementsSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('user', 'apiKey', new Client());
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(RetroAchievements::class);
    }

    function it_should_get_top_ten_users()
    {
        $userOb = (object) [
            1 => 'username',
            2 => 500,
            3 => 400
        ];
        $mock = new MockHandler([
            new Response(200, [], json_encode(array_fill(0, 10, $userOb))),
        ]);
        $handler = HandlerStack::create($mock);
        $this->beConstructedWith('user', 'apiKey', new Client(['handler' => $handler]));

        $this->getTopTenUsers()->shouldHaveCount(10);
    }

    function it_should_get_console_ids()
    {
        $userOb = (object) [
            'ID' => 3,
            'Name' => 'Super Nintendo Entertainment System',
        ];
        $mock = new MockHandler([
            new Response(200, [], json_encode(array_fill(0, 10, $userOb))),
        ]);
        $handler = HandlerStack::create($mock);
        $this->beConstructedWith('user', 'apiKey', new Client(['handler' => $handler]));

        $this->getConsoles();
    }

    function it_should_get_games_list()
    {
        $userOb = (object) [
            'ID' => 1,
            'Title' => 'Super Mario World',
            'ConsoleID' => 3,
            'ImageIcon' => '',
        ];
        $mock = new MockHandler([
            new Response(200, [], json_encode(array_fill(0, 10, $userOb))),
        ]);
        $handler = HandlerStack::create($mock);
        $this->beConstructedWith('user', 'apiKey', new Client(['handler' => $handler]));

        $consoleId = 1;
        $this->getGamesForConsole($consoleId);
    }
}
