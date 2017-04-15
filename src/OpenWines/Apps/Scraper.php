<?php

namespace OpenWines\Apps;
use OpenWines\Command\AppellationCommand;
use OpenWines\Command\InfoCommand;

/**
 * Scraper
 *
 * @author    Ronan Guilloux <ronan.guilloux@gmail.com>
 * @copyright 2017 OpenWines (http://scraper.openwines.eu)
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */
class Scraper extends Application
{
    /**
     * {@inheritdoc}
     */
    public function __construct($name, $version = null, array $values = array())
    {
        parent::__construct($name, $version, $values);
        $this->command(new InfoCommand());
        $this->command(new AppellationCommand());
    }
}
