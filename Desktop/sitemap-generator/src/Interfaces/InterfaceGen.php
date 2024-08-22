<?php

namespace SitemapGenerator\Interfaces;

interface InterfaceGen
{
    public function write(array $urls, string $filePath): void;
}