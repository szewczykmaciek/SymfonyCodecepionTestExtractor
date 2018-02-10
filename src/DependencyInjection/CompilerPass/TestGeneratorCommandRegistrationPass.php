<?php

namespace SzewczykMaciek\Bundle\TestGeneratorBundle\DependencyInjection\CompilerPass;

use Symfony\Bundle\MakerBundle\Command\TestGeneratorCommand;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Reference;
use SzewczykMaciek\Bundle\TestGeneratorBundle\Util\TestGeneratorInterface;

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
                sprintf('test.generator.auto_command.%s', $class::getCommandName()),
                TestGeneratorCommand::class
            )->setArguments([
                new Reference($id)
            ])->addTag('console.command', ['command' => $class::getCommandName()]);
        }
    }
}
