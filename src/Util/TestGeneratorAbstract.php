<?php

namespace SzewczykMaciek\Bundle\TestGenerator\Util;


abstract class TestGeneratorAbstract implements TestGeneratorInterface
{
    /**
     * List of files that should be processed
     * @var bool|\ArrayObject
     */
    protected  $filesToProcess=false;

    public function getNumberOfFilesToProcess():int{
        return $this->filesToProcess->count();
    }

}
