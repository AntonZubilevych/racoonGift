<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 30.07.18
 * Time: 18:56
 */

namespace App\Form;

use App\Entity\Hobby;
use App\Entity\Location;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\{ChoiceType,NumberType,SubmitType};
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\GiftFinder\GiftReceiver;

class QuizType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder->add('age',NumberType::class)
            ->add('price',NumberType::class)
            ->add('location',EntityType::class, [
                'class' => Location::class,
                'choice_label' => 'name'])
            ->add('hobby',EntityType::class, [
                'class' => Hobby::class,
                'choice_label' => 'name'])
            ->add('sex', ChoiceType::class, [
                'choices'  => [
                    'male'=>'male',
                    'female'=>'female'
                ],
            ])
            ->add('save',SubmitType::class,['label'=>'Find Gift']);
    }

    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults([
            'data_class' => GiftReceiver::class
        ]);
    }
}