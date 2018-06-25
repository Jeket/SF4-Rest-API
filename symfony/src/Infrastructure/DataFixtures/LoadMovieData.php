<?php

namespace App\Infrastructure\DataFixtures;

use App\Application\DTO\MovieDTO;
use App\Application\Service\MovieService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Loader Class for Movie Data.
 */
class LoadMovieData extends Fixture
{

    /**
     * @var MovieService
     */
    private $movieService;

    /**
     * @var array
     */
    protected $movieDatas;

    /**
     * MovieController constructor.
     *
     * @param MovieService $movieService
     */
    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
        $this->movieDatas = [
          [
            'title' => 'Deadpool',
            'year' => 2017,
            'time' => 120,
            'description' => 'A crazy Film :) !',
          ],
          [
            'title' => 'Deadpool 2',
            'year' => 2018,
            'time' => 300,
            'description' => 'A VERY VERY crazy Film :) !',
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
        for ($i = 0, $c = count($this->movieDatas); $i < $c; $i++) {
            $data = $this->movieDatas[$i];
            $movieDTO = new MovieDTO($data['title'], $data['year'], $data['time'], $data['description']);
            $this->movieService->addMovie($movieDTO);
        }
    }
}
