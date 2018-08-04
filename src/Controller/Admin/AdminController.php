<?php

namespace App\Controller\Admin;

use App\Entity\Gift;
use App\Form\GiftType;
use App\FileSystem\FileManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController
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

}