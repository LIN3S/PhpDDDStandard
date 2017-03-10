<?php

/*
 * This file is part of the Php DDD Standard project.
 *
 * Copyright (c) 2017 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Domain\Model\Page\Template;

use App\Domain\Model\Location\Address;
use LIN3S\CMSKernel\Domain\Model\Template\TemplateContent;
use LIN3S\CMSKernel\Domain\Model\Template\TemplateId;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
final class ContactTemplate extends Template
{
    private $address;

    private function __construct(TemplateId $id, Address $address)
    {
        $this->id = $id;
        $this->address = $address;
    }

    public static function fromContent(TemplateContent $content)
    {
        return new self(
            TemplateId::generate(),
            new Address(
                $content->get('street'),
                $content->get('postal_code'),
                $content->get('city')
            )
        );
    }

    public function serialize()
    {
        return [
            'street'      => $this->address->street(),
            'postal_code' => $this->address->postalCode(),
            'city'        => $this->address->city(),
        ];
    }

    public function address()
    {
        return $this->address;
    }

    public static function name()
    {
        return 'contact';
    }
}
