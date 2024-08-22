<?php

namespace SitemapGenerator\Exceptions;

use Exception;

class FileWriteException extends Exception
{
    public function __construct($message = "Ошибка записи файла", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}