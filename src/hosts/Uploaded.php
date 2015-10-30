<?php
declare(strict_types=1);

namespace Checker\hosts;

class Uploaded implements CheckInterface
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

        if($result !== '' && !strpos($result, 'Error: 404')) {
            return true;
        }
        else {
            return false;
        }
    }
}

//var_dump(Mega::isOnline("http://uploaded.net/file/9qutrtsy"));
