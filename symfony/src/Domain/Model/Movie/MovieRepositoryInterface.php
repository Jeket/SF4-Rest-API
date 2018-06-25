<?php

namespace App\Domain\Model\Movie;

/**
 * Interface MovieRepositoryInterface
 * @package App\Repository
 */
interface MovieRepositoryInterface
{
    /**
     * Find movie entity by unique identifier.
     *
     * @param int $movieId The Id of movie to found.
     *
     * @return Movie|null  The movie entity found for given Id.
     */
    public function findById(int $movieId): ?Movie;

    /**
     * Find movie entity by title field.
     *
     * @param string $title The title of movie.
     *
     * @return Movie|null   The movie entity found by given title.
     */
    public function findOneByTitle(string $title): ?Movie;

    /**
     * Save given movie entity with entityManager.
     *
     * @param Movie $movie The movie entity to save.
     */
    public function save(Movie $movie): void;

    /**
     * Delete given movie entity from database.
     *
     * @param Movie $movie The movie entity to delete.
     */
    public function delete(Movie $movie): void;
}
