<?php

namespace SitemapGenerator;

use SitemapGenerator\Interfaces\InterfaceGen;
use SitemapGenerator\Exceptions\InvalidDataException;
use SitemapGenerator\Exceptions\FileWriteException;
use SitemapGenerator\Generators\XmlGen;
use SitemapGenerator\Generators\CsvGen;
use SitemapGenerator\Generators\JsonGen;

class Sitemap
{
    private array $pages;
    private string $type;
    private string $path;
    private InterfaceGen $generator;

    public function __construct(array $pages, string $type, string $path)
    {
        $this->pages = $pages;
        $this->type = $type;
        $this->path = $path;

        $this->validateData();
        $this->selectGenerator();
    }

    private function validateData(): void
    {
        foreach ($this->pages as $page) {
            if (!isset($page['loc'], $page['lastmod'], $page['priority'], $page['changefreq'])) {
                throw new InvalidDataException('Отсутствуют необходимые данные о странице.');
            }
        }
    }

    private function selectGenerator(): void
    {
        switch ($this->type) {
            case 'xml':
                $this->generator = new XmlGen();
                break;
            case 'csv':
                $this->generator = new CsvGen();
                break;
            case 'json':
                $this->generator = new JsonGen();
                break;
            default:
                throw new InvalidDataException('Неподдерживаемый тип файла.');
        }
    }

    public function generate(): void
    {
        $this->generator->write($this->pages, $this->path);
    }
}
