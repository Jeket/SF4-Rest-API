<?php

namespace App\Domain\Model\Person;

use Doctrine\ORM\Mapping as ORM;

/**
 * The person entity class.
 *
 * @ORM\Entity(repositoryClass="App\Infrastructure\Repository\PersonRepository")
 * @package App\Domain\Model\Person
 */
class Person implements PersonInterface
{
    /**
     * The unique identifier of person.
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * The first name of person.
     *
     * @ORM\Column(type="string", length=70)
     */
    private $firstName;

    /**
     * The last name of person.
     *
     * @ORM\Column(type="string", length=100)
     */
    private $lastName;

    /**
     * The birthday datetime of person.
     *
     * @ORM\Column(type="date")
     */
    private $birthday;

    /**
     * Get the unique identifier of person entity.
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
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * Set the first name.
     *
     * @param string $firstName The first name of person.
     *
     * @return Person           The person entity.
     */
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * Set the last name.
     *
     * @param string $lastName The last name of person.
     *
     * @return Person          The person entity.
     */
    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    /**
     * Set the birthday date.
     *
     * @param \DateTimeInterface $birthday The birthday date.
     *
     * @return Person                      The person entity.
     */
    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }
}
