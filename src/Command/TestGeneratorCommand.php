<?php

namespace SzewczykMaciek\Bundle\TestGenerator\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use SzewczykMaciek\Bundle\TestGenerator\Util\TestGeneratorInterface;

final class TestGeneratorCommand extends Command
{
    /**
     * @var TestGeneratorInterface $generator
     */
    private $generator;

    public function __construct(TestGeneratorInterface $generator)
    {
        $this->generator = $generator;

        parent::__construct();
    }

    protected function configure()
    {
        $this->generator->configureCommand($this)
            ->setDefinition(
                new InputDefinition(
                    [
                        new InputOption(
                            'path',
                            'p',
                            InputOption::VALUE_REQUIRED|InputOption::VALUE_IS_ARRAY,
                            'Path to directory or file that should be processed, You can use `glob` patterns like -p=Entity/*'
                        ),
                        new InputOption(
                            'generate-templates',
                            't',
                            InputOption::VALUE_OPTIONAL,
                            'Generate templates for tests that was not created before'
                        ),
                        new InputOption(
                            'generate-diff',
                            'd',
                            InputOption::VALUE_OPTIONAL,
                            'Generate templates containing only methods that was not tested in test class (if exists if not create template)'
                        ),
                        new InputOption(
                            'connect-tests-to-class',
                            'c',
                            InputOption::VALUE_OPTIONAL,
                            'Add `@see` annotation on both sites of entity-test'
                        ),
                    ]
                )
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Test Generator');
        $io->section($this->getName().' ('.$this->getDescription().')');


        $filesList = $input->getOption('path');
        $files=$this->createFileListFromOptionArray($filesList);
        $this->filterFiles($files,$input);

        $this->generator->filterFiles(new \ArrayObject($files));


        $count = $this->generator->getNumberOfFilesToProcess();
        $io->progressStart($count);

        $this->generator->generate($io);

        $io->progressAdvance($count);
        $io->section('');
    }

    private function filterFiles(array $files,InputInterface $input):\ArrayObject {
        $list=new \ArrayObject();

        foreach($files as $key=>$filePath){
            $skip=false;

           // die();
        }


        return new \ArrayObject($files);
    }

    private function createFileListFromOptionArray(array  $inputList){
        $files=[];

        foreach ($inputList as $item) {
            if(file_exists($item) && !is_dir($item)){
                $files[]=$item;
            }
            else{
                $files=array_merge($files,glob($item));
            }
        }
        dump($files);
        return $files;
    }

}
