<?php

namespace App\Application\Service;

use App\Application\Assembler\PersonAssembler;
use App\Application\DTO\PersonDTO;
use App\Domain\Model\Person\Person;
use App\Domain\Model\Person\PersonRepositoryInterface;
use App\Infrastructure\Repository\PersonRepository;
use Doctrine\ORM\EntityNotFoundException;

/**
 * Class PersonService
 * @package App\Service
 */
final class PersonService
{

    const PERSON_NOT_FOUND = "Person with id %u does not exist!";

    /**
     * The Person entity repository service.
     *
     * @var PersonRepositoryInterface
     */
    private $personRepository;

    /**
     * The Person assembler service.
     *
     * @var PersonAssembler
     */
    private $personAssembler;

    /**
     * MovieService constructor.
     *
     * @param PersonRepositoryInterface $personRepository The Person entity repository class.
     * @param PersonAssembler           $personAssembler  The Person assembler service.
     */
    public function __construct(PersonRepositoryInterface $personRepository, PersonAssembler $personAssembler)
    {
        $this->personRepository = $personRepository;
        $this->personAssembler = $personAssembler;
    }

    /**
     * Find a Person entity for given movieId.
     *
     * @param int $personId The person Id.
     *
     * @return Person       The person entity object.
     * @throws EntityNotFoundException
     */
    public function getPerson(int $personId): Person
    {
        $person = $this->personRepository->findById($personId);
        if (!$person) {
            throw new EntityNotFoundException(sprintf(self::PERSON_NOT_FOUND, $personId));
        }

        return $person;
    }

    /**
     * Get all person found from base.
     *
     * @return array|null An array of person object or empty array.
     */
    public function getAllPersons(): ?array
    {
        return $this->personRepository->findAll();
    }

    /**
     * Add one person from given person DTO object.
     *
     * @param PersonDTO $personDTO The movie DTO object.
     *
     * @return Person              The person entity created from DTO object.
     */
    public function addPerson(PersonDTO $personDTO): Person
    {
        $person = $this->personAssembler->createPerson($personDTO);
        $this->personRepository->save($person);

        return $person;
    }

    /**
     * Update one person from person DTO object.
     *
     * @param int       $personId  The person id to update.
     * @param PersonDTO $personDTO The person DTO object.
     *
     * @return Person              The person entity updated.
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function updatePerson(int $personId, PersonDTO $personDTO): Person
    {
        $person = $this->personRepository->findById($personId);
        if (!$person) {
            throw new EntityNotFoundException(sprintf(self::PERSON_NOT_FOUND, $personId));
        }

        $person = $this->personAssembler->updatePerson($person, $personDTO);
        $this->personRepository->save($person);

        return $person;
    }

    /**
     * Delete one person entity.
     *
     * @param int $personId The Id of person to delete.
     * @throws EntityNotFoundException
     */
    public function deletePerson(int $personId): void
    {
        $person = $this->personRepository->findById($personId);
        if (!$person) {
            throw new EntityNotFoundException(sprintf(self::PERSON_NOT_FOUND, $personId));
        }

        $this->personRepository->delete($person);
    }
}
