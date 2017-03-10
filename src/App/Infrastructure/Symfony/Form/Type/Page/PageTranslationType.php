<?php

/*
 * This file is part of the Php DDD Standard project.
 *
 * Copyright (c) 2017 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Infrastructure\Symfony\Form\Type\Page;

use App\Domain\Model\Page\Template\ContactTemplate;
use App\Domain\Model\Page\Template\DefaultTemplate;
use App\Infrastructure\Symfony\Form\Type\Page\Template\ContactTemplateType;
use App\Infrastructure\Symfony\Form\Type\Page\Template\DefaultTemplateType;
use LIN3S\CMSKernel\Infrastructure\Symfony\Form\Type\SeoType;
use LIN3S\CMSKernel\Infrastructure\Symfony\Form\Type\TemplateSelectorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class PageTranslationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('slug', TextType::class)
            ->add('seo', SeoType::class)
            ->add('templateSelector', TemplateSelectorType::class, [
                'templates' => [
                    [
                        'type'    => DefaultTemplateType::class,
                        'options' => [
                            'template' => DefaultTemplate::class,
                            'label'    => 'Default',
                        ],
                    ],
                    [
                        'type'    => ContactTemplateType::class,
                        'options' => [
                            'template' => ContactTemplate::class,
                            'label'    => 'Contact',
                        ],
                    ],
                ],
            ]);
    }
}
