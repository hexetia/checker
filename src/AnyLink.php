<?php
declare(strict_types=1);

namespace Checker;

use Checker\hosts\DepositFiles;
use Checker\hosts\Uploaded;
use Checker\hosts\Mega;
use Checker\hosts\Uppit;
use Checker\hosts\File4GO;
use Checker\hosts\UolVideos;
use Checker\hosts\GoogleDrive;
use Checker\hosts\CheckInterface;

class AnyLink implements CheckInterface
{
    /**
     * Em casos de domínios curtos (ex: up.ht) o ideal é que a expressão regular
     * procure pelo domínio completo, veja o caso do uppit abaixo,
     * isso evita que o algorítimo se confunda e acabe retornando um falso-positivo
     *
     * @inheritdoc
     */
    public static function isOnline(string $url): boolean
    {
        try {
            switch ($url) {
                case (preg_match('#\b(depositfiles|dfiles)\b#i', $url, $matches)):
                    return DepositFiles::isOnline($url);

                case (preg_match('#\b(uploaded|ul.to)\b#i', $url, $matches)):
                    return Uploaded::isOnline($url);

                case (preg_match('#\b(mega)\b#i', $url, $matches)):
                    return Mega::isOnline($url);

                case (preg_match('#\b(uppit|upx.nz|up.ht)\b#i', $url, $matches)):
                    return Uppit::isOnline($url);

                case (preg_match('#\b(file4go|sizedrive)\b#i', $url, $matches)):
                    return File4GO::isOnline($url);

                case (preg_match('#\b(mais.uol)\b#i', $url, $matches)):
                    return UolVideos::isOnline($url);

                case (preg_match('#\b(google)\b#i', $url, $matches)):
                    return GoogleDrive::isOnline($url);

                default:
                    return false;
            }
        } catch (\Exception $e) {
            print $e; // exemplo

            return false;
        }
    }
}