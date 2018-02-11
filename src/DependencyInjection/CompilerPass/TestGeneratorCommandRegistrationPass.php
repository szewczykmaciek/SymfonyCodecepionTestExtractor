<?php

namespace SzewczykMaciek\Bundle\TestGenerator\DependencyInjection\CompilerPass;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Reference;
use SzewczykMaciek\Bundle\TestGenerator\Command\TestGeneratorCommand;
use SzewczykMaciek\Bundle\TestGenerator\Util\TestGeneratorInterface;

class TestGeneratorCommandRegistrationPass implements CompilerPassInterface
{
    const TEST_GENERATOR_TAG = 'test.generator.command';

    public function process(ContainerBuilder $container)
    {
        foreach ($container->findTaggedServiceIds(self::TEST_GENERATOR_TAG) as $id => $tags) {
            $def = $container->getDefinition($id);
            /**
             * @var $class TestGeneratorInterface
             */
            $class = $container->getParameterBag()->resolveValue($def->getClass());
            if (!is_subclass_of($class, TestGeneratorInterface::class)) {
                throw new InvalidArgumentException(sprintf('Service "%s" must implement interface "%s".', $id, TestGeneratorInterface::class));
            }

            $container->register(
                sprintf('test.generator.%s',$class::getCommandName()),
                TestGeneratorCommand::class
            )->setArguments([
                new Reference($id)
            ])->addTag('console.command', ['command' => $class::getCommandName()]);
        }
    }
}
