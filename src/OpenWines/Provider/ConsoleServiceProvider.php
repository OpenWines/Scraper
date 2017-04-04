<?php

namespace OpenWines\Provider;

use Pimple\Container;
use OpenWines\Provider\Console\ContainerAwareApplication;

/**
 * @author    Ronan Guilloux <ronan.guilloux@gmail.com>
 * @copyright 2017 OpenWines (http://scraper.openwines.eu)
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */
class ConsoleServiceProvider implements \Pimple\ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $pimple)
    {
        $pimple['console'] = function($pimple) {
            $console = new ContainerAwareApplication($pimple['console.name'], $pimple['console.version']);
            $console->setContainer($pimple);

            return $console;
        };
    }
}
