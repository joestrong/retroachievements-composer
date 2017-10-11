<?php

require_once('../vendor/autoload.php');

use JoeStrong\RetroAchievements\RetroAchievements;

$username = '';
$apiKey = '';

$ra = new RetroAchievements($username, $apiKey);
$users = $ra->getTopTenUsers();

echo "<strong>Top users</strong><br>";
foreach ($users as $user) {
    echo "$user->username<br>";
}
