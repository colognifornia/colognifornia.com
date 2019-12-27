<?php

namespace Colognifornia\Web\Session;

/**
 * Class Session
 *
 * @package Colognifornia\Web\Session
 */
class Session
{

    /**
     * @param array $options
     */
    public static function start(array $options = [])
    {
        session_start(array_merge([
            'cookie_httponly' => true,
            'cookie_samesite' => 'Strict',
        ], $options));
        session_regenerate_id(true);
    }

    /**
     * @param string $name
     * @return bool
     */
    public static function exists(string $name) : bool
    {
        return isset($_SESSION[$name]);
    }

    /**
     * @param string $name
     * @param $value
     * @return bool
     */
    public static function put(string $name, $value) : bool
    {
        $_SESSION[$name] = $value;

        if (self::exists($name)) {
            return true;
        }

        return false;
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public static function get(string $name)
    {
        if (self::exists($name)) {
            return $_SESSION[$name];
        }

        return null;
    }

    /**
     * @param string $name
     * @return bool
     */
    public static function delete(string $name) : bool
    {
        if (self::exists($name)) {
            unset($_SESSION[$name]);
        }

        return !self::exists($name);
    }
}
