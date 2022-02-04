<?php

namespace vahidkaargar\util;

class Json
{
    public static function encode(mixed $value, $flags = 0, $depth = 512)
    {
        return json_encode($value, $flags, $depth);
    }

    public static function decode(string $json, $associative = true, $depth = 512, $flags = 0)
    {
        return json_decode($json, $associative, $depth, $flags);
    }
}