<?php

namespace App\Form;

use App\Entity\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class CarFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('make', TextType::class,[
                'required' => true,
                'constraints' => [
                    new Length([
                        'min' => 2,
                    ]),],])
            ->add('model', TextType::class,[
                'required' => true,
                'constraints' => [
                    new Length([
                        'min' => 2,
                    ]),],])
            ->add('year')
            ->add('engine')
            ->add('transmission')
            ->add('enginePower')
            ->add('typeSize', TextType::class,[
                'required' => true,
                'constraints' => [
                    new Length([
                        'min' => 2,
                    ]),],])
            ->add('fuelEconomy')
            ->add('forWhat')
            ->add('size')
            ->add('fuelType')
            ->add('color')
            ->add('bodyType')
            ->add('bootCapacity')
            ->add('rareness')
            ->add('engineLife')
            ->add('failureRate')
            ->add('tuning')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
