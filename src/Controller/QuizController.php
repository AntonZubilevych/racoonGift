<?php


namespace App\Controller;


use App\Entity\Gift;
use App\Form\QuizType;
use App\GiftFinderTool\GiftFinder;
use App\Model\GiftReceiver\GiftReceiver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class QuizController extends AbstractController
{
    public function quiz(Request $request,GiftReceiver $giftReceiver,GiftFinder $finder)
    {

        $form = $this->createForm(QuizType::class,  $giftReceiver );
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $category = $finder->chooseCategory($giftReceiver);
            $repository = $this->getDoctrine()->getRepository(Gift::class);
            $gifts = $repository->findBy(
                ['category' => $category],
                ['price' => 'ASC']
            );

            return $this->redirectToRoute('result', array('result' => 10));

        }

        return $this->render('catalog/addGift.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function lucky(Request $request)
    {

        $form = $this->createFormBuilder()
            ->add('save', SubmitType::class, array('label' => 'Find Random Gift'))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $repository = $this->getDoctrine()->getRepository(Gift::class);
           $result =  $repository->findMaxId();
           echo '<pre>';
           var_dump($result[0]);
            echo '</pre>';

        }

        return $this->render('catalog/addGift.html.twig', array(
            'form' => $form->createView(),
        ));

    }

    public function result(Request $request)
    {

        $repository = $this->getDoctrine()->getRepository(Gift::class);
        $id = $request->query->get('result');
        $gift = $repository->find($id);
        return new Response('');

    }
}