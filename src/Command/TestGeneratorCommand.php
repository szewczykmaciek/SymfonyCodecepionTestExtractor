<?php

namespace SzewczykMaciek\Bundle\TestGenerator\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use SzewczykMaciek\Bundle\TestGenerator\Util\TestGeneratorInterface;

final class TestGeneratorCommand extends Command
{
    private $generator;

    public function __construct(TestGeneratorInterface $generator)
    {
        $this->generator = $generator;

        parent::__construct();
    }

    protected function configure()
    {
        $this->generator->configureCommand($this);
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->writeln('<fg=green;options=bold,underscore>OK</> ADZOA');
    }

}
