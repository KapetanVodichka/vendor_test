<?php

namespace SitemapGenerator\Generators;

use SitemapGenerator\Interfaces\InterfaceGen;
use SitemapGenerator\Exceptions\FileAccessException;

class CsvGen implements InterfaceGen
{
    public function write(array $urls, string $filePath): void
    {
        if (!file_exists(dirname($filePath))) {
            mkdir(dirname($filePath), 0777, true);
        }

        $file = fopen($filePath, 'w');
        if ($file === false) {
            throw new FileAccessException("Не удалось записать файл: $filePath");
        }

        fputcsv($file, ['loc', 'lastmod', 'priority', 'changefreq'], ';');

        foreach ($urls as $url) {
            fputcsv($file, [$url['loc'], $url['lastmod'], $url['priority'], $url['changefreq']], ';');
        }

        fclose($file);
    }
}