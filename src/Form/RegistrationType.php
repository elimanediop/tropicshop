<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
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
            ->add('nom')
            ->add('prenom')
            ->add('mail', EmailType::class)
            ->add('tel', TextType::class)
            ->add('adresse', TextType::class)
            ->add('codepostal', IntegerType::class)
            ->add('nommagasin', TextType::class)
            ->add('siret', TextType::class)
            ->add('tva', TextType::class)
            ->add('ville', TextType::class)
            ->add('password', PasswordType::class)
            ->add('confirm_password', PasswordType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
