<?php

namespace Spec\App\Domain\Model\Page\Template;

use App\Domain\Model\Location\Address;
use LIN3S\CMSKernel\Domain\Model\Template\Template;
use LIN3S\CMSKernel\Domain\Model\Template\TemplateContent;
use PhpSpec\ObjectBehavior;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class ContactTemplateSpec extends ObjectBehavior
{
    function let(TemplateContent $content)
    {
        $content->get('street')->willReturn('Uribitarte 6');
        $content->get('postal_code')->willReturn('48001');
        $content->get('city')->willReturn('Bilbao');
        $this->beConstructedFromContent($content);
    }

    function it_implements_lin3s_cms_kernel_template()
    {
        $this->shouldImplement(Template::class);
    }

    function it_returns_contact_as_name()
    {
        $this::name()->shouldReturn('contact');
    }

    function it_gets_address()
    {
        $this->address()->shouldReturnAnInstanceOf(Address::class);
    }

    function it_can_serialize()
    {
        $this->serialize()->shouldReturn([
            'street'      => 'Uribitarte 6',
            'postal_code' => '48001',
            'city'        => 'Bilbao',
        ]);
    }
}
