<?php

namespace DngoIO\CoverCreator\Exception;


class InvalidTypeException extends \Exception
{

    public function __construct($message = 'Config value is invalid.', $code = 0, \Exception $previous = null )
    {
        parent::__construct($message, $code, $previous);
    }
}