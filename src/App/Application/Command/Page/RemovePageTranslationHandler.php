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
use LIN3S\CMSKernel\Domain\Model\Page\PageDoesNotExistException;
use LIN3S\CMSKernel\Domain\Model\Page\PageId;
use LIN3S\CMSKernel\Domain\Model\Translation\Locale;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class RemovePageTranslationHandler
{
    private $repository;

    public function __construct(PageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(RemovePageTranslationCommand $command)
    {
        $pageId = PageId::generate($command->pageId());
        $locale = new Locale($command->locale());

        $page = $this->repository->pageOfId($pageId); /** @var Page $page */
        $this->checkPageExists($page);
        $page->removeTranslation($locale);
        $this->repository->persist($page);
    }

    private function checkPageExists(Page $page = null)
    {
        if (!$page instanceof Page) {
            throw new PageDoesNotExistException();
        }
    }
}
