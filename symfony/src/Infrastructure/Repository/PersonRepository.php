<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Person\PersonRepositoryInterface;
use App\Domain\Model\Person\Person;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Person|null find($id, $lockMode = null, $lockVersion = null)
 * @method Person|null findOneBy(array $criteria, array $orderBy = null)
 * @method Person[]    findAll()
 * @method Person[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonRepository extends ServiceEntityRepository implements PersonRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Person::class);
    }

    /**
     * {@inheritdoc}
     */
    public function findById(int $personId): ?Person
    {
        $movie = $this->find($personId);

        return $movie;
    }

    /**
     * {@inheritdoc}
     */
    public function findOneByName(string $firstName): Person
    {
        $person = $this->findBy(['title' => $firstName]);

        return $person;
    }

    /**
     * {@inheritdoc}
     */
    public function save(Person $person): void
    {
        $this->_em->persist($person);
        $this->_em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function delete(Person $person): void
    {
        $this->_em->remove($person);
        $this->_em->flush();
    }
}
