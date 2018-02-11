<?php
namespace SzewczykMaciek\Bundle\TestGenerator\Generators;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use SzewczykMaciek\Bundle\TestGenerator\Util\TestGeneratorAbstract;


final class GenerateEntity extends TestGeneratorAbstract
{
    public static function getCommandName(): string
    {
        return 'test:generate:entity';
    }

    public function configureCommand(Command $command)
    {
        $command
            ->setDescription('Creates an test for entity class')
            ->addArgument('file', InputArgument::REQUIRED, 'path to file that will be processed (e.g. <fg=yellow>src/Entity/User.php</>)')
            ->setHelp(file_get_contents(__DIR__.'/../Resources/help/GenerateEntity.txt'))
        ;
    }
}
