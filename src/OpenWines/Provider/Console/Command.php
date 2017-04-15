<?php

/*
 * This file is part of the Cilex framework.
 *
 * (c) Mike van Riel <mike.vanriel@naenius.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenWines\Provider\Console;

use Symfony\Component\Console\Command\Command as BaseCommand;

/**
 * @author    Ronan Guilloux <ronan.guilloux@gmail.com>
 * @copyright 2017 OpenWines (http://scraper.openwines.eu)
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */
abstract class Command extends BaseCommand
{
    /**
     * Returns the application container.
     *
     * @return \OpenWines\Apps\Application
     */
    public function getContainer()
    {
        return $this->getApplication()->getContainer();
    }

    /**
     * Returns a service contained in the application container or null if none
     * is found with that name.
     *
     * This is a convenience method used to retrieve an element from the
     * Application container without having to assign the results of the
     * getContainer() method in every call.
     *
     * @param string $name Name of the service
     *
     * @see self::getContainer()
     *
     * @api
     *
     * @return \stdClass|null
     */
    public function getService($name)
    {
        return $this->getApplication()->getService($name);
    }
}