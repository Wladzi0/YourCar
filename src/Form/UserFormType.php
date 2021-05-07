<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('firstName', TextType::class,[
        'required' => false,
        'constraints' => [
            new Length([
                'min' => 2,
            ]),],])
        ->add('lastName', TextType::class,[
            'required' => false,
            'constraints' => [
                new Length([
                    'min' => 2,
                ]),],])
        ->add('email', EmailType::class, ['required' => false])
        ->add('defaultLanguage', LanguageType::class, [
            'placeholder' => false,
            'required' => false,
        ])
            ->add('plainPassword', RepeatedType::class, [
                'constraints' => [
                    new Length([
                        'min' => 6,
                        'minMessage' => 'The password value should have at least 6 characters.'
                    ]),],
                'type' => PasswordType::class,
                'first_options' => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),
                'mapped' => false,
                'required' => false,

            ])
            ->add('preferLanguage', LanguageType::class, [
                'placeholder' => false,
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
