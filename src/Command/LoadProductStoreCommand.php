<?php

namespace App\Command;

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
            ->addArgument('file', InputArgument::REQUIRED, 'Absolute Path of csv file which content product store to load')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $id_store = $input->getArgument('id_store');
        $file_path = $input->getArgument('file');

        if ($id_store && $file_path) {
            $io->note(sprintf('You passed an argument: %s', $id_store));
        }



        $io->success('All product store are loading !');

        return 0;
    }
}
