<?php

namespace App\Controller\Admin;

use App\Entity\Gift;
use App\Form\GiftType;
use App\FileSystem\ImageManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{Request,Response};

class CatalogController extends AbstractController
{
    public function addGift(Request $request , ImageManager $imgManager ):Response
    {
        $gift = new Gift();
        $form = $this->createForm(GiftType::class,$gift);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $file = $gift->getImg();
            $imgManager->resize($file);
            if ($fileName = $imgManager->upload($file)){
                $gift->setImg($fileName);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($gift);
                $entityManager->flush();
                $this->redirectToRoute('success');
            }
        }

        return $this->render('catalog/addGift.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}