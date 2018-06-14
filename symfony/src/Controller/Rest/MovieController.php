<?php

namespace App\Controller\Rest;

use App\Service\MovieService;
use Doctrine\ORM\EntityNotFoundException;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as FOSRest;

/**
 * Brand controller.
 */
final class MovieController extends FOSRestController
{

    /**
     * @var MovieService
     */
    private $movieService;

    /**
     * MovieController constructor.
     *
     * @param MovieService $movieService
     */
    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    /**
     * Lists all Movies.
     *
     * @FOSRest\Get("/movies")
     * @return \FOS\RestBundle\View\View
     */
    public function getMovies(): View
    {
        $movie = $this->movieService->getAllMovies();

        return $this->view($movie, Response::HTTP_OK, []);
    }

    /**
     * Return One Movie from ID.
     *
     * @FOSRest\Get("/movies/{movieId}")
     * @param int $movieId The movie id.
     *
     * @return \FOS\RestBundle\View\View
     * @throws EntityNotFoundException
     */
    public function getMovie(int $movieId): View
    {
        $movie = $this->movieService->getMovie($movieId);

        return $this->view($movie, Response::HTTP_OK, []);
    }

    /**
     * Delete Movie.
     *
     * @FOSRest\Delete("/movies/{movieId}")
     * @param int $movieId The movie id.
     *
     * @return \FOS\RestBundle\View\View
     * @throws EntityNotFoundException
     */
    public function deleteMovie(int $movieId): View
    {
        $this->movieService->deleteMovie($movieId);

        return $this->view(null, Response::HTTP_NO_CONTENT, []);
    }

    /**
     * Create Movie.
     *
     * @FOSRest\Post("/movies")
     * @param Request $request A Request instances
     *
     * @return \FOS\RestBundle\View\View
     */
    public function postMovie(Request $request): View
    {
        // ASSEMBLER + DTO For more complex actions.
        $movieData = [
          'title' => $request->get('title'),
          'year' => $request->get('year'),
          'time' => $request->get('time'),
          'description' => $request->get('description'),
        ];

        $movie = $this->movieService->addMovie($movieData);

        if (null === $movie) {
            return $this->view($movie, Response::HTTP_NOT_FOUND, []);
        }

        return $this->view($movie, Response::HTTP_CREATED, []);
    }
}
