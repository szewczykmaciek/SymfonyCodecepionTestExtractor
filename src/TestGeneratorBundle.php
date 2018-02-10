<?php
namespace SzewczykMaciek\Bundle\TestGeneratorBundle;

use Symfony\Bundle\MakerBundle\DependencyInjection\CompilerPass\MakeCommandRegistrationPass;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use SzewczykMaciek\Bundle\TestGeneratorBundle\DependencyInjection\CompilerPass\TestGeneratorCommandRegistrationPass;

/**
 * @author Maciej Szewczyk <kontakt@szewczykmaciej.pl>
 */
class TestGeneratorBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new TestGeneratorCommandRegistrationPass(), PassConfig::TYPE_BEFORE_OPTIMIZATION, 10);
    }
}
