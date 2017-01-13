<?php

/*
 * This file is part of the Symfony Standard DDD project.
 *
 * Copyright (c) 2017 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Infrastructure\Symfony\HttpAction;

use Symfony\Component\HttpFoundation\Response;

class DefaultAction
{
    private $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function __invoke()
    {
        return new Response($this->twig->render('default/index.html.twig'));
    }
}
