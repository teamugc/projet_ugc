<?php

namespace App\Form;

use App\Document\User;
use App\Document\Users;
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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;



class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('gender', ChoiceType::class, [
            'label' => 'Genre',
            'choices' => [
                'Homme' => true,
                'Femme' => false,
            ],
            
            'attr' => [
                'class' => 'form-control'
            ],
            'expanded' => true
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
        ->add('email', TextType::class, [
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
        ->add('address', TextType::class, [
            'label' => 'Votre adresse',
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
        
        ->add('postal_code', IntegerType::class, [
            'label' => 'code postale',
            'attr' => [
                'class' => 'form-control'
            ]
        ])

        ->add('fidelity_points', IntegerType::class, [
            'label' => 'points de fidélité',
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

        ->add('fidelity_points', IntegerType::class, [
            'label' => 'points de fidélité',
            'attr' => [
                'class' => 'form-control'
            ]
        ])

        // ->add('preferencies', Users::class, [
        //     'entry_type' => TextType::class,
        //     'allow_add' => true,
        //     'allow_delete' => true,
        //     'by_reference' => false,
        //     'label' => 'Actors',
        //     'entry_options' => [
        //         'attr' => [
        //             'class' => 'form-control',
        //         ],
        //     ],
        // ])
   
   


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

// class PreferenciesType extends AbstractType
// {
//     public function buildForm(FormBuilderInterface $builder, array $options): void
//     {
//         $builder
//             ->add('actor', UserType::class, [
//                 'entry_type' => TextType::class,
//                 'allow_add' => true,
//                 'allow_delete' => true,
//                 'by_reference' => false,
//                 'label' => 'Actors',
//                 'entry_options' => [
//                     'attr' => [
//                         'class' => 'form-control',
//                     ],
//                 ],
//             ])
//             ->add('director', UserType::class, [
//                 'entry_type' => TextType::class,
//                 'allow_add' => true,
//                 'allow_delete' => true,
//                 'by_reference' => false,
//                 'label' => 'Directors',
//                 'entry_options' => [
//                     'attr' => [
//                         'class' => 'form-control',
//                     ],
//                 ],
//             ])
//             ->add('genres', UserType::class, [
//                 'entry_type' => TextType::class,
//                 'allow_add' => true,
//                 'allow_delete' => true,
//                 'by_reference' => false,
//                 'label' => 'Genres',
//                 'entry_options' => [
//                     'attr' => [
//                         'class' => 'form-control',
//                     ],
//                 ],
//             ])
//             ->add('location', TextType::class, [
//                 'attr' => [
//                     'class' => 'form-control',
//                 ],
//             ])
//             ->add('seats', TextType::class, [
//                 'attr' => [
//                     'class' => 'form-control',
//                 ],
//             ])
//         ;
//     }

//     // ...
// }