<?php

namespace App\Domain\Model\Movie;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The movie entity class.
 *
 * @ORM\Entity(repositoryClass="App\Infrastructure\Repository\MovieRepository")
 * @package App\Domain\Model\Movie
 */
final class Movie implements MovieInterface
{
    /**
     * The unique identifier of movie entity.
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var integer
     */
    private $id;

    /**
     * The title of movie.
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     * @var string
     */
    private $title;

    /**
     * The year of publication of movie.
     *
     * @ORM\Column(type="smallint")
     * @Assert\NotBlank()
     * @Assert\Range(min=1888, max=2025)
     * @var integer
     */
    private $year;

    /**
     * The duration of movie.
     *
     * @ORM\Column(type="smallint")
     * @Assert\NotBlank()
     * @Assert\Range(min=30, max=300)
     * @var integer
     */
    private $time;

    /**
     * The description of movie.
     *
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank()
     * @var string
     */
    private $description;

    /**
     * Get unique identifier of movie resource.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Set the title of movie.
     *
     * @param string $title
     *
     * @return Movie
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getYear(): ?int
    {
        return $this->year;
    }

    /**
     * Set year of publication.
     *
     * @param int $year The year of publication of this movie.
     *
     * @return Movie
     */
    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTime(): ?int
    {
        return $this->time;
    }

    /**
     * Set the duration of movie.
     *
     * @param int $time The duration of movie.
     *
     * @return Movie
     */
    public function setTime(int $time): self
    {
        $this->time = $time;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set the description of movie.
     *
     * @param null|string $description The description of movie.
     *
     * @return Movie
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
