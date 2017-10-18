<?php

require_once('../vendor/autoload.php');

use JoeStrong\RetroAchievements\RetroAchievements;

$username = '';
$apiKey = '';

$ra = new RetroAchievements($username, $apiKey);
$consoles = $ra->getConsoles();

foreach ($consoles as $console) {
    echo "{$console->getName()}<br>";
}
