<?php

namespace App\Command;

use App\Entity\Produit;
use App\Entity\ProduitStore;
use App\Repository\OrigineRepository;
use App\Repository\ProduitRepository;
use App\Repository\ProduitStoreRepository;
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


class   LoadProductStoreCommand extends Command
{
    protected static $defaultName = 'load:product-store';
    private Utils $utils;
    private ObjectManager $manager;
    private ProduitRepository $produitRepository;
    private ProduitStoreRepository $produitStoreRepository;
    private OrigineRepository $origineRepository;
    private TypeProduitRepository $typeProduitRepository;
    private UserRepository $userRepository;

    /**
     * LoadProductStoreCommand constructor.
     * @param Utils $utils
     * @param ObjectManager $manager
     * @param ProduitRepository $produitRepository
     * @param ProduitStoreRepository $produitStoreRepository
     * @param OrigineRepository $origineRepository
     * @param TypeProduitRepository $typeProduitRepository
     * @param UserRepository $userRepository
     */
    public function __construct(Utils $utils, ObjectManager $manager, ProduitRepository $produitRepository, ProduitStoreRepository $produitStoreRepository, OrigineRepository $origineRepository, TypeProduitRepository $typeProduitRepository, UserRepository $userRepository)
    {
        $this->utils = $utils;
        $this->manager = $manager;
        $this->produitRepository = $produitRepository;
        $this->produitStoreRepository = $produitStoreRepository;
        $this->origineRepository = $origineRepository;
        $this->typeProduitRepository = $typeProduitRepository;
        $this->userRepository = $userRepository;
        parent::__construct();
    }


    protected function configure()
    {
        $this
            ->setDescription('Load product in a store from csv file')
            ->addArgument('id_store', InputArgument::REQUIRED, 'Id of store')
            ->addArgument('filename', InputArgument::REQUIRED, 'csv file name which content product store to load. Example: liste101-174.csv')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $id_store = $input->getArgument('id_store');
        $file_name = $input->getArgument('filename');

        $current_dir = __DIR__;
        $file_path = $current_dir."/../../Data/product_store/".$file_name;
        if ($id_store && $file_path) {
            $io->note(sprintf('You passed two arguments : %s | %s', $id_store, $file_name));
        }
        if(file_exists($file_path)){
            $csv_data = $this->utils->getCSVContent($file_path);
        }else{
            $io->error(sprintf('File : %s does not exist', $file_path));
            return 0;
        }


        //dd($csv_data);

        foreach ($csv_data as $data){
            $this->addProduct($data, $id_store, $io);
        }


        $io->success('All product store are loading !');

        return 0;
    }

    private function addProduct($data, $id, SymfonyStyle $io){
        /**
         * @var ProduitStore $produitstore
         */
        $produitstore = new ProduitStore();
        /**
         * @var Produit[] $produit
         */
        $produit = $this->produitRepository->findByNameLike($data["nom"]);


        //dd(($data["nom"]));
        if(count($produit) > 0){
            var_dump($data["nom"]);

            //dd($produit);
            //print_r($produit);
            //$io->note("Product found : %s ", $data["nom"]);
        }

        //$this->manager->persist($produitstore);
        //$this->manager->flush();
    }
}
