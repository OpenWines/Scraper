<?php

namespace OpenWines\DataSources\Wikipedia\Infobox;

/**
 * InfoboxAppellation
 *
 * @author    Ronan Guilloux <ronan.guilloux@gmail.com>
 * @copyright 2017 OpenWines (http://scraper.openwines.eu)
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */
class InfoboxAppellation extends InfoboxTaxonomy
{
    public function getAttribute($content, $key)
    {
        $unwanted = ["| $key", 'unité|', 'formatnum:', '=', '[', ']', '|', '{', '}'];
        $noURLsRegex = "@(https?://([-\\w\\.]+[-\\w])+(:\\d+)?(/([\\w/_\\.#-]*(\\?\\S+)?[^\\.\\s])?).*$)@";
        $attribute = "";
        if (preg_match("/(\\|\\s\\b$key.*)/", $content, $matches)) {
            $value = mb_convert_encoding($matches[0], 'ISO-8859-1', 'HTML-ENTITIES');
            $value = str_replace('  ', '', str_replace($unwanted, ' ', $value));
            $value = preg_replace($noURLsRegex, ' ', $value);
            $attribute = trim(strip_tags(html_entity_decode($value, ENT_NOQUOTES)));
        }

        return $attribute;
    }

}
