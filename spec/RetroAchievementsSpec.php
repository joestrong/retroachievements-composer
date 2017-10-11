<?php

namespace spec\JoeStrong\RetroAchievements;

use JoeStrong\RetroAchievements\RetroAchievements;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RetroAchievementsSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('', '');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(RetroAchievements::class);
    }

    function it_should_get_top_ten_users()
    {
        $this->getTopTenUsers()->shouldHaveCount(10);
    }

    function it_should_get_console_ids()
    {
        $this->getConsoles();
    }

    function it_should_get_games_list()
    {
        $consoleId = 1;
        $this->getGamesForConsole($consoleId);
    }
}
