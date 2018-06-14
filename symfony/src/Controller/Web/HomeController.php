<?php

namespace App\Controller\Web;

use App\Service\MovieService;
use App\Service\PersonService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Home Controller.
 */
final class HomeController extends AbstractController
{

    /**
     * @var MovieService
     */
    private $movieService;

    /**
     * @var PersonService
     */
    private $personService;

    /**
     * HomeController constructor.
     *
     * @param MovieService  $movieService
     * @param PersonService $personService
     */
    public function __construct(MovieService $movieService, PersonService $personService)
    {
        $this->movieService = $movieService;
        $this->personService = $personService;
    }

    /**
     * @Route("/", name="homepage")
     *
     * @return Response
     */
    public function index(): Response
    {
        return $this->render(
            'base.html.twig',
            [
                'movies' => $this->getAllMovies(),
                'persons' => $this->getAllPersons(),
            ]
        );
    }

    /**
     * Return all movies from database.
     *
     * @return array|null
     */
    private function getAllMovies()
    {
        return $this->movieService->getAllMovies();
    }

    /**
     * Return all person from database.
     *
     * @return array|null
     */
    private function getAllPersons()
    {
        return $this->personService->getAllPersons();
    }
}
