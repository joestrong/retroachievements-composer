<?php namespace JoeStrong\RetroAchievements;

use GuzzleHttp\Client;

class RetroAchievements
{
    protected $apiUrl = 'http://retroachievements.org/API/';
    protected $username;
    protected $apiKey;

    /**
     * Makes requests to the RetroAchievements.org API
     *
     * @param string $username Your RetroAchievements.org username
     * @param string $apiKey Your RetroAchievements.org API key
     */
    public function __construct(string $username, string $apiKey)
    {
        $this->username = $username;
        $this->apiKey = $apiKey;
        $this->client = new Client(['base_uri' => $this->apiUrl]);
    }

    /**
     * Get the top ten users on RetroAchievements.org
     *
     * @return array
     * @throws \Error
     */
    public function getTopTenUsers() : array
    {
        $userData = $this->request('API_GetTopTenUsers.php');
        
        return array_map(function ($data) {
            $user = new User();
            $user->username = $data->{1};
            $user->points = $data->{2};
            $user->trueRatio = $data->{3};
            return $user;
        }, $userData);
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
