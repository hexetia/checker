<?php
declare(strict_types=1);

namespace Checker\hosts;

class Uppit implements CheckInterface
{
    /**
     * @inheritdoc
     */
    public static function isOnline(string $url): bool
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        $result = curl_exec($ch);
        curl_close($ch);

        if($result && $result !== '' &&  !strpos($result, 'File Not Found')) {
            return true;
        }
        else {
            return false;
        }
    }
}

//var_dump(Uppit::isOnline("http://uppit.com/frpic40noztm"));
