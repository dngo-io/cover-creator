<?php

namespace DngoIO\CoverCreator\Exception;


class InvalidFileException extends \Exception
{

    public function __construct($message = "File is not valid, it should be JPG or PNG", $code = 0, \Exception $previous = null )
    {
        parent::__construct($message, $code, $previous);
    }

}