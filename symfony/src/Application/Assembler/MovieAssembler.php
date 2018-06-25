<?php

namespace App\Application\Assembler;

use App\Application\DTO\MovieDTO;
use App\Domain\Model\Movie\Movie;

/**
 * Class MovieAssembler
 * @package App\Application\Assembler
 */
final class MovieAssembler
{
    /**
     * Read and manipulate movie entity from given DTO object.
     *
     * @param MovieDTO   $movieDTO The DTO object representing movie entity.
     * @param Movie|null $movie    The movie entity to update if set.
     *
     * @return Movie     The movie entity updated or created.
     */
    public function readDTO(MovieDTO $movieDTO, ?Movie $movie = null): Movie
    {
        if (!$movie) {
            $movie = new Movie();
        }

        $movie
          ->setTitle($movieDTO->getTitle())
          ->setYear($movieDTO->getYear())
          ->setTime($movieDTO->getTime())
          ->setDescription($movieDTO->getDescription());

        return $movie;
    }

    /**
     * Update movie entity with given DTO object.
     *
     * @param Movie    $movie    The movie entity to update.
     * @param MovieDTO $movieDTO The DTO object to manage our entity.
     *
     * @return Movie   The movie entity updated from DTO object.
     */
    public function updateMovie(Movie $movie, MovieDTO $movieDTO): Movie
    {
        return $this->readDTO($movieDTO, $movie);
    }

    /**
     * Create new movie entity from given DTO movie object.
     *
     * @param MovieDTO $movieDTO The DTO object contain all data to build movie.
     *
     * @return Movie             The movie entity created from DTO data.
     */
    public function createMovie(MovieDTO $movieDTO): Movie
    {
        return $this->readDTO($movieDTO);
    }

    /**
     * Set new person DTO object from existing movie entity.
     *
     * @param Movie $movie Movie entity to build person DTO.
     *
     * @return MovieDTO    DTO object representing given movie entity.
     */
    public function writeDTO(Movie $movie): MovieDTO
    {
        return new MovieDTO(
            $movie->getTitle(),
            $movie->getYear(),
            $movie->getTime(),
            $movie->getDescription()
        );
    }
}
