<?php

namespace SitemapGenerator\Exceptions;

use Exception;

class InvalidDataException extends Exception
{
    public function __construct($message = "Неверные данные", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}