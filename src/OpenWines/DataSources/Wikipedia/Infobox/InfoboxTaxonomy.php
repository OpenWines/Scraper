<?php

namespace OpenWines\DataSources\Wikipedia\Infobox;

use League\Csv\Reader;
use OpenWines\DataSources\Helper\HttpTool;
use Symfony\Component\Yaml\Yaml;

/**
 * FRRegionViticole
 *
 * @author    Ronan Guilloux <ronan.guilloux@gmail.com>
 * @copyright 2017 OpenWines (http://scraper.openwines.eu)
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */
abstract class InfoboxTaxonomy implements InfoBoxModelInterface
{

    protected $name;
    protected $model;
    protected $sources;
    protected $lang;

    const API_URL = 'wikipedia.org/w/api.php?action=query&prop=revisions&rvprop=content&format=xmlfm&rvsection=0&titles=';

    public function __construct($filePath, $model= 'UNKNOWN', $name = 'UNKNOWN', $lang = 'fr')
    {
        $this->model = $model;
        $this->name = $name;
        $this->lang = $lang;
        $reader = Reader::createFromPath($filePath);
        foreach ($reader as $offset => $record) {
            $this->sources[$record[1]] = $record[2]; // struct: [subregion,appellation_code,appellation_url]
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getBoxModelKeys()
    {
        $params = Yaml::parse($this->getConfiguration());
        return $params['keys'];
    }

    /**
     * {@inheritdoc}
     */
    public function getConfiguration()
    {
        return file_get_contents($this->model);
    }

    public function getScrapableURL($url)
    {
        if (strpos($url, '.wikipedia.org/w/api.php?action=query') !== true) {
            $parts = explode('/', $url);
            $url = sprintf('https://%s.%s%s', $this->lang, self::API_URL, end($parts));
        }

        return $url;
    }


    /**
     * {@inheritdoc}
     */
    public function get()
    {
        $values = [];
        $rows = [];
        $columns = $this->getBoxModelKeys();
        array_push($columns, 'wikipedia_url');
        array_push($columns, 'wikipedia_api');
        if(!empty($this->name)) {
            $url = $this->sources[$this->name];
            $rows[$url] = HttpTool::getSSLPage( $this->getScrapableURL($url));
        } else {
            foreach ($this->sources as $name=>$url) {
                $rows[$url] = HttpTool::getSSLPage( $this->getScrapableURL($url));
            }
        }
        foreach ($rows as $url=>$content) {
            foreach ($columns as $j=>$key) {
                $values[$url][$key] = $this->getAttribute($content, $key);

            }
            $values[$url]['wikipedia_url'] = $url;
            $values[$url]['wikipedia_api'] =  $this->getScrapableURL($url);
        }
        array_unshift($values, $columns);

        return $values;
    }


}
