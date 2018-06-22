<?php

namespace App\Domain\Model\Movie;

/**
 * Interface MovieInterface.
 *
 * @package App\Domain\Model\Movie
 */
interface MovieInterface
{
    /**
     * Get title of movie.
     *
     * @return null|string
     */
    public function getTitle(): ?string;

    /**
     * Get year of publication.
     *
     * @return int|null
     */
    public function getYear(): ?int;

    /**
     * Get the duration of movie.
     *
     * @return int|null
     */
    public function getTime(): ?int;

    /**
     * Get the description of movie.
     *
     * @return null|string
     */
    public function getDescription(): ?string;
}