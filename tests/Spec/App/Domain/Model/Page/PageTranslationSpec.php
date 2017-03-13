<?php

namespace Spec\App\Domain\Model\Page;

use App\Domain\Model\Page\Template\Template;
use LIN3S\CMSKernel\Domain\Model\Page\PageTitle;
use LIN3S\CMSKernel\Domain\Model\Page\PageTranslationId;
use LIN3S\CMSKernel\Domain\Model\Seo\Metadata;
use LIN3S\CMSKernel\Domain\Model\Translation\Locale;
use LIN3S\CMSKernel\Domain\Model\Translation\Translation;
use LIN3S\SharedKernel\Domain\Model\Slug\Slug;
use PhpSpec\ObjectBehavior;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class PageTranslationSpec extends ObjectBehavior
{
    function let(PageTranslationId $id, Locale $locale, PageTitle $title, Slug $slug, Metadata $seo, Template $template)
    {
        $this->beConstructedWith($id, $locale, $title, $slug, $seo, $template);
    }

    function it_is_a_translation_instance()
    {
        $this->shouldHaveType(Translation::class);
    }

    function it_gets_properties(PageTranslationId $id, PageTitle $title, Slug $slug, Metadata $seo, Template $template)
    {
        $id->id()->shouldBeCalled()->willReturn('page-translation-id');

        $this->id()->shouldReturn($id);
        $this->title()->shouldReturn($title);
        $this->slug()->shouldReturn($slug);
        $this->seo()->shouldReturn($seo);
        $this->template()->shouldReturn($template);
        $this->id()->shouldReturn($id);
        $this->__toString()->shouldReturn('page-translation-id');
    }
}
