<?php

namespace App\Controller;

use App\Entity\Gift;
use App\Form\QuizType;
use App\GiftFinder\GiftReceiver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\{Request,Response};
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuizController extends AbstractController
{
    public function quiz(Request $request,GiftReceiver $giftReceiver):Response
    {
        $form = $this->createForm(QuizType::class,$giftReceiver);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $category = $giftReceiver->chooseCategory();
            $repository = $this->getDoctrine()->getRepository(Gift::class);

            $id = $repository->findGiftByFields(
                $category,
                $giftReceiver->getPrice(),
                $giftReceiver->getLocation(),
                $giftReceiver->getHobby()
            );

            if(empty($id)){
                return $this->redirectToRoute('lucky');
            }

            return $this->redirectToRoute('result', ['id' => $id]);
        }

        return $this->render('catalog/addGift.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function lucky(Request $request):Response
    {
        $form = $this->createFormBuilder()
            ->add('save', SubmitType::class, ['label' => 'Find Random Gift'])
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $repository = $this->getDoctrine()->getRepository(Gift::class);
            $id =  $repository->findRandId();

            return $this->redirectToRoute('result', ['id' => $id]);
        }

        return $this->render('catalog/addGift.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function result(Request $request):Response
    {
        $repository = $this->getDoctrine()->getRepository(Gift::class);
        $id = $request->query->get('id');
        $gift = $repository->find($id);

        return $this->render('catalog/gift.html.twig', compact('gift'));
    }
}