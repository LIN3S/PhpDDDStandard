<?php

namespace Spec\App\Application\Command\Page;

use App\Application\Command\Page\RemovePageTranslationCommand;
use App\Domain\Model\Page\Page;
use App\Domain\Model\Page\PageRepository;
use LIN3S\CMSKernel\Domain\Model\Page\PageDoesNotExistException;
use LIN3S\CMSKernel\Domain\Model\Page\PageId;
use LIN3S\CMSKernel\Domain\Model\Template\TemplateFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class RemovePageTranslationHandlerSpec extends ObjectBehavior
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

    function let(PageRepository $repository, TemplateFactory $templateFactory, RemovePageTranslationCommand $command)
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
        $command->locale()->shouldBeCalled()->willReturn($this->locale);

        $this->beConstructedWith($repository, $templateFactory);
    }

    function it_cannot_remove_translation_if_the_page_does_not_exist(
        RemovePageTranslationCommand $command,
        PageRepository $repository
    ) {
        $repository->pageOfId(PageId::generate($this->pageId))->shouldBeCalled()->willReturn(null);
        $this->shouldThrow(PageDoesNotExistException::class)->during__invoke($command);
    }

    function it_removes_a_page_translation(
        RemovePageTranslationCommand $command,
        Page $page,
        PageRepository $repository
    ) {
        $repository->pageOfId(PageId::generate($this->pageId))->shouldBeCalled()->willReturn($page);
        $page->removeTranslation($this->locale)->shouldBeCalled();
        $repository->persist(Argument::type(Page::class))->shouldBeCalled();
        $this->__invoke($command);
    }
}
