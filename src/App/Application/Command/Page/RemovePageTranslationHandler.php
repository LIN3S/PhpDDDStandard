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

class RemovePageTranslationHandler
{
    private $repository;

    public function __construct(PageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(RemovePageTranslationCommand $command)
    {
        $page = $this->repository->pageOfId(
            PageId::generate(
                $command->pageId()
            )
        );
        if (!$page instanceof Page) {
            throw new PageDoesNotExistException();
        }
        $page->removeTranslation(
            new Locale(
                $command->locale()
            )
        );

        $this->repository->persist($page);
    }
}
