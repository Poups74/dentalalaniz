<?php

namespace App\Form;

use App\Entity\Patient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

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
            ->add('civilite', ChoiceType::class,[
                'choices'=>[
                    'femme'=>'f',
                    'homme'=>'h'
                ],
                'expanded'=>true
            ])
            ->add('MotifConsultation',TextType::class,[
                'mapped'=>false
            ] )
            ->add('message', TextareaType::class,[
                'mapped'=>false
            ])
            ->add('specialiste', ChoiceType::class,[
                'mapped'=>false,
                'choices'=>[
                    'Dr Alaniz Garcia - Odontologie intégrale'=>'Dr Alaniz Garcia',
                    'Dr Alaniz Garcia - Odontologie générale'=>'Dr Alaniz Garcia',
                    'Dra Alaniz Barrera - Endodontie'=>'Dr Alaniz Barrera',
                    'Dra Alaniz Paredes - Orthodontie, Orthopédie'=>'Dra Alaniz Paredes',
                    'Dra Alaniz Paredes - Periodontie, Implantologie'=>'Dra Alaniz Paredes',
                    'Dra Alaniz Paredes - Odonthopedriatrie, Orthopedie'=>'Dra Alaniz Paredes',
                    'Sra Barrera Velasquez - Secrétaire médicale'=>'Sra Barrera Velasquez'
                ]
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Patient::class,
        ]);
    }
}
