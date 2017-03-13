<?php

namespace Spec\App\Domain\Model\Page\Template;

use App\Domain\Model\Location\Address;
use LIN3S\CMSKernel\Domain\Model\Template\Template;
use LIN3S\CMSKernel\Domain\Model\Template\TemplateContent;
use PhpSpec\ObjectBehavior;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class DefaultTemplateSpec extends ObjectBehavior
{
    function let(TemplateContent $content)
    {
        $content->get('content')->willReturn('<p>Lorem ipsum</p>');
        $this->beConstructedFromContent($content);
    }

    function it_implements_lin3s_cms_kernel_template()
    {
        $this->shouldImplement(Template::class);
    }

    function it_returns_contact_as_name()
    {
        $this::name()->shouldReturn('default');
    }

    function it_gets_the_content()
    {
        $this->content()->shouldReturn('<p>Lorem ipsum</p>');
    }

    function it_can_serialize()
    {
        $this->serialize()->shouldReturn([
            'content' => '<p>Lorem ipsum</p>',
        ]);
    }
}
