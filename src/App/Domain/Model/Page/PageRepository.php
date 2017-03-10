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

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
interface PageRepository
{
    public function pageOfId(PageId $id);

    public function persist(Page $page);

    public function remove(Page $page);
}
