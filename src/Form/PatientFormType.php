<?php

namespace App\Form;

use App\Entity\Patient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom',TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Le nom est manquant.']),
                    new Length([
                        'min' => 2,
                        'max' => 50,
                        'maxMessage' => 'Le nom ne peut comporter plus de {{ limit }} caractères.'
                    ])
                ]
            ])
            ->add('Prenom',TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Le prénom est manquant.']),
                    new Length([
                        'min' => 2,
                        'max' => 50,
                        'maxMessage' => 'Le prénom ne peut comporter plus de {{ limit }} caractères.'
                    ])
                ]
            ])
            ->add('Telephone',TelType::class)
            ->add('Email', EmailType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Patient::class,
        ]);
    }
}
