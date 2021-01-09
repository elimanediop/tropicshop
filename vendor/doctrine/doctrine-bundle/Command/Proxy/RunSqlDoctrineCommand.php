<?php

namespace Doctrine\Bundle\DoctrineBundle\Command\Proxy;

use Doctrine\DBAL\Tools\Console\Command\RunSqlCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Execute a SQL query and output the results.
 *
 * @deprecated use Doctrine\DBAL\Tools\Console\Command\RunSqlCommand instead
 */
class RunSqlDoctrineCommand extends RunSqlCommand
{
    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('doctrine:query:sql')
            ->setHelp(<<<EOT
The <info>%command.name%</info> command executes the given SQL query and
outputs the results:

<info>php %command.full_name% "SELECT * FROM users"</info>
EOT
        );

        if ($this->getDefinition()->hasOption('connection')) {
            return;
        }

        $this->addOption('connection', null, InputOption::VALUE_OPTIONAL, 'The connection to use for this command');
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        @trigger_error(sprintf('The "%s" (doctrine:query:sql) is deprecated, use dbal:run-sql command instead.', self::class), E_USER_DEPRECATED);

        DoctrineCommandHelper::setApplicationConnection($this->getApplication(), $input->getOption('connection'));

        // compatibility with doctrine/dbal 2.11+
        // where this option is also present and unsupported before we are not switching to use a ConnectionProvider
        $input->setOption('connection', null);

        return parent::execute($input, $output);
    }
}
