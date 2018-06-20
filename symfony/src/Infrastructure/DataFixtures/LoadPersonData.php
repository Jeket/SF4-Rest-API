<?php

namespace App\Infrastructure\DataFixtures;

use App\Application\Service\PersonService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Loader Class for Person Data.
 */
class LoadPersonData extends Fixture
{

    /**
     * @var PersonService
     */
    private $personService;

    /**
     * @var array
     */
    protected $personDatas;

    /**
     * LoadPersonData constructor.
     *
     * @param PersonService $personService
     */
    public function __construct(PersonService $personService)
    {
        $this->personService = $personService;
        $this->personDatas = [
          [
            'firstname' => 'Alexandre',
            'lastname' => 'Mallet',
            'birthday' => new \DateTime('1989-06-16'),
          ],
          [
            'firstname' => 'Woprrr',
            'lastname' => 'Mallet',
            'birthday' => new \DateTime('1986-06-13'),
          ],
        ];
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < count($this->personDatas); $i++) {
            $this->personService->addPerson($this->personDatas[$i]);
        }
    }
}
