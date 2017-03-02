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

use LIN3S\CMSKernel\Domain\Model\Template\Template;
use LIN3S\CMSKernel\Domain\Model\Template\TemplateContent;
use LIN3S\CMSKernel\Domain\Model\Template\TemplateId;

final class DefaultTemplate implements Template
{
    private $id;
    private $content;
    private $pageTranslation;

    private function __construct(TemplateId $id, $content)
    {
        $this->id = $id;
        $this->content = $content;
    }

    public static function fromContent(TemplateContent $content)
    {
        return new self(
            TemplateId::generate(),
            $content->get('content')
        );
    }

    public function serialize()
    {
        return [
            'content' => $this->content,
        ];
    }

    public function id()
    {
        return $this->id;
    }

    public function content()
    {
        return $this->content;
    }
}
