<?php

namespace App\Form;

use App\Entity\{Gift,Hobby,Location,Category};
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\{NumberType,TextType,SubmitType,FileType,TextareaType};
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GiftType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder->add('name',TextType::class)
            ->add('price',NumberType::class)
            ->add('description',TextareaType::class)
            ->add('link',TextType::class)
            ->add('location',EntityType::class, [
                'class' => Location::class,
                'choice_label' => 'name'])
            ->add('hobby',EntityType::class, [
                'class' => Hobby::class,
                'choice_label' => 'name'])
            ->add('category',EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name'])
            ->add('img', FileType::class, ['label' => 'Gift picture'])
            ->add('save',SubmitType::class,['label'=>'Create Gift']);
    }

    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults([
            'data_class' => Gift::class,
        ]);
    }
}