<?php

namespace App\Application\DTO;

use JMS\Serializer\Annotation\Type;

/**
 * Movie Data Transfer Object.
 */
final class MovieDTO
{
    /**
     * @var string
     * @Type("string")
     */
    private $title;

    /**
     * @var int
     * @Type("int")
     */
    private $year;

    /**
     * @var int
     * @Type("int")
     */
    private $time;

    /**
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
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @return int
     */
    public function getTime(): int
    {
        return $this->time;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

}
