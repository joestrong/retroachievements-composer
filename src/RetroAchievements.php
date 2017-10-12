<?php namespace JoeStrong\RetroAchievements;

use GuzzleHttp\Client;

class RetroAchievements
{
    protected $apiUrl = 'http://retroachievements.org/API/';
    protected $username;
    protected $apiKey;
    protected $client;

    /**
     * Makes requests to the RetroAchievements.org API
     *
     * @param string $username Your RetroAchievements.org username
     * @param string $apiKey Your RetroAchievements.org API key
     */
    public function __construct(string $username, string $apiKey, $client = null)
    {
        $this->username = $username;
        $this->apiKey = $apiKey;
        $this->client = $client;
        if (!isset($client)) {
            $this->client = new Client(['base_uri' => $this->apiUrl]);
        }
    }

    /**
     * Get the top ten users on RetroAchievements.org
     *
     * @return array Array of \JoeStrong\RetroAchievements\User objects
     * @throws \Error
     */
    public function getTopTenUsers() : array
    {
        $userData = $this->request('API_GetTopTenUsers.php');
        
        return array_map(function ($data) {
            $user = new User();
            $user->username = $data->{1};
            $user->points = (int) $data->{2};
            $user->trueRatio = (int) $data->{3};
            return $user;
        }, $userData);
    }

    /**
     * Get the consoles on RetroAchievements.org
     *
     * @return array Array of \JoeStrong\RetroAchievements\Console objects
     * @throws \Error
     */
    public function getConsoles() : array
    {
        $consoleData = $this->request('API_GetConsoleIDs.php');
        
        return array_map(function ($data) {
            $console = new Console();
            $console->id = (int) $data->ID;
            $console->name = $data->Name;
            return $console;
        }, $consoleData);
    }

    /**
     * Get the games for a particular console
     *
     * @param int $consoleId The id of the console to get games for
     * @return array Array of \JoeStrong\RetroAchievements\Game objects
     * @throws \Error
     */
    public function getGamesForConsole(int $consoleId) : array
    {
        $gamesData = $this->request('API_GetGameList.php', ['i' => $consoleId]);

        return array_map(function ($data) {
            $game = new Game();
            $game->id = (int) $data->ID;
            $game->title = $data->Title;
            $game->consoleId = (int) $data->ConsoleID;
            $game->imageIcon = $data->ImageIcon;
            return $game;
        }, $gamesData);
    }

    /**
     * Make a request to the RetroAchievements.org API
     *
     * @param string $endpoint
     * @param array $parameters
     * @return array
     * @throws \Error
     */
    protected function request(string $endpoint, array $parameters = []) : array
    {
        $auth = "?z={$this->username}&y={$this->apiKey}";
        $parameters = array_reduce(array_keys($parameters), function ($carry, $key) use ($parameters) {
            return "$carry&$key=$parameters[$key]";
        });

        $result = $this->client->get($endpoint . $auth . "&$parameters");
        if ($result->getStatusCode() !== 200) {
            throw new \Error('Could not get the data');
        }
        try {
            return \json_decode($result->getBody());
        } catch (\Error $e) {
            throw new \Error('Did not receive a JSON response');
        }
    }
}
