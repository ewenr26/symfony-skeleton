<?php


namespace App\Http\Api\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    /**
     * @Route("/services", name="services_get")
     */
    public function getAll(): Response
    {
        return new JsonResponse("Services");
    }
}