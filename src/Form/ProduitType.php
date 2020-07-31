<?php

namespace App\Form;

use App\Entity\Origine;
use App\Entity\Produit;
use App\Entity\TypeProduit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prix')
            ->add('origine', EntityType::class, ["class" => Origine::class, 'choice_label' => 'country'])
            ;
        //$builder
          //  ->add('imagesproduit', FileType::class, ['required'=>false])
        //->add('nom')
        //->add('description')
        //->add('typeproduit', EntityType::class, ["class" => TypeProduit::class, 'choice_label' => 'libelle']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
