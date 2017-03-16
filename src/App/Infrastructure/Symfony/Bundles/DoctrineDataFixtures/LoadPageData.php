<?php

/*
 * This file is part of the Php DDD Standard project.
 *
 * Copyright (c) 2017 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Infrastructure\Symfony\Bundles\DoctrineDataFixtures;

use App\Infrastructure\Persistence\Doctrine\DataFixtures\LoadPageData as BaseLoadPageData;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class LoadPageData extends BaseLoadPageData implements ContainerAwareInterface
{
    public function setContainer(ContainerInterface $container = null)
    {
        $this->commandBus = $container->get('lin3s.cms_kernel.application.command_bus');
        $this->locales = $this->locales($container->getParameter('cms_kernel_admin_bridge.config'));
    }

    private function locales($configuration)
    {
        $locales = $configuration['locales'];
        if (!isset($locales['others'])) {
            return [
                $locales['default'],
            ];
        }

        return array_merge([$locales['default']], $locales['others']);
    }
}
