<?php

namespace App\Domain\Model\Person;

/**
 * Interface PersonRepositoryInterface
 * @package App\Repository
 */
interface PersonRepositoryInterface
{
    /**
     * Find person entity by unique identifier.
     *
     * @param int $personId The Id of person to found.
     *
     * @return Person|null  The person entity found for given Id.
     */
    public function findById(int $personId): ?Person;

    /**
     * Find person entity by firstName field.
     *
     * @param string $firstName The firstName of person entity.
     *
     * @return Person|null      The person entity found by given name.
     */
    public function findOneByName(string $firstName): ?Person;

    /**
     * Save given person entity with entityManager.
     *
     * @param Person $person The person entity to save.
     */
    public function save(Person $person): void;

    /**
     * Delete given person entity from database.
     *
     * @param Person $person The person entity to delete.
     */
    public function delete(Person $person): void;
}
