<?php

require_once dirname(__DIR__) . '/services/HttpClient.php';

class ComicService
{
    /**
     * Http client instance
     *
     * @var HttpClient
     */
    private $http = null;

    public function get()
    {
        return $this->httpClient()->get('https://xkcd.com/info.0.json')->toJson();
    }

    /**
     * @return HttpService
     */
    private function httpClient()
    {
        if (is_null($this->http)) {
            $this->http = new HttpService();
        }

        return $this->http;
    }
}
