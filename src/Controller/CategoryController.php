<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CategoryController
{
    public function getAllCategories()
    {
        return new JsonResponse([]);
    }

    public function create(Request $request)
    {

    }
}