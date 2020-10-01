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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("nom", TextType::class, ["disabled" => true])
            ->add('prix')

            ->add('taille', NumberType::class, ['error_bubbling' => true])

            ->add('type_vente', ChoiceType::class, [
                'choices' => [
                        'Au kilogramme (Kg)' => "Au kilogramme (Kg)",
                        'Au gramme (g)' => 'Au gramme (g)',
                        'Au litre (l)' => 'Au litre (l)',
                        'Au centilitre (cl)' => 'Au centilitre (cl)',
                        'Au millilitre (ml)' => 'Au millilitre (ml)'
                    ]])
            ->add('origine', EntityType::class, ["class" => Origine::class, 'choice_label' => 'country'])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
