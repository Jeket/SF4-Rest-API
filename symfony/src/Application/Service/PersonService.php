<?php

namespace App\Application\Service;

use App\Domain\Model\Person\Person;
use App\Domain\Model\Person\PersonRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;

/**
 * Class PersonService
 * @package App\Service
 */
final class PersonService
{

    const PERSON_NOT_FOUND = "Person with id %u does not exist!";

    /**
     * @var PersonRepositoryInterface
     */
    private $personRepository;

    /**
     * MovieService constructor.
     *
     * @param PersonRepositoryInterface $personRepository
     */
    public function __construct(PersonRepositoryInterface $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    /**
     * @param int $personId
     *
     * @return Person
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
     * @return array|null
     */
    public function getAllPersons(): ?array
    {
        return $this->personRepository->findAll();
    }

    /**
     * @param array $personData (You can also use DTO).
     * @return Person
     */
    public function addPerson(array $personData): Person
    {
        $person = new Person();
        $person
          ->setFirstName($personData['firstname'])
          ->setLastName($personData['lastname'])
          ->setBirthday($personData['birthday']);

        $this->personRepository->save($person);

        return $person;
    }

    /**
     * @param int   $personId
     * @param array $personData
     *
     * @return Person
     * @throws EntityNotFoundException
     */
    public function updateArticle(int $personId, array $personData): Person
    {
        $person = $this->personRepository->findById($personId);
        if (!$person) {
            throw new EntityNotFoundException(sprintf(self::PERSON_NOT_FOUND, $personId));
        }

        $person
          ->setFirstName($personData['firstname'])
          ->setLastName($personData['lastname'])
          ->setBirthday(new \DateTime($personData['birthday']));

        $this->personRepository->save($person);

        return $person;
    }

    /**
     * @param int $personId
     * @throws EntityNotFoundException
     */
    public function deleteMovie(int $personId): void
    {
        $person = $this->personRepository->findById($personId);
        if (!$person) {
            throw new EntityNotFoundException(sprintf(self::PERSON_NOT_FOUND, $personId));
        }

        $this->personRepository->delete($person);
    }
}
