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
use LIN3S\SharedKernel\Exception\InvalidArgumentException;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
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
            'title'            => $translation->title(),
            'slug'             => $translation->slug(),
            'templateSelector' => $translation->template(),
            'seo'              => $translation->seo(),
        ]);
    }

    public function mapFormsToData($forms, &$data)
    {
        $forms = iterator_to_array($forms);
        $translation = $forms['translation']->getData();

        try {
            $data = new AddPageCommand(
                $this->locale,
                $translation['title'],
                $translation['templateSelector']['name'],
                $translation['templateSelector']['content'],
                $translation['slug'],
                $translation['seo']['metaTitle'],
                $translation['seo']['metaDescription'],
                $translation['seo']['robotsIndex'],
                $translation['seo']['robotsFollow']
            );
        } catch (InvalidArgumentException $exception) {
            $forms['translation']['title']->addError(new FormError('The title should not be blank'));
        }
    }
}
