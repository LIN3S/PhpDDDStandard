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

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
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
        $pageId = PageId::generate($command->pageId());
        $page = $this->repository->pageOfId($pageId); /** @var Page $page */
        $this->checkPageExists($page);

        $pageTranslationId = PageTranslationId::generate();
        $locale = new Locale($command->locale());
        $title = new PageTitle($command->title());
        $slug = null === $command->slug() ? $title->title() : $command->slug();
        $slug = new Slug($slug);
        $seo = new Metadata(
            new MetaTitle($command->metaTitle()),
            new MetaDescription($command->metaDescription()),
            new MetaRobots($command->robotsIndex(), $command->robotsFollow())
        );
        $templateName = $command->templateName();
        $templateContent = $command->templateContent();

        $template = $this->templateFactory->build($templateName, $templateContent);
        $pageTranslation = new PageTranslation($pageTranslationId, $locale, $title, $slug, $seo, $template);

        $page->removeTranslation($locale);
        $page->addTranslation($pageTranslation);
        $this->repository->persist($page);
    }

    private function checkPageExists(Page $page = null)
    {
        if (!$page instanceof Page) {
            throw new PageDoesNotExistException();
        }
    }
}
