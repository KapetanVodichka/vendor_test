<?php

namespace SitemapGenerator\Generators;

use SitemapGenerator\Interfaces\InterfaceGen;
use SitemapGenerator\Exceptions\FileAccessException;

class JsonGen implements InterfaceGen
{
    public function write(array $urls, string $filePath): void
    {
        if (!file_exists(dirname($filePath))) {
            mkdir(dirname($filePath), 0777, true);
        }

        $json = json_encode($urls, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        if (file_put_contents($filePath, $json) === false) {
            throw new FileAccessException("Не удалось записать файл: $filePath");
        }
    }
}