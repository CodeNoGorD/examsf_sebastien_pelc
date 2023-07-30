<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' =>'Nom'
            ])
            ->add('firstname', TextType::class, [
                'label' =>'Prenom'
            ])
            ->add('email', TextType::class, [
                'label' =>'Email'
            ])
            ->add('pictureFile', FileType::class, [
                'label' => 'Image du profil',
                'mapped' => false,
                'required' => $options['required'],
                'constraints' => [
                    new File([
                        'maxSize' => '4096k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                            'image/webp',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Votre image doit être au format : png, jpg, gif ou webp',
                        'maxSizeMessage' => 'Veuillez sélectionner un fichier qui fait moins de 4Mo.'
                    ])
                ]
            ])
            ->add('password', PasswordType::class, [
                'label' =>'Mot de passe'
            ])
            ->add('sector', ChoiceType::class, [
                'label' => 'Service',
                'placeholder' => '-- Choisissez un secteur --',
                'choices'  => [
                    'RH' => 'RH',
                    'Informatique' => 'INFORMATIQUE',
                    'Comptabilité' => 'COMPTABILITE',
                    'Direction' => 'DIRECTION'
                ],
            ])
            ->add('contract', ChoiceType::class, [
                'label' => 'Type de contrat',
                'placeholder' => '-- Choisissez un type de contrat --',
                'choices'  => [
                    'CDI' => 'CDI',
                    'CDD' => 'CDD',
                    'INTERIM' => 'INTERIM'
                ],
            ])
            ->add('dateContract', DateType::class, [
                'label' => 'Date de fin de contrat',
                'required' => false,
                'widget' => 'single_text'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'required' => false,
            'csrf_protection' => true,
        ]);
    }
}
