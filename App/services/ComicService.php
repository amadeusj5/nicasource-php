<?php

namespace App\Services;

class ComicService
{
    /**
     * Http client instance
     *
     * @var HttpClient
     */
    private $http = null;

    /**
     * @var string
     */
    const XKCD_URI = 'https://xkcd.com';

    /**
     * @param integer|null $id
     * @return mixed
     */
    public function get(int $id = null)
    {
        if (is_null($id)) {
            return $this->transform($this->getComicOfTheDay());
        }

        $data = $this->httpClient()->get(self::XKCD_URI . '/' . $id . '/info.0.json')->toJson();

        return $this->transform($data, $id);
    }

    /**
     * @return mixed
     */
    public function getComicOfTheDay()
    {
        return $this->httpClient()->get(self::XKCD_URI . '/info.0.json')->toJson();
    }

    /**
     * @return HttpService
     */
    private function httpClient()
    {
        if (is_null($this->http)) {
            $this->http = new HttpClient();
        }

        return $this->http;
    }

    /**
     * Transform the comic object
     *
     * @param array $comic
     * @param integer|null $comic_id
     * 
     * @return array
     */
    private function transform(array $comic, int $comic_id = null)
    {
        if (empty($comic)) {
            $today_comic = $this->getComicOfTheDay();

            if ($comic_id > $today_comic['num']) {
                return $this->abortTo('/');
            }

            $previous_comic_id = $this->getPreviouslyRequestedComicId();

            if (is_null($previous_comic_id) || $previous_comic_id < $comic_id) {
                return $this->abortTo('/comic/' . ($comic_id + 1));
            }

            return $this->abortTo('/comic/' . ($comic_id - 1));
        }

        return [
            'comic' => $comic,
            'previous' => $this->previousComicUrl($comic_id, $comic),
            'next' => $this->nextComicUrl($comic_id)
        ];
    }

    /**
     * @param integer|null  $comic_id
     * @param array $comic
     * 
     * @return string
     */
    private function previousComicUrl(int $comic_id = null, array $comic)
    {
        if ($comic_id && $comic_id === 1) {
            return '';
        }

        $previous_comic_id = $comic['num'] - 1;
        return "/comic/$previous_comic_id";
    }

    /**
     * @param integer|null $comic_id
     * @return string
     */
    private function nextComicUrl(int $comic_id = null)
    {
        if (is_null($comic_id)) {
            return '';
        }

        $today_comic = $this->getComicOfTheDay();

        if ($comic_id === $today_comic['num']) {
            return '';
        }

        $next_comic_id = $comic_id + 1;
        return "/comic/$next_comic_id";
    }

    /**
     * @return null|int
     */
    private function getPreviouslyRequestedComicId()
    {
        $url = $this->httpClient()->getPreviousRequest();

        if (empty($url)) {
            return null;
        }

        $path = explode('/', parse_url($url, PHP_URL_PATH));

        return end($path);
    }

    /**
     * Abort Comic, redirect and die
     *
     * @param string $url
     */
    protected function abortTo($url)
    {
        header("Location: $url");
        return [];
    }
}
