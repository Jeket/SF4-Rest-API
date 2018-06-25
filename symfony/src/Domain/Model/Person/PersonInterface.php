<?php

namespace App\Domain\Model\Person;

use DateTimeInterface;

/**
 * Interface PersonInterface.
 *
 * @package App\Domain\Model\Person
 */
interface PersonInterface
{
    /**
     * Get the first name of person.
     *
     * @return null|string
     */
    public function getFirstName(): ?string;

    /**
     * Get the last name of person.
     *
     * @return null|string
     */
    public function getLastName(): ?string;

    /**
     * Get the birthday date of person.
     *
     * @return DateTimeInterface
     */
    public function getBirthday(): ?\DateTimeInterface;
}
