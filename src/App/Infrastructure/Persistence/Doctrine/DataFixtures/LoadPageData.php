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

use App\Application\Command\Page\AddPageCommand;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class LoadPageData extends AbstractFixture implements OrderedFixtureInterface
{
    protected $commandBus;
    protected $locales;

    const TEMPLATES = [
        'default' => [
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ' .
                'incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud ' .
                'exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure ' .
                'dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. ' .
                'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit ' .
                'anim id est laborum.',
        ],
        'contact' => [
            'street'      => 'Uribitarte',
            'postal_code' => 48001,
            'city'        => 'Bilbao',
        ],
    ];

    public function getOrder()
    {
        return 1;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 40; ++$i) {
            $this->addPage(sprintf('Page %s', $i + 1));
        }
    }

    private function addPage($title)
    {
        $templateName = array_rand(self::TEMPLATES);
        $templateContent = self::TEMPLATES[$templateName];
        $locale = $this->locales[array_rand($this->locales)];

        $command = new AddPageCommand(
            $locale,
            $title,
            $templateName,
            $templateContent
        );
        $this->commandBus->handle($command);
    }
}
