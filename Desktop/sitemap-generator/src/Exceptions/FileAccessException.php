<?php

namespace SitemapGenerator\Exceptions;

use Exception;

class FileAccessException extends Exception
{
    public function __construct($message = "Ошибка доступа к файлу", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}