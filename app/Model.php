<?php

namespace AiSocial;

use BadMethodCallException;

abstract class Model
{
    public function __call($method, $arguments)
    {
        if (strpos($method, 'get') === 0) {
            $name = substr($method, 3);
            return $this->$name;
        } elseif (strpos($method, 'set') === 0) {
            $name = substr($method, 3);
            $argumentsLength = count($arguments);
            if ($argumentsLength === 1) {
                $this->$name = array_pop($arguments);
            } elseif ($argumentsLength > 1) {
                $this->$name = $arguments;
            } else {
                throw new BadMethodCallException;
            }

            return $this;
        }

        throw new BadMethodCallException;
    }
}