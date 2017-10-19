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

Get game info

`$ra->getGameInfo($gameId);`


## API Key

To use the wrapper you'll need a valid username and api key. For that you must:

1. Create an account on [retroachievements.org](http://retroachievements.org/createaccount.php)
2. Validate your email address
3. Login with your username and password [login](http://retroachievements.org)
4. Go to settings > [my settings](http://retroachievements.org/controlpanel.php) 
5. Copy the api key

For the library credentials, use your retroachievements username and the api key from the settings page.


## Contributing

See [CONTRIBUTING.md](https://github.com/joestrong/retroachievements-composer/blob/master/CONTRIBUTING.md)
