<?php namespace JoeStrong\RetroAchievements;

/**
 * Represents a console on RetroAchievements.org
 *
 * @package JoeStrong\RetroAchievements
 */
class FeedItem
{
    const ACHIEVEMENT_EARNED = 1;
    const LOGGED_IN = 2;
    const STARTED_PLAYING = 3;

    public $type;
    
    public $user;
    public $game;
    public $achievement;
    public $timestamp;

    /**
     * FeedItem constructor.
     * @param int $type The type of feed item
     * @param User $user The user the feed item belongs to
     */
    public function __construct(int $type, User $user, int $timestamp)
    {
        $this->type = $type;
        $this->user = $user;
        $this->timestamp = $timestamp;
    }

    /**
     * Sets the game the feed item refers to
     *
     * @param Game $game
     */
    public function setGame(Game $game)
    {
        $this->game = $game;
    }

    /**
     * Sets the achievement the feed item refers to
     *
     * @param Achievement $achievement
     */
    public function setAchievement(Achievement $achievement)
    {
        $this->achievement = $achievement;
    }
}
