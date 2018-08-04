<?php

namespace App\Controller;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomePageController extends Controller
{

    public function index(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('save', SubmitType::class, ['label' => 'Let`s Start'])
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            return $this->redirectToRoute('quiz');
        }

        return $this->render('homePage/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function success()
    {
        return $this->render('homePage/success.html.twig');
    }

}
