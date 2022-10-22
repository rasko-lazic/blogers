<?php

namespace Core;

class Helpers {

    public static function getRefererPath(): ?string
    {
        return explode($_SERVER['SERVER_NAME'], $_SERVER['HTTP_REFERER'])[1] ?? null;
    }

    public static function array_flatten($array): array
    {
        $return = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $return = array_merge($return, self::array_flatten($value));
            }
            else {
                $return[$key] = $value;
            }
        }

        return $return;
    }
}