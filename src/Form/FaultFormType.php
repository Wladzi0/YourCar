<?php

namespace App\Form;

use App\Entity\Fault;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FaultFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('images', FileType::class,[
                'required'=>true,
                'label'=>'Please upload a file',
                'multiple'=>true,
                'mapped'=>false,
            ])
            ->add('name',TextType::class,[
                'required'=>true
            ])
            ->add('description',TextareaType::class,[
                'required'=>true
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Fault::class,
        ]);
    }
}
