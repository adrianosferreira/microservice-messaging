<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Repository\CustomerRepository;
use App\Service\CustomerCreation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class CustomerController extends AbstractController
{
    private $customerRepository;
    private $customerCreation;

    public function __construct(
        CustomerRepository $customerRepository,
        CustomerCreation $customerCreation
    ) {
        $this->customerRepository = $customerRepository;
        $this->customerCreation   = $customerCreation;
    }

    public function showCustomers(): JsonResponse
    {
        return new JsonResponse(array_map([$this, 'objToArray'],
            $this->customerRepository->findAll()));
    }

    public function createCustomer(): JsonResponse
    {
        $customer = null;
        try {
            $customer = $this->customerCreation->createFromRequest();
        } catch (\BadMethodCallException $e) {
            return new JsonResponse(['error' => $e->getMessage()]);
        }

        $result = array_map([$this, 'objToArray'], [$customer]);

        return new JsonResponse([
            'success' => 'Customer created.',
            'data'    => $result ? $result[0] : [],
        ]);
    }

    private function objToArray(Customer $customer)
    {
        return [
            'id'      => $customer->getId(),
            'name'    => $customer->getName(),
            'surname' => $customer->getSurname(),
        ];
    }
}
