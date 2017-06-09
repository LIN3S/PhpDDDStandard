<?php

/*
 * This file is part of the Php DDD Standard project.
 *
 * Copyright (c) 2017 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Double\App\Domain\Model\Page\Template;

use App\Domain\Model\Page\Template\Template;
use LIN3S\CMSKernel\Domain\Model\Template\TemplateContent;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class TemplateStub extends Template
{
    public function __construct()
    {
        $this->id = 123;
    }

    public static function fromContent(TemplateContent $content)
    {
        return true;
    }

    public function serialize()
    {
        return [];
    }

    public static function name()
    {
        return 'template_stub';
    }
}
