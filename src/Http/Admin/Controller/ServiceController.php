<?php


namespace App\Http\Admin\Controller;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController
{
    /**
     * @Route("/services", name="services_index")
     */
    public function index(): Response
    {
        return new JsonResponse("Test");
    }
}