<?php

/*
 * This file is part of the Php DDD Standard project.
 *
 * Copyright (c) 2017 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Application\Command\Page;

use LIN3S\SharedKernel\Exception\InvalidArgumentException;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class RemovePageTranslationCommand
{
    private $pageId;
    private $locale;

    public function __construct($pageId, $locale)
    {
        if (null === $pageId) {
            throw new InvalidArgumentException('The page id cannot be null');
        }
        if (null === $locale) {
            throw new InvalidArgumentException('The locale cannot be null');
        }
        $this->pageId = $pageId;
        $this->locale = $locale;
    }

    public function id()
    {
        return $this->pageId;
    }

    public function locale()
    {
        return $this->locale;
    }
}
