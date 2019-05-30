<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,['attr'=>['class'=>'form-control']])
            ->add('status',ChoiceType::class, 
            [
                'choices' =>[
                            'Active' =>'Active',
                            'In Active'=>'In Active',
                ],
                'attr'=>[
                    'class'=>'form-control',
                   // 'style'=>'width:20px;'
                ]
            ]);
       
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
            'attr' => [
                'class' => 'form'
            ]
        ]);
    }
}
