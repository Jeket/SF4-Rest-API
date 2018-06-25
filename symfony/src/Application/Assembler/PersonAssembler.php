<?php

namespace App\Application\Assembler;

use App\Application\DTO\PersonDTO;
use App\Domain\Model\Person\Person;

/**
 * Class PersonAssembler
 * @package App\Application\Assembler
 */
final class PersonAssembler
{
    /**
     * Read and manipulate person entity from given DTO object.
     *
     * @param PersonDTO   $personDTO The DTO object representing person entity.
     * @param Person|null $person    The person entity to update if set.
     *
     * @return Person     The person entity updated or created.
     */
    public function readDTO(PersonDTO $personDTO, ?Person $person = null): Person
    {
        if (!$person) {
            $person = new Person();
        }

        $person
          ->setFirstName($personDTO->getFirstName())
          ->setLastName($personDTO->getLastName())
          ->setBirthday($personDTO->getBirthday());

        return $person;
    }

    /**
     * Update person entity with given DTO object.
     *
     * @param Person    $person    The person entity to update.
     * @param PersonDTO $personDTO The DTO object to manage our entity.
     *
     * @return Person   The person entity updated from DTO object.
     */
    public function updatePerson(Person $person, PersonDTO $personDTO): Person
    {
        return $this->readDTO($personDTO, $person);
    }

    /**
     * Create new person entity from given DTO person object.
     *
     * @param PersonDTO $personDTO The DTO object contain all data to build person.
     *
     * @return Person              The person entity created from DTO data.
     */
    public function createPerson(PersonDTO $personDTO): Person
    {
        return $this->readDTO($personDTO);
    }

    /**
     * Set new person DTO object from existing person entity.
     *
     * @param Person $person Person entity to build person DTO.
     *
     * @return PersonDTO     DTO object representing given person entity.
     */
    public function writeDTO(Person $person): PersonDTO
    {
        return new PersonDTO(
            $person->getFirstName(),
            $person->getLastName(),
            $person->getBirthday()
        );
    }
}
