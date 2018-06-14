<?php

namespace App\Controller\Rest;

use App\Service\PersonService;
use Doctrine\ORM\EntityNotFoundException;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as FOSRest;

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
     * @FOSRest\Get("/persons")
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
     * @FOSRest\Get("/persons/{personId}")
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
     * @FOSRest\Delete("/persons/{personId}")
     * @param int $personId The person id.
     *
     * @return \FOS\RestBundle\View\View
     * @throws EntityNotFoundException
     */
    public function deletePerson(int $personId)
    {
        $this->personService->deleteMovie($personId);

        return $this->view(null, Response::HTTP_NO_CONTENT, []);
    }

    /**
     * Create Person.
     *
     * @FOSRest\Post("/person")
     * @param Request $request A Request instances
     *
     * @return \FOS\RestBundle\View\View
     */
    public function postPerson(Request $request): View
    {
        // ASSEMBLER + DTO For more complex actions.
        $personData = [
          'firstname' => $request->get('firstname'),
          'lastname' => $request->get('lastname'),
          'birthday' => new \DateTime($request->get('birthday')),
        ];

        $person = $this->personService->addPerson($personData);
        if (null === $person) {
            return $this->view($person, Response::HTTP_NOT_FOUND, []);
        }

        return $this->view($person, Response::HTTP_CREATED, []);
    }
}
