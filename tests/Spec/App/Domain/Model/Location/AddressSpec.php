<?php

namespace Spec\App\Domain\Model\Location;

use LIN3S\SharedKernel\Exception\DomainException;
use PhpSpec\ObjectBehavior;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class AddressSpec extends ObjectBehavior
{
    private $street;
    private $postalCode;
    private $city;

    function let()
    {
        $this->street = 'Uribitarte 6 left';
        $this->postalCode = '48001';
        $this->city = 'Bilbao';
    }

    function it_can_create_address()
    {
        $this->beConstructedWith($this->street, $this->postalCode, $this->city);

        $this->street()->shouldReturn($this->street);
        $this->postalCode()->shouldReturn($this->postalCode);
        $this->city()->shouldReturn($this->city);
    }

    function it_cannot_create_address_without_street()
    {
        $this->beConstructedWith(null, $this->postalCode, $this->city);

        $this->shouldThrow(new DomainException('The given street cannot be empty'))->duringInstantiation();
    }

    function it_cannot_create_address_without_postal_code()
    {
        $this->beConstructedWith($this->street, null, $this->city);

        $this->shouldThrow(new DomainException('The given postal code cannot be empty'))->duringInstantiation();
    }

    function it_cannot_create_address_without_city()
    {
        $this->beConstructedWith($this->street, $this->postalCode, null);

        $this->shouldThrow(new DomainException('The given city cannot be empty'))->duringInstantiation();
    }
}
