<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Movie\Movie;
use App\Domain\Model\Movie\MovieRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Movie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Movie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Movie[]    findAll()
 * @method Movie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class MovieRepository extends ServiceEntityRepository implements MovieRepositoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Movie::class);
    }

    /**
     * {@inheritdoc}
     */
    public function findById(int $movieId): ?Movie
    {
        $movie = $this->find($movieId);

        return $movie;
    }

    /**
     * {@inheritdoc}
     */
    public function findOneByTitle(string $title): Movie
    {
        $movie = $this->findBy(['title' => $title]);

        return $movie;
    }

    /**
     * {@inheritdoc}
     */
    public function save(Movie $movie): void
    {
        $this->_em->persist($movie);
        $this->_em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function delete(Movie $movie): void
    {
        $this->_em->remove($movie);
        $this->_em->flush();
    }
}
