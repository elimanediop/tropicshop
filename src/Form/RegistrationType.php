<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('role', ChoiceType::class, [
                'choices' => [
                        'Client ou Vendeur' => '',
                        'Client' => 'ROLE_CLIENT',
                        'Vendeur' => 'ROLE_STORE'
                    ]]);
        $builder
            ->add('nom', TextType::class,['error_bubbling' => true])
            ->add('prenom', TextType::class,['error_bubbling' => true])
            ->add('mail', EmailType::class, ['error_bubbling' => true])
            ->add('confirm_mail', EmailType::class, ['error_bubbling' => true])
            ->add('tel', TextType::class, ['error_bubbling' => true])
            ->add('adresse', TextType::class)
            ->add('codepostal', IntegerType::class)
            ->add('nommagasin', TextType::class,['error_bubbling' => true])
            ->add('siret', TextType::class,['error_bubbling' => true])
            ->add('tva', TextType::class,['error_bubbling' => true])
            ->add('ville', TextType::class)
            ->add('password', PasswordType::class, ['error_bubbling' => true])
            ->add('confirm_password', PasswordType::class, ['error_bubbling' => true])
            ->add('lat', HiddenType::class, ['attr' => ["data-lat" =>"lat"], 'error_bubbling' => true])
            ->add('lon',HiddenType::class, ['attr' => ["data-lon" =>"lon"]]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
