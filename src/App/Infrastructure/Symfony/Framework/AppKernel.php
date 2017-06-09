<?php

/*
 * This file is part of the Php DDD Standard project.
 *
 * Copyright (c) 2017 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Infrastructure\Symfony\Framework;

use BenGorFile\DoctrineORMBridgeBundle\BenGorFileDoctrineORMBridgeBundle;
use BenGorFile\FileBundle\BenGorFileBundle;
use BenGorFile\SimpleBusBridgeBundle\BenGorFileSimpleBusBridgeBundle;
use BenGorFile\SimpleBusBridgeBundle\BenGorFileSimpleBusDoctrineORMBridgeBundle;
use BenGorFile\SymfonyFilesystemBridgeBundle\BenGorFileSymfonyFilesystemBridgeBundle;
use BenGorUser\DoctrineORMBridgeBundle\DoctrineORMBridgeBundle;
use BenGorUser\SimpleBusBridgeBundle\SimpleBusBridgeBundle;
use BenGorUser\SimpleBusBridgeBundle\SimpleBusDoctrineORMBridgeBundle as BenGorUserSimpleBusDoctrineOrmBridgeBundle;
use BenGorUser\SwiftMailerBridgeBundle\SwiftMailerBridgeBundle;
use BenGorUser\SymfonyRoutingBridgeBundle\SymfonyRoutingBridgeBundle;
use BenGorUser\SymfonySecurityBridgeBundle\SymfonySecurityBridgeBundle;
use BenGorUser\TwigBridgeBundle\TwigBridgeBundle;
use BenGorUser\UserBundle\BenGorUserBundle;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle;
use Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle;
use LIN3S\AdminBundle\Lin3sAdminBundle;
use LIN3S\AdminDDDExtensionsBundle\Lin3sAdminDDDExtensionsBundle;
use LIN3S\CMSKernel\Infrastructure\BenGorFileBundle\CmsKernelBenGorFileBridgeBundle;
use LIN3S\CMSKernel\Infrastructure\BenGorUserBundle\CmsKernelBenGorUserBridgeBundle;
use LIN3S\CMSKernel\Infrastructure\Lin3sAdminBundle\CmsKernelAdminBridgeBundle;
use LIN3S\CMSKernel\Infrastructure\Symfony\Bundle\Lin3sCmsKernelBundle;
use LIN3S\Distribution\Php\Symfony\Lin3sDistributionBundle;
use LIN3S\SharedKernel\Infrastructure\Symfony\Bundle\Lin3sSharedKernelBundle;
use Sensio\Bundle\DistributionBundle\SensioDistributionBundle;
use Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle;
use SimpleBus\SymfonyBridge\DoctrineOrmBridgeBundle as SimpleBusDoctrineOrmBridgeBundle;
use SimpleBus\SymfonyBridge\SimpleBusCommandBusBundle;
use SimpleBus\SymfonyBridge\SimpleBusEventBusBundle;
use SmartCore\Bundle\AcceleratorCacheBundle\AcceleratorCacheBundle;
use Symfony\Bundle\DebugBundle\DebugBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\MonologBundle\MonologBundle;
use Symfony\Bundle\SecurityBundle\SecurityBundle;
use Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Bundle\WebProfilerBundle\WebProfilerBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            new AcceleratorCacheBundle(),
            new DoctrineMigrationsBundle(),
            new DoctrineBundle(),
            new FrameworkBundle(),
            new Lin3sDistributionBundle(),
            new Lin3sSharedKernelBundle(),
            new MonologBundle(),
            new SecurityBundle(),
            new SensioFrameworkExtraBundle(),
            new SimpleBusCommandBusBundle(),
            new SimpleBusDoctrineOrmBridgeBundle(),
            new SimpleBusEventBusBundle(),
            new SwiftmailerBundle(),
            new TwigBundle(),

            new BenGorUserSimpleBusDoctrineOrmBridgeBundle(),
            new DoctrineORMBridgeBundle(),
            new SimpleBusBridgeBundle(),
            new SwiftMailerBridgeBundle(),
            new SymfonyRoutingBridgeBundle(),
            new SymfonySecurityBridgeBundle(),
            new TwigBridgeBundle(),
            new BenGorUserBundle(),

            new BenGorFileSymfonyFilesystemBridgeBundle(),
            new BenGorFileDoctrineORMBridgeBundle(),
            new BenGorFileSimpleBusBridgeBundle(),
            new BenGorFileSimpleBusDoctrineORMBridgeBundle(),
            new BenGorFileBundle(),

            new Lin3sAdminBundle(),
            new Lin3sAdminDDDExtensionsBundle(),
            new Lin3sCmsKernelBundle(),

            new CmsKernelAdminBridgeBundle(),
            new CmsKernelBenGorFileBridgeBundle(),
            new CmsKernelBenGorUserBridgeBundle(),
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new DoctrineFixturesBundle();
            $bundles[] = new DebugBundle();
            $bundles[] = new WebProfilerBundle();
            $bundles[] = new SensioDistributionBundle();
        }

        return $bundles;
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return dirname(__DIR__) . '/../../../../var/cache/' . $this->getEnvironment();
    }

    public function getLogDir()
    {
        return dirname(__DIR__) . '/../../../../var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir() . '/config/config_' . $this->getEnvironment() . '.yml');
    }
}
