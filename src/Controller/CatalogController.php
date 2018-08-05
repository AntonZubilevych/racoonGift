<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Gift;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CatalogController extends AbstractController
{

    public function show():Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repository =  $entityManager->getRepository(Gift::class);
        $gifts= $repository ->findAll();

        $repositoryCategory = $entityManager->getRepository(Category::class);
        $categories = $repositoryCategory->findAll();

        return $this->render('catalog/show.html.twig',[
            'categories'=>$categories,
            'gifts'=>$gifts
        ]);
    }

    public function category(string $categoryName):Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repository =  $entityManager->getRepository(Gift::class);
        $gifts = $repository->findOneBy(['category' => $categoryName]);

        if(empty($gifts)){
            throw $this->createNotFoundException();
        }

        return $this->render('catalog/show.html.twig',compact('gifts'));
    }

    public function gift(int $id):Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $entityManager->getRepository(Gift::class);
        $gift = $repository->find($id);

        if (empty($gift)) {
            throw $this->createNotFoundException();
        }

        return $this->render('catalog/gift.html.twig', compact('gift'));
    }

}