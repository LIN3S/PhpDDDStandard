<?php

namespace Spec\App\Domain\Model\Page\Template;

use App\Domain\Model\Page\PageTranslation;
use LIN3S\CMSKernel\Domain\Model\Template\Template;
use Tests\Double\App\Domain\Model\Page\Template\TemplateStub;
use PhpSpec\ObjectBehavior;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class TemplateSpec extends ObjectBehavior
{
    function let()
    {
        $this->beAnInstanceOf(TemplateStub::class);
    }

    function it_implements_template()
    {
        $this->shouldImplement(Template::class);
    }

    function it_gets_to_string_related_with_the_id()
    {
        $this->id()->shouldReturn(123);
        $this->__toString()->shouldReturn('123');
    }

    function it_can_mutate_the_page_translation_because_the_doctrine_limitation(PageTranslation $pageTranslation)
    {
        $this->pageTranslation()->shouldReturn(null);
        $this->setPageTranslation($pageTranslation);
        $this->pageTranslation()->shouldReturn($pageTranslation);
    }
}
