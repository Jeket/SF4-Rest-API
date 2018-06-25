<?php

namespace App\Infrastructure\Http\Rest\Controller;

use App\Application\DTO\MovieDTO;
use App\Application\Service\MovieService;
use Doctrine\ORM\EntityNotFoundException;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Brand controller.
 */
final class MovieController extends FOSRestController
{

    /**
     * The movie service.
     *
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
     * @Rest\Get("/movies")
     *
     * @return View The response.
     */
    public function getMovies(): View
    {
        $movie = $this->movieService->getAllMovies();

        return $this->view($movie, Response::HTTP_OK, []);
    }

    /**
     * Return One Movie from ID.
     *
     * @Rest\Get("/movies/{movieId}")
     * @param int $movieId The movie id.
     *
     * @return View        The response.
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
     * @Rest\Delete("/movies/{movieId}")
     * @param int $movieId The movie id.
     *
     * @return View        The response.
     * @throws EntityNotFoundException
     */
    public function deleteMovie(int $movieId): View
    {
        $this->movieService->deleteMovie($movieId);

        return $this->view(null, Response::HTTP_NO_CONTENT, []);
    }

    /**
     * Replaces Movie resource.
     *
     * @Rest\Put("/movies/{movieId}")
     * @ParamConverter("movieDTO", converter="fos_rest.request_body")
     * @param int      $movieId  The movie id.
     * @param MovieDTO $movieDTO The move DTO object.
     *
     * @return View              The response.
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function putMovie(int $movieId, MovieDTO $movieDTO): View
    {
        $article = $this->movieService->updateArticle($movieId, $movieDTO);

        return View::create($article, Response::HTTP_OK);
    }

    /**
     * Create Movie.
     *
     * @Rest\Post("/movies")
     * @ParamConverter("movieDTO", converter="fos_rest.request_body")
     * @param MovieDTO $movieDTO The move DTO object.
     *
     * @return View              The response.
     */
    public function postMovie(MovieDTO $movieDTO): View
    {
        $movie = $this->movieService->addMovie($movieDTO);

        if (null === $movie) {
            return $this->view($movie, Response::HTTP_NOT_FOUND, []);
        }

        return $this->view($movie, Response::HTTP_CREATED, []);
    }
}
