<?php
declare(strict_types=1);

namespace Checker\hosts;

class UolVideos implements CheckInterface
{
    /**
     * @inheritdoc
     */
    public static function isOnline(string $url): boolean
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        $result = curl_exec($ch);
        curl_close($ch);

        if($result && $result !== '' && !strpos($result, '<span class="code">') && !strpos($result, 'encontrada')) {
            return true;
        } else {
            return false;
        }
    }
}

// example
//var_dump(UolVideos::isOnline("15560998")); // online
//var_dump(UolVideos::isOnline("25560999")); // "broken"
