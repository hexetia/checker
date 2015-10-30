<?php
declare(strict_types=1);

namespace Checker\hosts;

interface CheckInterface
{
    /**
     * @param string $url
     * @return string
     */
    static function isOnline(string $url): bool;
}