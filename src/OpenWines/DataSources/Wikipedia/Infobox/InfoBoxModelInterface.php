<?php

namespace OpenWines\DataSources\Wikipedia\Infobox;

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
     * @param string $filePath list of URLs
     * @param string $model Infobox model parameters
     * @param string $name appellation code (optionnal)
     * @param string $lang Wikipedia locale (optional)
     */
    public function __construct($filePath, $model, $name, $lang);

    /**
     * @return array [key1, key2, keyN]
     */
    public function getBoxModelKeys();

    /**
     * @return string filepath
     */
    public function getConfiguration();

    public function getAttribute($content, $key);

    /**
     * @return array [key1=>value1, etc.]
     */
    public function get();
}
