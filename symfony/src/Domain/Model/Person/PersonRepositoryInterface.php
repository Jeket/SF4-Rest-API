<?php

namespace App\Domain\Model\Person;

/**
 * Interface PersonRepositoryInterface
 * @package App\Repository
 */
interface PersonRepositoryInterface
{
    /**
     * @param int $personId
     * @return Person
     */
    public function findById(int $personId): ?Person;

    /**
     * @param string $firstName
     * @return Person
     */
    public function findOneByName(string $firstName): ?Person;

    /**
     * @param Person $person
     */
    public function save(Person $person): void;

    /**
     * @param Person $person
     */
    public function delete(Person $person): void;
}
