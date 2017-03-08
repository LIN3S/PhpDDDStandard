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

use App\Domain\Model\Page\Page;
use App\Domain\Model\Page\PageRepository;
use App\Domain\Model\Page\PageTranslation;
use LIN3S\CMSKernel\Domain\Model\Page\PageDoesNotExistException;
use LIN3S\CMSKernel\Domain\Model\Page\PageId;
use LIN3S\CMSKernel\Domain\Model\Page\PageTitle;
use LIN3S\CMSKernel\Domain\Model\Page\PageTranslationId;
use LIN3S\CMSKernel\Domain\Model\Seo\Metadata;
use LIN3S\CMSKernel\Domain\Model\Seo\MetaDescription;
use LIN3S\CMSKernel\Domain\Model\Seo\MetaRobots;
use LIN3S\CMSKernel\Domain\Model\Seo\MetaTitle;
use LIN3S\CMSKernel\Domain\Model\Template\TemplateFactory;
use LIN3S\CMSKernel\Domain\Model\Translation\Locale;
use LIN3S\SharedKernel\Domain\Model\Slug\Slug;

class EditPageTranslationHandler
{
    private $repository;
    private $templateFactory;

    public function __construct(PageRepository $repository, TemplateFactory $templateFactory)
    {
        $this->repository = $repository;
        $this->templateFactory = $templateFactory;
    }

    public function __invoke(EditPageTranslationCommand $command)
    {
        $page = $this->repository->pageOfId(
            PageId::generate(
                $command->pageId()
            )
        );
        if (!$page instanceof Page) {
            throw new PageDoesNotExistException();
        }
        $locale = new Locale(
            $command->locale()
        );

        $newTranslation = new PageTranslation(
            PageTranslationId::generate(),
            $locale,
            new PageTitle(
                $command->title()
            ),
            new Slug(
                null === $command->slug()
                    ? $command->title()
                    : $command->slug()
            ),
            new Metadata(
                new MetaTitle(
                    $command->metaTitle()
                ),
                new MetaDescription(
                    $command->metaDescription()
                ),
                new MetaRobots(
                    $command->robotsIndex(),
                    $command->robotsFollow()
                )
            ),
            $this->templateFactory->build(
                $command->templateName(),
                $command->templateContent()
            )
        );

        $page->removeTranslation($locale);
        $page->addTranslation($newTranslation);
        $this->repository->persist($page);
    }
}
