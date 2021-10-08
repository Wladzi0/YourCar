<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserSettingsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('preferLanguage', LanguageType::class, [
                'placeholder' => false,
                'required' => true,
            ])
            ->add('carType', ChoiceType::class, [
                'label' => 'Your prefer car type',
                'required' => false,
                'placeholder' => 'Please select',
                'choices' => [
                    'Hatchback' => 'Hatchback',
                    'Sedan' => 'Sedan',
                    'MUV/SUV' => 'MUV/SUV',
                    'Coupe' => 'Coupe',
                    'Convertible' => 'Convertible',
                    'Wagon' => 'Wagon',
                    'Van' => 'Van',
                    'Jeep' => 'Jeep'
                ],
            ])
            ->add('tuning', ChoiceType::class, [
                'label' => 'Suitability for tuning',
                'required' => false,
                'placeholder' => 'Please select',
                'choices' => [
                    'Poorly level' => 'Poorly level',
                    'Average level' => 'Average level',
                    'High level' => 'High level',
                ],
            ])
            ->add('fuelConsumption', ChoiceType::class, [
                'required' => false,
                'placeholder' => 'Please select',
                'choices' => [
                    '6<' => '6<',
                    '6-8' => '6-8',
                    '8-10' => '8-10',
                    '>10' => '>10'
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
