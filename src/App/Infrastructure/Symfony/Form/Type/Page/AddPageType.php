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

use App\Application\Command\Page\AddPageCommand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddPageType extends AbstractType implements DataMapperInterface
{
    private $locale;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->locale = $options['locale'];

        $builder
            ->add('translation', PageTranslationType::class)
            ->setDataMapper($this);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired(['locale']);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars = array_merge($view->vars, [
            'groups' => [
                [
                    'name'   => 'General',
                    'fields' => [
                        'translation.title',
                        'translation.slug',
                    ],
                ],
                [
                    'name'   => 'Template',
                    'fields' => [
                        'translation.templateSelector',
                    ],
                ],
                [
                    'name'   => 'Seo',
                    'fields' => [
                        'translation.seo',
                    ],
                ],
            ],
        ]);
    }

    public function mapDataToForms($data, $forms)
    {
        if (null === $data) {
            return;
        }
        $forms = iterator_to_array($forms);
        $translation = $data->${$this->locale}();

        $forms['translation']->setData([
            'title' => $translation->title(),
            'slug'  => $translation->description(),
            'seo'   => [
                'metaTitle'       => $translation->seo()->title()->title(),
                'metaDescription' => $translation->seo()->description()->description(),
                'robotsIndex'     => $translation->seo()->robots()->index(),
                'robotsFollow'    => $translation->robots()->follow(),
            ],
        ]);
    }

    public function mapFormsToData($forms, &$data)
    {
        $forms = iterator_to_array($forms);

        $translation = $forms['translation']->getData();
        $template = $forms['template']->getData();

        $data = new AddPageCommand(
            $this->locale,
            $translation['title'],
            $template['name'],
            $template['content'],
            $translation['slug'],
            $translation['metaTitle'],
            $translation['metaDescription'],
            $translation['robotsIndex'],
            $translation['robotsFollow']
        );
    }
}
