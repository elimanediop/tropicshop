<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use App\Entity\User;
use App\Entity\Origine;
use App\Entity\TypeProduit;
use App\Entity\FiltreProduit;
use App\Entity\TypeVente;

class FiltreProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('origine',EntityType::class,[
                'required'=>false,
                'label'=>false,
                'class'=>Origine::Class,
                'choice_label'=>'country',
                'attr'=>[
                    'class'=>'SlectBox form-control',
                    'placeholder'=>'Selectionnez origines'
                ],
                'multiple'=>true
            ])
            ->add('typeProduits',EntityType::class,[
                'required'=>false,
                'choice_label'=>'libelle',
                'label'=>false,
                'attr'=>[
                    'class'=>'SlectBox form-control',
                    'placeholder'=>'Selectionnez catégories'
                ],
                'class'=>TypeProduit::Class,
                'multiple'=>true,  
            ])
            ->add('prixInf',TextType::class,[ 
                'required'=>false,
                'label'=>false, 
                'attr'=>[
                    'class'=>'prix form-control',

                ],  
            ])
             ->add('prixSup',TextType::class,[
                'required'=>false,
                'label'=>false, 
                'attr'=>[
                    'class'=>'prix form-control',
                    
                ], 
            ])
            ->add('recherche',HiddenType::class,[
                'required'=>false,
                'label'=>false,  
            ])
            /*->add('store',EntityType::class,[
                'required'=>false,
                'choice_label'=>'nommagasin',
                'label'=>false,
                'class'=>User::Class,
                'multiple'=>true,  
            ])*/
            ->add('typeVente',EntityType::class,[
                'required'=>false,
                'choice_label'=>'libelle',
                'label'=>false,
                'attr'=>[
                    'class'=>'SlectBox form-control',
                    'placeholder'=>'Selectionnez tye de vente'
                ],
                'class'=>TypeVente::Class,
                'multiple'=>true, 
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FiltreProduit::class,
            'method'=>'GET',
            'csrf_protection'=>false
        ]);
    }

    public function getBlockPrefix(){
        return "";
    }
}
