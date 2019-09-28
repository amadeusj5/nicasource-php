<?php

class HttpService
{
    /**
     * Http response data
     *
     * @var mixed
     */
    private static $data = null;

    /**
     * Http get
     *
     * @param string $url
     * @return self
     */
    public function get(string $url)
    {
        self::$data = @file_get_contents($url);

        return new self();
    }

    /**
     * Transform response
     *
     * @return mixed
     */
    public function toJson()
    {
        if (empty(self::$data)) {
            return [];
        }

        return json_decode(self::$data, true);
    }
}
