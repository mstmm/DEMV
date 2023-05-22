<?php

namespace App\Command;

use App\Entity\Makler;
use App\Entity\Vermittlernummer;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Doctrine\ORM\EntityManagerInterface;

#[AsCommand(
    name: 'app:suche-makler',
    description: 'Sucht einen Makler anhand einer Vermittlernummer',
    hidden: false,
    aliases: ['app:makler-suche']
)]
class SucheMaklerCommand extends Command
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $vermittlernummer = $input->getArgument('Vermittlernummer');
        $Versicherung = $input->getArgument('Versicherung');
        $normalized = preg_replace("/^0+|0+$|-+|\/+|^\d*\/|R/", '', $vermittlernummer);
        $em = $this->entityManager;
        $repository = $em->getRepository(Vermittlernummer::class);
        $makler = $repository->getMaklerInfo($Versicherung, $normalized);

        if (!empty($makler)) {
            $lines = [
                '',
                'Makler: ' . $makler,
                '===========================',
                '',
            ];
        } else {
            $lines = [
                '',
                'Es wurde kein Makler gefunden',
                '===========================',
                '',
            ];
        }

        $output->writeln($lines);

        return Command::SUCCESS;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('Vermittlernummer', InputArgument::REQUIRED, 'Die Vermittlernummer des Maklers')
            ->addArgument('Versicherung', InputArgument::REQUIRED, 'Die Versicherung zu der gesucht werden soll')
        ;
    }
}