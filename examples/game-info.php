<?php

require_once('../vendor/autoload.php');

use JoeStrong\RetroAchievements\RetroAchievements;

$username = '';
$apiKey = '';

$ra = new RetroAchievements($username, $apiKey);
$game = $ra->getGameInfo(344);

echo <<<HTML
    ID: {$game->getId()}<br>
    Title: {$game->getTitle()}<br>
    Forum topic ID: {$game->getForumTopicId()}<br>
    Console ID: {$game->getConsoleId()}<br>
    Image icon: {$game->getImageIcon()}<br>
    Game icon: {$game->getGameIcon()}<br>
    Image title: {$game->getImageTitle()}<br>
    Image in game: {$game->getImageInGame()}<br>
    Image box art: {$game->getImageBoxArt()}<br>
    Publisher: {$game->getPublisher()}<br>
    Developer: {$game->getDeveloper()}<br>
    Genre: {$game->getGenre()}<br>
    Release Date: {$game->getReleaseDate()}<br>
HTML;
