<?php

require_once('../vendor/autoload.php');

use JoeStrong\RetroAchievements\RetroAchievements;

$username = '';
$apiKey = '';

$ra = new RetroAchievements($username, $apiKey);
$games = $ra->getGamesForConsole(3);

foreach ($games as $game) {
    echo "{$game->getTitle()}<br>";
}
