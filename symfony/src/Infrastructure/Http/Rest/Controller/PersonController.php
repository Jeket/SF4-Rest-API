<?php

namespace App\Infrastructure\Http\Rest\Controller;

use App\Application\DTO\PersonDTO;
use App\Application\Service\PersonService;
use Doctrine\ORM\EntityNotFoundException;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Brand controller.
 */
final class PersonController extends FOSRestController
{

    /**
     * @var PersonService
     */
    private $personService;

    /**
     * PersonController constructor.
     *
     * @param PersonService $personService
     */
    public function __construct(PersonService $personService)
    {
        $this->personService = $personService;
    }

    /**
     * Lists all Persons.
     *
     * @Rest\Get("/persons")
     * @return \FOS\RestBundle\View\View
     */
    public function getPersons(): View
    {
        $person = $this->personService->getAllPersons();

        return $this->view($person, Response::HTTP_OK, []);
    }

    /**
     * Lists One Person.
     *
     * @Rest\Get("/persons/{personId}")
     * @param int $personId The person id.
     *
     * @return \FOS\RestBundle\View\View
     * @throws EntityNotFoundException
     */
    public function getPerson(int $personId): View
    {
        $person = $this->personService->getPerson($personId);

        return $this->view($person, Response::HTTP_OK, []);
    }

    /**
     * Delete Person.
     *
     * @Rest\Delete("/persons/{personId}")
     * @param int $personId The person id.
     *
     * @return \FOS\RestBundle\View\View
     * @throws EntityNotFoundException
     */
    public function deletePerson(int $personId)
    {
        $this->personService->deletePerson($personId);

        return $this->view(null, Response::HTTP_NO_CONTENT, []);
    }

    /**
     * Replaces Person resource.
     *
     * @Rest\Put("/persons/{personId}")
     * @ParamConverter("personDTO", converter="fos_rest.request_body")
     * @param int       $personId  The id of person entity to update.
     * @param PersonDTO $personDTO The DTO object to update person entity.
     *
     * @return View                The response.
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function putMovie(int $personId, PersonDTO $personDTO): View
    {
        $article = $this->personService->updatePerson($personId, $personDTO);

        return View::create($article, Response::HTTP_OK);
    }

    /**
     * Create Person.
     *
     * @Rest\Post("/persons")
     * @ParamConverter("personDTO", converter="fos_rest.request_body")
     * @param PersonDTO $personDTO The DTO object representing person data.
     *
     * @return View                The response.
     */
    public function postPerson(PersonDTO $personDTO): View
    {
        $person = $this->personService->addPerson($personDTO);
        if (null === $person) {
            return $this->view($person, Response::HTTP_NOT_FOUND, []);
        }

        return $this->view($person, Response::HTTP_CREATED, []);
    }
}
