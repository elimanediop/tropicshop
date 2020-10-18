<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use App\Entity\User;
use App\Entity\Origine;
use App\Entity\TypeProduit;
use App\Entity\FiltreProduit;

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
                'multiple'=>true
            ])
            ->add('typeProduits',EntityType::class,[
                'required'=>false,
                'choice_label'=>'libelle',
                'label'=>false,
                'class'=>TypeProduit::Class,
                'multiple'=>true,  
            ])
            ->add('store',EntityType::class,[
                'required'=>false,
                'choice_label'=>'nommagasin',
                'label'=>false,
                'class'=>User::Class,
                'multiple'=>true,  
            ])
            ->add('typeVente',ChoiceType::class,[
                'choices' => [
                    'selectionnez un ou plusieurs'=>0,
                    'Au kilo'=>1,
                    'par pièce'=>2
                ],
                'multiple'=>true,
                'label'=>false,
                'required'=> false
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
