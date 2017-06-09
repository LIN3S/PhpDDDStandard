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
    private $image;

    private function __construct(TemplateId $id, $content, FileId $file = null, FileId $image = null)
    {
        $this->id = $id;
        $this->content = $content;
        $this->file = $file;
        $this->image = $image;
    }

    public static function fromContent(TemplateContent $content)
    {
        $fileId = null;
        $imageId = null;

        if ($content->has('file')) {
            $fileId = new FileId($content->get('file'));
        }
        if ($content->has('image')) {
            $imageId = new FileId($content->get('image'));
        }

        return new self(
            TemplateId::generate(),
            $content->get('content'),
            $fileId,
            $imageId
        );
    }

    public function serialize()
    {
        return [
            'content' => $this->content,
            'file'    => $this->file,
            'image'   => $this->image,
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

    public function image()
    {
        return $this->image;
    }

    public static function name()
    {
        return 'default';
    }
}
