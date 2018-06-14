<?php
namespace App\Service;

use App\Entity\Movie;
use App\Repository\MovieRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;

/**
 * Class MovieService
 * @package App\Service
 */
final class MovieService
{

    const MOVIE_NOT_FOUND = "Movie with id %u does not exist!";

    /**
     * @var MovieRepositoryInterface
     */
    private $movieRepository;

    /**
     * MovieService constructor.
     * @param MovieRepositoryInterface $movieRepository
     */
    public function __construct(MovieRepositoryInterface $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    /**
     * @param int $movieId
     * @return Movie
     * @throws EntityNotFoundException
     */
    public function getMovie(int $movieId): Movie
    {
        $movie = $this->movieRepository->findById($movieId);
        if (!$movie) {
            throw new EntityNotFoundException(sprintf(self::MOVIE_NOT_FOUND, $movieId));
        }

        return $movie;
    }

    /**
     * @return array|null
     */
    public function getAllMovies(): ?array
    {
        return $this->movieRepository->findAll();
    }

    /**
     * @param array $movieData (You can also use DTO).
     * @return Movie
     */
    public function addMovie(array $movieData): Movie
    {
        $movie = new Movie();
        $movie
          ->setTitle($movieData['title'])
          ->setYear($movieData['year'])
          ->setTime($movieData['time'])
          ->setDescription($movieData['description']);

        $this->movieRepository->save($movie);

        return $movie;
    }

    /**
     * @param int   $movieId
     * @param array $movieData
     *
     * @return Movie
     * @throws EntityNotFoundException
     */
    public function updateArticle(int $movieId, array $movieData): Movie
    {
        $movie = $this->movieRepository->findById($movieId);
        if (!$movie) {
            throw new EntityNotFoundException(sprintf(self::MOVIE_NOT_FOUND, $movieId));
        }

        $movie
          ->setTitle($movieData['title'])
          ->setYear($movieData['year'])
          ->setTime($movieData['time'])
          ->setDescription($movieData['description']);

        $this->movieRepository->save($movie);

        return $movie;
    }

    /**
     * @param int $movieId
     * @throws EntityNotFoundException
     */
    public function deleteMovie(int $movieId): void
    {
        $movie = $this->movieRepository->findById($movieId);
        if (!$movie) {
            throw new EntityNotFoundException(sprintf(self::MOVIE_NOT_FOUND, $movieId));
        }

        $this->movieRepository->delete($movie);
    }
}
