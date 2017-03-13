<?php

/*
 * This file is part of the Saunier Duval Ofisat project.
 *
 * Copyright (c) 2016-2017 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Spec\App\Domain\Model\User;

use BenGorUser\User\Domain\Model\User;
use BenGorUser\User\Domain\Model\UserEmail;
use BenGorUser\User\Domain\Model\UserId;
use BenGorUser\User\Domain\Model\UserPassword;
use PhpSpec\ObjectBehavior;

class UserSpec extends ObjectBehavior
{
    function it_is_BenGorUser()
    {
        $this->beConstructedSignUp(
            new UserId(),
            new UserEmail('bespina@lin3s.com'),
            UserPassword::fromEncoded('123456', 'salt')
        );
        $this->shouldHaveType(User::class);
    }
}
