<?php

namespace Symfony\Bundle\MakerBundle\Command;

use Symfony\Bundle\MakerBundle\ApplicationAwareMakerInterface;
use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Bundle\MakerBundle\DependencyBuilder;
use Symfony\Bundle\MakerBundle\Exception\RuntimeCommandException;
use Symfony\Bundle\MakerBundle\ExtraGenerationMakerInterface;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Bundle\MakerBundle\InputConfiguration;
use Symfony\Bundle\MakerBundle\MakerInterface;
use Symfony\Bundle\MakerBundle\Validator;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use SzewczykMaciek\Bundle\TestGeneratorBundle\Util\TestGeneratorInterface;

/**
 * Used as the Command class for the generators.
 *
 * @internal
 */
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
