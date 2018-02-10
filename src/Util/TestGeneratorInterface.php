<?php

namespace SzewczykMaciek\Bundle\TestGeneratorBundle\Util;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;

interface TestGeneratorInterface
{
    public static function getCommandName(): string;

    public function configureCommand(Command $command);

}
