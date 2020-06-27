<?php

namespace ContainerAqCdAey;


use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/*
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getConsole_Command_CacheClearService extends App_KernelProdContainer
{
    /*
     * Gets the private 'console.command.cache_clear' shared service.
     *
     * @return \Symfony\Bundle\FrameworkBundle\Command\CacheClearCommand
     */
    public static function do($container, $lazyLoad = true)
    {
        $container->privates['console.command.cache_clear'] = $instance = new \Symfony\Bundle\FrameworkBundle\Command\CacheClearCommand(($container->services['cache_clearer'] ?? $container->load('getCacheClearerService')), ($container->services['filesystem'] ?? ($container->services['filesystem'] = new \Symfony\Component\Filesystem\Filesystem())));

        $instance->setName('cache:clear');

        return $instance;
    }
}
