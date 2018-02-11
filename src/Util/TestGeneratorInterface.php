<?php

namespace SzewczykMaciek\Bundle\TestGenerator\Util;

use Symfony\Component\Console\Command\Command;

interface TestGeneratorInterface
{
    public static function getCommandName(): string;

    public function configureCommand(Command $command);

}
