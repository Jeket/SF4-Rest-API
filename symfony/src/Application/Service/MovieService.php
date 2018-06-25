<?php

namespace App\Application\Service;

use App\Application\Assembler\MovieAssembler;
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
     * The Movie entity repository service.
     *
     * @var MovieRepositoryInterface
     */
    private $movieRepository;

    /**
     * The Movie assembler service.
     *
     * @var MovieAssembler
     */
    private $movieAssembler;

    /**
     * MovieService constructor.
     *
     * @param MovieRepositoryInterface $movieRepository The Movie entity repository class.
     * @param MovieAssembler           $movieAssembler  The Movie assembler service.
     */
    public function __construct(MovieRepositoryInterface $movieRepository, MovieAssembler $movieAssembler)
    {
        $this->movieRepository = $movieRepository;
        $this->movieAssembler = $movieAssembler;
    }

    /**
     * Find a movie entity for given movieId.
     *
     * @param int $movieId The movie Id.
     *
     * @return Movie       The movie entity object.
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
     * Get all movies found from base.
     *
     * @return array|null An array of movie object or empty array.
     */
    public function getAllMovies(): ?array
    {
        return $this->movieRepository->findAll();
    }

    /**
     * Add one movie from given movie DTO object.
     *
     * @param MovieDTO $movieDTO The movie DTO object.
     *
     * @return Movie             The movie entity created from DTO object.
     */
    public function addMovie(MovieDTO $movieDTO): Movie
    {
        $movie = $this->movieAssembler->createMovie($movieDTO);
        $this->movieRepository->save($movie);

        return $movie;
    }

    /**
     * Update one movie from movie DTO object.
     *
     * @param int      $movieId  The movie id to update.
     * @param MovieDTO $movieDTO The movie DTO object.
     *
     * @return Movie             The movie entity updated.
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function updateArticle(int $movieId, MovieDTO $movieDTO): Movie
    {
        $movie = $this->movieRepository->findById($movieId);
        if (!$movie) {
            throw new EntityNotFoundException(sprintf(self::MOVIE_NOT_FOUND, $movieId));
        }

        $movie = $this->movieAssembler->updateMovie($movie, $movieDTO);
        $this->movieRepository->save($movie);

        return $movie;
    }

    /**
     * Delete one movie entity.
     *
     * @param int $movieId The Id of movie to delete.
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
