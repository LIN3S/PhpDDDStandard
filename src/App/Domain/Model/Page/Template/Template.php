<?php

/*
 * This file is part of the Php DDD Standard project.
 *
 * Copyright (c) 2017 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Domain\Model\Page\Template;

use LIN3S\CMSKernel\Domain\Model\Template\Template as BaseTemplate;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
abstract class Template implements BaseTemplate
{
    protected $id;
    protected $pageTranslation;

    public function id()
    {
        return $this->id;
    }

    public function __toString()
    {
        return (string)$this->id;
    }
}
