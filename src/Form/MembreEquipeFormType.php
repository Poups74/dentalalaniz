<?php

namespace App\Form;

use App\Entity\MembreEquipe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class MembreEquipeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('civilite')
            ->add('titre')
            ->add('nom')
            ->add('prenom')
            ->add('metier')
            ->add('specialite')
            ->add('description_metier',TextareaType::class,[
                'constraints'=> [
                    new Length([
                        'max'=> 1000,
                        'maxMessage'=>'Le nom ne peut comporter plus de {{limit}}caractères.'
                        ])
                    
                        ]
                    ] )
            ->add('experience')
            ->add('formation')
            ->add('image',FileType::class,array('data_class' => null,'required' => false,'label'=>'Inserez une photo'));
               
    }

  
    






   

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MembreEquipe::class,
        ]);
    }
}
