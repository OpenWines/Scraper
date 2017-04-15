<?php

namespace OpenWines\Command;

use League\Csv\CharsetConverter;
use League\Csv\Writer;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use OpenWines\Provider\Console\Command;
use OpenWines\DataSources\Wikipedia\Appellation\Infobox\InfoboxTaxonomy;

/**
 * Example command for testing purposes.
 *
 * @author    Ronan Guilloux <ronan.guilloux@gmail.com>
 * @copyright 2017 OpenWines (http://scraper.openwines.eu)
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */
class AppellationCommand extends Command
{
    const CSV_DELIMITER = ';';

    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setName('appellation')
            ->setDescription('Get taxonomy content')
            ->addArgument('name', InputArgument::OPTIONAL, 'The entity name')
            ->addArgument('lang', InputArgument::OPTIONAL, 'The entity lang', 'fr');
            ;
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
        $taxonomy = new InfoboxTaxonomy(
             __DIR__ . '/../../../config/Resources/Appellations/InfoboxModel/FR_Infobox_Region_viticole.yml',
            $input->getArgument('name'),
            $input->getArgument('lang')
            );
        $appellation = $taxonomy->get();

        $formatter = (new CharsetConverter())
            ->outputEncoding('utf-8')
        ;
        $writer = Writer::createFromFileObject(new \SplTempFileObject());
        $writer->addFormatter($formatter);
        $writer->insertAll($appellation);
        $output->writeln((string)$writer);
    }
}