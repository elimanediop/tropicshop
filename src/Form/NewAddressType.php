<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class NewAddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('adresse', TextType::class)
        ->add('adresse_complete', HiddenType::class, ['attr' => ["data-complete-address" =>"address"]])
        ->add('codepostal', IntegerType::class)
        ->add('ville', TextType::class)
        ->add('lat', HiddenType::class, ['attr' => ["data-lat" =>"lat"], 'error_bubbling' => true])
        ->add('lon', HiddenType::class, ['attr' => ["data-lon" =>"lon"], 'error_bubbling' => true]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
