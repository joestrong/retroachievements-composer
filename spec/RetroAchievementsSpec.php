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
}
