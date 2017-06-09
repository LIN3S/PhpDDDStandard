<?php

/*
 * This file is part of the Php DDD Standard project.
 *
 * Copyright (c) 2017 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Infrastructure\Persistence\Doctrine\DataFixtures;

use BenGorUser\User\Application\Command\SignUp\SignUpUserCommand;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    protected $commandBus;
    protected $benGorUserCommandBus;

    public function getOrder()
    {
        return 1;
    }

    public function load(ObjectManager $manager)
    {
        $this->benGorUserCommandBus->handle(
            new SignUpUserCommand(
                'info@lin3s.com',
                '123456',
                ['ROLE_USER', 'ROLE_ADMIN']
            )
        );
    }
}
