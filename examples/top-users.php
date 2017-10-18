<?php

require_once('../vendor/autoload.php');

use JoeStrong\RetroAchievements\RetroAchievements;

$username = '';
$apiKey = '';

$ra = new RetroAchievements($username, $apiKey);
$users = $ra->getTopTenUsers();

echo "<strong>Top users</strong><br>";
echo "<ol>";
foreach ($users as $user) {
    echo "<li>{$user->getUsername()}</li>";
}
echo "</ol>";
