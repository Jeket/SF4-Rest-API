<?php

namespace App\Application\DTO;

use App\Domain\Model\Movie\MovieInterface;
use JMS\Serializer\Annotation\Type;

/**
 * Movie Data Transfer Object.
 */
final class MovieDTO implements MovieInterface
{
    /**
     * The title of movie.
     *
     * @var string
     * @Type("string")
     */
    private $title;

    /**
     * The year of publication of movie.
     *
     * @var int
     * @Type("int")
     */
    private $year;

    /**
     * The duration of movie.
     *
     * @var int
     * @Type("int")
     */
    private $time;

    /**
     * The description of movie.
     *
     * @var string
     * @Type("string")
     */
    private $description;

    /**
     * MovieDTO constructor.
     *
     * @param string $title
     * @param int    $year
     * @param int    $time
     * @param string $description
     */
    public function __construct(string $title = '', int $year = 0, int $time = 0, string $description = '')
    {
        $this->title = $title;
        $this->year = $year;
        $this->time = $time;
        $this->description = $description;
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * {@inheritdoc}
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * {@inheritdoc}
     */
    public function getTime(): int
    {
        return $this->time;
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription(): string
    {
        return $this->description;
    }

}
