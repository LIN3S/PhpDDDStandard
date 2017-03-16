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
class EditPageTranslationCommand
{
    private $pageId;
    private $locale;
    private $title;
    private $slug;
    private $templateName;
    private $templateContent;
    private $metaTitle;
    private $metaDescription;
    private $robotsIndex;
    private $robotsFollow;

    public function __construct(
        $pageId,
        $locale,
        $title,
        $templateName,
        array $templateContent,
        $slug = null,
        $metaTitle = null,
        $metaDescription = null,
        $robotsIndex = null,
        $robotsFollow = null
    ) {
        if (null === $pageId) {
            throw new InvalidArgumentException('The page id cannot be null');
        }
        if (null === $locale) {
            throw new InvalidArgumentException('The locale cannot be null');
        }
        if (null === $title) {
            throw new InvalidArgumentException('The title cannot be null');
        }
        $this->pageId = $pageId;
        $this->locale = $locale;
        $this->title = $title;
        $this->slug = $slug;
        $this->templateName = $templateName;
        $this->templateContent = $templateContent;
        $this->metaTitle = $metaTitle;
        $this->metaDescription = $metaDescription;
        $this->robotsIndex = $robotsIndex;
        $this->robotsFollow = $robotsFollow;
    }

    public function id()
    {
        return $this->pageId;
    }

    public function locale()
    {
        return $this->locale;
    }

    public function title()
    {
        return $this->title;
    }

    public function slug()
    {
        return $this->slug;
    }

    public function templateName()
    {
        return $this->templateName;
    }

    public function templateContent()
    {
        return $this->templateContent;
    }

    public function metaTitle()
    {
        return $this->metaTitle;
    }

    public function metaDescription()
    {
        return $this->metaDescription;
    }

    public function robotsIndex()
    {
        return $this->robotsIndex;
    }

    public function robotsFollow()
    {
        return $this->robotsFollow;
    }
}
