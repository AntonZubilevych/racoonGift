<?php


namespace App\Controller;


use App\Entity\Gift;
use App\Form\QuizType;
use App\GiftFinderTool\GiftFinder;
use App\Model\GiftReceiver\GiftReceiver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class QuizController extends AbstractController
{
    public function quiz(Request $request,GiftReceiver $giftReceiver,GiftFinder $finder)
    {

        $form = $this->createForm(QuizType::class,  $giftReceiver );
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $category = $finder->chooseCategory($giftReceiver);
            $repository = $this->getDoctrine()->getRepository(Gift::class);

           $res =  $repository->findByExampleFields($category,$giftReceiver->getPrice(),$giftReceiver->getLocation(),$giftReceiver->getHobby());
           var_dump($res[0]->getId());
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
            $id =  $repository->findRandId();

            return $this->redirectToRoute('result', array('id' => $id));
        }

        return $this->render('catalog/addGift.html.twig', array(
            'form' => $form->createView(),
        ));

    }

    public function result(Request $request)
    {

        $repository = $this->getDoctrine()->getRepository(Gift::class);
        $id = $request->query->get('id');
        $gift = $repository->find($id);

        var_dump($gift->getName());
        return $this->render('catalog/addGift.html.twig', compact('gift'));
    }
}