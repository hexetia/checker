<?php
declare(strict_types=1);

namespace Checker\hosts;

class Mega implements CheckInterface
{
    /**
     * Handles query to mega servers
     * @param array $req data to be sent to mega
     * @return array
     */
    public static function megaApiRequest(array $req): array
    {
        $ch = curl_init('https://g.api.mega.co.nz/cs?id=1');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array($req)));
        $resp = curl_exec($ch);
        curl_close($ch);
        $resp = json_decode($resp, true);

        return $resp[0];
    }

    /**
     * @param string $url
     * @return bool
     */
    public static function isOnline(string $url): boolean
    {
        preg_match('/\!(.*?)\!(.*)/', $url, $matches);

        if (!isset($matches[1])) {
            return false;
        }

        $info = self::megaApiRequest([
            'a' => 'g',
            'g' => 1,
            'p' => $matches[1]
        ]);

        if ($info['g']) {
            return true;
        }
        else {
            return false;
        }
    }
}

//var_dump(Mega::isOnline("https://mega.co.nz/#!7okShZ4J!AL4zvQCa_mcSNqa_HKzbogDR5MUA9rs2EnyEuBwj0qY"));