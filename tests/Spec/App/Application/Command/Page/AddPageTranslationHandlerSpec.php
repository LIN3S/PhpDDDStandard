<?php

namespace Spec\App\Application\Command\Page;

use App\Application\Command\Page\AddPageTranslationCommand;
use App\Domain\Model\Page\Page;
use App\Domain\Model\Page\PageRepository;
use App\Domain\Model\Page\Template\Template;
use LIN3S\CMSKernel\Domain\Model\Page\PageDoesNotExistException;
use LIN3S\CMSKernel\Domain\Model\Page\PageId;
use LIN3S\CMSKernel\Domain\Model\Template\TemplateFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class AddPageTranslationHandlerSpec extends ObjectBehavior
{
    private $pageId;
    private $locale;
    private $title;
    private $templateName;
    private $templateContent;
    private $slug;
    private $metaTitle;
    private $metaDescription;
    private $robotsIndex;
    private $robotsFollow;

    function let(PageRepository $repository, TemplateFactory $templateFactory, AddPageTranslationCommand $command)
    {
        $this->pageId = 'page-id';
        $this->locale = 'es_ES';
        $this->title = 'The page title';
        $this->templateName = 'default';
        $this->templateContent = ['content' => '<p>Lorem ipsum</p>'];
        $this->slug = 'the-page-title';
        $this->metaTitle = 'The meta title';
        $this->metaDescription = 'The meta description';
        $this->robotsIndex = 1;
        $this->robotsFollow = 1;

        $command->id()->shouldBeCalled()->willReturn($this->pageId);

        $this->beConstructedWith($repository, $templateFactory);
    }

    function it_cannot_add_translation_if_the_page_does_not_exist(
        AddPageTranslationCommand $command,
        PageRepository $repository
    ) {
        $repository->pageOfId(PageId::generate($this->pageId))->shouldBeCalled()->willReturn(null);
        $this->shouldThrow(PageDoesNotExistException::class)->during__invoke($command);
    }

    function it_adds_a_page_translation(
        AddPageTranslationCommand $command,
        Page $page,
        TemplateFactory $templateFactory,
        Template $template,
        PageRepository $repository
    ) {
        $repository->pageOfId(PageId::generate($this->pageId))->shouldBeCalled()->willReturn($page);

        $command->locale()->shouldBeCalled()->willReturn($this->locale);
        $command->title()->shouldBeCalled()->willReturn($this->title);
        $command->slug()->shouldBeCalled()->willReturn($this->slug);
        $command->metaTitle()->shouldBeCalled()->willReturn($this->metaTitle);
        $command->metaDescription()->shouldBeCalled()->willReturn($this->metaDescription);
        $command->robotsIndex()->shouldBeCalled()->willReturn(true);
        $command->robotsFollow()->shouldBeCalled()->willReturn(true);
        $command->templateName()->shouldBeCalled()->willReturn($this->templateName);
        $command->templateContent()->shouldBeCalled()->willReturn($this->templateContent);

        $templateFactory->build($this->templateName, $this->templateContent)->shouldBeCalled()->willReturn($template);

        $repository->persist(Argument::type(Page::class))->shouldBeCalled();
        $this->__invoke($command);
    }
}
