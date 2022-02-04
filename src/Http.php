<?php


namespace vahidkaargar\util;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class Http
{
    private static $instance = null;
    private $client;

    public static function factory()
    {
        if (is_null(self::$instance))
            self::$instance = new Http();
        return self::$instance;
    }

    public function client()
    {
        $this->client = new Client();
        return $this;
    }

    public function request($method, $url, $options = [])
    {
        $request = $this->client->request($method, $url, $options);
        $response = [
            'success' => false,
            'message' => 'Request status code is not 200'
        ];
        if ($request->getStatusCode() === 200)
            $response = Json::decode($request->getBody()->getContents());
        return $response;
    }

    public function requestWithCache($method, $url, $options = [])
    {
        $cache = $options['_cache'];
        unset($options['_cache']);
        return Cache::remember($cache['key'], $cache['seconds'], function () use ($method, $url, $options) {
            return $this->request($method, $url, $options);
        });
    }
}