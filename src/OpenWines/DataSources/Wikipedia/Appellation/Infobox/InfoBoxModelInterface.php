<?php

namespace OpenWines\DataSources\Wikipedia\Appellation\Infobox;

/**
 * Interface InfoBoxModelInterface
 *
 * @author    Ronan Guilloux <ronan.guilloux@gmail.com>
 * @copyright 2017 OpenWines (http://scraper.openwines.eu)
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */
interface InfoBoxModelInterface
{

    /**
     * InfoBoxModelInterface constructor.
     * @param string $source Wikipedia URI
     * @param string $model Infobox model parameters
     * @param string $lang Wikipedia locale
     */
    public function __construct($source, $model, $lang);

    /**
     * @return array [key1, key2, keyN]
     */
    public function getBoxModelKeys();

    /**
     * @return string filepath
     */
    public function getConfiguration();

    /**
     * @param string $url Wikipedia URL
     * @return string raw infoBox content
     */
    public function getInfoBoxRawContent($url);

    /**
     * @return array [key1=>value1, etc.]
     */
    public function get();
}
