<?php

namespace App\Application\Service;

use App\Application\DTO\MovieDTO;
use App\Domain\Model\Movie\Movie;
use App\Domain\Model\Movie\MovieRepositoryInterface;
use App\Infrastructure\Repository\MovieRepository;
use Doctrine\ORM\EntityNotFoundException;

/**
 * Class MovieService
 * @package App\Application\Service
 */
final class MovieService
{

    const MOVIE_NOT_FOUND = "Movie with id %u does not exist!";

    /**
     * @var MovieRepository
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
     * @param MovieDTO $movieDTO (You can also use DTO).
     *
     * @return Movie
     */
    public function addMovie(MovieDTO $movieDTO): Movie
    {
        $movie = $this->setMovieField(new Movie(), $movieDTO);
        $this->movieRepository->save($movie);

        return $movie;
    }

    /**
     * @param int      $movieId
     * @param MovieDTO $movieDTO
     *
     * @return Movie
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function updateArticle(int $movieId, MovieDTO $movieDTO): Movie
    {
        $movie = $this->movieRepository->findById($movieId);
        if (!$movie) {
            throw new EntityNotFoundException(sprintf(self::MOVIE_NOT_FOUND, $movieId));
        }

        $movie = $this->setMovieField($movie, $movieDTO);
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

    /**
     * Set the data for given Movie entity.
     *
     * @param Movie $movie
     * @param MovieDTO $movieDTO
     *
     * @return \App\Domain\Model\Movie\Movie
     * @TODO Use Assembler instead of that method.
     */
    private function setMovieField(Movie $movie, MovieDTO $movieDTO)
    {
        $movie
          ->setTitle($movieDTO->getTitle())
          ->setYear($movieDTO->getYear())
          ->setTime($movieDTO->getTime())
          ->setDescription($movieDTO->getDescription());

        return $movie;
    }
}
