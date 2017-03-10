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

use App\Domain\Model\Page\Template\Template;
use LIN3S\CMSKernel\Domain\Model\Page\PageTitle;
use LIN3S\CMSKernel\Domain\Model\Page\PageTranslationId;
use LIN3S\CMSKernel\Domain\Model\Seo\Metadata;
use LIN3S\CMSKernel\Domain\Model\Translation\Locale;
use LIN3S\CMSKernel\Domain\Model\Translation\Translation;
use LIN3S\SharedKernel\Domain\Model\Slug\Slug;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class PageTranslation extends Translation
{
    private $id;
    private $title;
    private $slug;
    private $seo;
    private $template;

    public function __construct(
        PageTranslationId $id,
        Locale $locale,
        PageTitle $title,
        Slug $slug,
        Metadata $seo,
        Template $template
    ) {
        parent::__construct($locale);
        $this->id = $id;
        $this->title = $title;
        $this->slug = $slug;
        $this->seo = $seo;
        $this->setTemplate($template);
    }

    private function setTemplate(Template $template)
    {
        $template->setPageTranslation($this);
        $this->template = $template;
    }

    public function id()
    {
        return $this->id;
    }

    public function title()
    {
        return $this->title;
    }

    public function slug()
    {
        return $this->slug;
    }

    public function seo()
    {
        return $this->seo;
    }

    public function template()
    {
        return $this->template;
    }

    public function __toString()
    {
        return (string)$this->id->id();
    }
}
