<?php

namespace App\Form;

use App\Entity\ProduitStore;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitStoreType extends AbstractType
{
    /**
     * @var ProduitStore
     */
    private $produitStore;


    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->produitStore = $builder->getData();
        //dd($this->produitStore->getTypevente());
        $builder->add('produit', ProduitType::class);
        $builder
            ->add('mesure')
            ->add('prix')
            ->add('typevente', ChoiceType::class, [
                'choices' => [
                    'Au Kilogramme (kg)' => 'Au Kilogramme (kg)',
                    'Au gramme (g)' => 'Au gramme (g)',
                    'Au milligramme (mg)' => 'Au milligramme (mg)',
                    'Au litre (l)' => 'Au litre (l)',
                    'Au décilitre (dl)' => 'Au décilitre (dl)',
                    'Au centilitre (cl)' => 'Au centilitre (cl)',
                    'Au millilitre (ml)' => 'Au millilitre (ml)',
                    'Variable' => 'Variable',
                    'Pièce' => 'Pièce'
                ],
                'data' => $this->produitStore->getTypevente()

            ]);
       $builder ->add('origine', OrigineType::class);
    }



    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProduitStore::class,
        ]);
    }
}
