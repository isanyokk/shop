<?php

namespace App\Controller\Api;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    public function __construct(private readonly ProductRepository $repository)
    {

    }

    #[Route(path: '/api/products/jopa', name: 'getOne')]
    public function getOne()
    {
        return $this->repository->findOneBy(['id' => 206201]);
    }
}
