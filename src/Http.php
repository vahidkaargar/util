<?php


namespace vahidkaargar\util;

use GuzzleHttp\Client;


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
}