<?php

namespace Colognifornia\Web\Config;

use Colognifornia\Web\Config\Exceptions\ConfigNotFoundException;
use Colognifornia\Web\Config\Exceptions\RequestedConfigNotDefinedException;

/**
 * Class Config
 *
 * @package Colognifornia\Web\Config
 */
class Config
{

    /**
     * @var array
     */
    protected $config = [];

    /**
     * @param array $config
     */
    public function set(array $config)
    {
        $this->config = $config;
    }

    /**
     * @param string $path
     * @throws ConfigNotFoundException
     * @throws RequestedConfigNotDefinedException
     */
    public function get(string $path)
    {
        $config = $this->config;

        if (!$config) {
            throw new ConfigNotFoundException;
        }

        foreach (explode('.', $path) as $node) {
            if (isset($config[$node])) {
                $config = $config[$node];
            } else {
                throw new RequestedConfigNotDefinedException;
            }
        }

        return $config;
    }

    /**
     * @param  string $path
     * @return bool
     * @throws ConfigNotFoundException
     */
    public function has(string $path)
    {
        $config = $this->config;

        if (!$config) {
            throw new ConfigNotFoundException;
        }

        foreach (explode('.', $path) as $node) {
            if (!isset($config[$node])) {
                return false;
            }

            $config = $config[$node];
        }

        return true;
    }

}
