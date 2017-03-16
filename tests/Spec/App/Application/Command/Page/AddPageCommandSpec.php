<?php

namespace Spec\App\Application\Command\Page;

use LIN3S\SharedKernel\Exception\InvalidArgumentException;
use PhpSpec\ObjectBehavior;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class AddPageCommandSpec extends ObjectBehavior
{
    private $locale;
    private $title;
    private $templateName;
    private $templateContent;
    private $slug;
    private $metaTitle;
    private $metaDescription;
    private $robotsIndex;
    private $robotsFollow;

    function let()
    {
        $this->locale = 'es_ES';
        $this->title = 'The page title';
        $this->templateName = 'default';
        $this->templateContent = ['content' => '<p>Lorem ipsum</p>'];
        $this->slug = 'the-page-title';
        $this->metaTitle = 'The meta title';
        $this->metaDescription = 'The meta description';
        $this->robotsIndex = 1;
        $this->robotsFollow = 1;
    }

    function it_can_create()
    {
        $this->beConstructedWith(
            $this->locale,
            $this->title,
            $this->templateName,
            $this->templateContent,
            $this->slug,
            $this->metaTitle,
            $this->metaDescription,
            $this->robotsIndex,
            $this->robotsFollow
        );

        $this->id()->shouldReturn(null);
        $this->locale()->shouldReturn($this->locale);
        $this->title()->shouldReturn($this->title);
        $this->slug()->shouldReturn($this->slug);
        $this->templateName()->shouldReturn($this->templateName);
        $this->templateContent()->shouldReturn($this->templateContent);
        $this->metaTitle()->shouldReturn($this->metaTitle);
        $this->metaDescription()->shouldReturn($this->metaDescription);
        $this->robotsIndex()->shouldReturn($this->robotsIndex);
        $this->robotsFollow()->shouldReturn($this->robotsFollow);
    }

    function it_cannot_create_without_locale()
    {
        $this->beConstructedWith(
            null,
            $this->title,
            $this->templateName,
            $this->templateContent,
            $this->slug,
            $this->metaTitle,
            $this->metaDescription,
            $this->robotsIndex,
            $this->robotsFollow
        );

        $this->shouldThrow(new InvalidArgumentException('The locale cannot be null'))->duringInstantiation();
    }

    function it_cannot_create_without_title()
    {
        $this->beConstructedWith(
            $this->locale,
            null,
            $this->templateName,
            $this->templateContent,
            $this->slug,
            $this->metaTitle,
            $this->metaDescription,
            $this->robotsIndex,
            $this->robotsFollow
        );

        $this->shouldThrow(new InvalidArgumentException('The title cannot be null'))->duringInstantiation();
    }
}
