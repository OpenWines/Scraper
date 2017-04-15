<?php

namespace OpenWines\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use OpenWines\Provider\Console\Command;

/**
 * Example command for testing purposes.
 *
 * @author    Ronan Guilloux <ronan.guilloux@gmail.com>
 * @copyright 2017 OpenWines (http://scraper.openwines.eu)
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */
class InfoCommand extends Command
{
    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setName('info')
            ->setDescription('Get Application Information');
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // This is a contrived example to show accessing services
        // from the container without needing the command itself
        // to extend from anything but Symfony Console's base Command.

        $app = $this->getApplication()->getService('console');

        $output->writeln('Name: ' . $app->getName());
        $output->writeln('Version: ' . $app->getVersion());
    }
}