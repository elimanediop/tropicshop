<?php

namespace App\Command;

use App\Entity\Produit;
use App\Entity\ProduitStore;
use App\Repository\OrigineRepository;
use App\Repository\ProduitRepository;
use App\Repository\TypeProduitRepository;
use App\Repository\UserRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Services\Utils\Utils;

class LoadProductCommand extends Command
{
    protected static $defaultName = 'load:product';
    private $utils;
    private $manager;
    private $produitRepository;
    private $origineRepository;
    private $typeProduitRepository;
    private $userRepository;

    /**
     * LoadProductCommand constructor.
     * @param $utils
     */
    public function __construct(ObjectManager $manager, UserRepository $userRepository, Utils $utils, ProduitRepository $produitRepository, OrigineRepository $origineRepository, TypeProduitRepository $typeProduitRepository)
    {
        $this->utils = $utils;
        $this->produitRepository = $produitRepository;
        $this->manager = $manager;
        $this->origineRepository = $origineRepository;
        $this->typeProduitRepository = $typeProduitRepository;
        $this->userRepository = $userRepository;
        parent::__construct();
    }


    protected function configure()
    {
        $this
            ->setDescription('Load product from csv file')
            ->addArgument('csvname', InputArgument::OPTIONAL, 'name of product plug')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $current_dir = __DIR__;
        $file_path = $current_dir."/../../Data/product/liste101-174.csv";
        $csv_data = $this->utils->getCSVContent($file_path);

        foreach ($csv_data as $data){
            $this->addProduct($data);
        }

        //$csvname = $input->getArgument('csvname');

        $io->success(sprintf("You're load %s product template in database.", count($csv_data)));

        return 0;
    }

    private function addProduct($data){
        $produit = new Produit();
        //dd($data);
        $produit->setImages($data["num_image"].'.jpg')
            ->setNom($data["nom_produit"])
            ->setDescription($data["description"])
            ->setTypeproduit($this->typeProduitRepository->findOneBy(["libelle" => $data["type_produit"]]))
            ->setOrigine($this->origineRepository->findOneBy(["country" => $data["origine"]]))
            ->setTypevente($data["vente"])
            ->setPrix(0)
            ->setIsdefault(true)
            ->setStore($this->userRepository->find(1)) //TODO add admin user
        ;
        $this->manager->persist($produit);
        $this->manager->flush();
    }
}
