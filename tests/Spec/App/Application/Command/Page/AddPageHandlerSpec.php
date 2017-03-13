<?php

namespace Spec\App\Application\Command\Page;

use App\Application\Command\Page\AddPageCommand;
use App\Domain\Model\Page\Page;
use App\Domain\Model\Page\PageRepository;
use App\Domain\Model\Page\Template\Template;
use LIN3S\CMSKernel\Domain\Model\Page\PageId;
use LIN3S\CMSKernel\Domain\Model\Page\PageIsAlreadyExistsException;
use LIN3S\CMSKernel\Domain\Model\Template\TemplateFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class AddPageHandlerSpec extends ObjectBehavior
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

    function let(PageRepository $repository, TemplateFactory $templateFactory, AddPageCommand $command)
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

        $command->pageId()->shouldBeCalled()->willReturn($this->pageId);

        $this->beConstructedWith($repository, $templateFactory);
    }

    function it_cannot_add_page_when_page_is_already_exists(
        AddPageCommand $command,
        PageRepository $repository,
        Page $page
    ) {
        $repository->pageOfId(PageId::generate($this->pageId))->shouldBeCalled()->willReturn($page);
        $this->shouldThrow(PageIsAlreadyExistsException::class)->during__invoke($command);
    }

    function it_adds_a_page(
        AddPageCommand $command,
        TemplateFactory $templateFactory,
        Template $template,
        PageRepository $repository
    ) {
        $repository->pageOfId(PageId::generate($this->pageId))->shouldBeCalled()->willReturn(null);

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
