<?php

namespace spec\JoeStrong\RetroAchievements;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use JoeStrong\RetroAchievements\Console;
use JoeStrong\RetroAchievements\Game;
use JoeStrong\RetroAchievements\RetroAchievements;
use JoeStrong\RetroAchievements\User;
use PhpSpec\Exception\Exception;
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

    function it_should_get_top_ten_users_using_user_object()
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

        $this->getTopTenUsers()->shouldOnlyContainInstancesOf(User::class);
    }

    function it_should_throw_errors_when_api_offline()
    {
        $mock = new MockHandler([
            new Response(404),
        ]);
        $handler = HandlerStack::create($mock);
        $this->beConstructedWith('user', 'apiKey', new Client(['handler' => $handler]));

        $this->shouldThrow(ClientException::class)->duringGetTopTenUsers();
    }

    function it_should_get_consoles()
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

        $this->getConsoles()->shouldOnlyContainInstancesOf(Console::class);
    }

    function it_should_get_a_list_of_games_for_a_console()
    {
        $gameOb = (object) [
            'ID' => 504,
            'Title' => 'Super Mario Land',
            'ConsoleID' => 4,
            'ImageIcon' => '',
        ];
        $mock = new MockHandler([
            new Response(200, [], json_encode(array_fill(0, 10, $gameOb))),
        ]);
        $handler = HandlerStack::create($mock);
        $this->beConstructedWith('user', 'apiKey', new Client(['handler' => $handler]));

        $consoleId = 1;
        $this->getGamesForConsole($consoleId)->shouldOnlyContainInstancesOf(Game::class);
    }

    function it_must_require_a_game_id_for_get_game_info()
    {
        $this->shouldThrow(\ArgumentCountError::class)->duringGetGameInfo();
    }

    function it_must_require_an_integer_for_game_id_for_get_game_info()
    {
        $this->shouldThrow(\TypeError::class)->duringGetGameInfo([]);
    }

    function it_should_get_game_info_as_a_game_object()
    {
        $mock = new MockHandler([
            $this->mockGameResponse(),
        ]);
        $handler = HandlerStack::create($mock);
        $this->beConstructedWith('user', 'apiKey', new Client(['handler' => $handler]));

        $gameId = 504;
        $this->getGameInfo($gameId)->shouldBeAnInstanceOf(Game::class);
    }

    function it_should_get_all_game_fields_from_get_game_info()
    {
        $mock = new MockHandler([
            $this->mockGameResponse(504),
            $this->mockGameResponse(344),
        ]);
        $handler = HandlerStack::create($mock);
        $this->beConstructedWith('user', 'apiKey', new Client(['handler' => $handler]));

        /** @var Game $gameInfo */
        $gameInfo = $this->getGameInfo(504);
        $gameInfo->getTitle()->shouldEqual('Super Mario Land');
        $gameInfo->getForumTopicId()->shouldEqual(111);
        $gameInfo->getConsoleId()->shouldEqual(4);
        $gameInfo->getImageIcon()->shouldEqual('/Images/000963.png');
        $gameInfo->getGameIcon()->shouldEqual('/Images/000963.png');
        $gameInfo->getImageTitle()->shouldEqual('/Images/000128.png');
        $gameInfo->getImageInGame()->shouldEqual('/Images/000129.png');
        $gameInfo->getImageBoxArt()->shouldEqual('/Images/000477.png');
        $gameInfo->getPublisher()->shouldEqual('Nintendo');
        $gameInfo->getDeveloper()->shouldEqual('Nintendo');
        $gameInfo->getGenre()->shouldEqual('Platformer');
        $gameInfo->getReleaseDate()->shouldEqual('April 21, 1989');

        $gameInfo = $this->getGameInfo(344);
        $gameInfo->getTitle()->shouldEqual('Contra III: The Alien Wars');
        $gameInfo->getForumTopicId()->shouldEqual(73);
        $gameInfo->getConsoleId()->shouldEqual(3);
        $gameInfo->getImageIcon()->shouldEqual('/Images/003376.png');
        $gameInfo->getGameIcon()->shouldEqual('/Images/003376.png');
        $gameInfo->getImageTitle()->shouldEqual('/Images/000143.png');
        $gameInfo->getImageInGame()->shouldEqual('/Images/000028.png');
        $gameInfo->getImageBoxArt()->shouldEqual('/Images/000144.png');
        $gameInfo->getPublisher()->shouldEqual('Konami');
        $gameInfo->getDeveloper()->shouldEqual('Konami');
        $gameInfo->getGenre()->shouldEqual('Run and gun');
        $gameInfo->getReleaseDate()->shouldEqual('February 28, 1992');
    }

    function it_should_return_a_game_object_with_an_id_from_get_game_info()
    {
        $mock = new MockHandler([
            $this->mockGameResponse(504),
            $this->mockGameResponse(503),
        ]);
        $handler = HandlerStack::create($mock);
        $this->beConstructedWith('user', 'apiKey', new Client(['handler' => $handler]));

        $this->getGameInfo(504)->getId()->shouldEqual(504);
        $this->getGameInfo(344)->getId()->shouldEqual(344);
    }

    public function getMatchers(): array
    {
        return [
            'onlyContainInstancesOf' => function ($subject, $key) {
                if (!is_iterable($subject)) {
                    return false;
                }
                foreach ($subject as $item) {
                    if (!$item instanceof $key) {
                        return false;
                    }
                }
                return true;
            },
        ];
    }

    protected function mockGameResponse(int $id = null) : Response
    {
        switch ($id) {
            case 344:
                $gameOb = (object)[
                    'Title' => 'Contra III: The Alien Wars',
                    'ForumTopicID' => 73,
                    'ConsoleID' => 3,
                    'ConsoleName' => 'SNES',
                    'ImageIcon' => '/Images/003376.png',
                    'GameIcon' => '/Images/003376.png',
                    'ImageTitle' => '/Images/000143.png',
                    'ImageIngame' => '/Images/000028.png',
                    'ImageBoxArt' => '/Images/000144.png',
                    'Publisher' => 'Konami',
                    'Developer' => 'Konami',
                    'Genre' => 'Run and gun',
                    'Released' => 'February 28, 1992',
                    'GameTitle' => 'Contra III: The Alien Wars',
                    'Console' => 'SNES',
                ];
                break;
            case 504:
            default:
                $gameOb = (object)[
                    'Title' => 'Super Mario Land',
                    'ForumTopicID' => 111,
                    'ConsoleID' => 4,
                    'ConsoleName' => 'Gameboy',
                    'ImageIcon' => '/Images/000963.png',
                    'GameIcon' => '/Images/000963.png',
                    'ImageTitle' => '/Images/000128.png',
                    'ImageIngame' => '/Images/000129.png',
                    'ImageBoxArt' => '/Images/000477.png',
                    'Publisher' => 'Nintendo',
                    'Developer' => 'Nintendo',
                    'Genre' => 'Platformer',
                    'Released' => 'April 21, 1989',
                    'GameTitle' => 'Super Mario Land',
                    'Console' => 'Gameboy',
                ];
                break;
        }
        return new Response(200, [], json_encode($gameOb));
    }
}
