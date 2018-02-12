<?php

namespace SzewczykMaciek\Bundle\TestGenerator\Util;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

interface TestGeneratorInterface
{
    public static function getCommandName(): string;

    function configureCommand(Command $command);

    function filterFiles(\ArrayObject $files): \ArrayObject;

    function generate(SymfonyStyle $io);

    function getNumberOfFilesToProcess():int;

}
