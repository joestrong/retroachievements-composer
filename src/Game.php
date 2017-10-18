<?php namespace JoeStrong\RetroAchievements;

/**
 * Represents a game on RetroAchievements.org
 *
 * @package JoeStrong\RetroAchievements
 */
class Game
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var int
     */
    private $consoleId;

    /**
     * @var string
     */
    private $imageIcon;

    /**
     * @var string
     */
    public $gameIcon;
    public $imageTitle;
    public $imageInGame;
    public $imageBoxArt;
    public $publisher;
    public $developer;
    public $genre;
    public $releaseDate;
    public $forumTopicId;

    /**
     * @param int $id
     * @param string $title
     * @param int $consoleId
     * @param string $imageIcon
     */
    public function __construct(
        int $id,
        string $title,
        int $consoleId,
        string $imageIcon,
        string $gameIcon = null,
        string $imageTitle = null,
        string $imageInGame = null,
        string $imageBoxArt = null,
        string $publisher = null,
        string $developer = null,
        string $genre = null,
        string $releaseDate = null,
        int $forumTopicId = null
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->consoleId = $consoleId;
        $this->imageIcon = $imageIcon;
        $this->gameIcon = $gameIcon;
        $this->imageTitle = $imageTitle;
        $this->imageInGame = $imageInGame;
        $this->imageBoxArt = $imageBoxArt;
        $this->publisher = $publisher;
        $this->developer = $developer;
        $this->genre = $genre;
        $this->releaseDate = $releaseDate;
        $this->forumTopicId = $forumTopicId;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getConsoleId(): int
    {
        return $this->consoleId;
    }

    /**
     * @return string
     */
    public function getImageIcon(): string
    {
        return $this->imageIcon;
    }

    /**
     * @return string
     */
    public function getGameIcon()
    {
        return $this->gameIcon;
    }

    /**
     * @return string
     */
    public function getImageTitle()
    {
        return $this->imageTitle;
    }

    /**
     * @return string
     */
    public function getImageInGame()
    {
        return $this->imageInGame;
    }

    /**
     * @return string
     */
    public function getImageBoxArt()
    {
        return $this->imageBoxArt;
    }

    /**
     * @return string
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * @return string
     */
    public function getDeveloper()
    {
        return $this->developer;
    }

    /**
     * @return string
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @return string
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * @return int
     */
    public function getForumTopicId()
    {
        return $this->forumTopicId;
    }
}
