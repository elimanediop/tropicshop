<?php

namespace App\Form;

use App\Entity\BonLivraison;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BonLivraisonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('typeLivraison', ChoiceType::class, [
                'choices' => [
                    'Choisir' => '',
                    'Standard' => BonLivraison::STANDARD,
                    'Express' => BonLivraison::EXPRESS
                ]])
            ->add('dateExpress',  DateTimeType::class, array(

            ))
            ->add('dateLivraison', ChoiceType::class, [
                'choices' => [
                    'Choisir' => '',
                    'Samedi 28/11 à 11h15' => '28/11/2020/11/15',
                    'Samedi 28/11 à 9h15' => '28/11/2020/09/15'
                ]])
            ->add('adresse', TextType::class,['error_bubbling' => true])
            ->add('codepostal', IntegerType::class)
            ->add('ville', TextType::class,['error_bubbling' => true])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BonLivraison::class,
        ]);
    }
}
