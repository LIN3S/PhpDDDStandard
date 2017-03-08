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

use App\Application\Command\Page\AddPageTranslationCommand;
use App\Application\Command\Page\EditPageTranslationCommand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditPageTranslationType extends AbstractType implements DataMapperInterface
{
    private $locale;
    private $pageId;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->pageId = isset($options['page_id']) ? $options['page_id'] : null;
        $this->locale = $options['locale'];
        $builder
            ->add('translation', PageTranslationType::class)
            ->setDataMapper($this);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired(['locale', 'page_id']);
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
        $forms['translation']->setData([
            'title' => $data->title(),
            'slug'  => $data->slug(),
            'seo'   => [
                'metaTitle'       => $data->seo()->title()->title(),
                'metaDescription' => $data->seo()->description()->description(),
                'robotsIndex'     => $data->seo()->robots()->index(),
                'robotsFollow'    => $data->seo()->robots()->follow(),
            ],
        ]);
    }

    public function mapFormsToData($forms, &$data)
    {
        $forms = iterator_to_array($forms);

        $translation = $forms['translation']->getData();
        $templateName = $translation['templateSelector']['name'];
        $templateContent = $translation['templateSelector'][$templateName];

        if (empty($data)) {
            $data = new AddPageTranslationCommand(
                $this->pageId,
                $this->locale,
                $translation['title'],
                $templateName,
                $templateContent,
                $translation['slug'],
                $translation['metaTitle'],
                $translation['metaDescription'],
                $translation['robotsIndex'],
                $translation['robotsFollow']
            );
        } elseif (null !== $this->pageId) {
            $data = new EditPageTranslationCommand(
                $this->pageId,
                $this->locale,
                $translation['title'],
                $templateName,
                $templateContent,
                $translation['slug'],
                $translation['seo']['metaTitle'],
                $translation['seo']['metaDescription'],
                $translation['seo']['robotsIndex'],
                $translation['seo']['robotsFollow']
            );
        }
    }
}
