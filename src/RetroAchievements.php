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
     * @param Client $client An instance of the GuzzleHttp client
     */
    public function __construct(string $username, string $apiKey, Client $client = null)
    {
        $this->username = $username;
        $this->apiKey = $apiKey;
        $this->client = $client ?? new Client(['base_uri' => $this->apiUrl]);
    }

    /**
     * Get the top ten users on RetroAchievements.org
     *
     * @return User[]
     * @throws \Error
     */
    public function getTopTenUsers() : array
    {
        $userData = $this->request('API_GetTopTenUsers.php');
        
        return array_map(function ($data) {
            return new User($data->{1}, (int) $data->{2}, (int) $data->{3});
        }, $userData);
    }

    /**
     * Get the consoles on RetroAchievements.org
     *
     * @return Console[]
     * @throws \Error
     */
    public function getConsoles() : array
    {
        $consoleData = $this->request('API_GetConsoleIDs.php');
        
        return array_map(function ($data) {
            return new Console((int) $data->ID, $data->Name);
        }, $consoleData);
    }

    /**
     * Get the games for a particular console
     *
     * @param int $consoleId The id of the console to get games for
     * @return Game[]
     * @throws \Error
     */
    public function getGamesForConsole(int $consoleId) : array
    {
        $gamesData = $this->request('API_GetGameList.php', ['i' => $consoleId]);

        return array_map(function ($gameData) {
            return new Game(
                $gameData->ID,
                $gameData->Title,
                $gameData->ConsoleID,
                $gameData->ImageIcon
            );
        }, $gamesData);
    }

    /**
     * Get game's info from a game id
     *
     * @param int $gameId The id of the game to look up
     * @return Game The game containing the info
     */
    public function getGameInfo(int $gameId) : Game
    {
        $gameData = $this->request('API_GetGame.php', ['i' => $gameId]);

        return new Game(
            $gameId,
            $gameData->Title,
            $gameData->ConsoleID,
            $gameData->ImageIcon,
            $gameData->GameIcon,
            $gameData->ImageTitle,
            $gameData->ImageIngame,
            $gameData->ImageBoxArt,
            $gameData->Publisher,
            $gameData->Developer,
            $gameData->Genre,
            $gameData->Released,
            $gameData->ForumTopicID
        );
    }

    /**
     * Make a request to the RetroAchievements.org API
     *
     * @param string $endpoint
     * @param array $parameters
     * @return mixed
     * @throws \Error
     */
    protected function request(string $endpoint, array $parameters = [])
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
