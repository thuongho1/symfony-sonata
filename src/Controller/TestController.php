<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;

    }

    /**
     * @Route("/test", name="admin_test")
     */
    public function index(Request $request): Response
    {
        $query = $request->getQueryString();
        $price = $request->get('price') ?: 10;

        $results = $this->productRepository->findAll();
        $results = $this->productRepository->findAllGreaterThanPrice($price);

        return $this->render('test/index.html.twig', [
            'results' => $results,
        ]);
    }

    /**
     * @Route("/test", name="admin_test_1")
     */
    public function test2(Request $request, CategoryRepository $categoryRepository): Response
    {
        $query = $request->getQueryString();
        $results = [];
        $category_id = $request->get('id') ?: 10;
        try {
            $category = $categoryRepository->find($category_id);
            if($category){
                $results = $category->getProducts();
            }
        }
        catch (\Exception $exception)
        {
            dd($exception->getMessage());
        }


        return $this->render('test/index.html.twig', [
            'results' => $results,
        ]);
    }
    /**
     * @Route("/test2", name="admin_test_2")
     */
    public function index2(Request $request, LoggerInterface $logger): Response
    {
        $query = $request->getQueryString();
        $logger->info('I just got the logger');
        $logger->error('An error occurred');

        $logger->critical('I left the oven on!', [
            // include extra "context" info in your logs
            'cause' => 'in_hurry',
        ]);

        $price = $request->get('price') ?: 10;
        $results = $this->productRepository->find($price);

        return $this->render('test/index.html.twig', [
            'results' => $results,
        ]);
    }
    /**
     * @Route("/test3", name="admin_test_3")
     */
    public function index3(Request $request, LoggerInterface $logger): Response
    {

        $results = $this->productRepository->findAll();

        return $this->render('test/index.html.twig', [
            'results' => $results,
        ]);
    }
}
