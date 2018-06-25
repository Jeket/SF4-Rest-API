<?php

namespace App\Application\DTO;

use App\Domain\Model\Person\PersonInterface;
use JMS\Serializer\Annotation\Type;

/**
 * Person Data Transfer Object.
 */
final class PersonDTO implements PersonInterface
{
    /**
     * The first name of person.
     *
     * @var string
     * @Type("string")
     */
    private $firstName;

    /**
     * The last name of person.
     *
     * @var string
     * @Type("string")
     */
    private $lastName;

    /**
     * The birthday date of person.
     *
     * @var \DateTime
     * @Type("DateTime")
     */
    private $birthday;

    /**
     * PersonDTO constructor.
     *
     * @param string    $firstName
     * @param string    $lastName
     * @param \DateTime $birthday
     */
    public function __construct(string $firstName = '', string $lastName = '', \DateTime $birthday = null)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->birthday = $birthday;
    }

    /**
     * {@inheritdoc}
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * {@inheritdoc}
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * {@inheritdoc}
     */
    public function getBirthday(): \DateTimeInterface
    {
        if (null === $this->birthday) {
            $this->birthday = new \DateTime('now');
        }

        return $this->birthday;
    }
}
