<?php

namespace App\Form;

use App\Document\User;
use App\Form\DataMapper\DateOfBirthType;
use DateTime;
use Doctrine\ODM\MongoDB\Types\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Validator\Constraints\Regex;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('gender', RadioType::class, [
            'label' => 'Genre',
            'choices' => [
                'Homme' => 'homme',
                'Femme' => 'femme',
            ],
            'expanded' => true,
        ])
        ->add('firstname', TextType::class, [
            'attr' => [
                'class' => 'form-control'
            ]
        ])
        ->add('lastname', TextType::class, [
            'attr' => [
                'class' => 'form-control'
            ]
        ])
        ->add('dateOfBirth', BirthdayType::class, [
            'widget' => 'single_text',
            'attr' => [
                'class' => 'form-control'
            ],
            
            'format' => 'yyyy-MM-dd',
        ])
        ->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            'first_options' => ['label' => 'Mot de passe'],
            'second_options' => ['label' => 'Confirmer le mot de passe'],
        ])

        ->add('email', EmailType::class, [
            'attr' => [
                'class' => 'form-control'
            ]
        ])
        ->add('phone', IntegerType::class, [
            'label' => 'Téléphone',
            'attr' => [
                'class' => 'form-control'
            ]
        ])
        ->add('address', TextType::class, [
            'label' => 'Votre adresse',
            'attr' => [
                'class' => 'form-control'
            ]
        ])
        ->add('postalCode', IntegerType::class, [
            'label' => 'code postale',
            'attr' => [
                'class' => 'form-control'
            ]
        ])
        ->add('city', TextType::class, [
            'label' => 'Ville',
            'attr' => [
                'class' => 'form-control'
            ]
        ])
        ->add('valid', SubmitType::class, [
            'label' => 'Validez',
            'attr' => [
                'class' => 'btn btn-success'
            ]
        ])
        ->add('annuler', ButtonType::class,[
            
            'label' => 'Annuler',
            'attr' => [
                'class' => 'btn btn-danger form-control'
            ]
            ]);
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}