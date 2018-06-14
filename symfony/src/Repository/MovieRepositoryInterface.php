<?php

namespace App\Repository;

use App\Entity\Movie;

/**
 * Interface MovieRepositoryInterface
 * @package App\Repository
 */
interface MovieRepositoryInterface
{
    /**
     * @param int $movieId
     * @return Movie
     */
    public function findById(int $movieId): ?Movie;

    /**
     * @param string $title
     * @return Movie
     */
    public function findOneByTitle(string $title): ?Movie;

    /**
     * @param Movie $movie
     */
    public function save(Movie $movie): void;

    /**
     * @param Movie $movie
     */
    public function delete(Movie $movie): void;
}
