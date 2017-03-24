<?php

/*
 * This file is part of the Php DDD Standard project.
 *
 * Copyright (c) 2017 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Infrastructure\Symfony\Form\Type\Page\Template;

use LIN3S\CMSKernel\Infrastructure\Symfony\Form\Type\FileType;
use LIN3S\CMSKernel\Infrastructure\Symfony\Form\Type\TemplateType;
use LIN3S\CMSKernel\Infrastructure\Symfony\Form\Type\WysiwygType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class DefaultTemplateType extends TemplateType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('content', WysiwygType::class);
        $builder->add('file', FileType::class);
    }
}
