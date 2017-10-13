<?php

require_once('../vendor/autoload.php');

use JoeStrong\RetroAchievements\RetroAchievements;

$username = '';
$apiKey = '';

$ra = new RetroAchievements($username, $apiKey);
$game = $ra->getGameInfo(344);

echo <<<HTML
    ID: $game->id<br>
    Title: $game->title<br>
    Forum topic ID: $game->forumTopicId<br>
    Console ID: $game->consoleId<br>
    Image icon: $game->imageIcon<br>
    Game icon: $game->gameIcon<br>
    Image title: $game->imageTitle<br>
    Image in game: $game->imageInGame<br>
    Image box art: $game->imageBoxArt<br>
    Publisher: $game->publisher<br>
    Developer: $game->developer<br>
    Genre: $game->genre<br>
    Release Date: $game->releaseDate<br>
HTML;
