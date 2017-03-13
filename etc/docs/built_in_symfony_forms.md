#Built-in Symfony forms

This package provides some ready to use Symfony forms:

```bash
LIN3S\CMSKernel\Infrastructure\Symfony\Form\Type\SeoType
LIN3S\CMSKernel\Infrastructure\Symfony\Form\Type\WysiwygType
LIN3S\CMSKernel\Infrastructure\Symfony\Form\Type\TemplateSelectorType *
```

```php
// App/Infrastructure/Symfony/Form/Type/YourAwesomeFormType.php

(...)

public function buildForm(FormBuilderInterface $builder, array $options)
{
    $builder
        ->add('seo', SeoType::class)
        ->add('content', WysiwygType::class);
}
```

The template selector type has more complex behaviour so check it out its concrete [chapter](symfony_form_template_selector.md).

- Back to the [index](index.md).
