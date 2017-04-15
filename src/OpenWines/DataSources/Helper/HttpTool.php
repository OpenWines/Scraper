<?php

namespace OpenWines\DataSources\Helper;

/**
 * HttpTool
 *
 */
class HttpTool
{
    public static function getSSLPage($url) {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_COOKIESESSION, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $result = curl_exec($ch);
        if ($n = curl_errno($ch)) {
            throw new \Exception("curl error ($n) : ".curl_error($ch));
        }
        curl_close($ch);

        return $result;
    }
}
