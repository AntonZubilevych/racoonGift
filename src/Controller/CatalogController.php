<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 30.07.18
 * Time: 8:21
 */

namespace App\Controller;


use App\Entity\Category;
use App\Entity\Gift;
use App\Form\GiftType;
use App\FileSystem\FileManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CatalogController extends AbstractController
{
    public function addGift(Request $request , FileManager $fileManager)
    {
        $gift = new Gift();

        $form = $this->createForm(GiftType::class,$gift);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $file = $gift->getImg();

          if ($fileName = $fileManager->upload($file)){

                $gift->setImg($fileName);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($gift);
                $entityManager->flush();

                $this->redirectToRoute('success');
           }

        }

        return $this->render('catalog/addGift.html.twig', array(
            'form' => $form->createView(),
        ));
    }

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

    public function category($categoryName)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repository =  $entityManager->getRepository(Gift::class);
        $gifts = $repository->findOneBy(['category' => $categoryName]);

        return $this->render('catalogCategory/category.html.twig',compact('gifts'));
    }

    public function gift($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repository =  $entityManager->getRepository(Gift::class);
        $gift = $repository->find($id);

        return $this->render('catalog/gift.html.twig',compact('gift'));
    }

}