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
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;




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
            ])
            
        
        
        ->add('seats', ChoiceType::class,[
            'choices' => [
                'Pas de préférence' => '0',
                "Dans les premiers rangs" => '1',
                'Au milieu de la salle' => '2',
                'Dans les derniers rangs' => '3',
            ],
            'label' => 'Préférence de siège',
            'attr' => [
                'class' => 'form-control'
            ]
            ])
            ->add('location', ChoiceType::class,[
                'choices' => [
                    'UGC cergy' => '0',
                    "UGC bercy" => '1',
                    'UGC chatelet' => '2',
                    'UGC normandie' => '3',
                ],
                'label' => 'Vos cinéma favoris',
                'attr' => [
                    'class' => 'form-control'
                    
                ],
                'multiple' => true,
                'expanded' => true,
                ])
                ->add('actor', ChoiceType::class,[
                    'choices' => [
                        'Tom Hanks' => '0',
                        "Brad Pitt" => '1',
                        'Meryl Streep' => '2',
                        'Leonardo DiCaprio' => '3',
                    ],
                    'label' => 'Acteur',
                    'attr' => [
                        'class' => 'form-control'
                        
                    ],
                    'multiple' => true,
                    'expanded' => true,
                    ])
                    ->add('director', ChoiceType::class,[
                        'choices' => [
                            'Steven Spielberg' => '0',
                            "Martin Scorsese" => '1',
                            'Quentin Tarantino' => '2',
                            'Christopher Nolan' => '3',
                        ],
                        'label' => 'Réalisateur',
                        'attr' => [
                            'class' => 'form-control'
                            
                        ],
                        'multiple' => true,
                        'expanded' => true,
                        ])
                        ->add('genres', ChoiceType::class,[
                            'choices' => [
                                'Action' => '0',
                                "horreur" => '1',
                                'Comédie' => '2',
                                'Science-fiction' => '3',
                            ],
                            'label' => 'Genres',
                            'attr' => [
                                'class' => 'form-control'
                                
                            ],
                            'multiple' => true,
                            'expanded' => true,
                            ])
        ;
    }

   


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}