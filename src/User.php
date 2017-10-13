<?php namespace JoeStrong\RetroAchievements;

/**
 * Represents a user on RetroAchievements.org
 *
 * @package JoeStrong\RetroAchievements
 */
class User
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var int
     */
    private $points;

    /**
     * @var int
     */
    private $trueRatio;

    /**
     * @param string $username
     * @param int $points
     * @param int $trueRatio
     */
    public function __construct(string $username, int $points, int $trueRatio)
    {
        $this->username = $username;
        $this->points = $points;
        $this->trueRatio = $trueRatio;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return int
     */
    public function getPoints(): int
    {
        return $this->points;
    }

    /**
     * @return int
     */
    public function getTrueRatio(): int
    {
        return $this->trueRatio;
    }
}
