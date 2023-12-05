<?php

namespace App\Controller\Api\src\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class ProductController extends AbstractController
{
    public function __construct(private readonly ProductRepository $repository)
    {

    }

    public function __invoke(int $id, Request $request)
    {
        var_dump($request->headers);
        die;
    }
}