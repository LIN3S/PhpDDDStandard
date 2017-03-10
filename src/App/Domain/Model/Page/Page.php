<?php

/*
 * This file is part of the Php DDD Standard project.
 *
 * Copyright (c) 2017 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Domain\Model\Page;

use LIN3S\CMSKernel\Domain\Model\Page\PageId;
use LIN3S\CMSKernel\Domain\Model\Translation\Translatable;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class Page extends Translatable
{
    private $id;
    private $createdOn;
    private $updatedOn;

    public function __construct(PageId $id, PageTranslation $translation)
    {
        parent::__construct($translation);
        $this->id = $id;
        $this->createdOn = new \DateTimeImmutable();
        $this->updatedOn = new \DateTimeImmutable();
    }

    public function id()
    {
        return $this->id;
    }

    public function createdOn()
    {
        return $this->createdOn;
    }

    public function updatedOn()
    {
        return $this->updatedOn;
    }

    public function __toString()
    {
        return (string)$this->id->id();
    }
}
