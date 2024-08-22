<?php

require 'vendor/autoload.php';

use SitemapGenerator\Exceptions\FileAccessException;
use SitemapGenerator\Exceptions\FileWriteException;
use SitemapGenerator\Exceptions\InvalidDataException;
use SitemapGenerator\Sitemap;

$urls = [
    ['loc' => 'https://site.ru/', 'lastmod' => '2020-12-14', 'priority' => 1, 'changefreq' => 'hourly'],
    ['loc' => 'https://site.ru/news', 'lastmod' => '2020-12-10', 'priority' => 0.5, 'changefreq' => 'daily'],
    ['loc' => 'https://site.ru/about', 'lastmod' => '2020-12-07', 'priority' => 0.1, 'changefreq' => 'weekly']
];

try {
    // Генерация XML
    $sitemap = new Sitemap($urls, 'xml', __DIR__ . '/sitemap.xml');
    $sitemap->generate();
    echo "XML карта сайта успешно сгенерирована.\n";

    // Генерация CSV
    $sitemap = new Sitemap($urls, 'csv', __DIR__ . '/sitemap.csv');
    $sitemap->generate();
    echo "CSV карта сайта успешно сгенерирована.\n";

    // Генерация JSON
    $sitemap = new Sitemap($urls, 'json', __DIR__ . '/sitemap.json');
    $sitemap->generate();
    echo "JSON карта сайта успешно сгенерирована.\n";

} catch (FileAccessException | InvalidDataException | FileWriteException $e) {
    echo "Ошибка: " . $e->getMessage() . "\n";
}