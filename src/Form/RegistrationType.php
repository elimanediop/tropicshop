<?php

namespace App\Form;

use App\Entity\Client;
use phpDocumentor\Reflection\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cli_nom')
            ->add('cli_prenom')
            ->add('cli_mail')
            ->add('cli_tel')
            ->add('cli_mdp', PasswordType::class)
            ->add('cli_confirm_mdp', PasswordType::class)


        ;
        $builder->add('cli_adresse', AddressType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
