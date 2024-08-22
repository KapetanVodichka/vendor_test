<?php

namespace SitemapGenerator\Generators;

use SitemapGenerator\Interfaces\InterfaceGen;
use SitemapGenerator\Exceptions\FileAccessException;

class XmlGen implements InterfaceGen
{
    public function write(array $urls, string $filePath): void
    {
        $xml = new \SimpleXMLElement('<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"></urlset>');

        foreach ($urls as $url) {
            $urlElement = $xml->addChild('url');
            $urlElement->addChild('loc', htmlspecialchars($url['loc']));
            $urlElement->addChild('lastmod', $url['lastmod']);
            $urlElement->addChild('priority', $url['priority']);
            $urlElement->addChild('changefreq', $url['changefreq']);
        }

        if (!file_exists(dirname($filePath))) {
            mkdir(dirname($filePath), 0777, true);
        }

        if ($xml->asXML($filePath) === false) {
            throw new FileAccessException("Не удалось записать файл: $filePath");
        }
    }
}