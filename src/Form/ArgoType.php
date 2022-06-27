<?php

namespace App\Form;

use App\Entity\Argo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ArgoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class,[
                'label' => 'Nom de l\'argonaute :',
                'required' => true, 
                'attr' => [
                    'placeholder' =>"Charalampos", 
                ], 
                'constraints' => [
                    new Length([
                        'min' => 5, 
                        'max' => 50, 
                        'minMessage' => "Nom trop court (min 5 caractères)", 
                        'maxMessage' => "Nom trop long (max 50 caractères)"
                    ]), 
                    New NotBlank([
                        'message' => "Merci de saisir un nom."
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Argo::class,
        ]);
    }
}
