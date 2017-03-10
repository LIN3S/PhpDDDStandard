<?php

/*
 * This file is part of the Php DDD Standard project.
 *
 * Copyright (c) 2017 LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Domain\Model\Location;

use LIN3S\SharedKernel\Exception\DomainException;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class Address
{
    private $street;
    private $postalCode;
    private $city;

    public function __construct($street, $postalCode, $city)
    {
        $this->setStreet($street);
        $this->setPostalCode($postalCode);
        $this->setCity($city);
    }

    private function setStreet($street)
    {
        $this->checkStreetIsValid($street);
        $this->street = $street;
    }

    private function checkStreetIsValid($street)
    {
        if (null === $street || '' === $street) {
            throw new DomainException('The given street cannot be empty');
        }
    }

    private function setPostalCode($postalCode)
    {
        $this->checkPostalCodeIsValid($postalCode);
        $this->postalCode = $postalCode;
    }

    private function checkPostalCodeIsValid($postalCode)
    {
        if (null === $postalCode || '' === $postalCode) {
            throw new DomainException('The given postal code cannot be empty');
        }
    }

    private function setCity($city)
    {
        $this->checkCityIsValid($city);
        $this->city = $city;
    }

    private function checkCityIsValid($city)
    {
        if (null === $city || '' === $city) {
            throw new DomainException('The given city cannot be empty');
        }
    }

    public function street()
    {
        return $this->street;
    }

    public function postalCode()
    {
        return $this->postalCode;
    }

    public function city()
    {
        return $this->city;
    }

    public function __toString()
    {
        return $this->street . '. ' . $this->postalCode - ' - ' . $this->city;
    }
}
