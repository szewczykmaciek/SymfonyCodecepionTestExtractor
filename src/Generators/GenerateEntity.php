<?php
namespace SzewczykMaciek\Bundle\TestGenerator\Generators;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use SzewczykMaciek\Bundle\TestGenerator\Util\TestGeneratorAbstract;


final class GenerateEntity extends TestGeneratorAbstract
{

    public static function getCommandName(): string
    {
        return 'bs:generate:test:entity';
    }

    public function configureCommand(Command $command)
    {
        $command
            ->setDescription('Creates an test for entity class')
            ->setHelp(file_get_contents(__DIR__.'/../Resources/help/GenerateEntity.txt'))
        ;
        return $command;
    }

    public function filterFiles(\ArrayObject $files): \ArrayObject
    {
       foreach ($files as $index=>$file){
           if($file=='src/BrokerStar/WriterBundle/Entity/WriterTemplate.php'){
               $files->offsetUnset($index);
            }
       }

       return $this->filesToProcess=$files;
    }

    public function generate(SymfonyStyle $io){

        foreach ($this->filesToProcess as $file){
            sleep(0.1);
            $io->progressAdvance();
        }
    }
}
