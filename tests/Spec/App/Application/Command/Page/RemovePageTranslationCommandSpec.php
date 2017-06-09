<?php

namespace Spec\App\Application\Command\Page;

use LIN3S\SharedKernel\Exception\InvalidArgumentException;
use PhpSpec\ObjectBehavior;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class RemovePageTranslationCommandSpec extends ObjectBehavior
{
    private $pageId;
    private $locale;

    function let()
    {
        $this->pageId = 'page-id';
        $this->locale = 'es_ES';
    }

    function it_can_create()
    {
        $this->beConstructedWith(
            $this->pageId,
            $this->locale
        );

        $this->id()->shouldReturn($this->pageId);
        $this->locale()->shouldReturn($this->locale);
    }

    function it_cannot_create_without_page_id()
    {
        $this->beConstructedWith(
            null,
            $this->locale
        );

        $this->shouldThrow(new InvalidArgumentException('The page id cannot be null'))->duringInstantiation();
    }

    function it_cannot_create_without_locale()
    {
        $this->beConstructedWith(
            $this->pageId,
            null
        );

        $this->shouldThrow(new InvalidArgumentException('The locale cannot be null'))->duringInstantiation();
    }
}
