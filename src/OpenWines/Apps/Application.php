<?php

namespace OpenWines\Apps;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use OpenWines\Provider\ConsoleServiceProvider;

/**
 * Application
 *
 * @author    Ronan Guilloux <ronan.guilloux@gmail.com>
 * @copyright 2017 OpenWines (http://scraper.openwines.eu)
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */
class Application extends Container
{
    /**
     * @var ServiceProviderInterface[]
     */
    private $providers = array();

    /**
     * Registers the autoloader and necessary components.
     *
     * @param string      $name    Name for this application.
     * @param string|null $version Version number for this application.
     * @param array       $values
     */
    public function __construct($name, $version = null, array $values = array())
    {
        parent::__construct($values);
        $this->register(
            new ConsoleServiceProvider,
            array(
                'console.name'    => $name,
                'console.version' => $version,
            )
        );
    }
    /**
     * {@inheritDoc}
     */
    public function register(ServiceProviderInterface $provider, array $values = array())
    {
        parent::register($provider, $values);
        $this->providers[] = $provider;
    }

    /**
     * Executes this application.
     *
     * @param InputInterface|null  $input
     * @param OutputInterface|null $output
     *
     * @return integer
     */
    public function run(InputInterface $input = null, OutputInterface $output = null)
    {
        return $this['console']->run($input, $output);
    }
    /**
     * Allows you to add a command as Command object or as a command name+callable
     *
     * @param string|Command $nameOrCommand
     * @param callable|null $callable Must be a callable if $nameOrCommand is the command's name
     * @return Command The command instance that you can further configure
     * @api
     */
    public function command($nameOrCommand, $callable = null)
    {
        if ($nameOrCommand instanceof Command) {
            $command = $nameOrCommand;
        } else {
            if (!is_callable($callable)) {
                throw new \InvalidArgumentException('$callable must be a valid callable with the command\'s code');
            }
            $command = new Command($nameOrCommand);
            $command->setCode($callable);
        }
        $this['console']->add($command);
        return $command;
    }
}