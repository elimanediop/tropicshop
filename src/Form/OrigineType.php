<?php

namespace App\Form;

use App\Entity\Origine;
use App\Repository\OrigineRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrigineType extends AbstractType
{
    /**
     * @var Origine[]
     */
    private $origines;
    /**
     * @var OrigineRepository
     */
    private $origineRepository;
    /**
     * @var Origine
     */
    private $origine;

    /**
     * ProduitStoreType constructor.
     */
    public function __construct(OrigineRepository $origineRepository)
    {
        $this->origineRepository = $origineRepository;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->origine = $builder->getData();
        $builder
            ->add('country', ChoiceType::class,
                [
                    'choices' => $this->origineList(),
                ]);
    }

    private function origineList(){
        $labelList = [];
        $this->origines = $this->origineRepository->findAll();
        foreach ($this->origines as $origine){
            $labelList[] = [$origine->getCountry() => $origine->getCountry()];
        }
        return $labelList;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Origine::class,
        ]);
    }
}
