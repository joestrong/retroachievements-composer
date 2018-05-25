<?php namespace JoeStrong\RetroAchievements;

class Achievement
{
    public $title;
    public $description;
    public $game;
    public $points;

    public function __construct(string $title, string $description, Game $game, int $points)
    {
        $this->title = $title;
        $this->description = $description;
        $this->game = $game;
        $this->points = $points;
    }
}
