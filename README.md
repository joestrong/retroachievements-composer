## RetroAchievements composer package

Install with:

`composer require joestrong/retroachievements`

Use in a project:

```
require_once('../vendor/autoload.php');

use JoeStrong\RetroAchievements\RetroAchievements;

$ra = new RetroAchievements($username, $apiKey);
$users = $ra->getTopTenUsers();

foreach ($users as $user) {
    echo "$user->username<br>";
}
```

## Methods

Auth with the API

`$ra = new RetroAchievements($username, $apiKey);`

Get the top 10 users

`$ra->getTopTenUsers();`

Get the consoles

`$ra->getConsoles();`

Get games for console

`$ra->getGamesForConsole($consoleId);`
