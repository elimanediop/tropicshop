<?php

namespace App\Form;

use App\Entity\Origine;
use App\Entity\ProduitStore;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateProductStoreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('produit', ProduitType::class)
            ->add('type_vente', ChoiceType::class, [
                'choices' => [
                    'Au kilogramme (Kg)' => "Au kilogramme (Kg)",
                    'Au gramme (g)' => 'Au gramme (g)',
                    'Au litre (l)' => 'Au litre (l)',
                    'Au centilitre (cl)' => 'Au centilitre (cl)',
                    'Au millilitre (ml)' => 'Au millilitre (ml)'
                ]])
            ->add('origine', EntityType::class, ["class" => Origine::class, 'choice_label' => 'country'])
            ->add('mesure')
            ->add('prix')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProduitStore::class,
        ]);
    }
}
