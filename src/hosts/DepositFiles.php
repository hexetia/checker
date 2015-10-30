<?php
declare(strict_types=1);

namespace Checker\hosts;

class DepositFiles implements CheckInterface
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

        if($result && $result !== '' && strpos($result, 'string_title')) {
            return true;
        } else {
            return false;
        }
    }
}

//var_dump(DepositFiles::isOnline("http://depositfiles.org/files/f1ilth2ya"));