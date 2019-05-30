<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\Common\Collections\ArrayCollection;

use App\Entity\Category;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title',TextType::class,['attr'=>['class'=>'form-control']])
            //->add('description')
            ->add('description', TextareaType::class, [
                'attr' => ['class' => 'ckeditor'],
                    ])
            ->add('category', EntityType::class, array(
                    'required' => true,
                    'choice_label' => 'name',
                    'placeholder' => 'Select a category...',
                    'class' => 'App\Entity\Category'),
            ChoiceType::class,['attr'=>['class'=>'form-control',
                'style'=>'width:200px'
        ]])
        

            ->add('image', FileType::class, [ 'required' => false,'data_class' => null] )

            ->add('tag', EntityType::class, array(
                    'required' => true,
                    //'multiple'=>true,
                    'choice_label' => 'name',
                    'placeholder' => 'Select tags...',
                    'class' => 'App\Entity\Tag',
            ));   
            // $builder->add('slug',TextType::class,['attr'=>['class'=>'form-control']]);         

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
