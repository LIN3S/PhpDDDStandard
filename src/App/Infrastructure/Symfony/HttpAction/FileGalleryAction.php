<?php

/*
 * This file is part of the Php DDD Standard project.
 *
 * Copyright (c) 2017 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Infrastructure\Symfony\HttpAction;

use BenGorFile\File\Application\Query\AllFilesHandler;
use BenGorFile\File\Application\Query\AllFilesQuery;
use Symfony\Component\HttpFoundation\Response;

class FileGalleryAction
{
    private $twig;
    private $allFilesHandler;

    public function __construct(\Twig_Environment $twig, AllFilesHandler $allFilesHandler)
    {
        $this->twig = $twig;
        $this->allFilesHandler = $allFilesHandler;
    }

    public function __invoke()
    {
        $files = $this->allFilesHandler->__invoke(
            new AllFilesQuery()
        );

        return new Response(
            $this->twig->render('json/files.json.twig', [
                'files' => $files
            ])
        );
    }
}
