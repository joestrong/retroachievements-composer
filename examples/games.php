<?php

require_once('../vendor/autoload.php');

use JoeStrong\RetroAchievements\RetroAchievements;

$username = '';
$apiKey = '';

$ra = new RetroAchievements($username, $apiKey);
$games = $ra->getGamesForConsole(3);

echo "<ul>";
foreach ($games as $game) {
    echo "<li>{$game->getTitle()}</li>";
}
echo "</ul>";
