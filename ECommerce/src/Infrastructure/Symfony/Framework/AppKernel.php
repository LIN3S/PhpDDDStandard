<?php

/*
 * This file is part of the Php DDD Standard project.
 *
 * Copyright (c) 2017-present-present LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ECommerce\Infrastructure\Symfony\Framework;

use SmartCore\Bundle\AcceleratorCacheBundle\AcceleratorCacheBundle;
use Sylius\Bundle\CoreBundle\Application\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles() : array
    {
        $bundles = [
            new AcceleratorCacheBundle(),

            new \Sylius\Bundle\ShopBundle\SyliusShopBundle(),
            new \Sylius\Bundle\AdminBundle\SyliusAdminBundle(),
            new \FOS\OAuthServerBundle\FOSOAuthServerBundle(), // Required by SyliusAdminApiBundle.
            new \Sylius\Bundle\AdminApiBundle\SyliusAdminApiBundle(),
        ];

        return array_merge(parent::registerBundles(), $bundles);
    }

    public function getRootDir() : string
    {
        return __DIR__;
    }

    public function getCacheDir() : string
    {
        return dirname(__DIR__) . '/../../../var/cache/' . $this->getEnvironment();
    }

    public function getLogDir() : string
    {
        return dirname(__DIR__) . '/../../../var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader) : void
    {
        $loader->load($this->getRootDir() . '/config/config_' . $this->getEnvironment() . '.yml');
    }
}
