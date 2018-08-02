<?php

namespace App\Controller;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HomePageController extends Controller
{
    public function index(Request $request)
    {

        $form = $this->createFormBuilder()
            ->add('save', SubmitType::class, array('label' => 'Let`s Start'))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            return $this->redirectToRoute('quiz');
        }

        return $this->render('homePage/index.html.twig', array(
            'form' => $form->createView(),
        ));

    }
    public function success()
    {
        return $this->render('homePage/success.html.twig');
    }
}
