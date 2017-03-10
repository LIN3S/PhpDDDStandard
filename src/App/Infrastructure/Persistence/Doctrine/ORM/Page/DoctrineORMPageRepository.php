<?php

/*
 * This file is part of the Php DDD Standard project.
 *
 * Copyright (c) 2017 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Infrastructure\Persistence\Doctrine\ORM\Page;

use App\Domain\Model\Page\Page;
use App\Domain\Model\Page\PageRepository;
use Doctrine\ORM\EntityRepository;
use LIN3S\CMSKernel\Domain\Model\Page\PageId;
use LIN3S\CMSKernel\Domain\Model\Translation\TranslatableId;
use LIN3S\CMSKernel\Domain\Model\Translation\TranslatableRepository;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class DoctrineORMPageRepository extends EntityRepository implements PageRepository, TranslatableRepository
{
    public function pageOfId(PageId $id)
    {
        return $this->find($id->id());
    }

    public function persist(Page $page)
    {
        $this->getEntityManager()->persist($page);
    }

    public function remove(Page $page)
    {
        $this->getEntityManager()->remove($page);
    }

    public function translatableOfId(TranslatableId $id)
    {
        return $this->pageOfId(PageId::generate($id->id()));
    }

    public function query($specification = null)
    {
        return null === $specification
            ? $this->findAll()
            : $specification->buildQuery($this->getEntityManager())->getResult();
    }

    public function count($specification = null)
    {
        if (null === $specification) {
            $queryBuilder = $this->createQueryBuilder('p');

            return (int)$queryBuilder
                ->select($queryBuilder->expr()->count('p.id'))
                ->getQuery()
                ->getSingleScalarResult();
        }

        return (int)$specification->buildCount($this->getEntityManager())->getSingleScalarResult();
    }
}
