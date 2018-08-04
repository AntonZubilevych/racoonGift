<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Gift;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CatalogController extends AbstractController
{

    public function show()
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

    public function category(string $categoryName)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repository =  $entityManager->getRepository(Gift::class);
        $gifts = $repository->findOneBy(['category' => $categoryName]);

        if(empty($gifts)){
            return $this->render('notFound.html.twig');
        }

        return $this->render('catalog/show.html.twig',compact('gifts'));
    }

    public function gift(int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $entityManager->getRepository(Gift::class);
        $gift = $repository->find($id);

        if (empty($gift)) {
            return $this->render('notFound.html.twig');
        }

        return $this->render('catalog/gift.html.twig', compact('gift'));
    }

}