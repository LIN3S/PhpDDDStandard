#Configure and usage the Template Selector Type

This chapter explains the configuration and usage process of this kind of form type:

**1.** Firstly, create the domain model according to the requirements, for example:

```php
// App/Domain/Model/Page/Template/DefaultTemplate.php

<?php

namespace App\Domain\Model\Page\Template;

use LIN3S\CMSKernel\Domain\Model\Template\TemplateContent;
use LIN3S\CMSKernel\Domain\Model\Template\TemplateId;
use LIN3S\CMSKernel\Domain\Model\Template\Template;

final class DefaultTemplate implements Template
{
    private $id;
    private $content;
    private $page;

    private function __construct(TemplateId $id, $content)
    {
        $this->id = $id;
        $this->content = $content;
    }

    public static function fromContent(TemplateContent $content)
    {
        return new self(
            TemplateId::generate(),
            $content->get('content')
        );
    }

    public function serialize()
    {
        return [
            'content' => $this->content,
        ];
    }
    
    public function id()
    {
        return $this->id;
    }

    public function content()
    {
        return $this->content;
    }
    
    public function page()
    {
        return $this->page;
    }
    
    // This is a hack to satisfy the Doctrine ORM
    // limitations with bidirectional relationships.
    public function setPage(Page $page)
    {
        $this->page = $page;
    }

    public static function name()
    {
        return 'default';
    }
    
    public function __toString()
    {
        return (string)$this->id;
    }
}
```

```php
// App/Domain/Model/Page/Template/OtherTemplate.php

<?php

namespace App\Domain\Model\Page\Template;

use LIN3S\CMSKernel\Domain\Model\Template\TemplateContent;
use LIN3S\CMSKernel\Domain\Model\Template\TemplateId;
use LIN3S\CMSKernel\Domain\Model\Template\Template;

final class OtherTemplate implements Template
{
    private $id;
    private $subtitle;
    private $page;

    private function __construct(TemplateId $id, $subtitle)
    {
        $this->id = $id;
        $this->subtitle = $subtitle;
    }

    public static function fromContent(TemplateContent $content)
    {
        return new self(
            TemplateId::generate(),
            $content->get('subtitle')
        );
    }

    public function serialize()
    {
        return [
            'subtitle' => $this->subtitle,
        ];
    }
    
    public function id()
    {
        return $this->id;
    }

    public function subtitle()
    {
        return $this->subtitle;
    }
    
    public function page()
    {
        return $this->page;
    }
    
    // This is a hack to satisfy the Doctrine ORM
    // limitations with bidirectional relationships.
    public function setPage(Page $page)
    {
        $this->page = $page;
    }

    public static function name()
    {
        return 'other';
    }
    
    public function __toString()
    {
        return (string)$this->id;
    }
}
```
Also define its use inside your current resource:

```php
// App/Domain/Model/Page/Page.php

<?php

namespace App\Domain\Model\Page\Page;

class Page
{
    private $id;
    private $template;
    
    public function __construct(PageId $id, Template $template)
    {
        $this->id = $id;
        $this->setTemplate($template);
    }

    private function setTemplate(Template $template)
    {
        $template->setPage($this);
        $this->template = $template;
    }
}
```

**2.** Declare form types:
```php
// App/Domain/Model/Page/DefaultTemplateType.php

<?php

namespace App\Infrastructure\Symfony\Form\Type\Page\Template;

use LIN3S\CMSKernel\Infrastructure\Symfony\Form\Type\TemplateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class DefaultTemplateType extends TemplateType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('content', TextType::class);
    }
}
```

```php
// App/Domain/Model/Page/OtherTemplateType.php

<?php

namespace App\Infrastructure\Symfony\Form\Type\Page\Template;

use LIN3S\CMSKernel\Infrastructure\Symfony\Form\Type\TemplateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class OtherTemplateType extends TemplateType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('subtitle', TextType::class);
    }
}
```
**3.** Use the template selector form type in your resource form type. 
```php
// App/Infrastructure/Symfony/Form/Type/PageType.php

(...)

public function buildForm(FormBuilderInterface $builder, array $options)
{
    $builder->add('templateSelector', TemplateSelectorType::class, [
        'templates' => [
            [
                'type'    => DefaultTemplateType::class,
                'options' => [
                    'template' => DefaultTemplate::class,
                    'label'    => 'Default',
                ],
            ],
            [
                'type'    => OtherTemplateType::class,
                'options' => [
                    'template' => OtherTemplate::class,
                    'label'    => 'Other',
                ],
            ],
        ],
    ]);
}
```

**4.** Finally, declare the class map inside the configuration tree.
```yml
# src/App/Infrastructure/Symfony/Framework/config/admin.yml

lin3s_cms_kernel:
    templates:
        class_map:
            page:
                - App\Domain\Model\Page\Template\DefaultTemplate
                - App\Domain\Model\Page\Template\OtherTemplate

```
This, allows to use the template factory inside the command handler:
```php

// App/Application/Command/AddPageHandler.php

public function __construct(PageRepository $repository, TemplateFactory $templateFactory)
{
    $this->repository = $repository;
    $this->templateFactory = $templateFactory;
}

public function __invoke(AddPageCommand $command)
{
    $templateName = ...;
    $templateContent = ...;

    $template = $this->templateFactory->build($templateName, $templateContent);
}
```
```yml
# App/Infrastructure/Symfony/Framework/config/services/command/page.yml

services:
    app.application.command_handler.add_page:
        class: App/Application/Command/AddPageHandler
        arguments:
            - "@app.repository.page"
            - "@lin3s_cms_kernel.page.template_factory"
        tags:
            -
                name: command_handler
                handles: App\Application\Command\AddPageCommand
```

- Back to the [index](index.md).
