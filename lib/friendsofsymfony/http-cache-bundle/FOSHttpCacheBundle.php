<?php

/*
 * This file is part of the FOSHttpCacheBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FOS\HttpCacheBundle;

use FOS\HttpCacheBundle\DependencyInjection\Compiler\LoggerPass;
use FOS\HttpCacheBundle\DependencyInjection\Compiler\SecurityContextPass;
use FOS\HttpCacheBundle\DependencyInjection\Compiler\TagSubscriberPass;
use FOS\HttpCacheBundle\DependencyInjection\Compiler\HashGeneratorPass;
use FOS\HttpCacheBundle\DependencyInjection\Compiler\SessionListenerRemovePass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\Kernel;

class FOSHttpCacheBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new LoggerPass());
        $container->addCompilerPass(new SecurityContextPass());
        $container->addCompilerPass(new TagSubscriberPass());
        $container->addCompilerPass(new HashGeneratorPass());
        if (version_compare(Kernel::VERSION, '3.4', '>=')) {
            $container->addCompilerPass(new SessionListenerRemovePass());
        }
    }
}
