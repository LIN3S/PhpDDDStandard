<?php

namespace Spec\App\Domain\Model\Page;

use App\Domain\Model\Page\PageTranslation;
use LIN3S\CMSKernel\Domain\Model\Page\PageId;
use LIN3S\CMSKernel\Domain\Model\Translation\Translatable;
use PhpSpec\ObjectBehavior;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class PageSpec extends ObjectBehavior
{
    function let(PageId $id, PageTranslation $translation)
    {
        $this->beConstructedWith($id, $translation);
    }

    function it_is_a_translatable_instance()
    {
        $this->shouldHaveType(Translatable::class);
    }

    function it_gets_properties(PageId $id)
    {
        $id->id()->shouldBeCalled()->willReturn('page-id');

        $this->id()->shouldReturn($id);
        $this->createdOn()->shouldReturnAnInstanceOf(\DateTimeInterface::class);
        $this->updatedOn()->shouldReturnAnInstanceOf(\DateTimeInterface::class);
        $this->id()->shouldReturn($id);
        $this->__toString()->shouldReturn('page-id');
    }
}
