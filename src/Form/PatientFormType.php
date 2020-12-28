<?php

namespace App\Form;

use App\Entity\Patient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
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
<<<<<<< Updated upstream
        $builder
=======
       $this->medecin=$medecin ;
       
    }


    public function buildForm(FormBuilderInterface $builder, array $options )
    {

        $liste= $this->medecin->findAll();
        $array = [];
        foreach ($liste as $category) {
            if (!empty($category->getNom())) {
              
                $array[$category->getTitre().' '.$category->getPrenom().' '.$category->getNom()] = $category->getTitre().' '.$category->getPrenom() 
                .' '.$category->getNom() ;
                
                // dd($array);
                
                // dd($array);
           
               
            }
        }

        $builder->add('SelectMedecin',ChoiceType::class, array(
                            'choices' => $array,
                            'mapped'=> false))



>>>>>>> Stashed changes
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
            ->add('civilite', CheckboxType::class)
            ->add('MotifConsultation',TextType::class )
            ->add('message', TextareaType::class)
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Patient::class,
        ]);
    }
}
