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

use BenGorFile\File\Domain\Model\FileId;
use LIN3S\CMSKernel\Domain\Model\Template\TemplateContent;
use LIN3S\CMSKernel\Domain\Model\Template\TemplateId;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
final class DefaultTemplate extends Template
{
    private $content;
    private $file;

    private function __construct(TemplateId $id, $content, FileId $file)
    {
        $this->id = $id;
        $this->content = $content;
        $this->file = $file;
    }

    public static function fromContent(TemplateContent $content)
    {
        return new self(
            TemplateId::generate(),
            $content->get('content'),
            new FileId($content->get('file'))
        );
    }

    public function serialize()
    {
        return [
            'content' => $this->content,
            'file' => $this->file,
        ];
    }

    public function content()
    {
        return $this->content;
    }

    public function file()
    {
        return $this->file;
    }

    public static function name()
    {
        return 'default';
    }
}
