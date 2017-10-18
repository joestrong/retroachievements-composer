<?php

require_once('../vendor/autoload.php');

use JoeStrong\RetroAchievements\RetroAchievements;

$username = '';
$apiKey = '';

$ra = new RetroAchievements($username, $apiKey);
$consoles = $ra->getConsoles();

echo "<ul>";
foreach ($consoles as $console) {
    echo "<li>{$console->getName()}</li>";
}
echo "</ul>";
