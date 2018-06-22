<?php

namespace App\Infrastructure\Http\Rest\Controller;

use App\Application\DTO\MovieDTO;
use App\Application\Service\MovieService;
use Doctrine\ORM\EntityNotFoundException;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as FOSRest;

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
     * Replaces Movie resource.
     *
     * @FOSRest\Put("/movies/{movieId}")
     * @ParamConverter("movieDTO", converter="fos_rest.request_body")
     * @param int $movieId
     * @param MovieDTO $movieDTO
     *
     * @return View
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
     * @FOSRest\Post("/movies")
     * @ParamConverter("movieDTO", converter="fos_rest.request_body")
     * @param MovieDTO $movieDTO
     *
     * @return \FOS\RestBundle\View\View
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
